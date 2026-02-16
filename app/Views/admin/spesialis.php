<?= $this->extend('admin/new_layout'); ?>

<?= $this->section('admin_content'); ?>

<!-- Page Header -->
<div class="page-header" style="margin-bottom: 2rem;">
    <h1 class="page-title">
        <i class="fas fa-star"></i> Data Spesialis
    </h1>
    <p style="color: #999; margin: 0.5rem 0 0 0;">Kelola daftar spesialisasi medis</p>
</div>

<div class="data-card">
    <div class="data-card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h3 class="data-card-title" style="margin: 0;">Daftar Spesialis</h3>
        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#spesialisModal" onclick="resetForm()">
            <i class="fas fa-plus"></i> Tambah Spesialis
        </button>
    </div>

    <div id="alertContainer"></div>

    <div id="loadingState" class="loading">
        <div class="loading-spinner"></div>
        <p>Memuat data spesialis...</p>
    </div>

    <div id="tableContainer" style="display: none;">
        <div class="table-wrapper">
            <table class="table" id="spesialisTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Spesialis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="spesialisBody">
                </tbody>
            </table>
        </div>
    </div>

    <div id="emptyState" style="display: none;" class="empty-state">
        <i class="fas fa-database"></i>
        <p>Tidak ada data spesialis</p>
    </div>
</div>

<!-- Modal Tambah/Edit Spesialis -->
<div class="modal fade" id="spesialisModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Spesialis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="spesialisForm" onsubmit="saveSpesialis(event)">
                <div class="modal-body">
                    <input type="hidden" id="spesialisID">

                    <div class="form-group">
                        <label class="form-label">Nama Spesialis *</label>
                        <input type="text" class="form-control" id="namaSpesialis" required>
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
// Load spesialis data
function loadSpesialis() {
    document.getElementById('loadingState').style.display = 'block';
    document.getElementById('tableContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'none';

    fetch(`${API_URL}/spesialis`, {credentials: 'include'})
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
            return { data, status, contentType };
        })
        .then(({ data }) => {
            if (data.status) {
                const spesialis = data.data.spesialis;

                if (spesialis.length > 0) {
                    let html = '';
                    spesialis.forEach((item, index) => {
                        html += `
                            <tr>
                                <td>${index + 1}</td>
                                <td><strong>${item.nama_spesialis}</strong></td>
                                <td>
                                    <button class="btn-action btn-edit" onclick="editSpesialis(${item.id_spesialis})">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-action btn-delete" onclick="deleteSpesialis(${item.id_spesialis})">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    document.getElementById('spesialisBody').innerHTML = html;
                    document.getElementById('tableContainer').style.display = 'block';
                } else {
                    document.getElementById('emptyState').style.display = 'block';
                }

                document.getElementById('loadingState').style.display = 'none';
            }
        })
        .catch(error => {
            console.error('loadSpesialis Error:', error);
            console.error('Error message:', error.message);
            showAlert('Gagal memuat data spesialis: ' + error.message, 'danger');
            document.getElementById('loadingState').style.display = 'none';
        });
}

// Reset form
function resetForm() {
    document.getElementById('spesialisForm').reset();
    document.getElementById('spesialisID').value = '';
    document.getElementById('modalTitle').textContent = 'Tambah Spesialis';
}

// Edit spesialis
function editSpesialis(id) {
    fetch(`${API_URL}/spesialis/${id}`, {credentials: 'include'})
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const spesialis = data.data;
                document.getElementById('spesialisID').value = spesialis.id_spesialis;
                document.getElementById('namaSpesialis').value = spesialis.nama_spesialis;
                document.getElementById('modalTitle').textContent = 'Edit Spesialis';

                new bootstrap.Modal(document.getElementById('spesialisModal')).show();
            } else {
                showAlert('Spesialis tidak ditemukan', 'danger');
            }
        })
        .catch(error => {
            console.error('editSpesialis Error:', error);
            showAlert('Error memuat spesialis: ' + error.message, 'danger');
        });
}

// Save spesialis
function saveSpesialis(e) {
    e.preventDefault();

    const nama_spesialis = document.getElementById('namaSpesialis').value;
    const id = document.getElementById('spesialisID').value;
    const url = id ? `${API_URL}/spesialis/${id}` : `${API_URL}/spesialis`;

    const params = new URLSearchParams();
    if (id) {
        params.append('_method', 'PUT'); // Method spoofing for UPDATE
    }
    params.append('nama_spesialis', nama_spesialis);

    fetch(url, {
        method: 'POST',
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
            showAlert(id ? 'Spesialis berhasil diupdate' : 'Spesialis berhasil ditambahkan', 'success');
            bootstrap.Modal.getInstance(document.getElementById('spesialisModal')).hide();
            loadSpesialis();
        } else {
            const errors = data.errors ? Object.values(data.errors).join(', ') : data.message || 'Terjadi kesalahan';
            showAlert(errors, 'danger');
        }
    })
    .catch(error => {
        console.error('saveSpesialis Error:', error);
        console.error('Error message:', error.message);
        showAlert('Terjadi kesalahan: ' + error.message, 'danger');
    });
}

// Delete spesialis
function deleteSpesialis(id) {
    confirmDelete('spesialis', () => {
        const params = new URLSearchParams();
        params.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

        fetch(`${API_URL}/spesialis/${id}`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            credentials: 'include',
            body: params
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                showAlert('Spesialis berhasil dihapus', 'success');
                loadSpesialis();
            } else {
                showAlert('Gagal menghapus spesialis', 'danger');
            }
        });
    });
}

// Init
document.addEventListener('DOMContentLoaded', function() {
    loadSpesialis();
});
</script>
<?= $this->endSection(); ?>
