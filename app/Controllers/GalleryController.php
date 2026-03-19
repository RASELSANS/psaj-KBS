<?php

namespace App\Controllers;

use App\Controllers\Admin\AdminController;

class GalleryController extends AdminController
{
    protected $helpers = ['form'];
    private $uploadPath = 'public/uploads/gallery/';

    public function __construct()
    {
        parent::__construct();
        // Ensure upload directory exists
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
    }

    public function index()
    {
        return view('admin/gallery');
    }

    /**
     * Get all gallery images from all subfolders in uploads/
     * Returns JSON array of images
     */
    public function listImages()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        try {
            $images = [];
            $baseDir = FCPATH . 'uploads/';

            if (is_dir($baseDir)) {
                // Recursively scan all subdirectories
                $images = $this->scanImagesRecursive($baseDir, $baseDir);
            }

            // Sort by date DESC (newest first)
            usort($images, function($a, $b) {
                return $b['date'] <=> $a['date'];
            });

            return $this->response->setJSON([
                'success' => true,
                'data' => $images,
                'total' => count($images)
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error loading images: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Recursively scan directory for images
     */
    private function scanImagesRecursive($dir, $baseDir)
    {
        $images = [];
        
        if (!is_dir($dir)) {
            return $images;
        }

        $items = array_diff(scandir($dir), array('.', '..'));
        
        foreach ($items as $item) {
            $fullPath = $dir . $item;
            
            if (is_dir($fullPath)) {
                // Recursively scan subdirectory
                $subImages = $this->scanImagesRecursive($fullPath . '/', $baseDir);
                $images = array_merge($images, $subImages);
            } elseif (is_file($fullPath) && $this->isImageFile($fullPath)) {
                // Get relative path from uploads folder
                $relativePath = str_replace($baseDir, '', $fullPath);
                $relativePath = str_replace('\\', '/', $relativePath); // Windows compatibility
                
                // Get folder name for display
                $folderPath = dirname($relativePath);
                $folderName = $folderPath === '.' ? 'Root' : ucfirst(basename($folderPath));
                
                $images[] = [
                    'filename' => basename($fullPath),
                    'folder' => $folderName,
                    'relative_path' => $relativePath,
                    'url' => base_url('uploads/' . $relativePath),
                    'size' => filesize($fullPath),
                    'date' => filemtime($fullPath),
                    'date_formatted' => date('d/m/Y H:i', filemtime($fullPath))
                ];
            }
        }
        
        return $images;
    }

    /**
     * Upload new image
     */
    public function upload()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        try {
            // Check if file exists in request
            if (!$this->request->getFile('image')) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No file uploaded'
                ], 400);
            }

            $file = $this->request->getFile('image');

            // Validate file
            if (!$file->isValid()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'File upload failed: ' . $file->getErrorString()
                ], 400);
            }

            // Check file type
            $mimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($file->getMimeType(), $mimes)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid file type. Only JPG, PNG, GIF, WebP allowed'
                ], 400);
            }

            // Check file size (max 5MB)
            if ($file->getSize() > 5242880) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'File too large. Maximum 5MB allowed'
                ], 400);
            }

            // Generate unique filename
            $originalName = $file->getClientName();
            $newName = time() . '_' . $this->sanitizeFilename($originalName);

            // Move file to uploads directory
            $dir = FCPATH . 'uploads/gallery/';
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            $file->move($dir, $newName);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'data' => [
                    'filename' => $newName,
                    'url' => base_url('uploads/gallery/' . $newName),
                    'size' => filesize($dir . $newName),
                    'date_formatted' => date('d/m/Y H:i')
                ]
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Upload error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete image
     */
    public function delete()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        try {
            $relativePath = $this->request->getPost('path');
            
            if (!$relativePath) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Path required'
                ], 400);
            }
            
            // Security: prevent directory traversal
            $relativePath = str_replace(['../', '..\\'], '', $relativePath);
            $relativePath = str_replace('\\', '/', $relativePath);
            
            $filePath = FCPATH . 'uploads/' . $relativePath;

            if (!file_exists($filePath)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'File not found'
                ], 404);
            }

            if (!is_file($filePath)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Path is not a file'
                ], 400);
            }

            if (!$this->isImageFile($filePath)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid file type'
                ], 400);
            }

            if (unlink($filePath)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Image deleted successfully'
                ]);
            }

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to delete image'
            ], 500);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Delete error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if file is a valid image
     */
    private function isImageFile($filePath)
    {
        // Check file extension first
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        
        if (!in_array($extension, $validExtensions)) {
            log_message('debug', 'isImageFile - Invalid extension: ' . $extension);
            return false;
        }
        
        // Check MIME type
        $validMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        
        // Try to get MIME type
        if (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            if ($finfo) {
                $mimeType = finfo_file($finfo, $filePath);
                finfo_close($finfo);
                
                if ($mimeType && in_array($mimeType, $validMimes)) {
                    return true;
                }
                log_message('debug', 'isImageFile - Invalid MIME type: ' . $mimeType);
            }
        }
        
        // Fallback: if finfo not available, trust the extension
        return true;
    }

    /**
     * Sanitize filename
     */
    private function sanitizeFilename($filename)
    {
        // Remove special characters
        $filename = preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
        // Remove multiple dots
        $filename = preg_replace('/\.+/', '.', $filename);
        return $filename;
    }
}
