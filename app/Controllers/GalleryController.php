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
     * Get all gallery images
     * Returns JSON array of images
     */
    public function listImages()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        try {
            $images = [];
            $dir = FCPATH . 'uploads/gallery/';

            if (is_dir($dir)) {
                $files = array_diff(scandir($dir), array('.', '..'));
                
                foreach ($files as $file) {
                    $filePath = $dir . $file;
                    
                    // Only include image files
                    if (is_file($filePath) && $this->isImageFile($filePath)) {
                        $images[] = [
                            'filename' => $file,
                            'url' => base_url('uploads/gallery/' . $file),
                            'size' => filesize($filePath),
                            'date' => filemtime($filePath),
                            'date_formatted' => date('d/m/Y H:i', filemtime($filePath))
                        ];
                    }
                }
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
    public function delete($filename = null)
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        try {
            if (!$filename) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Filename required'
                ], 400);
            }

            // Sanitize filename to prevent path traversal
            $filename = basename($filename);
            $filePath = FCPATH . 'uploads/gallery/' . $filename;

            // Check if file exists
            if (!file_exists($filePath)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'File not found'
                ], 404);
            }

            // Check if it's actually an image
            if (!$this->isImageFile($filePath)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid file'
                ], 400);
            }

            // Delete file
            if (unlink($filePath)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Image deleted successfully'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to delete image'
                ], 500);
            }
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
        $validMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $filePath);
        finfo_close($finfo);
        
        return in_array($mimeType, $validMimes);
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
