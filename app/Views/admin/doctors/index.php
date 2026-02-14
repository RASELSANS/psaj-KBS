<?= $this->extend('admin/layout') ?>
<?= $this->section('admin_content') ?>

<div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Daftar Dokter</h5>
        <a href="#" class="btn btn-orange btn-sm shadow-sm rounded-pill px-3">
            <i class="fa fa-plus me-1"></i> Tambah Dokter
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 80px;">Foto</th>
                    <th>Nama Lengkap</th>
                    <th>Spesialis</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($doctors as $d): ?>
                <tr>
                    <td><img src="https://via.placeholder.com/50" class="rounded-3 shadow-sm" width="50" height="50"></td>
                    <td>
                        <div class="fw-bold"><?= $d['nama']; ?></div>
                        <small class="text-muted">NIP: <?= $d['nip']; ?></small>
                    </td>
                    <td><span class="text-secondary small"><?= $d['spesialis']; ?></span></td>
                    <td><span class="badge rounded-pill bg-success-subtle text-success border border-success px-3"><?= $d['status']; ?></span></td>
                    <td class="text-center">
                        <div class="btn-group shadow-sm rounded-3 overflow-hidden">
                            <button class="btn btn-white btn-sm text-primary border-end"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-white btn-sm text-danger"><i class="fa fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>