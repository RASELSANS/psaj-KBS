<?= $this->extend('admin/new_layout'); ?>

<?= $this->section('admin_content'); ?>

<!-- Page Header -->
<div class="page-header" style="margin-bottom: 2rem;">
    <h1 class="page-title">
        <i class="fas fa-calendar"></i> Data Jadwal
    </h1>
    <p style="color: #999; margin: 0.5rem 0 0 0;">Kelola jadwal praktik dokter</p>
</div>

<div class="data-card">
    <div class="data-card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <h3 class="data-card-title" style="margin: 0;">Daftar Jadwal</h3>
        <button type="button" class="btn-add" onclick="openAddModal()">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </button>
    </div>

    <!-- Search & Filter Bar -->
    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap; padding: 0 1.5rem 0 1.5rem;">
        <select id="filterDokter" class="form-select" style="width: auto; min-width: 180px;">
            <option value="">-- Pilih Dokter --</option>
        </select>
        <select id="filterHari" class="form-select" style="width: auto; min-width: 140px;">
            <option value="">-- Semua Hari --</option>
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
            <option value="Sabtu">Sabtu</option>
            <option value="Minggu">Minggu</option>
        </select>
        <button onclick="applyFilters()" class="btn-action" style="padding: 0.5rem 1.5rem;">
            <i class="fas fa-search"></i> Filter
        </button>
    </div>

    <div id="alertContainer"></div>

    <div id="loadingState" class="loading">
        <div class="loading-spinner"></div>
        <p>Memuat data jadwal...</p>
    </div>

    <div id="tableContainer" style="display: none;">
        <div class="table-wrapper">
            <table class="table" id="jadwalTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dokter</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="jadwalBody">
                </tbody>
            </table>
        </div>
    </div>

    <div id="emptyState" style="display: none;" class="empty-state">
        <i class="fas fa-database"></i>
        <p>Tidak ada data jadwal</p>
    </div>
</div>

<!-- Modal Tambah/Edit Jadwal -->
<div class="modal fade" id="jadwalModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="jadwalForm" onsubmit="saveJadwal(event)">
                <div class="modal-body">
                    <input type="hidden" id="jadwalID">

                    <div class="form-group">
                        <label class="form-label">Dokter *</label>
                        <select class="form-select" id="idDokter" required>
                            <option value="">-- Pilih Dokter --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Hari *</label>
                        <input type="text" class="form-control" id="hari" placeholder="Contoh: Senin-Jumat, Rabu" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jam Mulai *</label>
                        <input type="time" class="form-control" id="jamMulai" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jam Selesai *</label>
                        <input type="time" class="form-control" id="jamSelesai" required>
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
let jadwalData = [];
let doctoArray = [];
let currentFilterDokter = '';
let currentFilterHari = '';

// Load jadwal data with filter
function loadJadwal() {
    document.getElementById('loadingState').style.display = 'block';
    document.getElementById('tableContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'none';

    fetch(`${API_URL}/doctors`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                doctoArray = data.data;
                
                let html = '';
                let rowNum = 1;
                doctoArray.forEach((doctor, index) => {
                    // Apply filters
                    if (currentFilterDokter && doctor.id_doctor !== parseInt(currentFilterDokter)) {
                        return;
                    }

                    doctor.jadwal.forEach((j, jIndex) => {
                        // Apply hari filter
                        if (currentFilterHari && j.hari !== currentFilterHari) {
                            return;
                        }

                        html += `
                            <tr>
                                <td>${rowNum}</td>
                                <td><strong>${doctor.nama_doctor}</strong></td>
                                <td>${j.hari}</td>
                                <td>${j.jam_mulai}</td>
                                <td>${j.jam_selesai}</td>
                                <td>
                                    <button class="btn-action btn-edit" onclick="editJadwal(${j.id_jadwal})">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-action btn-delete" onclick="deleteJadwal(${j.id_jadwal})">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        `;
                        rowNum++;
                    });
                });

                if (html) {
                    document.getElementById('jadwalBody').innerHTML = html;
                    document.getElementById('tableContainer').style.display = 'block';
                } else {
                    document.getElementById('emptyState').style.display = 'block';
                    document.getElementById('emptyState').innerHTML = `
                        <div class="empty-state" style="padding: 2rem; text-align: center;">
                            <i class="fas fa-inbox" style="font-size: 50px; color: #ccc; margin-bottom: 1rem;"></i>
                            <p style="color: #999;">Tidak ada jadwal yang sesuai filter</p>
                            <button onclick="resetFilters()" class="btn-add" style="margin-top: 1rem;">Reset Filter</button>
                        </div>
                    `;
                }

                document.getElementById('loadingState').style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Gagal memuat data jadwal', 'danger');
            document.getElementById('loadingState').style.display = 'none';
        });
}

// Apply filters
function applyFilters() {
    currentFilterDokter = document.getElementById('filterDokter').value;
    currentFilterHari = document.getElementById('filterHari').value;
    loadJadwal();
}

// Reset filters
function resetFilters() {
    document.getElementById('filterDokter').value = '';
    document.getElementById('filterHari').value = '';
    currentFilterDokter = '';
    currentFilterHari = '';
    loadJadwal();
}

// Load dokter options for modal AND filter dropdown
async function loadDokterOptions() {
    try {
        const response = await fetch(`${API_URL}/doctors`);
        const data = await response.json();
        if (data.status) {
            let modalHtml = '<option value="">-- Pilih Dokter --</option>';
            let filterHtml = '<option value="">-- Pilih Dokter --</option>';
            data.data.forEach(doctor => {
                modalHtml += `<option value="${doctor.id_doctor}">${doctor.nama_doctor}</option>`;
                filterHtml += `<option value="${doctor.id_doctor}">${doctor.nama_doctor}</option>`;
            });
            document.getElementById('idDokter').innerHTML = modalHtml;
            document.getElementById('filterDokter').innerHTML = filterHtml;
        }
    } catch (error) {
        console.error('Error loading dokter options:', error);
    }
}

// Open add modal dengan menunggu dokter options siap
async function openAddModal() {
    await loadDokterOptions();
    resetForm();
    new bootstrap.Modal(document.getElementById('jadwalModal')).show();
}

// Reset form
function resetForm() {
    document.getElementById('jadwalForm').reset();
    document.getElementById('jadwalID').value = '';
    document.getElementById('modalTitle').textContent = 'Tambah Jadwal';
}

// Edit jadwal
function editJadwal(id) {
    let jadwal = null;
    for (let doctor of doctoArray) {
        const found = doctor.jadwal.find(j => j.id_jadwal === id);
        if (found) {
            jadwal = found;
            document.getElementById('idDokter').value = doctor.id_doctor;
            break;
        }
    }

    if (jadwal) {
        document.getElementById('jadwalID').value = jadwal.id_jadwal;
        document.getElementById('hari').value = jadwal.hari;
        document.getElementById('jamMulai').value = jadwal.jam_mulai;
        document.getElementById('jamSelesai').value = jadwal.jam_selesai;
        document.getElementById('modalTitle').textContent = 'Edit Jadwal';

        new bootstrap.Modal(document.getElementById('jadwalModal')).show();
    }
}

// Save jadwal
function saveJadwal(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('id_doctor', document.getElementById('idDokter').value);
    formData.append('hari', document.getElementById('hari').value);
    formData.append('jam_mulai', document.getElementById('jamMulai').value);
    formData.append('jam_selesai', document.getElementById('jamSelesai').value);

    const id = document.getElementById('jadwalID').value;
    const method = id ? 'PUT' : 'POST';
    const url = id ? `${API_URL}/jadwal/${id}` : `${API_URL}/jadwal`;

    fetch(url, {
        method: method,
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            showAlert(id ? 'Jadwal berhasil diupdate' : 'Jadwal berhasil ditambahkan', 'success');
            bootstrap.Modal.getInstance(document.getElementById('jadwalModal')).hide();
            loadJadwal();
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

// Delete jadwal
function deleteJadwal(id) {
    if (confirmDelete(id, 'jadwal')) {
        fetch(`${API_URL}/jadwal/${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                showAlert('Jadwal berhasil dihapus', 'success');
                loadJadwal();
            } else {
                showAlert('Gagal menghapus jadwal', 'danger');
            }
        });
    }
}

// Init
document.addEventListener('DOMContentLoaded', async function() {
    await loadDokterOptions();
    loadJadwal();
});
</script>
<?= $this->endSection(); ?>
