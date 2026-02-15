<?= $this->extend('admin/layout'); ?>

<?= $this->section('admin_content'); ?>

<div class="subtitle-admin">Manage</div>
<h1 class="section-title-admin">
    <i class="fas fa-newspaper" style="color: #ff8a3d;"></i> Data Artikel
</h1>

<div class="data-card">
    <div class="data-card-header">
        <h3 class="data-card-title">Daftar Artikel</h3>
        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#artikelModal" onclick="resetForm()">
            <i class="fas fa-plus"></i> Tambah Artikel
        </button>
    </div>

    <div id="alertContainer"></div>

    <div id="loadingState" class="loading">
        <div class="loading-spinner"></div>
        <p>Memuat data artikel...</p>
    </div>

    <div id="tableContainer" style="display: none;">
        <div class="table-wrapper">
            <table class="table" id="artikelTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Thumbnail</th>
                        <th>Tanggal Publish</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="artikelBody">
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation" id="paginationContainer" style="display: none;">
            <ul class="pagination justify-content-center">
                <li class="page-item" id="prevBtn"><a class="page-link" href="#" onclick="previousPage()">Previous</a></li>
                <li class="page-item active"><span class="page-link" id="pageInfo">Page 1</span></li>
                <li class="page-item" id="nextBtn"><a class="page-link" href="#" onclick="nextPage()">Next</a></li>
            </ul>
        </nav>
    </div>

    <div id="emptyState" style="display: none;" class="empty-state">
        <i class="fas fa-database"></i>
        <p>Tidak ada data artikel</p>
    </div>
</div>

<!-- Modal Tambah/Edit Artikel -->
<div class="modal fade" id="artikelModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="artikelForm" enctype="multipart/form-data" onsubmit="saveArtikel(event)">
                <div class="modal-body">
                    <input type="hidden" id="artikelID">

                    <div class="form-group">
                        <label class="form-label">Judul *</label>
                        <input type="text" class="form-control" id="judul" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Isi *</label>
                        <textarea class="form-control" id="isi" rows="6" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail" accept="image/*">
                        <small class="text-muted">Max 2MB (JPG, PNG, GIF)</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal Publish *</label>
                        <input type="date" class="form-control" id="tanggalPublish" required>
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
let currentPage = 1;
let totalPages = 1;

// Load artikel data
function loadArtikel(page = 1) {
    document.getElementById('loadingState').style.display = 'block';
    document.getElementById('tableContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'none';

    fetch(`${API_URL}/artikel?page=${page}`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const artikel = data.data.artikel;
                const pagination = data.data.pagination;

                if (artikel.length > 0) {
                    let html = '';
                    artikel.forEach((item, index) => {
                        const thumbnailHtml = item.thumbnail ? 
                            `<img src="${window.location.origin}/uploads/articles/${item.thumbnail}" width="50" height="50" style="border-radius: 8px; object-fit: cover;">` 
                            : '<span style="color: #999;">Tidak ada</span>';

                        html += `
                            <tr>
                                <td>${((pagination.page - 1) * pagination.limit) + index + 1}</td>
                                <td><strong>${item.judul}</strong></td>
                                <td>${thumbnailHtml}</td>
                                <td>${new Date(item.tanggal_publish).toLocaleDateString('id-ID')}</td>
                                <td>
                                    <button class="btn-action btn-edit" onclick="editArtikel(${item.id_artikel})">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-action btn-delete" onclick="deleteArtikel(${item.id_artikel})">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    document.getElementById('artikelBody').innerHTML = html;
                    currentPage = pagination.page;
                    totalPages = pagination.total_pages;
                    
                    document.getElementById('pageInfo').textContent = `Page ${currentPage}`;
                    document.getElementById('prevBtn').classList.toggle('disabled', currentPage === 1);
                    document.getElementById('nextBtn').classList.toggle('disabled', currentPage === totalPages);
                    document.getElementById('paginationContainer').style.display = totalPages > 1 ? 'block' : 'none';

                    document.getElementById('tableContainer').style.display = 'block';
                } else {
                    document.getElementById('emptyState').style.display = 'block';
                }

                document.getElementById('loadingState').style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Gagal memuat data artikel', 'danger');
            document.getElementById('loadingState').style.display = 'none';
        });
}

// Reset form
function resetForm() {
    document.getElementById('artikelForm').reset();
    document.getElementById('artikelID').value = '';
    document.getElementById('modalTitle').textContent = 'Tambah Artikel';
    document.getElementById('tanggalPublish').valueAsDate = new Date();
}

// Edit artikel
function editArtikel(id) {
    fetch(`${API_URL}/artikel/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const item = data.data;
                document.getElementById('artikelID').value = item.id_artikel;
                document.getElementById('judul').value = item.judul;
                document.getElementById('isi').value = item.isi;
                
                const date = new Date(item.tanggal_publish);
                document.getElementById('tanggalPublish').valueAsDate = date;
                
                document.getElementById('modalTitle').textContent = 'Edit Artikel';

                new bootstrap.Modal(document.getElementById('artikelModal')).show();
            }
        });
}

// Save artikel
function saveArtikel(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('judul', document.getElementById('judul').value);
    formData.append('isi', document.getElementById('isi').value);
    formData.append('tanggal_publish', document.getElementById('tanggalPublish').value);
    
    if (document.getElementById('thumbnail').files.length > 0) {
        formData.append('thumbnail', document.getElementById('thumbnail').files[0]);
    }

    const id = document.getElementById('artikelID').value;
    const method = id ? 'PUT' : 'POST';
    const url = id ? `${API_URL}/artikel/${id}` : `${API_URL}/artikel`;

    fetch(url, {
        method: method,
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            showAlert(id ? 'Artikel berhasil diupdate' : 'Artikel berhasil ditambahkan', 'success');
            bootstrap.Modal.getInstance(document.getElementById('artikelModal')).hide();
            loadArtikel(1);
        } else {
            const errors = Object.values(data.errors).join(', ');
            showAlert(errors, 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan', 'danger');
    });
}

// Delete artikel
function deleteArtikel(id) {
    if (confirmDelete(id, 'artikel')) {
        fetch(`${API_URL}/artikel/${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                showAlert('Artikel berhasil dihapus', 'success');
                loadArtikel(currentPage);
            } else {
                showAlert('Gagal menghapus artikel', 'danger');
            }
        });
    }
}

// Pagination
function nextPage() {
    if (currentPage < totalPages) {
        loadArtikel(currentPage + 1);
    }
}

function previousPage() {
    if (currentPage > 1) {
        loadArtikel(currentPage - 1);
    }
}

// Init
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('tanggalPublish').valueAsDate = new Date();
    loadArtikel(1);
});
</script>
<?= $this->endSection(); ?>
