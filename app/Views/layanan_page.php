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
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="font-bold">Detail Layanan Kami</h1>
        <p class="text-gray-600">Komitmen kami memberikan pelayanan kesehatan paripurna untuk Anda.</p>
    </div>
</section>

<section class="detail-content">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center mb-5">
            <div>
                <img src="https://via.placeholder.com/600x400" alt="Layanan Umum" class="img-detail">
            </div>
            <div class="pl-0 md:pl-5 mt-4 md:mt-0">
                <h2 class="font-bold mb-4" style="color: #ff8a3d;">Medical Check Up & Rawat Luka</h2>
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