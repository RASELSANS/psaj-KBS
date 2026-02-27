<?= $this->extend('admin/layout'); ?>

<?= $this->section('admin_content'); ?>

<!-- Page Header -->
<div class="page-header" style="margin-bottom: 2rem;">
    <h1 class="page-title">
        <i class="fas fa-clinic-medical"></i> Data Poli
    </h1>
    <p style="color: #999; margin: 0.5rem 0 0 0;">Kelola departemen dan poliklinik</p>
</div>

<div class="data-card">
    <div class="data-card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h3 class="data-card-title" style="margin: 0;">Daftar Poli</h3>
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

    fetch(`${API_URL}/poli`, {credentials: 'include'})
        .then(response => {
            // Log response details
            console.log('loadPoli response status:', response.status);
            console.log('loadPoli response headers:', {
                'content-type': response.headers.get('content-type')
            });
            
            if (!response.ok) {
                console.error('Response not OK:', response.status);
            }
            
            return response.text().then(text => ({
                text: text,
                ok: response.ok,
                status: response.status,
                contentType: response.headers.get('content-type')
            }));
        })
        .then(({ text, ok, status, contentType }) => {
            // Try to parse as JSON
            let data;
            try {
                data = JSON.parse(text);
            } catch (e) {
                console.error('Failed to parse JSON:', e);
                console.error('Response text:', text.substring(0, 200));
                throw new Error(`Invalid JSON response (${status}): ${text.substring(0, 100)}`);
            }
            
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
            } else {
                throw new Error('API returned status=false: ' + JSON.stringify(data.errors));
            }
        })
        .catch(error => {
            console.error('loadPoli Error:', error);
            console.error('Error message:', error.message);
            showAlert('Gagal memuat data poli: ' + error.message, 'danger');
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
    fetch(`${API_URL}/poli/${id}`, {credentials: 'include'})
        .then(response => response.text().then(text => ({
            text: text,
            status: response.status
        })))
        .then(({ text, status }) => {
            try {
                const data = JSON.parse(text);
                if (data.status) {
                    const poli = data.data;
                    document.getElementById('poliID').value = poli.id_poli;
                    document.getElementById('namaPoli').value = poli.nama_poli;
                    document.getElementById('deskripsi').value = poli.deskripsi;
                    document.getElementById('modalTitle').textContent = 'Edit Poli';

                    new bootstrap.Modal(document.getElementById('poliModal')).show();
                }
            } catch (e) {
                console.error('Failed to parse editPoli response:', e);
                console.error('Response:', text.substring(0, 200));
            }
        })
        .catch(error => {
            console.error('editPoli Error:', error);
        });
}

// Save poli
function savePoli(e) {
    e.preventDefault();

    const namaPoli = document.getElementById('namaPoli').value.trim();
    const deskripsi = document.getElementById('deskripsi').value.trim();

    // Client-side validation
    if (!namaPoli) {
        showAlert('Nama Poli tidak boleh kosong', 'warning');
        return;
    }
    if (!deskripsi) {
        showAlert('Deskripsi tidak boleh kosong', 'warning');
        return;
    }

    const id = document.getElementById('poliID').value;
    const url = id ? `${API_URL}/poli/${id}` : `${API_URL}/poli`;

    const params = new URLSearchParams();
    if (id) {
        params.append('_method', 'PUT'); // Method spoofing for UPDATE
    }
    params.append('nama_poli', namaPoli);
    params.append('deskripsi', deskripsi);

    fetch(url, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        credentials: 'include',
        body: params
    })
    .then(response => {
        // Log response details for debugging
        console.log('savePoli response status:', response.status);
        console.log('savePoli response headers:', {
            'content-type': response.headers.get('content-type')
        });
        
        return response.text().then(text => ({
            text: text,
            status: response.status,
            contentType: response.headers.get('content-type')
        }));
    })
    .then(({ text, status, contentType }) => {
        console.log('savePoli response text (first 200 chars):', text.substring(0, 200));
        
        // Try to parse as JSON
        let data;
        try {
            data = JSON.parse(text);
        } catch (e) {
            console.error('Failed to parse JSON:', e);
            console.error('Full response text:', text);
            throw new Error(`Invalid JSON response (status ${status}). Response: ${text.substring(0, 150)}`);
        }
        
        if (data.status) {
            showAlert(id ? 'Poli berhasil diupdate' : 'Poli berhasil ditambahkan', 'success');
            setTimeout(() => {
                bootstrap.Modal.getInstance(document.getElementById('poliModal')).hide();
                loadPoli();
            }, 500);
        } else {
            const errors = data.errors ? Object.values(data.errors).join(', ') : data.message || 'Terjadi kesalahan';
            showAlert(errors, 'danger');
        }
    })
    .catch(error => {
        console.error('savePoli Error:', error);
        console.error('Error message:', error.message);
        showAlert('Terjadi kesalahan: ' + error.message, 'danger');
    });
}

// Delete poli
function deletePoli(id) {
    confirmDelete('poli', () => {
        const params = new URLSearchParams();
        params.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

        fetch(`${API_URL}/poli/${id}`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            credentials: 'include',
            body: params
        })
        .then(response => response.text().then(text => ({
            text: text,
            status: response.status
        })))
        .then(({ text, status }) => {
            try {
                const data = JSON.parse(text);
                if (data.status) {
                    showAlert('Poli berhasil dihapus', 'success');
                    loadPoli();
                } else {
                    showAlert('Gagal menghapus poli: ' + JSON.stringify(data.errors), 'danger');
                }
            } catch (e) {
                console.error('Failed to parse deletePoli response:', e);
                console.error('Response:', text.substring(0, 200));
                showAlert('Error parsing delete response', 'danger');
            }
        })
        .catch(error => {
            console.error('deletePoli Error:', error);
            showAlert('Error: ' + error.message, 'danger');
        });
    });
}

// Init
document.addEventListener('DOMContentLoaded', function() {
    loadPoli();
});
</script>
<?= $this->endSection(); ?>
