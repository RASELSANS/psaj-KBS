<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    /* Hero Style - Padding bawah dikurangi agar lebih rapat */
    .hero-section { 
        padding-top: 60px; 
        padding-bottom: 20px; 
    }
    .badge-health { background-color: #fff2e7; color: #ff8a3d; font-size: 12px; font-weight: 600; padding: 8px 15px; display: inline-block; margin-bottom: 20px; }
    .hero-title { font-weight: 700; font-size: 3.5rem; line-height: 1.2; margin-bottom: 20px; }
    .hero-desc { color: #777; margin-bottom: 30px; max-width: 450px; }
    .hero-img { border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); width: 100%; }

    /* Services Style - Padding atas dikurangi drastis untuk menghilangkan ruang kosong */
    .services-section { 
        padding-top: 20px; 
        padding-bottom: 80px; 
        scroll-margin-top: 100px; 
    } 
    .section-title { color: #ff8a3d; font-weight: 600; font-size: 2.5rem; margin-bottom: 40px; }
    
    .service-card {
        background-color: #fff2e7;
        border-radius: 20px;
        padding: 40px 30px;
        height: 100%;
        border: none;
        transition: transform 0.3s ease;
        position: relative;
        margin-top: 40px;
    }
    .service-card:hover { transform: translateY(-10px); }
    .icon-wrapper {
        width: 80px; height: 80px;
        background: white; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        position: absolute; top: -40px; left: 50%;
        transform: translateX(-50%);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        border: 2px solid #333;
    }
    .service-card h4 { font-weight: 700; margin-top: 20px; margin-bottom: 20px; color: #000; }
    .service-card p { font-size: 0.9rem; color: #444; line-height: 1.6; }
</style>

<section class="hero-section mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="badge-health">WE TAKE CARE OF YOUR HEALTH</div>
                <h1 class="hero-title">Memberikan Pelayanan terbaik dengan ketulusan</h1>
                <p class="hero-desc">Start your free assesment and consult with a licensed doctor. Expert medical advice is just a click away!</p>
                <a href="#" class="btn btn-orange btn-lg px-5">Reservasi</a>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
    <img src="<?= base_url('img/klinik.jpeg') ?>" alt="Klinik Brayan Sehat" class="hero-img">
</div>

<section id="services" class="services-section text-center mt-5">
    <div class="container">
        <h2 class="section-title">Our Services</h2>
        
        <div class="row g-4 justify-content-center mt-5">
            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-hand-holding-medical fa-2x"></i>
                    </div>
                    <h4>Layanan</h4>
                    <p>Medical Check Up Berbasis Okupasi, Instalasi Farmasi, Laboratorium, Wound Care Dressing Modern (Rawat Luka Modern), Konsultasi Kesehatan Dan Keselamatan Kerja (K3) Kedokteran Kerja, Serta Khitan Center.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-clipboard-check fa-2x"></i>
                    </div>
                    <h4>Penunjangan Diagnostik</h4>
                    <p>Treadmill Test, Spirometri, Audiometri, EKG/ Rekam Jantung, Echocardiography, USG (Abdomen, Tiroid, Mamae), Serta Tes MMPI.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-house-user fa-2x"></i>
                    </div>
                    <h4>Poliklinik</h4>
                    <p>Poli Umum, Poli Gigi, Poli Saraf, Poli Jantung Dan Pembuluh Darah, THT, Bedah, Penyakit Dalam, Kedokteran Jiwa, Radiologi, Paru, Serta Anestesi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>