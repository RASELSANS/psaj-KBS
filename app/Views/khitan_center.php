<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-orange: #ff8a3d;
        --dark-navy: #1e293b;
        --soft-orange: #fff2e7;
        --bg-light: #f8fafc;
        --success-green: #10b981;
    }

    body { background-color: var(--bg-light); }

    /* --- HEADER WATERMARK (YANG LO SUKA) --- */
    .khitan-header { 
        padding: 180px 0 100px; 
        background: linear-gradient(135deg, #ffffff 0%, var(--soft-orange) 100%);
        position: relative;
        overflow: hidden;
    }

    .khitan-header::after {
        content: 'KHITAN';
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
        padding: 8px 20px;
        background: white;
        color: var(--primary-orange);
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(255, 138, 61, 0.1);
    }

    /* --- BENEFIT WRAPPER (ISIPERSI SEBELUMNYA) --- */
    .benefit-wrapper {
        background: white;
        border-radius: 40px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
        margin-top: -50px; /* Efek menumpuk ke header */
        position: relative;
        z-index: 10;
        border: 1px solid rgba(0,0,0,0.02);
    }

    .check-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 15px;
        background: var(--bg-light);
        border-radius: 15px;
        margin-bottom: 10px;
        font-weight: 600;
        color: var(--dark-navy);
        transition: 0.3s;
    }
    .check-item:hover { background: #eef2f7; }
    .check-item i { color: var(--success-green); font-size: 1.2rem; }

    /* --- METHOD CARDS --- */
    .method-card {
        background: #fff;
        border-radius: 30px;
        padding: 40px 30px;
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }
    .method-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.1);
        border-color: var(--primary-orange);
    }
    .icon-box {
        width: 70px; height: 70px;
        background: var(--soft-orange);
        color: var(--primary-orange);
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 25px;
    }

    /* --- PRICING GRID --- */
    .pricing-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 15px;
        margin-top: 30px;
    }
    .price-tag {
        background: white;
        padding: 15px 20px;
        border-radius: 20px;
        border: 1px solid #eee;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: 0.3s;
        cursor: pointer;
        text-decoration: none;
        color: var(--dark-navy);
        font-weight: 600;
    }
    .price-tag:hover {
        background: var(--primary-orange);
        color: white;
        border-color: var(--primary-orange);
    }

    .section-title { font-weight: 800; color: var(--dark-navy); position: relative; }
</style>

<section class="khitan-header">
    <div class="container position-relative" style="z-index: 1;">
        <div class="text-center" data-aos="zoom-in">
            <span class="header-tagline">Sirkum Smile Indonesia Partner</span>
            <h1 class="display-4 fw-bold mt-3 mb-4">Khitan Center <span style="color: var(--primary-orange);">Modern</span></h1>
            <p class="mx-auto text-muted" style="max-width: 650px; font-size: 1.1rem;">
                Klinik Utama Brayan Sehat menghadirkan pengalaman khitan yang menyenangkan, minim trauma, dan ditangani profesional.
            </p>
        </div>
    </div>
</section>

<div class="container">
    <div class="benefit-wrapper" data-aos="fade-up">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <h3 class="fw-bold mb-4">Mengapa Pilih Kami?</h3>
                <div class="check-item"><i class="fa-solid fa-circle-check"></i> Tenaga Medis Ahli & Berpengalaman</div>
                <div class="check-item"><i class="fa-solid fa-circle-check"></i> Alat Steril & Sekali Pakai</div>
                <div class="check-item"><i class="fa-solid fa-circle-check"></i> Kontrol Pasca Khitan GRATIS</div>
            </div>
            <div class="col-lg-7 mt-4 mt-lg-0">
                <div class="p-4 rounded-4" style="background: var(--soft-orange); border: 2px dashed var(--primary-orange);">
                    <h5 class="fw-bold"><i class="fa-solid fa-notes-medical me-2 text-orange"></i> Manfaat Medis Khitan</h5>
                    <p class="small text-muted mb-0">
                        Kerjasama strategis kami dengan <strong>Sirkum Smile Indonesia</strong> menjamin akses metode khitan termutakhir yang secara medis terbukti mengurangi risiko infeksi saluran kemih (ISK) dan menjaga kesehatan reproduksi jangka panjang.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <section class="py-5 mt-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold">4 Metode Unggulan</h2>
            <p class="text-muted">Pilih kenyamanan terbaik untuk jagoan Anda</p>
        </div>

        <div class="row g-4 text-center">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="method-card h-100">
                    <div class="icon-box mx-auto"><i class="fa-solid fa-user-doctor"></i></div>
                    <h5 class="fw-bold">Konvensional</h5>
                    <p class="small text-muted mb-0">Metode standar medis dengan teknik jahit presisi untuk hasil optimal.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="method-card h-100">
                    <div class="icon-box mx-auto"><i class="fa-solid fa-bolt-lightning"></i></div>
                    <h5 class="fw-bold">Electric Cauter</h5>
                    <p class="small text-muted mb-0">Sering disebut "Laser". Proses cepat, minim pendarahan, luka cepat kering.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="method-card h-100">
                    <div class="icon-box mx-auto"><i class="fa-solid fa-shield-virus"></i></div>
                    <h5 class="fw-bold">Thecno Sealer</h5>
                    <p class="small text-muted mb-0">Metode tanpa perban & tanpa jahit. <strong>Boleh langsung mandi!</strong></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="method-card h-100">
                    <div class="icon-box mx-auto"><i class="fa-solid fa-moon"></i></div>
                    <h5 class="fw-bold">Sirkum Sleeping</h5>
                    <p class="small text-muted mb-0">Metode Hipno Sedasi. Khitan nyaman saat anak tertidur pulas.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="p-5 rounded-4 bg-white shadow-sm border" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <h3 class="fw-bold">Pilihan Paket Khitan</h3>
                    <p class="text-muted">Tersedia berbagai pilihan paket yang dapat disesuaikan dengan kebutuhan Anda.</p>
                    <a href="https://wa.me/6281234567890" class="btn btn-warning px-4 py-3 rounded-pill fw-bold w-100 mt-2 shadow-sm">
                        <i class="fa-brands fa-whatsapp me-2"></i> Tanya Harga Paket
                    </a>
                </div>
                <div class="col-lg-8">
                    <div class="pricing-grid">
                        <div class="price-tag"><span>Paket Basic</span> <i class="fa-solid fa-chevron-right"></i></div>
                        <div class="price-tag"><span>Paket Gold</span> <i class="fa-solid fa-chevron-right"></i></div>
                        <div class="price-tag"><span>Paket Saphire</span> <i class="fa-solid fa-chevron-right"></i></div>
                        <div class="price-tag"><span>Paket Diamond</span> <i class="fa-solid fa-chevron-right"></i></div>
                        <div class="price-tag"><span>Paket Saphire Ultima</span> <i class="fa-solid fa-chevron-right"></i></div>
                        <div class="price-tag"><span>Paket Diamond Ultima</span> <i class="fa-solid fa-chevron-right"></i></div>
                        <div class="price-tag"><span>Paket Sultan Suleyman</span> <i class="fa-solid fa-chevron-right"></i></div>
                        <div class="price-tag"><span>Paket Bazeyid</span> <i class="fa-solid fa-chevron-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 1000, once: true });
    });
</script>
<?= $this->endSection(); ?>