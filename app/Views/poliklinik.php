<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    :root {
        --primary-orange: #ff8a3d;
        --soft-orange: #fff5ed;
    }

    /* --- Header Clean --- */
    .poli-header { 
        padding: 130px 0 60px; 
        background: linear-gradient(180deg, var(--soft-orange) 0%, #ffffff 100%);
        text-align: center; 
    }

    /* --- Grid Poli Compact --- */
    .poli-card-compact {
        background: #fff;
        border-radius: 20px;
        padding: 30px 20px;
        height: 100%;
        border: 1px solid #f0f0f0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.02);
    }

    .poli-card-compact:hover {
        transform: translateY(-8px);
        border-color: var(--primary-orange);
        box-shadow: 0 15px 30px rgba(255, 138, 61, 0.12);
    }

    .icon-wrapper {
        width: 70px;
        height: 70px;
        background: var(--soft-orange);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        transition: 0.3s;
    }

    .poli-card-compact:hover .icon-wrapper {
        background: var(--primary-orange);
        color: #fff;
    }

    .icon-wrapper i {
        font-size: 2rem;
        color: var(--primary-orange);
        transition: 0.3s;
    }

    .poli-card-compact:hover .icon-wrapper i {
        color: #fff;
    }

    .card-title-small {
        font-weight: 700;
        font-size: 1.15rem;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .card-desc-small {
        color: #777;
        font-size: 0.85rem;
        line-height: 1.5;
        margin-bottom: 0;
    }

    .poli-container {
        padding-bottom: 80px;
    }
</style>

<section class="poli-header">
    <div class="container" data-aos="fade-down">
        <h1 class="fw-bold display-5">Layanan Poliklinik</h1>
        <p class="text-muted mx-auto" style="max-width: 600px;">
            Komitmen kami memberikan layanan medis spesialis terbaik dengan tenaga ahli profesional bagi Anda.
        </p>
    </div>
</section>

<section class="poli-container">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="50">
                <div class="poli-card-compact">
                    <div class="icon-wrapper"><i class="fa-solid fa-user-md"></i></div>
                    <h5 class="card-title-small">Poli Umum</h5>
                    <p class="card-desc-small">Pemeriksaan kesehatan dasar, konsultasi umum, dan rujukan medis harian.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="poli-card-compact">
                    <div class="icon-wrapper"><i class="fa-solid fa-tooth"></i></div>
                    <h5 class="card-title-small">Poli Gigi</h5>
                    <p class="card-desc-small">Layanan kesehatan gigi dan mulut, mulai dari pembersihan hingga tindakan bedah ringan.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
                <div class="poli-card-compact">
                    <div class="icon-wrapper"><i class="fa-solid fa-heart-pulse"></i></div>
                    <h5 class="card-title-small">Poli Jantung & Pembuluh Darah</h5>
                    <p class="card-desc-small">Diagnosa dan penanganan masalah kardiovaskular secara komprehensif.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="poli-card-compact">
                    <div class="icon-wrapper"><i class="fa-solid fa-ear-deaf"></i></div>
                    <h5 class="card-title-small">Poli THT</h5>
                    <p class="card-desc-small">Spesialisasi kesehatan Telinga, Hidung, dan Tenggorokan.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
                <div class="poli-card-compact">
                    <div class="icon-wrapper"><i class="fa-solid fa-stethoscope"></i></div>
                    <h5 class="card-title-small">Poli Penyakit Dalam</h5>
                    <p class="card-desc-small">Penanganan masalah kesehatan organ internal dan manajemen penyakit kronis.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="poli-card-compact">
                    <div class="icon-wrapper"><i class="fa-solid fa-x-ray"></i></div>
                    <h5 class="card-title-small">Poli Radiologi</h5>
                    <p class="card-desc-small">Layanan imaging diagnostik untuk diagnosa medis yang akurat.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
                <div class="poli-card-compact">
                    <div class="icon-wrapper"><i class="fa-solid fa-baby-carriage"></i></div>
                    <h5 class="card-title-small">Poli Anak</h5>
                    <p class="card-desc-small">Pelayanan kesehatan menyeluruh untuk bayi, anak-anak, dan remaja.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="poli-card-compact">
                    <div class="icon-wrapper"><i class="fa-solid fa-brain"></i></div>
                    <h5 class="card-title-small">Poli Kedokteran Jiwa (Psikiater)</h5>
                    <p class="card-desc-small">Layanan konsultasi kesehatan mental dan penanganan klinis psikis.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="450">
                <div class="poli-card-compact">
                    <div class="icon-wrapper"><i class="fa-solid fa-user-friends"></i></div>
                    <h5 class="card-title-small">Psikolog</h5>
                    <p class="card-desc-small">Layanan konseling psikologis untuk kesehatan mental dan kesejahteraan emosional.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            once: true
        });
    });
</script>
<?= $this->endSection(); ?>