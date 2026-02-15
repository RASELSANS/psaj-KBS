<?= $this->extend('admin/new_layout'); ?>

<?= $this->section('admin_content'); ?>

<!-- Page Header -->
<div class="page-header" style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 class="page-title" style="margin: 0;">
            <i class="fas fa-newspaper"></i> <span id="pageTitle">Buat Artikel Baru</span>
        </h1>
        <p style="color: #999; margin: 0.5rem 0 0 0;">Tulis dan publikasikan artikel baru ke portal</p>
    </div>
    <a href="/admin/artikel" class="btn-action" style="text-decoration: none; padding: 0.75rem 1.5rem;">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="data-card">
    <div id="alertContainer"></div>

    <form id="artikelForm" enctype="multipart/form-data" onsubmit="saveArtikel(event)" style="max-width: none;">
        <div style="padding: 1.5rem; border-bottom: 1px solid #f0f0f0;">
            <!-- Judul -->
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label" style="font-weight: 600; margin-bottom: 0.5rem;">
                    <i class="fas fa-heading" style="color: #ff8a3d;"></i> Judul Artikel *
                </label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="judul" 
                    placeholder="Masukkan judul artikel yang menarik..."
                    required
                    style="font-size: 1rem; padding: 0.75rem;"
                >
                <small style="color: #999; margin-top: 0.25rem; display: block;">Minimal 5 karakter, maksimal 200 karakter</small>
            </div>

            <!-- Thumbnail -->
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label" style="font-weight: 600; margin-bottom: 0.5rem;">
                    <i class="fas fa-image" style="color: #ff8a3d;"></i> Thumbnail (Gambar Utama)
                </label>
                <div style="display: flex; gap: 1rem; align-items: flex-start;">
                    <div style="flex: 1;">
                        <input 
                            type="file" 
                            class="form-control" 
                            id="thumbnail" 
                            accept="image/jpeg,image/png,image/gif"
                            onchange="previewThumbnail(event)"
                        >
                        <small style="color: #999; margin-top: 0.25rem; display: block;">JPG, PNG, GIF • Max 2MB • Minimum 400x300px rekomendasi 800x600px</small>
                    </div>
                    <img id="thumbnailPreview" src="" alt="Preview" style="width: 120px; height: 120px; border-radius: 8px; object-fit: cover; display: none; border: 2px solid #f0f0f0;">
                </div>
            </div>

            <!-- Tanggal Publish -->
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label" style="font-weight: 600; margin-bottom: 0.5rem;">
                    <i class="fas fa-calendar-alt" style="color: #ff8a3d;"></i> Tanggal Publikasi *
                </label>
                <input 
                    type="date" 
                    class="form-control" 
                    id="tanggalPublish" 
                    required
                    style="max-width: 250px;"
                >
            </div>
        </div>

        <!-- Isi Artikel -->
        <div style="padding: 1.5rem; border-bottom: 1px solid #f0f0f0;">
            <label class="form-label" style="font-weight: 600; margin-bottom: 0.5rem; display: block;">
                <i class="fas fa-pen" style="color: #ff8a3d;"></i> Konten Artikel *
            </label>
            <div style="background: #f8f9fa; border: 2px dashed #e9ecef; border-radius: 8px; overflow: hidden;">
                <textarea 
                    class="form-control" 
                    id="isi" 
                    placeholder="Tulis konten artikel di sini... Minimal 50 karakter."
                    required
                    style="min-height: 400px; border: none; background: #f8f9fa; padding: 1rem; font-family: 'Courier New', monospace; font-size: 0.95rem; resize: vertical;"
                ></textarea>
            </div>
            <small style="color: #999; margin-top: 0.5rem; display: block;">
                <i class="fas fa-info-circle"></i> Gunakan spasi kosong untuk paragraf baru. Styling dasar HTML didukung.
            </small>
        </div>

        <!-- Form Footer -->
        <div style="padding: 1.5rem; display: flex; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
            <div>
                <a href="/admin/artikel" class="btn-action" style="text-decoration: none; padding: 0.75rem 1.5rem; display: inline-block;">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
            <div style="display: flex; gap: 1rem;">
                <button type="button" class="btn-action" onclick="saveDraft()" style="padding: 0.75rem 1.5rem;">
                    <i class="fas fa-save"></i> Simpan Sebagai Draft
                </button>
                <button type="submit" class="btn-add" style="padding: 0.75rem 1.5rem;">
                    <i class="fas fa-rocket"></i> <span id="submitBtnText">Publikasikan</span>
                </button>
            </div>
        </div>

        <input type="hidden" id="artikelID">
    </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('admin_scripts'); ?>
<script>
const urlParams = new URLSearchParams(window.location.search);
const artikelID = urlParams.get('id');
let isEditMode = false;

// Load artikel if editing
async function loadArtikelForEdit() {
    if (artikelID) {
        isEditMode = true;
        document.getElementById('pageTitle').textContent = 'Edit Artikel';
        document.getElementById('submitBtnText').textContent = 'Perbarui';

        try {
            const response = await fetch(`${API_URL}/artikel/${artikelID}`);
            const data = await response.json();

            if (data.status) {
                const item = data.data;
                document.getElementById('artikelID').value = item.id_artikel;
                document.getElementById('judul').value = item.judul;
                document.getElementById('isi').value = item.isi;

                const date = new Date(item.tanggal_publish);
                const dateString = date.toISOString().split('T')[0];
                document.getElementById('tanggalPublish').value = dateString;

                // Show thumbnail preview if exists
                if (item.thumbnail) {
                    const preview = document.getElementById('thumbnailPreview');
                    preview.src = `${window.location.origin}/uploads/articles/${item.thumbnail}`;
                    preview.style.display = 'block';
                }
            } else {
                showAlert('Gagal memuat artikel', 'danger');
                setTimeout(() => window.location.href = '/admin/artikel', 2000);
            }
        } catch (error) {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan memuat artikel', 'danger');
        }
    } else {
        // New artikel - set today's date
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggalPublish').value = today;
    }
}

// Preview thumbnail
function previewThumbnail(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('thumbnailPreview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

// Save artikel (publish)
function saveArtikel(e) {
    e.preventDefault();

    const judul = document.getElementById('judul').value.trim();
    const isi = document.getElementById('isi').value.trim();

    // Validation
    if (judul.length < 5) {
        showAlert('Judul minimal 5 karakter', 'warning');
        return;
    }
    if (isi.length < 50) {
        showAlert('Konten minimal 50 karakter', 'warning');
        return;
    }

    const formData = new FormData();
    formData.append('judul', judul);
    formData.append('isi', isi);
    formData.append('tanggal_publish', document.getElementById('tanggalPublish').value);
    formData.append('status', 'published'); // Mark as published

    if (document.getElementById('thumbnail').files.length > 0) {
        formData.append('thumbnail', document.getElementById('thumbnail').files[0]);
    }

    const id = document.getElementById('artikelID').value;
    const method = id ? 'PUT' : 'POST';
    const url = id ? `${API_URL}/artikel/${id}` : `${API_URL}/artikel`;

    // Show loading state
    const submitBtn = document.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

    fetch(url, {
        method: method,
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            showAlert(id ? 'Artikel berhasil diperbarui dan dipublikasikan!' : 'Artikel berhasil diterbitkan!', 'success');
            setTimeout(() => {
                window.location.href = '/admin/artikel';
            }, 1500);
        } else {
            const errors = Object.values(data.errors).join(', ');
            showAlert(errors || 'Gagal menyimpan artikel', 'danger');
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan saat menyimpan', 'danger');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
}

// Save as draft (not implemented yet - can be added later)
function saveDraft() {
    showAlert('Fitur draft akan segera tersedia', 'info');
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    loadArtikelForEdit();
});
</script>
<?= $this->endSection(); ?>
