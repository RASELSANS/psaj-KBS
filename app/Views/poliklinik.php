<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    .poli-header { padding: 100px 0 50px; background: #fff2e7; text-align: center; }
    .poli-item { 
        border: 1px solid #eee; border-radius: 15px; padding: 20px; 
        transition: 0.3s; background: #fff; margin-bottom: 20px;
    }
    .poli-item:hover { border-color: #ff8a3d; transform: scale(1.02); }
    .poli-icon { 
        font-size: 2.5rem; color: #ff8a3d; margin-right: 20px; 
        width: 60px; text-align: center;
    }
    .text-orange { color: #ff8a3d; }
</style>

<section class="poli-header">
    <div class="container">
        <h1 class="fw-bold">Layanan Poliklinik</h1>
        <p class="text-muted">Klinik Brayan Sehat menyediakan berbagai layanan spesialis untuk keluarga Anda.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="poli-item d-flex align-items-center">
                    <div class="poli-icon"><i class="fa-solid fa-user-doctor"></i></div>
                    <div>
                        <h4 class="fw-bold mb-1">Poliklinik Umum</h4>
                        <p class="text-muted mb-0">Pemeriksaan kesehatan dasar dan konsultasi kesehatan harian.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="poli-item d-flex align-items-center">
                    <div class="poli-icon"><i class="fa-solid fa-tooth"></i></div>
                    <div>
                        <h4 class="fw-bold mb-1">Poliklinik Gigi</h4>
                        <p class="text-muted mb-0">Perawatan gigi, cabut gigi, tambal, hingga pembersihan karang gigi.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="poli-item d-flex align-items-center">
                    <div class="poli-icon"><i class="fa-solid fa-person-breastfeeding"></i></div>
                    <div>
                        <h4 class="fw-bold mb-1">Kesehatan Ibu & Anak (KIA)</h4>
                        <p class="text-muted mb-0">Konsultasi kehamilan, imunisasi anak, dan program KB.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="poli-item d-flex align-items-center">
                    <div class="poli-icon"><i class="fa-solid fa-stethoscope"></i></div>
                    <div>
                        <h4 class="fw-bold mb-1">Spesialis Penyakit Dalam</h4>
                        <p class="text-muted mb-0">Penanganan masalah organ dalam yang lebih spesifik dan kronis.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>