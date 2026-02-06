<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    .detail-header { padding: 80px 0 40px; background: #fff2e7; text-align: center; }
    .detail-content { padding: 60px 0; }
    .list-service { list-style: none; padding-left: 0; }
    .list-service li { margin-bottom: 15px; display: flex; align-items: center; }
    .list-service li i { color: #ff8a3d; margin-right: 15px; }
    .img-detail { border-radius: 20px; width: 100%; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
</style>

<section class="detail-header">
    <div class="container">
        <h1 class="fw-bold">Detail Layanan Kami</h1>
        <p class="text-muted">Komitmen kami memberikan pelayanan kesehatan paripurna untuk Anda.</p>
    </div>
</section>

<section class="detail-content">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="https://via.placeholder.com/600x400" alt="Layanan Umum" class="img-detail">
            </div>
            <div class="col-md-6 ps-md-5 mt-4 mt-md-0">
                <h2 class="fw-bold mb-4" style="color: #ff8a3d;">Medical Check Up & Rawat Luka</h2>
                <p>Kami menyediakan fasilitas pemeriksaan kesehatan menyeluruh yang didukung oleh tenaga profesional.</p>
                <ul class="list-service">
                    <li><i class="fa-solid fa-check-circle"></i> Pemeriksaan Fisik Lengkap</li>
                    <li><i class="fa-solid fa-check-circle"></i> Rawat Luka Modern (Wound Care)</li>
                    <li><i class="fa-solid fa-check-circle"></i> Konsultasi K3 & Kedokteran Kerja</li>
                    <li><i class="fa-solid fa-check-circle"></i> Instalasi Farmasi 24 Jam</li>
                </ul>
                <a href="<?= base_url() ?>#registration" class="btn btn-orange">Daftar Sekarang</a>
            </div>
        </div>
        
        <hr class="my-5">
        
        </div>
</section>
<?= $this->endSection(); ?>