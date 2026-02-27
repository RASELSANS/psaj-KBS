<?php echo $this->extend('admin/layout'); ?>

<?php echo $this->section('admin_content'); ?>

<div class="page-header">
    <h1>Galeri Foto</h1>
    <p>Kelola foto dan gambar untuk portal</p>
</div>

<div class="data-card">
    <div class="data-card-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2>Unggah Foto Baru</h2>
    </div>

    <!-- Upload Form -->
    <form id="uploadForm" enctype="multipart/form-data" style="margin-bottom: 40px;">
        <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border: 2px dashed #dee2e6; border-radius: 20px; padding: 40px; text-align: center; cursor: pointer; transition: all 0.3s ease;" id="dropZone">
            <div style="margin-bottom: 16px;">
                <i class="fas fa-cloud-upload-alt" style="font-size: 48px; color: #ff8a3d;"></i>
            </div>
            <h3 style="color: #1a1a1a; margin: 8px 0; font-size: 18px;">Klik atau seret foto ke sini</h3>
            <p style="color: #666; font-size: 14px; margin: 8px 0 0 0;">
                JPG, PNG, GIF atau WebP • Maksimal 5MB
            </p>
            <input type="file" id="imageInput" name="image" accept="image/jpeg,image/png,image/gif,image/webp" style="display: none;">
        </div>
    </form>

    <!-- Loading Alert -->
    <div id="uploadAlert" style="display: none; margin-bottom: 20px;"></div>

    <!-- Image Grid -->
    <div style="margin-top: 40px;">
        <h2 style="color: #1a1a1a; margin-bottom: 20px;">Daftar Foto</h2>
        <div id="imageGallery" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; min-height: 200px;">
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #999;">
                <i class="fas fa-spinner fa-spin" style="font-size: 32px; margin-bottom: 16px;"></i>
                <p>Memuat foto...</p>
            </div>
        </div>
        <div id="emptyState" style="display: none; grid-column: 1 / -1; text-align: center; padding: 40px;">
            <i class="fas fa-image" style="font-size: 48px; color: #ddd; margin-bottom: 16px;"></i>
            <p style="color: #999; font-size: 16px;">Belum ada foto di galeri</p>
            <p style="color: #ccc; font-size: 14px;">Unggah foto pertama Anda untuk memulai</p>
        </div>
    </div>
</div>

<style>
    #dropZone:hover {
        background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
        border-color: #ff8a3d;
    }

    .image-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .image-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        transform: translateY(-4px);
    }

    .image-container {
        width: 100%;
        height: 200px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-info {
        padding: 12px;
        background: white;
    }

    .image-name {
        font-size: 12px;
        color: #1a1a1a;
        word-break: break-all;
        margin-bottom: 4px;
        max-height: 36px;
        overflow: hidden;
    }

    .image-size {
        font-size: 11px;
        color: #999;
        margin-bottom: 8px;
    }

    .image-actions {
        display: flex;
        gap: 8px;
    }

    .image-actions button {
        flex: 1;
        padding: 6px 8px;
        border: none;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-view {
        background: #2196F3;
        color: white;
    }

    .btn-view:hover {
        background: #1976D2;
    }

    .btn-delete {
        background: #e74c3c;
        color: white;
    }

    .btn-delete:hover {
        background: #c0392b;
    }

    .btn-delete:disabled {
        background: #bdc3c7;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        #imageGallery {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 16px;
        }
    }

    @media (max-width: 576px) {
        #imageGallery {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 12px;
        }

        .image-container {
            height: 120px;
        }
    }
</style>

<script>
    const API_URL = '<?php echo base_url('api/admin'); ?>';
    let isUploading = false;
    let isDeletingFile = null;

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadGalleryImages();
        initializeUploadForm();
    });

    /**
     * Load all gallery images
     */
    async function loadGalleryImages() {
        try {
            const response = await fetch(`${API_URL}/gallery/list`, {credentials: 'include'});
            const text = await response.text();
            
            let result;
            try {
                result = JSON.parse(text);
            } catch (e) {
                throw new Error(`Invalid JSON (${response.status}): ${text.substring(0, 200)}`);
            }

            if (result.success) {
                renderGallery(result.data);
            } else {
                showAlert(result.message || 'Error loading images', 'danger');
            }
        } catch (error) {
            console.error('loadGalleryImages Error:', error);
            console.error('Error message:', error.message);
            showAlert('Error loading images: ' + error.message, 'danger');
        }
    }

    /**
     * Render gallery grid
     */
    function renderGallery(images) {
        const gallery = document.getElementById('imageGallery');
        const emptyState = document.getElementById('emptyState');

        if (images.length === 0) {
            gallery.innerHTML = '';
            gallery.style.display = 'none';
            emptyState.style.display = 'block';
            return;
        }

        emptyState.style.display = 'none';
        gallery.style.display = 'grid';

        gallery.innerHTML = images.map(image => `
            <div class="image-card">
                <div class="image-container">
                    <img src="${image.url}" alt="${image.filename}" loading="lazy">
                </div>
                <div class="image-info">
                    <div class="image-name" title="${image.filename}">${image.filename}</div>
                    <div class="image-size">${formatFileSize(image.size)}</div>
                    <div class="image-date" style="font-size: 10px; color: #ccc; margin-bottom: 8px;">${image.date_formatted}</div>
                    <div class="image-actions">
                        <button class="btn-view" onclick="viewImage('${image.url}')">
                            <i class="fas fa-eye"></i> Lihat
                        </button>
                        <button class="btn-delete" onclick="deleteImage('${image.filename}')" ${isDeletingFile === image.filename ? 'disabled' : ''}>
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        `).join('');
    }

    /**
     * Initialize upload form
     */
    function initializeUploadForm() {
        const dropZone = document.getElementById('dropZone');
        const imageInput = document.getElementById('imageInput');

        // Click to upload
        dropZone.addEventListener('click', () => imageInput.click());

        // File selected
        imageInput.addEventListener('change', handleFileSelect);

        // Drag and drop
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.style.borderColor = '#ff8a3d';
            dropZone.style.background = 'linear-gradient(135deg, #ffe8d3 0%, #ffd9b3 100%)';
        });

        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.style.borderColor = '#dee2e6';
            dropZone.style.background = 'linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%)';
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.style.borderColor = '#dee2e6';
            dropZone.style.background = 'linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%)';

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                imageInput.files = files;
                handleFileSelect({ target: { files } });
            }
        });
    }

    /**
     * Handle file selection
     */
    async function handleFileSelect(event) {
        const files = event.target.files;
        if (files.length === 0) return;

        const file = files[0];

        // Validate file
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            showAlert('Tipe file tidak valid. Hanya JPG, PNG, GIF, WebP yang diizinkan', 'warning');
            return;
        }

        if (file.size > 5242880) {
            showAlert('File terlalu besar. Maksimal 5MB', 'warning');
            return;
        }

        await uploadImage(file);
    }

    /**
     * Upload image to server
     */
    async function uploadImage(file) {
        if (isUploading) return;

        isUploading = true;
        const uploadBtn = document.querySelector('[name="image"]').parentElement;
        const formData = new FormData();
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
        formData.append('image', file);

        showAlert('Mengunggah foto...', 'info');

        try {
            const response = await fetch(`${API_URL}/gallery/upload`, {
                method: 'POST',
                body: formData,
                credentials: 'include'
            });
            const text = await response.text();
            
            let result;
            try {
                result = JSON.parse(text);
            } catch (e) {
                throw new Error(`Invalid JSON (${response.status}): ${text.substring(0, 200)}`);
            }

            if (result.success) {
                showAlert('Foto berhasil diunggah', 'success');
                document.getElementById('imageInput').value = '';
                loadGalleryImages();
            } else {
                showAlert(result.message || 'Upload gagal', 'danger');
            }
        } catch (error) {
            console.error('uploadImage Error:', error);
            console.error('Error message:', error.message);
            showAlert('Error upload: ' + error.message, 'danger');
        } finally {
            isUploading = false;
        }
    }

    /**
     * Delete image
     */
    async function deleteImage(filename) {
        confirmDelete('foto', async () => {
            isDeletingFile = filename;
            showAlert('Menghapus foto...', 'info');

            try {
                const params = new URLSearchParams();
                params.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                const response = await fetch(`${API_URL}/gallery/delete/${filename}`, {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: params,
                    credentials: 'include'
                });

                const text = await response.text();
                
                let result;
                try {
                    result = JSON.parse(text);
                } catch (e) {
                    throw new Error(`Invalid JSON (${response.status}): ${text.substring(0, 200)}`);
                }

                if (result.success) {
                    showAlert('Foto berhasil dihapus', 'success');
                    loadGalleryImages();
                } else {
                    showAlert(result.message || 'Hapus gagal', 'danger');
                }
            } catch (error) {
                console.error('deleteImage Error:', error);
                console.error('Error message:', error.message);
                showAlert('Error menghapus foto: ' + error.message, 'danger');
            } finally {
                isDeletingFile = null;
            }
        });
    }

    /**
     * View image in modal
     */
    function viewImage(url) {
        // Create modal
        const modal = document.createElement('div');
        modal.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease;
        `;

        modal.innerHTML = `
            <div style="position: relative; max-width: 90vw; max-height: 90vh;">
                <img src="${url}" style="width: 100%; height: 100%; object-fit: contain;">
                <button onclick="this.parentElement.parentElement.remove()" style="
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    width: 40px;
                    height: 40px;
                    background: #fff;
                    border: none;
                    border-radius: 50%;
                    cursor: pointer;
                    font-size: 20px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #1a1a1a;
                    transition: all 0.3s ease;
                ">✕</button>
            </div>
        `;

        document.body.appendChild(modal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) modal.remove();
        });
    }

    /**
     * Format file size
     */
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round((bytes / Math.pow(k, i)) * 100) / 100 + ' ' + sizes[i];
    }

    /**
     * Show alert
     */
    function showAlert(message, type = 'info') {
        const alertDiv = document.getElementById('uploadAlert');
        const bgColor = {
            'success': '#d4edda',
            'danger': '#f8d7da',
            'warning': '#fff3cd',
            'info': '#d1ecf1'
        }[type];
        const textColor = {
            'success': '#155724',
            'danger': '#721c24',
            'warning': '#856404',
            'info': '#0c5460'
        }[type];
        const borderColor = {
            'success': '#c3e6cb',
            'danger': '#f5c6cb',
            'warning': '#ffeaa7',
            'info': '#bee5eb'
        }[type];

        alertDiv.style.cssText = `
            background: ${bgColor};
            color: ${textColor};
            border: 1px solid ${borderColor};
            padding: 12px 16px;
            border-radius: 8px;
            display: block;
        `;
        alertDiv.innerHTML = message;

        // Auto-hide success after 3 seconds
        if (type === 'success') {
            setTimeout(() => {
                alertDiv.style.display = 'none';
            }, 3000);
        }
    }
</script>

<?php echo $this->endSection(); ?>
