<?= $this->extend('admin/layout'); ?>

<?= $this->section('admin_content'); ?>

<!-- Page Header -->
<div class="page-header" style="margin-bottom: 2rem;">
    <h1 class="page-title">
        <i class="fas fa-user-doctor"></i> Data Dokter
    </h1>
    <p style="color: #999; margin: 0.5rem 0 0 0;">Kelola informasi dokter dan jadwal pratik</p>
</div>

<div class="data-card">
    <div class="data-card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <h3 class="data-card-title" style="margin: 0;">Daftar Dokter</h3>
        <button type="button" class="btn-add" onclick="openAddModal()">
            <i class="fas fa-plus"></i> Tambah Dokter
        </button>
    </div>

    <!-- Search & Filter Bar -->
    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap; padding: 0 1.5rem 0 1.5rem;">
        <input 
            type="text" 
            id="searchInput" 
            placeholder="Cari nama dokter..." 
            class="form-control" 
            style="flex: 1; min-width: 200px;"
        >
        <select id="filterSpesialis" class="form-select" style="width: auto; min-width: 150px;">
            <option value="">-- Semua Spesialis --</option>
        </select>
        <select id="filterPoli" class="form-select" style="width: auto; min-width: 120px;">
            <option value="">-- Semua Poli --</option>
        </select>
        <button onclick="applyFilters()" class="btn-action" style="padding: 0.5rem 1.5rem;">
            <i class="fas fa-search"></i> Cari
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
let currentSearchQuery = '';
let currentFilterSpesialis = '';
let currentFilterPoli = '';

// Load dokter data with search/filter
function loadDokter(page = 1) {
    document.getElementById('loadingState').style.display = 'block';
    document.getElementById('tableContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'none';

    let url = `${API_URL}/doctors?page=${page}`;
    
    if (currentSearchQuery) {
        url += `&search=${encodeURIComponent(currentSearchQuery)}`;
    }
    if (currentFilterSpesialis) {
        url += `&id_spesialis=${currentFilterSpesialis}`;
    }
    if (currentFilterPoli) {
        url += `&id_poli=${currentFilterPoli}`;
    }

    fetch(url, {credentials: 'include'})
        .then(response => {
            console.log('loadDokter response status:', response.status);
            return response.text().then(text => ({
                text: text,
                ok: response.ok,
                status: response.status,
                contentType: response.headers.get('content-type')
            }));
        })
        .then(({ text, ok, status, contentType }) => {
            let data;
            try {
                data = JSON.parse(text);
            } catch (e) {
                console.error('Failed to parse JSON:', e);
                console.error('Response text:', text.substring(0, 200));
                throw new Error(`Invalid JSON response (${status}): ${text.substring(0, 100)}`);
            }
            
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
                    document.getElementById('emptyState').innerHTML = `
                        <div class="empty-state" style="padding: 2rem; text-align: center;">
                            <i class="fas fa-inbox" style="font-size: 50px; color: #ccc; margin-bottom: 1rem;"></i>
                            <p style="color: #999;">Tidak ada dokter yang ditemukan</p>
                            <button onclick="resetFilters()" class="btn-add" style="margin-top: 1rem;">Reset Filter</button>
                        </div>
                    `;
                }

                document.getElementById('loadingState').style.display = 'none';
            } else {
                throw new Error('API returned status=false: ' + JSON.stringify(data.errors));
            }
        })
        .catch(error => {
            console.error('loadDokter Error:', error);
            console.error('Error message:', error.message);
            showAlert('Gagal memuat data dokter: ' + error.message, 'danger');
            document.getElementById('loadingState').style.display = 'none';
        });
}

// Apply search & filter
function applyFilters() {
    currentSearchQuery = document.getElementById('searchInput').value.trim();
    currentFilterSpesialis = document.getElementById('filterSpesialis').value;
    currentFilterPoli = document.getElementById('filterPoli').value;
    loadDokter(1);
}

// Reset filters
function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('filterSpesialis').value = '';
    document.getElementById('filterPoli').value = '';
    currentSearchQuery = '';
    currentFilterSpesialis = '';
    currentFilterPoli = '';
    loadDokter(1);
}

// Load spesialis dan poli options
async function loadOptions() {
    try {
        const spesialisResponse = await fetch(`${API_URL}/spesialis`, {credentials: 'include'});
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
            
            // Also populate filter dropdown
            let filterHtml = '<option value="">-- Semua Spesialis --</option>';
            spesialisData.data.spesialis.forEach(s => {
                filterHtml += `<option value="${s.id_spesialis}">${s.nama_spesialis}</option>`;
            });
            document.getElementById('filterSpesialis').innerHTML = filterHtml;
        }

        const poliResponse = await fetch(`${API_URL}/poli`, {credentials: 'include'});
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
            
            // Also populate filter dropdown
            let filterHtml = '<option value="">-- Semua Poli --</option>';
            poliData.data.poli.forEach(p => {
                filterHtml += `<option value="${p.id_poli}">${p.nama_poli}</option>`;
            });
            document.getElementById('filterPoli').innerHTML = filterHtml;
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
    // Load options (spesialis & poli) dulu sebelum fetch dokter detail
    loadOptions().then(() => {
        fetch(`${API_URL}/doctors/${id}`, {credentials: 'include'})
            .then(response => response.text().then(text => ({
                text: text,
                status: response.status,
                contentType: response.headers.get('content-type')
            })))
            .then(({ text, status, contentType }) => {
                let data;
                try {
                    data = JSON.parse(text);
                } catch (e) {
                    throw new Error(`Invalid JSON (${status}): ${text.substring(0, 200)}`);
                }
                return data;
            })
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
                } else {
                    showAlert('Error: ' + (data.errors?.doctor || JSON.stringify(data.errors)), 'danger');
                }
            })
            .catch(error => {
                console.error('editDokter Error:', error);
                showAlert('Gagal memuat dokter: ' + error.message, 'danger');
            });
    });
}

// Save dokter
function saveDokter(e) {
    e.preventDefault();

    const nama_doctor = document.getElementById('namaDokter').value;
    const profil = document.getElementById('profil').value;
    const fotoFile = document.getElementById('fotoDokter').files.length > 0 ? document.getElementById('fotoDokter').files[0] : null;
    const id = document.getElementById('dokterID').value;
    const url = id ? `${API_URL}/doctors/${id}` : `${API_URL}/doctors`;

    // Collect spesialis & poli
    const spesialisIds = [];
    const poliIds = [];
    document.querySelectorAll('.spesialis-checkbox:checked').forEach(cb => {
        spesialisIds.push(cb.value);
    });
    document.querySelectorAll('.poli-checkbox:checked').forEach(cb => {
        poliIds.push(cb.value);
    });

    console.log('saveDokter:', {
        nama_doctor: nama_doctor,
        profil: profil,
        id_spesialis_count: spesialisIds.length,
        id_poli_count: poliIds.length,
        hasFoto: !!fotoFile,
        dokterID: id,
        url: url
    });

    let body, headers, method;

    // For CREATE (POST): use FormData to support file upload
    if (!id && fotoFile) {
        const formData = new FormData();
        formData.append('nama_doctor', nama_doctor);
        formData.append('profil', profil);
        formData.append('foto', fotoFile);
        spesialisIds.forEach(sid => formData.append('id_spesialis[]', sid));
        poliIds.forEach(pid => formData.append('id_poli[]', pid));
        body = formData;
        headers = {};
        method = 'POST';
    } else if (!id) {
        // CREATE without file
        const params = new URLSearchParams();
        params.append('nama_doctor', nama_doctor);
        params.append('profil', profil);
        spesialisIds.forEach(sid => params.append('id_spesialis[]', sid));
        poliIds.forEach(pid => params.append('id_poli[]', pid));
        body = params;
        headers = { 'Content-Type': 'application/x-www-form-urlencoded' };
        method = 'POST';
    } else {
        // UPDATE: use FormData if ada file, otherwise URLSearchParams
        if (fotoFile) {
            // UPDATE with file - use FormData + _method=PUT
            const formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('nama_doctor', nama_doctor);
            formData.append('profil', profil);
            formData.append('foto', fotoFile);
            spesialisIds.forEach(sid => formData.append('id_spesialis[]', sid));
            poliIds.forEach(pid => formData.append('id_poli[]', pid));
            body = formData;
            headers = {}; // FormData auto-set content-type
            method = 'POST';
        } else {
            // UPDATE without file - use URLSearchParams + _method=PUT
            const params = new URLSearchParams();
            params.append('_method', 'PUT');
            params.append('nama_doctor', nama_doctor);
            params.append('profil', profil);
            spesialisIds.forEach(sid => params.append('id_spesialis[]', sid));
            poliIds.forEach(pid => params.append('id_poli[]', pid));
            body = params;
            headers = { 'Content-Type': 'application/x-www-form-urlencoded' };
            method = 'POST';
        }
    }

    fetch(url, {
        method: method,
        headers: headers,
        body: body,
        credentials: 'include'
    })
    .then(response => response.text().then(text => ({
        text: text,
        status: response.status,
        contentType: response.headers.get('content-type')
    })))
    .then(({ text, status, contentType }) => {
        let data;
        try {
            data = JSON.parse(text);
        } catch (e) {
            throw new Error(`Invalid JSON (${status}): ${text.substring(0, 200)}`);
        }
        return data;
    })
    .then(data => {
        if (data.status) {
            showAlert(id ? 'Dokter berhasil diupdate' : 'Dokter berhasil ditambahkan', 'success');
            bootstrap.Modal.getInstance(document.getElementById('dokterModal')).hide();
            loadDokter(1);
        } else {
            const errors = data.errors ? Object.values(data.errors).join(', ') : data.message || 'Terjadi kesalahan';
            showAlert(errors, 'danger');
        }
    })
    .catch(error => {
        console.error('saveDokter Error:', error);
        console.error('Error message:', error.message);
        showAlert('Terjadi kesalahan: ' + error.message, 'danger');
    });
}

// Delete dokter
function deleteDokter(id) {
    confirmDelete('dokter', () => {
        const params = new URLSearchParams();
        params.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

        fetch(`${API_URL}/doctors/${id}`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            credentials: 'include',
            body: params
        })
        .then(response => response.text().then(text => ({
            text: text,
            status: response.status,
            contentType: response.headers.get('content-type')
        })))
        .then(({ text, status, contentType }) => {
            let data;
            try {
                data = JSON.parse(text);
            } catch (e) {
                throw new Error(`Invalid JSON (${status}): ${text.substring(0, 200)}`);
            }
            return data;
        })
        .then(data => {
            if (data.status) {
                showAlert('Dokter berhasil dihapus', 'success');
                loadDokter(1);
            } else {
                showAlert('Gagal menghapus dokter', 'danger');
            }
        })
        .catch(error => {
            console.error('deleteDokter Error:', error);
            console.error('Error message:', error.message);
            showAlert('Error menghapus dokter: ' + error.message, 'danger');
        });
    });
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

// Enter key untuk search
document.addEventListener('DOMContentLoaded', async function() {
    await loadOptions();
    loadDokter(1);
    
    document.getElementById('searchInput')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            applyFilters();
        }
    });
});
</script>
<?= $this->endSection(); ?>
