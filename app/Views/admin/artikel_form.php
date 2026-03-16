<?= $this->extend('admin/layout'); ?>

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

            <!-- Kategori -->
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label" style="font-weight: 600; margin-bottom: 0.5rem;">
                    <i class="fas fa-tags" style="color: #ff8a3d;"></i> Kategori
                </label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <select class="form-control" id="kategori" style="max-width: 300px;">
                        <option value="">-- Pilih Kategori --</option>
                    </select>
                    <button type="button" class="btn-add" onclick="openKategoriModal()" style="padding: 0.5rem 1rem; white-space: nowrap;">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
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

        <!-- Rich Text Editor -->
        <div style="padding: 1.5rem; border-bottom: 1px solid #f0f0f0;">
            <label class="form-label" style="font-weight: 600; margin-bottom: 0.5rem; display: block;">
                <i class="fas fa-pen" style="color: #ff8a3d;"></i> Konten Artikel *
            </label>
            
            <!-- Custom Rich Text Editor -->
            <div style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                <!-- Toolbar -->
                <div id="toolbar" style="background: #f8f9fa; padding: 10px; border-bottom: 1px solid #ddd; display: flex; gap: 5px; flex-wrap: wrap;">
                    <button type="button" onclick="formatText('bold')" style="padding: 5px 10px; border: 1px solid #ccc; background: white; border-radius: 4px; cursor: pointer;">
                        <i class="fas fa-bold"></i>
                    </button>
                    <button type="button" onclick="formatText('italic')" style="padding: 5px 10px; border: 1px solid #ccc; background: white; border-radius: 4px; cursor: pointer;">
                        <i class="fas fa-italic"></i>
                    </button>
                    <button type="button" onclick="formatText('underline')" style="padding: 5px 10px; border: 1px solid #ccc; background: white; border-radius: 4px; cursor: pointer;">
                        <i class="fas fa-underline"></i>
                    </button>
                    <div style="width: 1px; height: 30px; background: #ddd; margin: 0 5px;"></div>
                    <button type="button" onclick="formatText('justifyLeft')" style="padding: 5px 10px; border: 1px solid #ccc; background: white; border-radius: 4px; cursor: pointer;">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <button type="button" onclick="formatText('justifyCenter')" style="padding: 5px 10px; border: 1px solid #ccc; background: white; border-radius: 4px; cursor: pointer;">
                        <i class="fas fa-align-center"></i>
                    </button>
                    <button type="button" onclick="formatText('justifyRight')" style="padding: 5px 10px; border: 1px solid #ccc; background: white; border-radius: 4px; cursor: pointer;">
                        <i class="fas fa-align-right"></i>
                    </button>
                    <button type="button" onclick="formatText('justifyFull')" style="padding: 5px 10px; border: 1px solid #ccc; background: white; border-radius: 4px; cursor: pointer;">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <div style="width: 1px; height: 30px; background: #ddd; margin: 0 5px;"></div>
                    <button type="button" onclick="formatText('insertOrderedList')" style="padding: 5px 10px; border: 1px solid #ccc; background: white; border-radius: 4px; cursor: pointer;">
                        <i class="fas fa-list-ol"></i>
                    </button>
                    <button type="button" onclick="formatText('insertUnorderedList')" style="padding: 5px 10px; border: 1px solid #ccc; background: white; border-radius: 4px; cursor: pointer;">
                        <i class="fas fa-list-ul"></i>
                    </button>
                    <div style="width: 1px; height: 30px; background: #ddd; margin: 0 5px;"></div>
                    <select onchange="formatHeading(this.value)" style="padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="">Normal</option>
                        <option value="h1">Heading 1</option>
                        <option value="h2">Heading 2</option>
                        <option value="h3">Heading 3</option>
                    </select>
                </div>
                
                <!-- Editor Area -->
                <div 
                    id="editor" 
                    contenteditable="true" 
                    style="min-height: 400px; padding: 15px; font-family: Arial, sans-serif; font-size: 14px; line-height: 1.6; outline: none;"
                    placeholder="Tulis konten artikel di sini... Minimal 50 karakter."
                    oninput="updateHiddenTextarea()"
                ></div>
            </div>
            
            <!-- Hidden textarea for form submission -->
            <textarea id="isi" name="isi" style="display: none;" required></textarea>
            
            <small style="color: #999; margin-top: 0.5rem; display: block;">
                <i class="fas fa-info-circle"></i> Gunakan toolbar di atas untuk formatting teks. Minimal 50 karakter.
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
                <!-- <button type="button" class="btn-action" onclick="saveDraft()" style="padding: 0.75rem 1.5rem;">
                    <i class="fas fa-save"></i> Simpan Sebagai Draft
                </button> -->
                <button type="submit" class="btn-add" style="padding: 0.75rem 1.5rem;">
                    <i class="fas fa-rocket"></i> <span id="submitBtnText">Publikasikan</span>
                </button>
            </div>
        </div>

        <input type="hidden" id="artikelID">
    </form>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="kategoriModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="kategoriForm" onsubmit="saveKategori(event)">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nama Kategori *</label>
                        <input type="text" class="form-control" id="namaKategori" placeholder="Contoh: Tips Sehat" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiKategori" placeholder="Deskripsi kategori (opsional)" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modal-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('admin_scripts'); ?>
<script>
const urlParams = new URLSearchParams(window.location.search);
const artikelID = urlParams.get('id');
let isEditMode = false;

// Rich Text Editor Functions
function formatText(command) {
    document.execCommand(command, false, null);
    document.getElementById('editor').focus();
    updateHiddenTextarea();
}

function formatHeading(tag) {
    if (tag) {
        document.execCommand('formatBlock', false, tag);
    } else {
        document.execCommand('formatBlock', false, 'div');
    }
    document.getElementById('editor').focus();
    updateHiddenTextarea();
}

function updateHiddenTextarea() {
    const editorContent = document.getElementById('editor').innerHTML;
    document.getElementById('isi').value = editorContent;
}

// Set placeholder behavior
document.addEventListener('DOMContentLoaded', function() {
    const editor = document.getElementById('editor');
    
    editor.addEventListener('focus', function() {
        if (this.innerHTML === '' || this.innerHTML === '<br>') {
            this.innerHTML = '';
        }
    });
    
    editor.addEventListener('blur', function() {
        if (this.innerHTML === '' || this.innerHTML === '<br>') {
            this.innerHTML = '';
        }
    });
});

// Load kategori options
async function loadKategoriOptions() {
    try {
        const response = await fetch(`${API_URL}/kategori-artikel`, {credentials: 'include'});
        const data = await response.json();
        if (data.status) {
            let html = '<option value="">-- Pilih Kategori --</option>';
            data.data.kategori.forEach(kat => {
                html += `<option value="${kat.nama_kategori}">${kat.nama_kategori}</option>`;
            });
            document.getElementById('kategori').innerHTML = html;
        }
    } catch (error) {
        console.error('Error loading kategori:', error);
    }
}

// Open kategori modal
function openKategoriModal() {
    document.getElementById('kategoriForm').reset();
    new bootstrap.Modal(document.getElementById('kategoriModal')).show();
}

// Save kategori
function saveKategori(e) {
    e.preventDefault();

    const namaKategori = document.getElementById('namaKategori').value.trim();
    const deskripsi = document.getElementById('deskripsiKategori').value.trim();

    if (!namaKategori) {
        showAlert('Nama kategori harus diisi', 'warning');
        return;
    }

    const params = new URLSearchParams();
    params.append('nama_kategori', namaKategori);
    params.append('deskripsi', deskripsi);

    fetch(`${API_URL}/kategori-artikel`, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: params,
        credentials: 'include'
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            showAlert('Kategori berhasil ditambahkan', 'success');
            bootstrap.Modal.getInstance(document.getElementById('kategoriModal')).hide();
            loadKategoriOptions();
            // Auto select new kategori
            setTimeout(() => {
                document.getElementById('kategori').value = namaKategori;
            }, 500);
        } else {
            const errors = data.errors ? Object.values(data.errors).join(', ') : data.message || 'Terjadi kesalahan';
            showAlert(errors, 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan saat menyimpan kategori', 'danger');
    });
}

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
                document.getElementById('kategori').value = item.kategori || '';
                
                // Set editor content
                document.getElementById('editor').innerHTML = item.isi;
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
    const kategori = document.getElementById('kategori').value;
    const isi = document.getElementById('isi').value;

    // Validation
    if (judul.length < 5) {
        showAlert('Judul minimal 5 karakter', 'warning');
        return;
    }
    
    // Get plain text from HTML for length validation
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = isi;
    const plainText = tempDiv.textContent || tempDiv.innerText || '';
    
    if (plainText.trim().length < 50) {
        showAlert('Konten minimal 50 karakter', 'warning');
        return;
    }

    const id = document.getElementById('artikelID').value;
    const url = id ? `${API_URL}/artikel/${id}` : `${API_URL}/artikel`;
    const thumbnailFile = document.getElementById('thumbnail').files.length > 0 ? document.getElementById('thumbnail').files[0] : null;

    let body, method = 'POST';

    // For CREATE or UPDATE with thumbnail: use FormData
    if (!id && thumbnailFile) {
        const formData = new FormData();
        formData.append('judul', judul);
        formData.append('kategori', kategori);
        formData.append('isi', isi);
        formData.append('tanggal_publish', document.getElementById('tanggalPublish').value);
        formData.append('status', 'published');
        formData.append('thumbnail', thumbnailFile);
        body = formData;
    } else if (id && thumbnailFile) {
        // UPDATE with new thumbnail: use FormData + _method=PUT
        const formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('judul', judul);
        formData.append('kategori', kategori);
        formData.append('isi', isi);
        formData.append('tanggal_publish', document.getElementById('tanggalPublish').value);
        formData.append('status', 'published');
        formData.append('thumbnail', thumbnailFile);
        body = formData;
    } else {
        // Without thumbnail: use URLSearchParams
        const params = new URLSearchParams();
        if (id) {
            params.append('_method', 'PUT'); // Method spoofing for UPDATE
        }
        params.append('judul', judul);
        params.append('kategori', kategori);
        params.append('isi', isi);
        params.append('tanggal_publish', document.getElementById('tanggalPublish').value);
        params.append('status', 'published');
        body = params;
    }

    // Show loading state
    const submitBtn = document.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

    fetch(url, {
        method: method,
        body: body,
        credentials: 'include'
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
    loadKategoriOptions();
    loadArtikelForEdit();
});
</script>
<?= $this->endSection(); ?>
