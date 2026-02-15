<?= $this->extend('admin/new_layout'); ?>

<?= $this->section('admin_content'); ?>

<!-- Page Header -->
<div class="page-header" style="margin-bottom: 2rem;">
    <h1 class="page-title">
        <i class="fas fa-newspaper"></i> Data Artikel
    </h1>
    <p style="color: #999; margin: 0.5rem 0 0 0;">Kelola artikel dan konten portal informasi</p>
</div>

<div class="data-card">
    <div class="data-card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <h3 class="data-card-title" style="margin: 0;">Daftar Artikel</h3>
        <a href="/admin/artikel_form" class="btn-add" style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
            <i class="fas fa-plus"></i> Artikel Baru
        </a>
    </div>

    <!-- Search & Filter Bar -->
    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap; padding: 0 1.5rem 0 1.5rem;">
        <input 
            type="text" 
            id="searchInput" 
            placeholder="Cari judul artikel..." 
            class="form-control" 
            style="flex: 1; min-width: 200px;"
        >
        <button onclick="applyFilters()" class="btn-action" style="padding: 0.5rem 1.5rem;">
            <i class="fas fa-search"></i> Cari
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

<?= $this->endSection(); ?>

<?= $this->section('admin_scripts'); ?>
<script>
let currentPage = 1;
let totalPages = 1;
let currentSearchQuery = '';

// Load artikel data with search
function loadArtikel(page = 1) {
    document.getElementById('loadingState').style.display = 'block';
    document.getElementById('tableContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'none';

    let url = `${API_URL}/artikel?page=${page}`;
    
    if (currentSearchQuery) {
        url += `&search=${encodeURIComponent(currentSearchQuery)}`;
    }

    fetch(url)
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
                                    <a href="/admin/artikel_form?id=${item.id_artikel}" class="btn-action btn-edit" style="text-decoration: none; display: inline-block;">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn-action btn-delete" onclick="deleteArtikel(${item.id_artikel})" style="border: none; background: none; cursor: pointer; padding: 0.5rem 1rem; display: inline-block;">
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
                    document.getElementById('emptyState').innerHTML = `
                        <div class="empty-state" style="padding: 2rem; text-align: center;">
                            <i class="fas fa-inbox" style="font-size: 50px; color: #ccc; margin-bottom: 1rem;"></i>
                            <p style="color: #999;">Tidak ada artikel yang ditemukan</p>
                            <button onclick="resetFilters()" class="btn-add" style="margin-top: 1rem;">Reset Pencarian</button>
                        </div>
                    `;
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

// Apply search filter
function applyFilters() {
    currentSearchQuery = document.getElementById('searchInput').value.trim();
    loadArtikel(1);
}

// Reset search filter
function resetFilters() {
    document.getElementById('searchInput').value = '';
    currentSearchQuery = '';
    loadArtikel(1);
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

// Enter key untuk search
document.addEventListener('DOMContentLoaded', function() {
    loadArtikel(1);
    
    document.getElementById('searchInput')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            applyFilters();
        }
    });
});
</script>
<?= $this->endSection(); ?>
