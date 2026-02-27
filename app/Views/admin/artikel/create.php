<?= $this->extend('admin/layout') ?>
<?= $this->section('admin_content') ?>

<div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Tulis Artikel Baru</h5>
        <a href="<?= base_url('admin') ?>" class="btn btn-light btn-sm border">Batal</a>
    </div>

    <form action="<?= base_url('admin/artikel/store') ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Artikel</label>
                    <input type="text" name="judul" class="form-control p-3 border-0 bg-light rounded-3" placeholder="Masukkan judul yang menarik..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Isi Konten</label>
                    <textarea name="isi" class="form-control border-0 bg-light rounded-3" rows="12" placeholder="Tuliskan isi artikel lengkap di sini..." required></textarea>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="mb-3 p-3 border rounded-4 bg-white shadow-sm">
                    <label class="form-label fw-bold">Gambar Utama</label>
                    <input type="file" name="foto" class="form-control mb-2" accept="image/*">
                    <small class="text-muted">Gunakan file .jpg atau .png (Maks 2MB)</small>
                </div>
                
                <div class="mb-3 p-3 border rounded-4 bg-white shadow-sm">
                    <label class="form-label fw-bold">Kategori</label>
                    <select name="kategori" class="form-select border-0 bg-light">
                        <option value="Tips Kesehatan">Tips Kesehatan</option>
                        <option value="Info Klinik">Info Klinik</option>
                        <option value="Event">Event</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-orange w-100 py-3 rounded-3 fw-bold shadow">
                    Terbitkan Artikel <i class="fa fa-paper-plane ms-2"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>