<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    /* Background header disamakan dengan Layanan & Kontak */
    .khitan-header { padding: 100px 0 50px; background: #fff2e7; text-align: center; }
    
    .feature-box { 
        border: none; 
        border-radius: 20px; 
        background: #fff; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
        transition: 0.3s; 
        border-left: 5px solid transparent;
    }
    
    /* Hover effect warna oranye */
    .feature-box:hover { 
        transform: translateY(-5px); 
        border-left: 5px solid #ff8a3d; 
        box-shadow: 0 15px 35px rgba(255, 138, 61, 0.2);
    }
    
    .text-orange { color: #ff8a3d; }
</style>

<section class="khitan-header">
    <div class="container">
        <h1 class="fw-bold">Khitan Center Modern</h1>
        <p class="text-muted">Metode khitan terkini yang minim rasa sakit, tanpa suntik, dan tanpa jahit.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="feature-box p-4 h-100">
                    <h4 class="fw-bold text-orange"><i class="fa-solid fa-wand-magic-sparkles me-2"></i> Metode Super Ring</h4>
                    <p class="text-muted">Metode tanpa perban dan boleh langsung terkena air. Sangat nyaman untuk anak karena bisa langsung beraktivitas.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature-box p-4 h-100">
                    <h4 class="fw-bold text-orange"><i class="fa-solid fa-bolt me-2"></i> Metode Laser (Flash Cauter)</h4>
                    <p class="text-muted">Proses sangat cepat, perdarahan minimal, dan proses penyembuhan yang relatif lebih singkat.</p>
                </div>
            </div>
        </div>
        
        <div class="mt-5 p-4 bg-light rounded-4 border-start border-4 border-warning">
            <h5 class="fw-bold mb-3">Kenapa Khitan di Brayan Sehat?</h5>
            <div class="row g-3">
                <div class="col-md-4"><i class="fa-solid fa-circle-check text-success me-2"></i> Tenaga Medis Ahli</div>
                <div class="col-md-4"><i class="fa-solid fa-circle-check text-success me-2"></i> Alat Steril & Modern</div>
                <div class="col-md-4"><i class="fa-solid fa-circle-check text-success me-2"></i> Kontrol Pasca Khitan Gratis</div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?> 