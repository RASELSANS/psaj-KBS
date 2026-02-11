<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    /* Warna Header disamakan dengan Khitan & Kontak */
    .vaksin-header { padding: 100px 0 50px; background: #fff2e7; text-align: center; }
    
    .vaksin-card { 
        border-radius: 20px; 
        border: 1px solid #eee; 
        transition: 0.3s; 
        background: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    
    /* Hover effect warna oranye */
    .vaksin-card:hover { 
        border-color: #ff8a3d; 
        background: #fffaf7; 
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(255, 138, 61, 0.2);
    }

    .text-orange { color: #ff8a3d; }
</style>

<section class="vaksin-header">
    <div class="container">
        <h1 class="fw-bold">Layanan Vaksinasi</h1>
        <p class="text-muted">Lindungi diri dan keluarga dengan imunisasi lengkap dan terpercaya.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="vaksin-card p-4 text-center h-100">
                    <i class="fa-solid fa-syringe mb-3 text-orange fs-1"></i>
                    <h5 class="fw-bold">Vaksin Influenza</h5>
                    <p class="text-muted small">Melindungi diri dari berbagai jenis virus flu musiman untuk dewasa dan anak-anak.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="vaksin-card p-4 text-center h-100">
                    <i class="fa-solid fa-baby mb-3 text-orange fs-1"></i>
                    <h5 class="fw-bold">Vaksin Anak</h5>
                    <p class="text-muted small">Layanan imunisasi dasar lengkap (Hepatitis, DPT, Polio, Campak) untuk tumbuh kembang optimal.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="vaksin-card p-4 text-center h-100">
                    <i class="fa-solid fa-shield-virus mb-3 text-orange fs-1"></i>
                    <h5 class="fw-bold">Vaksin Booster</h5>
                    <p class="text-muted small">Meningkatkan kembali kekebalan tubuh terhadap virus spesifik secara berkala.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>