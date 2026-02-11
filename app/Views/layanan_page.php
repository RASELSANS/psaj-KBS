<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    /* Header Section */
    .detail-header { 
        padding: 100px 0 60px; 
        background: linear-gradient(135deg, #fff2e7 0%, #ffffff 100%); 
        text-align: center; 
    }
    .detail-header h1 { font-size: 2.8rem; color: #333; }

    /* Content Section */
    .detail-content { padding: 80px 0; }
    
    .list-service { list-style: none; padding-left: 0; margin-bottom: 30px; }
    .list-service li { 
        margin-bottom: 12px; 
        display: flex; 
        align-items: center; 
        font-size: 1.05rem;
        color: #555;
    }
    .list-service li i { color: #ff8a3d; margin-right: 15px; font-size: 1.2rem; }
    
    .img-detail { 
        border-radius: 30px; 
        width: 100%; 
        box-shadow: 0 20px 40px rgba(0,0,0,0.08); 
        transition: transform 0.3s ease;
    }
    .img-detail:hover { transform: scale(1.02); }

    .service-block { margin-bottom: 100px; }
    .btn-orange { 
        background-color: #ff8a3d; 
        color: #fff; 
        padding: 12px 30px; 
        border-radius: 50px; 
        font-weight: 600; 
        transition: 0.3s;
    }
    .btn-orange:hover { background-color: #e66e1f; color: #fff; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(255, 138, 61, 0.3); }
</style>

<section class="detail-header">
    <div class="container">
        <span class="badge mb-3" style="background: #ff8a3d; padding: 8px 20px; border-radius: 50px;">OUR SERVICES</span>
        <h1 class="fw-bold">Layanan Medis Profesional</h1>
        <p class="text-muted mx-auto" style="max-width: 600px;">Kami berkomitmen memberikan pelayanan kesehatan paripurna dengan teknologi modern dan hati yang tulus.</p>
    </div>
</section>

<section class="detail-content">
    <div class="container">
        
        <div class="row align-items-center service-block">
            <div class="col-md-6">
                <img src="<?= base_url('img/Layanan1.png') ?>" alt="Layanan Umum" class="img-detail">
            </div>
            <div class="col-md-6 ps-md-5 mt-4 mt-md-0">
                <h2 class="fw-bold mb-4" style="color: #ff8a3d;">Medical Check Up </h2>
                <p class="text-secondary mb-4">Pemeriksaan kesehatan menyeluruh untuk deteksi dini dan penanganan luka dengan teknik modern agar proses penyembuhan lebih cepat dan minim nyeri.</p>
                <ul class="list-service">
                    <li><i class="fa-solid fa-circle-check"></i> Pemeriksaan Fisik Lengkap</li>
                    <li><i class="fa-solid fa-circle-check"></i> Rawat Luka Modern (Wound Care)</li>
                    <li><i class="fa-solid fa-circle-check"></i> Konsultasi Kedokteran Kerja (K3)</li>
                    <li><i class="fa-solid fa-circle-check"></i> Instalasi Farmasi 24 Jam</li>
                </ul>
                <a href="https://wa.me/6285540441147" class="btn btn-orange">Hubungi Admin</a>
            </div>
        </div>

        <div class="row align-items-center service-block flex-md-row-reverse">
            <div class="col-md-6">
                <img src="<?= base_url('img/Layanan2.png') ?>" alt="Penunjang Diagnostik" class="img-detail">
            </div>
            <div class="col-md-6 pe-md-5 mt-4 mt-md-0">
                <h2 class="fw-bold mb-4" style="color: #ff8a3d;">Penunjang Diagnostik</h2>
                <p class="text-secondary mb-4">Dilengkapi dengan peralatan medis terkini untuk memberikan hasil diagnosa yang akurat dan terpercaya bagi rencana pengobatan Anda.</p>
                <ul class="list-service">
                    <li><i class="fa-solid fa-circle-check"></i> EKG & Treadmill Jantung</li>
                    <li><i class="fa-solid fa-circle-check"></i> USG Abdomen & Tiroid</li>
                    <li><i class="fa-solid fa-circle-check"></i> Spirometri & Audiometri</li>
                    <li><i class="fa-solid fa-circle-check"></i> Pemeriksaan Laboratorium</li>
                </ul>
                <a href="https://wa.me/6285540441147" class="btn btn-orange">Cek Jadwal</a>
            </div>
        </div>

        <div class="row align-items-center service-block">
            <div class="col-md-6">
                <img src="<?= base_url('img/Layanan3.png') ?>" alt="Poliklinik" class="img-detail">
            </div>
            <div class="col-md-6 ps-md-5 mt-4 mt-md-0">
                <h2 class="fw-bold mb-4" style="color: #ff8a3d;">Poliklinik Spesialis</h2>
                <p class="text-secondary mb-4">Konsultasikan keluhan kesehatan Anda langsung dengan dokter spesialis kami yang berpengalaman di bidangnya masing-masing.</p>
                <ul class="list-service">
                    <li><i class="fa-solid fa-circle-check"></i> Poli Umum & Gigi</li>
                    <li><i class="fa-solid fa-circle-check"></i> Poli Jantung & Penyakit Dalam</li>
                    <li><i class="fa-solid fa-circle-check"></i> Poli Saraf & Jiwa</li>
                    <li><i class="fa-solid fa-circle-check"></i> Poli Bedah & Radiologi</li>
                </ul>
                <a href="https://wa.me/6285540441147" class="btn btn-orange">Buat Janji</a>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection(); ?>