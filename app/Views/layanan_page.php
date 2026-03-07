<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-orange: #ff8a3d;
        --soft-orange: #fff2e7;
        --dark-navy: #1e293b;
    }

    /* --- REVISI HEADER PREMIUM (GAYA BARU) --- */
    .detail-header { 
        padding: 180px 0 100px; 
        background: linear-gradient(135deg, #ffffff 0%, var(--soft-orange) 100%);
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .detail-header::after {
        content: 'SERVICES';
        position: absolute;
        font-size: 12vw;
        font-weight: 900;
        color: rgba(255, 138, 61, 0.04);
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 0;
        white-space: nowrap;
    }

    .header-tagline {
        display: inline-block;
        padding: 8px 25px;
        background: white;
        color: var(--primary-orange);
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        box-shadow: 0 5px 15px rgba(255, 138, 61, 0.1);
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .detail-header h1 { 
        font-size: 3rem; 
        color: var(--dark-navy); 
        position: relative;
        z-index: 1;
        font-weight: 800;
    }

    .header-desc {
        max-width: 600px;
        margin: 0 auto;
        color: #64748b;
        position: relative;
        z-index: 1;
    }

    /* --- ISI (KEMBALI KE STYLE SEBELUMNYA) --- */
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
        border: none;
        text-decoration: none;
        display: inline-block;
    }
    .btn-orange:hover { 
        background-color: #e66e1f; 
        color: #fff; 
        transform: translateY(-3px); 
        box-shadow: 0 10px 20px rgba(255, 138, 61, 0.3); 
    }

    .text-orange { color: var(--primary-orange); }
</style>

<section class="detail-header">
    <div class="container position-relative" style="z-index: 1;">
        <div data-aos="fade-up">
            <span class="header-tagline">Our Services</span>
            <h1 class="fw-bold mb-3">Layanan Medis <span class="text-orange">Profesional</span></h1>
            <p class="header-desc">
                Kami berkomitmen memberikan pelayanan kesehatan paripurna dengan teknologi modern dan hati yang tulus.
            </p>
        </div>
    </div>
</section>

<section class="detail-content">
    <div class="container">
        
        <div class="row align-items-center service-block" data-aos="fade-right">
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

        <div class="row align-items-center service-block flex-md-row-reverse" data-aos="fade-left">
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

        <div class="row align-items-center service-block" data-aos="fade-right">
            <div class="col-md-6">
                <img src="<?= base_url('img/Layanan33.png') ?>" alt="Poliklinik" class="img-detail">
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

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 1000, once: true });
    });
</script>
<?= $this->endSection(); ?>