<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    .artikel-header { padding: 100px 0 50px; background: #fff2e7; text-align: center; }
    .blog-card { border: none; border-radius: 20px; transition: 0.3s; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .blog-card:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(255, 138, 61, 0.2); }
    .text-orange { color: #ff8a3d; }
    .btn-read-more { color: #ff8a3d; font-weight: 600; text-decoration: none; font-size: 0.9rem; }
</style>

<section class="artikel-header">
    <div class="container">
        <h1 class="fw-bold">Artikel Kesehatan</h1>
        <p class="text-muted">Edukasi dan tips kesehatan terbaru dari tim medis kami.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            
            <div class="col-md-4">
                <div class="blog-card card h-100">
                    <img src="<?= base_url('img/artikel1.png') ?>" class="card-img-top" alt="Vaksinasi" height="200" style="object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="mb-2">
                            <span class="badge bg-light text-orange">Edukasi</span>
                        </div>
                        <h5 class="fw-bold">Pentingnya Vaksinasi Influenza</h5>
                        <p class="text-muted small">Ketahui manfaat vaksin influenza untuk menjaga daya tahan tubuh Anda...</p>
                        <a href="#" class="btn-read-more">Baca Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="blog-card card h-100">
                    <img src="<?= base_url('img/artikel1.png') ?>" class="card-img-top" alt="Pola Hidup" height="200" style="object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="mb-2">
                            <span class="badge bg-light text-orange">Tips Sehat</span>
                        </div>
                        <h5 class="fw-bold">Menjaga Pola Makan Sehat</h5>
                        <p class="text-muted small">Tips mengatur nutrisi harian agar tubuh tetap bugar di tengah kesibukan...</p>
                        <a href="#" class="btn-read-more">Baca Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="blog-card card h-100">
                    <img src="<?= base_url('img/artikel1.png') ?>" class="card-img-top" alt="Checkup" height="200" style="object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="mb-2">
                            <span class="badge bg-light text-orange">Info Medis</span>
                        </div>
                        <h5 class="fw-bold">Kapan Harus Medical Checkup?</h5>
                        <p class="text-muted small">Jangan tunggu sakit! Ketahui waktu ideal untuk melakukan pemeriksaan...</p>
                        <a href="#" class="btn-read-more">Baca Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?= $this->endSection(); ?>