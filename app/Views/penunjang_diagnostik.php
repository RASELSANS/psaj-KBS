<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    :root {
        --primary-orange: #ff8a3d;
        --soft-orange: #fff2e7;
    }

    .diagnostik-header { 
        padding: 120px 0 60px; 
        background: linear-gradient(180deg, var(--soft-orange) 0%, #ffffff 100%); 
        text-align: center; 
    }

    /* --- Card Style --- */
    .diag-card-mini { 
        border: 1px solid #f0f0f0; 
        border-radius: 20px; 
        padding: 30px;
        transition: all 0.3s ease; 
        background: #fff; 
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.02);
    }
    
    .diag-card-mini:hover { 
        transform: translateY(-8px); 
        border-color: var(--primary-orange);
        box-shadow: 0 15px 30px rgba(255, 138, 61, 0.1); 
    }

    .icon-circle { 
        width: 65px; height: 65px; 
        background: var(--soft-orange); 
        color: var(--primary-orange); 
        border-radius: 50%; 
        display: flex; align-items: center; justify-content: center; 
        font-size: 1.8rem; margin-bottom: 20px;
        transition: 0.3s;
    }

    .diag-card-mini:hover .icon-circle {
        background: var(--primary-orange);
        color: #fff;
    }

    .diag-card-mini h5 {
        font-weight: 800;
        font-size: 1.15rem;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .diag-card-mini p {
        font-size: 0.9rem;
        color: #777;
        margin-bottom: 0;
    }

    .section-divider {
        font-weight: 800;
        color: var(--primary-orange);
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.9rem;
        margin-bottom: 40px;
        display: block;
        text-align: center;
    }
</style>

<section class="diagnostik-header">
    <div class="container" data-aos="fade-down">
        <h1 class="fw-bold display-5">Penunjang Diagnostik</h1>
        <p class="text-muted mx-auto" style="max-width: 650px;">
            Dilengkapi dengan teknologi medis mutakhir untuk memberikan hasil pemeriksaan yang akurat, cepat, dan terpercaya.
        </p>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="diag-card-mini">
                    <div class="icon-circle"><i class="fa-solid fa-heart-pulse"></i></div>
                    <h5>Treadmill Test</h5>
                    <p>Uji latih beban jantung untuk mendeteksi gangguan aliran darah koroner.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="150">
                <div class="diag-card-mini">
                    <div class="icon-circle"><i class="fa-solid fa-lungs"></i></div>
                    <h5>Spirometri</h5>
                    <p>Pemeriksaan fungsi paru untuk mengukur volume dan kapasitas pernapasan.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="diag-card-mini">
                    <div class="icon-circle"><i class="fa-solid fa-ear-listen"></i></div>
                    <h5>Audiometri</h5>
                    <p>Pemeriksaan tingkat pendengaran untuk mendeteksi gangguan fungsi telinga.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="250">
                <div class="diag-card-mini">
                    <div class="icon-circle"><i class="fa-solid fa-wave-square"></i></div>
                    <h5>EKG / Rekam Jantung</h5>
                    <p>Mendeteksi aktivitas listrik jantung dan gangguan irama jantung.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="diag-card-mini">
                    <div class="icon-circle"><i class="fa-solid fa-van-shuttle"></i></div> <h5>Echocardiography</h5>
                    <p>USG khusus jantung untuk melihat struktur dan fungsi katup jantung.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="350">
                <div class="diag-card-mini">
                    <div class="icon-circle"><i class="fa-solid fa-hospital-user"></i></div>
                    <h5>USG Lengkap</h5>
                    <p>Pemeriksaan USG Abdomen, Thyroid, Mamae, dan organ lainnya.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="400">
                <div class="diag-card-mini">
                    <div class="icon-circle"><i class="fa-solid fa-brain"></i></div>
                    <h5>MMPI Test</h5>
                    <p>Evaluasi psikologis untuk menilai kepribadian dan kondisi kesehatan mental.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="450">
                <div class="diag-card-mini">
                    <div class="icon-circle"><i class="fa-solid fa-x-ray"></i></div>
                    <h5>Rontgen</h5>
                    <p>Pemeriksaan radiologi digital untuk melihat kondisi tulang dan organ dalam.</p>
                </div>
            </div>

            <div class="col-lg-12 text-center mt-5" data-aos="fade-up">
                <p class="text-muted fw-bold italic">Serta berbagai pemeriksaan penunjang medis lainnya sesuai kebutuhan pasien.</p>
            </div>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
<?= $this->endSection(); ?>