<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    .diagnostik-header { padding: 100px 0 50px; background: #fff2e7; text-align: center; }
    .diag-card { 
        border: none; border-radius: 20px; transition: 0.3s; 
        background: #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        height: 100%;
    }
    .diag-card:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(255, 138, 61, 0.2); }
    .icon-box { 
        width: 70px; height: 70px; background: #fff2e7; color: #ff8a3d; 
        border-radius: 50%; display: flex; align-items: center; justify-content: center; 
        font-size: 2rem; margin-bottom: 20px;
    }
    .text-orange { color: #ff8a3d; }
</style>

<section class="diagnostik-header">
    <div class="container">
        <h1 class="fw-bold">Penunjang Diagnostik</h1>
        <p class="text-muted">Layanan pemeriksaan medis akurat dengan teknologi modern untuk diagnosa yang tepat.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="diag-card p-4">
                    <div class="icon-box"><i class="fa-solid fa-microscope"></i></div>
                    <h4 class="fw-bold">Laboratorium</h4>
                    <p class="text-muted">Pemeriksaan darah lengkap, urine, gula darah, kolesterol, hingga fungsi ginjal dan hati.</p>
                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-check text-orange me-2"></i> Hasil Akurat & Cepat</li>
                        <li><i class="fa-solid fa-check text-orange me-2"></i> Alat Otomatis Terbaru</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="diag-card p-4">
                    <div class="icon-box"><i class="fa-solid fa-x-ray"></i></div>
                    <h4 class="fw-bold">Radiologi (Rontgen)</h4>
                    <p class="text-muted">Layanan foto Rontgen untuk mendeteksi kelainan tulang, paru-paru, dan organ dalam lainnya.</p>
                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-check text-orange me-2"></i> Digital Radiography</li>
                        <li><i class="fa-solid fa-check text-orange me-2"></i> Dosis Radiasi Rendah</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="diag-card p-4">
                    <div class="icon-box"><i class="fa-solid fa-baby"></i></div>
                    <h4 class="fw-bold">USG 2D/4D</h4>
                    <p class="text-muted">Pemeriksaan kehamilan maupun organ dalam (abdomen) dengan hasil visual yang jelas.</p>
                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-check text-orange me-2"></i> USG Kebidanan</li>
                        <li><i class="fa-solid fa-check text-orange me-2"></i> USG Organ Dalam</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="diag-card p-4">
                    <div class="icon-box"><i class="fa-solid fa-heart-pulse"></i></div>
                    <h4 class="fw-bold">EKG (Rekam Jantung)</h4>
                    <p class="text-muted">Pemeriksaan aktivitas listrik jantung untuk mendeteksi gangguan irama jantung dini.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="diag-card p-4">
                    <div class="icon-box"><i class="fa-solid fa-pills"></i></div>
                    <h4 class="fw-bold">Farmasi 24 Jam</h4>
                    <p class="text-muted">Penyediaan obat-obatan lengkap dan berkualitas yang dikelola oleh apoteker profesional.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>