<?= $this->extend('admin/layout') ?>
<?= $this->section('admin_content') ?>

<div class="row g-4">
    <div class="col-md-7">
        <div class="admin-card">
            <h6 class="fw-bold mb-3"><i class="fa fa-sliders me-2 text-orange-kbs"></i>Kelola Website</h6>
            <div class="row g-3">
                <div class="col-6">
                    <a href="#" class="btn btn-light w-100 p-4 text-start border shadow-sm rounded-4 text-decoration-none">
                        <i class="fa fa-edit d-block mb-2 text-warning fs-4"></i> 
                        <span class="text-dark fw-bold">Edit Halaman</span>
                    </a>
                </div>
                <div class="col-6">
                    <a href="#" class="btn btn-light w-100 p-4 text-start border shadow-sm rounded-4 text-decoration-none">
                        <i class="fa fa-info-circle d-block mb-2 text-info fs-4"></i> 
                        <span class="text-dark fw-bold">Update Info Klinik</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="d-flex justify-content-between mb-3 align-items-center">
                <h6 class="fw-bold mb-0">Artikel & Galeri</h6>
                <div class="btn-group gap-2">
                    <a href="<?= base_url('admin/artikel/add') ?>" class="btn btn-dark btn-sm rounded-pill px-3 shadow-sm">
                        <i class="fa fa-plus me-1"></i> Tambah Artikel
                    </a>
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3 shadow-sm">
                        <i class="fa fa-camera me-1"></i> Upload Foto
                    </button>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-6">
                    <div class="bg-light p-2 rounded-4 border position-relative overflow-hidden">
                        <img src="https://via.placeholder.com/300x150" class="img-fluid rounded-3 mb-2 shadow-sm">
                        <p class="small fw-bold mb-0 px-1 text-dark text-truncate">Tips Sehat Musim Hujan</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="bg-light p-2 rounded-4 border position-relative overflow-hidden">
                        <img src="https://via.placeholder.com/300x150" class="img-fluid rounded-3 mb-2 shadow-sm">
                        <p class="small fw-bold mb-0 px-1 text-dark text-truncate">Galeri Klinik Terbaru</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="admin-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Jadwal Dokter</h6>
                <a href="<?= base_url('admin/doctors') ?>" class="small text-orange-kbs text-decoration-none">Kelola <i class="fa fa-arrow-right small"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table table-sm small table-borderless">
                    <thead class="text-muted border-bottom">
                        <tr><th>Nama</th><th>Jadwal</th></tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle">
                            <td class="py-2"><strong>dr. Andi W.</strong><br><span class="text-muted" style="font-size: 10px;">Penyakit Dalam</span></td>
                            <td><span class="badge bg-light text-dark border">Senin, Rabu</span></td>
                        </tr>
                        <tr class="align-middle">
                            <td class="py-2"><strong>dr. Siti K.</strong><br><span class="text-muted" style="font-size: 10px;">Kandungan</span></td>
                            <td><span class="badge bg-light text-dark border">Selasa, Kamis</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-orange w-100 py-2 rounded-3 mt-2 fw-bold shadow-sm">
                Update Semua Jadwal <i class="fa fa-sync-alt ms-2" style="font-size: 12px;"></i>
            </button>
        </div>

        <div class="admin-card">
            <h6 class="fw-bold mb-3">Data Chatbot</h6>
            <div class="row g-2">
                <div class="col-6">
                    <div class="p-3 bg-light rounded-4 text-center border shadow-sm">
                        <small class="text-muted d-block mb-1">Total Chat</small>
                        <h4 class="fw-bold mb-0" style="color: var(--sidebar-dark)">1,250</h4>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-light rounded-4 text-center border shadow-sm">
                        <small class="text-muted d-block mb-1">Rating App</small>
                        <h4 class="fw-bold mb-0 text-warning">4.6 <i class="fa fa-star fs-6"></i></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>