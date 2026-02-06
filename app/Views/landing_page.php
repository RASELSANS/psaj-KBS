<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    /* Hero Style */
    .hero-section { padding: 60px 0 20px 0; }
    .badge-health { background-color: #fff2e7; color: #ff8a3d; font-size: 12px; font-weight: 600; padding: 8px 15px; display: inline-block; margin-bottom: 20px; }
    .hero-title { font-weight: 700; font-size: 3.5rem; line-height: 1.2; margin-bottom: 20px; }
    .hero-desc { color: #777; margin-bottom: 30px; max-width: 450px; }
    .hero-img { border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); width: 100%; object-fit: cover; }

    /* Services Style */
    .services-section { padding: 20px 0 80px 0; scroll-margin-top: 100px; } 
    .section-title { color: #ff8a3d; font-weight: 600; font-size: 2.5rem; margin-bottom: 40px; }
    
    .service-card {
        background-color: #fff2e7;
        border-radius: 20px;
        padding: 40px 30px;
        transition: transform 0.3s ease;
        position: relative;
        margin-top: 40px;
        border: none;
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

    /* CSS Tombol More Info agar muncul */
    .btn-more {
        background-color: transparent;
        color: #ff8a3d;
        border: 2px solid #ff8a3d;
        border-radius: 8px;
        padding: 5px 20px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
        margin-top: 15px;
    }
    .btn-more:hover {
        background-color: #ff8a3d;
        color: white;
    }

    .service-card h4 { font-weight: 700; margin-top: 20px; margin-bottom: 20px; color: #000; }
    .service-card p { font-size: 0.9rem; color: #444; line-height: 1.6; margin-bottom: 20px; }
    
    .btn-orange {
        background-color: #ff8a3d;
        color: white;
        border-radius: 8px;
        padding: 12px 40px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
    }
    .btn-orange:hover {
        background-color: #e67a2d;
        color: white;
    }
</style>

<section class="hero-section mb-5">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <div>
                <div class="badge-health">WE TAKE CARE OF YOUR HEALTH</div>
                <h1 class="hero-title">Memberikan Pelayanan terbaik dengan ketulusan</h1>
                <p class="hero-desc">Start your free assesment and consult with a licensed doctor. Expert medical advice is just a click away!</p>
                <a href="#" class="btn btn-orange">Reservasi</a>
            </div>
            <div class="mt-5 lg:mt-0">
                <img src="<?= base_url('img/klinik.jpeg') ?>" alt="Klinik Brayan Sehat" class="hero-img">
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4">
        <h2 class="section-title">Our Services</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-center mt-5">
            <div class="service-card flex flex-col h-full">
                <div class="icon-wrapper">
                    <i class="fa-solid fa-hand-holding-medical fa-2x"></i>
                </div>
                <h4>Layanan</h4>
                <p>Medical Check Up Berbasis Okupasi, Instalasi Farmasi, Laboratorium, Wound Care Dressing Modern (Rawat Luka Modern), Konsultasi Kesehatan Dan Keselamatan Kerja (K3) Kedokteran Kerja, Serta Khitan Center.</p>
                <div class="mt-auto">
                    <a href="<?= base_url('layanan') ?>" class="btn-more">More Info <i class="fa-solid fa-arrow-right ml-1"></i></a>
                </div>
            </div>

            <div class="service-card flex flex-col h-full">
                <div class="icon-wrapper">
                    <i class="fa-solid fa-clipboard-check fa-2x"></i>
                </div>
                <h4>Penunjangan Diagnostik</h4>
                <p>Treadmill Test, Spirometri, Audiometri, EKG/ Rekam Jantung, Echocardiography, USG (Abdomen, Tiroid, Mamae), Serta Tes MMPI.</p>
                <div class="mt-auto">
                    <a href="#" class="btn-more">More Info <i class="fa-solid fa-arrow-right ml-1"></i></a>
                </div>
            </div>

            <div class="service-card flex flex-col h-full">
                <div class="icon-wrapper">
                    <i class="fa-solid fa-house-user fa-2x"></i>
                </div>
                <h4>Poliklinik</h4>
                <p>Poli Umum, Poli Gigi, Poli Saraf, Poli Jantung Dan Pembuluh Darah, THT, Bedah, Penyakit Dalam, Kedokteran Jiwa, Radiologi, Paru, Serta Anestesi.</p>
                <div class="mt-auto">
                    <a href="#" class="btn-more">More Info <i class="fa-solid fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>