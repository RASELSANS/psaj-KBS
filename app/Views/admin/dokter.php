<?= $this->extend('admin/layout'); ?>

<?= $this->section('admin_content'); ?>

<div class="subtitle-admin">Manage</div>
<h1 class="section-title-admin">
    <i class="fas fa-user-doctor" style="color: #ff8a3d;"></i> Data Dokter
</h1>

<div class="data-card">
    <div class="data-card-header">
        <h3 class="data-card-title">Daftar Dokter</h3>
        <button type="button" class="btn-add" onclick="openAddModal()">
            <i class="fas fa-plus"></i> Tambah Dokter
        </button>
    </div>

    <div id="alertContainer"></div>

    <div id="loadingState" class="loading">
        <div class="loading-spinner"></div>
        <p>Memuat data dokter...</p>
    </div>

    <div id="tableContainer" style="display: none;">
        <div class="table-wrapper">
            <table class="table" id="dokterTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dokter</th>
                        <th>Spesialis</th>
                        <th>Poli</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="dokterBody">
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
        <p>Tidak ada data dokter</p>
    </div>
</div>

<!-- Modal Tambah/Edit Dokter -->
<div class="modal fade" id="dokterModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Dokter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="dokterForm" enctype="multipart/form-data" onsubmit="saveDokter(event)">
                <div class="modal-body">
                    <input type="hidden" id="dokterID">

                    <div class="form-group">
                        <label class="form-label">Nama Dokter *</label>
                        <input type="text" class="form-control" id="namaDokter" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Profil *</label>
                        <textarea class="form-control" id="profil" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Foto Dokter</label>
                        <input type="file" class="form-control" id="fotoDokter" accept="image/*">
                        <small class="text-muted">Max 2MB (JPG, PNG, GIF)</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Spesialis *</label>
                        <div id="spesialisContainer" class="border rounded p-3" style="max-height: 150px; overflow-y: auto;">
                            <div class="loading-spinner" style="margin: 20px auto;"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Poli *</label>
                        <div id="poliContainer" class="border rounded p-3" style="max-height: 150px; overflow-y: auto;">
                            <div class="loading-spinner" style="margin: 20px auto;"></div>
                        </div>
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
let selectedSpesialis = [];
let selectedPoli = [];

// Load dokter data
function loadDokter(page = 1) {
    document.getElementById('loadingState').style.display = 'block';
    document.getElementById('tableContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'none';

    fetch(`${API_URL}/doctors?page=${page}`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const doctors = data.data.doctors;
                const pagination = data.data.pagination;

                if (doctors.length > 0) {
                    let html = '';
                    doctors.forEach((doctor, index) => {
                        const spesialisText = doctor.spesialis.map(s => s.nama_spesialis).join(', ') || '-';
                        const poliText = doctor.poli.map(p => p.nama_poli).join(', ') || '-';
                        const fotoHtml = doctor.foto ? 
                            `<img src="${window.location.origin}/uploads/doctors/${doctor.foto}" width="40" height="40" style="border-radius: 8px; object-fit: cover;">` 
                            : '<span style="color: #999;">Tidak ada</span>';

                        html += `
                            <tr>
                                <td>${((pagination.page - 1) * pagination.limit) + index + 1}</td>
                                <td><strong>${doctor.nama_doctor}</strong></td>
                                <td>${spesialisText}</td>
                                <td>${poliText}</td>
                                <td>${fotoHtml}</td>
                                <td>
                                    <button class="btn-action btn-edit" onclick="editDokter(${doctor.id_doctor})">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-action btn-delete" onclick="deleteDokter(${doctor.id_doctor})">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    document.getElementById('dokterBody').innerHTML = html;
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
            showAlert('Gagal memuat data dokter', 'danger');
            document.getElementById('loadingState').style.display = 'none';
        });
}

// Load spesialis dan poli options
async function loadOptions() {
    try {
        const spesialisResponse = await fetch(`${API_URL}/spesialis`);
        const spesialisData = await spesialisResponse.json();
        
        if (spesialisData.status) {
            let html = '';
            spesialisData.data.spesialis.forEach(s => {
                html += `
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input spesialis-checkbox" 
                               value="${s.id_spesialis}" id="spesialis${s.id_spesialis}">
                        <label class="form-check-label" for="spesialis${s.id_spesialis}">
                            ${s.nama_spesialis}
                        </label>
                    </div>
                `;
            });
            document.getElementById('spesialisContainer').innerHTML = html;
        }

        const poliResponse = await fetch(`${API_URL}/poli`);
        const poliData = await poliResponse.json();
        
        if (poliData.status) {
            let html = '';
            poliData.data.poli.forEach(p => {
                html += `
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input poli-checkbox" 
                               value="${p.id_poli}" id="poli${p.id_poli}">
                        <label class="form-check-label" for="poli${p.id_poli}">
                            ${p.nama_poli}
                        </label>
                    </div>
                `;
            });
            document.getElementById('poliContainer').innerHTML = html;
        }
    } catch (error) {
        console.error('Error loading options:', error);
    }
}

// Open add modal dengan menunggu options siap
async function openAddModal() {
    await loadOptions();
    resetForm();
    new bootstrap.Modal(document.getElementById('dokterModal')).show();
}

// Reset form
function resetForm() {
    document.getElementById('dokterForm').reset();
    document.getElementById('dokterID').value = '';
    document.getElementById('modalTitle').textContent = 'Tambah Dokter';
    document.querySelectorAll('.spesialis-checkbox').forEach(cb => cb.checked = false);
    document.querySelectorAll('.poli-checkbox').forEach(cb => cb.checked = false);
}

// Edit dokter
function editDokter(id) {
    fetch(`${API_URL}/doctors/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const doctor = data.data;
                document.getElementById('dokterID').value = doctor.id_doctor;
                document.getElementById('namaDokter').value = doctor.nama_doctor;
                document.getElementById('profil').value = doctor.profil;
                document.getElementById('modalTitle').textContent = 'Edit Dokter';

                // Check spesialis
                const spesialisIds = doctor.spesialis.map(s => s.id_spesialis);
                document.querySelectorAll('.spesialis-checkbox').forEach(cb => {
                    cb.checked = spesialisIds.includes(parseInt(cb.value));
                });

                // Check poli
                const poliIds = doctor.poli.map(p => p.id_poli);
                document.querySelectorAll('.poli-checkbox').forEach(cb => {
                    cb.checked = poliIds.includes(parseInt(cb.value));
                });

                new bootstrap.Modal(document.getElementById('dokterModal')).show();
            }
        });
}

// Save dokter
function saveDokter(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('nama_doctor', document.getElementById('namaDokter').value);
    formData.append('profil', document.getElementById('profil').value);
    
    if (document.getElementById('fotoDokter').files.length > 0) {
        formData.append('foto', document.getElementById('fotoDokter').files[0]);
    }

    document.querySelectorAll('.spesialis-checkbox:checked').forEach(cb => {
        formData.append('id_spesialis[]', cb.value);
    });

    document.querySelectorAll('.poli-checkbox:checked').forEach(cb => {
        formData.append('id_poli[]', cb.value);
    });

    const id = document.getElementById('dokterID').value;
    const method = id ? 'PUT' : 'POST';
    const url = id ? `${API_URL}/doctors/${id}` : `${API_URL}/doctors`;

    fetch(url, {
        method: method,
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            showAlert(id ? 'Dokter berhasil diupdate' : 'Dokter berhasil ditambahkan', 'success');
            bootstrap.Modal.getInstance(document.getElementById('dokterModal')).hide();
            loadDokter(1);
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

// Delete dokter
function deleteDokter(id) {
    if (confirmDelete(id, 'dokter')) {
        fetch(`${API_URL}/doctors/${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                showAlert('Dokter berhasil dihapus', 'success');
                loadDokter(currentPage);
            } else {
                showAlert('Gagal menghapus dokter', 'danger');
            }
        });
    }
}

// Pagination
function nextPage() {
    if (currentPage < totalPages) {
        loadDokter(currentPage + 1);
    }
}

function previousPage() {
    if (currentPage > 1) {
        loadDokter(currentPage - 1);
    }
}

// Init
document.addEventListener('DOMContentLoaded', async function() {
    await loadOptions();
    loadDokter(1);
});
</script>
<?= $this->endSection(); ?>
