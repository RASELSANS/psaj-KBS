<?= $this->extend('admin/layout'); ?>

<?= $this->section('admin_content'); ?>

<div class="subtitle-admin">Manage</div>
<h1 class="section-title-admin">
    <i class="fas fa-clinic-medical" style="color: #ff8a3d;"></i> Data Poli
</h1>

<div class="data-card">
    <div class="data-card-header">
        <h3 class="data-card-title">Daftar Poli</h3>
        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#poliModal" onclick="resetForm()">
            <i class="fas fa-plus"></i> Tambah Poli
        </button>
    </div>

    <div id="alertContainer"></div>

    <div id="loadingState" class="loading">
        <div class="loading-spinner"></div>
        <p>Memuat data poli...</p>
    </div>

    <div id="tableContainer" style="display: none;">
        <div class="table-wrapper">
            <table class="table" id="poliTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Poli</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="poliBody">
                </tbody>
            </table>
        </div>
    </div>

    <div id="emptyState" style="display: none;" class="empty-state">
        <i class="fas fa-database"></i>
        <p>Tidak ada data poli</p>
    </div>
</div>

<!-- Modal Tambah/Edit Poli -->
<div class="modal fade" id="poliModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Poli</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="poliForm" onsubmit="savePoli(event)">
                <div class="modal-body">
                    <input type="hidden" id="poliID">

                    <div class="form-group">
                        <label class="form-label">Nama Poli *</label>
                        <input type="text" class="form-control" id="namaPoli" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deskripsi *</label>
                        <textarea class="form-control" id="deskripsi" rows="3" required></textarea>
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
// Load poli data
function loadPoli() {
    document.getElementById('loadingState').style.display = 'block';
    document.getElementById('tableContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'none';

    fetch(`${API_URL}/poli`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const poli = data.data.poli;

                if (poli.length > 0) {
                    let html = '';
                    poli.forEach((item, index) => {
                        html += `
                            <tr>
                                <td>${index + 1}</td>
                                <td><strong>${item.nama_poli}</strong></td>
                                <td>${item.deskripsi}</td>
                                <td>
                                    <button class="btn-action btn-edit" onclick="editPoli(${item.id_poli})">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-action btn-delete" onclick="deletePoli(${item.id_poli})">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    document.getElementById('poliBody').innerHTML = html;
                    document.getElementById('tableContainer').style.display = 'block';
                } else {
                    document.getElementById('emptyState').style.display = 'block';
                }

                document.getElementById('loadingState').style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Gagal memuat data poli', 'danger');
            document.getElementById('loadingState').style.display = 'none';
        });
}

// Reset form
function resetForm() {
    document.getElementById('poliForm').reset();
    document.getElementById('poliID').value = '';
    document.getElementById('modalTitle').textContent = 'Tambah Poli';
}

// Edit poli
function editPoli(id) {
    fetch(`${API_URL}/poli`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const poli = data.data.poli.find(p => p.id_poli === id);
                if (poli) {
                    document.getElementById('poliID').value = poli.id_poli;
                    document.getElementById('namaPoli').value = poli.nama_poli;
                    document.getElementById('deskripsi').value = poli.deskripsi;
                    document.getElementById('modalTitle').textContent = 'Edit Poli';

                    new bootstrap.Modal(document.getElementById('poliModal')).show();
                }
            }
        });
}

// Save poli
function savePoli(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('nama_poli', document.getElementById('namaPoli').value);
    formData.append('deskripsi', document.getElementById('deskripsi').value);

    const id = document.getElementById('poliID').value;
    const method = id ? 'PUT' : 'POST';
    const url = id ? `${API_URL}/poli/${id}` : `${API_URL}/poli`;

    fetch(url, {
        method: method,
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            showAlert(id ? 'Poli berhasil diupdate' : 'Poli berhasil ditambahkan', 'success');
            bootstrap.Modal.getInstance(document.getElementById('poliModal')).hide();
            loadPoli();
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

// Delete poli
function deletePoli(id) {
    if (confirmDelete(id, 'poli')) {
        fetch(`${API_URL}/poli/${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                showAlert('Poli berhasil dihapus', 'success');
                loadPoli();
            } else {
                showAlert('Gagal menghapus poli', 'danger');
            }
        });
    }
}

// Init
document.addEventListener('DOMContentLoaded', function() {
    loadPoli();
});
</script>
<?= $this->endSection(); ?>
