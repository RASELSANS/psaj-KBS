<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    /* --- Gaya Hero (TETAP) --- */
    .hero-section { padding: 60px 0 20px 0; }
    .badge-health { background-color: #fff2e7; color: #ff8a3d; font-size: 12px; font-weight: 600; padding: 8px 15px; display: inline-block; margin-bottom: 20px; }
    .hero-title { font-weight: 700; font-size: 3.5rem; line-height: 1.2; margin-bottom: 20px; }
    .hero-desc { color: #777; margin-bottom: 30px; max-width: 450px; }
    .hero-img { border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); width: 100%; object-fit: cover; }

    /* --- Gaya Layanan (PREFERENSI LO) --- */
    .services-section { padding: 100px 0; background-color: #fffaf7; }
    .section-subtitle { color: #ff8a3d; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; }
    .section-title { font-weight: 800; font-size: 2.5rem; margin-top: 10px; margin-bottom: 50px; }
    
    .service-card {
        background-color: #fff; border-radius: 25px; padding: 50px 30px 40px;
        transition: all 0.4s ease; position: relative; margin-top: 40px;
        border: 1px solid #f0f0f0; height: 100%;
    }
    .service-card:hover { transform: translateY(-15px); box-shadow: 0 25px 50px rgba(255, 138, 61, 0.15); border-color: #ff8a3d; }
    
    .icon-wrapper {
        width: 75px; height: 75px; background: #ff8a3d; color: white; border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        position: absolute; top: -38px; left: 35px; box-shadow: 0 10px 20px rgba(255, 138, 61, 0.3);
    }
    .btn-more { color: #ff8a3d; font-weight: 700; text-decoration: none; font-size: 0.9rem; transition: 0.3s; }

    /* --- Why Us Section (LENGKAP) --- */
    .why-us-section { padding: 100px 0; background-color: #1a1a1a; color: white; border-radius: 50px; margin: 0 15px; }
    .feature-item i { color: #ff8a3d; font-size: 2.2rem; margin-bottom: 20px; display: block; }
    
    /* --- Testimoni Section (DENGAN TOMBOL NAVIGASI) --- */
    .testi-section { padding: 80px 0; background: #fff; }
    .testi-wrapper { position: relative; padding: 0 45px; } 
    .swiper-testi { padding: 40px 10px 60px 10px !important; }
    .testi-card { 
        background: white; padding: 35px; border-radius: 25px; 
        border: 1px solid #eee; box-shadow: 0 10px 30px rgba(0,0,0,0.03); 
        height: 100%; transition: 0.3s;
    }
    .testi-card:hover { border-color: #ff8a3d; }

    /* Custom Navigation Buttons */
    .swiper-button-next, .swiper-button-prev {
        color: #ff8a3d !important; background: white;
        width: 45px !important; height: 45px !important;
        border-radius: 50%; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border: 1px solid #ff8a3d;
    }
    .swiper-button-next:after, .swiper-button-prev:after { font-size: 18px !important; font-weight: bold; }
    .swiper-button-next:hover, .swiper-button-prev:hover { background: #ff8a3d; color: white !important; }
    .swiper-pagination-bullet-active { background: #ff8a3d !important; }

    /* --- Artikel Kesehatan (LENGKAP) --- */
    .blog-card { border: none; border-radius: 25px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: 0.3s; }
    .blog-card:hover { transform: translateY(-10px); }
</style>

<section class="hero-section mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="badge-health">WE TAKE CARE OF YOUR HEALTH</div>
                <h1 class="hero-title">Memberikan Pelayanan terbaik dengan ketulusan</h1>
                <p class="hero-desc">Start your free assesment and consult with a licensed doctor. Expert medical advice is just a click away!</p>
                <a href="https://wa.me/6285540441147" class="btn btn-orange btn-lg px-5 shadow">Reservasi</a>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <img src="<?= base_url('img/klinik.jpeg') ?>" alt="Klinik Brayan Sehat" class="hero-img">
            </div> 
        </div> 
    </div> 
</section>

<section id="services" class="services-section">
    <div class="container text-center">
        <span class="section-subtitle">Layanan Unggulan</span>
        <h2 class="section-title">Solusi Medis Lengkap</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="service-card d-flex flex-column text-start">
                    <div class="icon-wrapper"><i class="fa-solid fa-hand-holding-medical fa-2x"></i></div>
                    <h4 class="fw-bold">Layanan Utama</h4>
                    <p class="text-muted">Medical Check Up Okupasi, Lab, Farmasi, Rawat Luka Modern, & Khitan Center.</p>
                    <div class="mt-auto"><a href="<?= base_url('layanan') ?>" class="btn-more">Selengkapnya <i class="fa-solid fa-arrow-right ms-2"></i></a></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card d-flex flex-column text-start">
                    <div class="icon-wrapper"><i class="fa-solid fa-microscope fa-2x"></i></div>
                    <h4 class="fw-bold">Penunjang Diagnostik</h4>
                    <p class="text-muted">Treadmill, Spirometri, Audiometri, EKG, USG (Abdomen/Tiroid), & Tes MMPI.</p>
                    <div class="mt-auto"><a href="<?= base_url('layanan/penunjang-diagnostik') ?>" class="btn-more">Selengkapnya <i class="fa-solid fa-arrow-right ms-2"></i></a></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card d-flex flex-column text-start">
                    <div class="icon-wrapper"><i class="fa-solid fa-house-user fa-2x"></i></div>
                    <h4 class="fw-bold">Poliklinik</h4>
                    <p class="text-muted">Poli Umum, Gigi, Saraf, Jantung, THT, Bedah, Penyakit Dalam, Jiwa, & Radiologi.</p>
                    <div class="mt-auto"><a href="<?= base_url('layanan/poliklinik') ?>" class="btn-more">Selengkapnya <i class="fa-solid fa-arrow-right ms-2"></i></a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="why-us-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <span class="section-subtitle" style="color: #ff8a3d;">Keunggulan</span>
                <h2 class="text-white fw-bold mb-4">Kenapa Memilih Klinik Brayan Sehat?</h2>
                <p class="text-secondary">Menghadirkan kenyamanan dan ketepatan medis dengan teknologi terkini.</p>
            </div>
            <div class="col-lg-7">
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="feature-item">
                            <i class="fa-solid fa-user-doctor"></i>
                            <h5 class="fw-bold">Dokter Spesialis</h5>
                            <p class="small text-secondary">Ditangani tenaga medis ahli & berpengalaman.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="feature-item">
                            <i class="fa-solid fa-clock"></i>
                            <h5 class="fw-bold">Respon Cepat</h5>
                            <p class="small text-secondary">Pelayanan efisien tanpa antre panjang.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testi-section">
    <div class="container text-center">
        <h2 class="fw-bold mb-2">Apa Kata Pasien Kami?</h2>
        <p class="text-muted mb-5">Pengalaman nyata dari mereka yang mempercayakan kesehatan kepada kami.</p>
        
        <div class="testi-wrapper">
            <div class="swiper swiper-testi">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testi-card text-start">
                            <p class="fst-italic text-muted">"Pelayanan sangat ramah, dokternya sangat profesional dan komunikatif. Klinik ternyaman!"</p>
                            <div class="d-flex align-items-center mt-4">
                                <img src="https://ui-avatars.com/api/?name=Andi+Susanto&background=ff8a3d&color=fff" class="rounded-circle me-3" width="50">
                                <div><h6 class="mb-0 fw-bold">Andi Susanto</h6><small class="text-muted">Pasien Poli Umum</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testi-card text-start">
                            <p class="fst-italic text-muted">"Layanan lab sangat memuaskan, hasilnya cepat dan harganya terjangkau. Sangat rekomen!"</p>
                            <div class="d-flex align-items-center mt-4">
                                <img src="https://ui-avatars.com/api/?name=Siti+Aisyah&background=ff8a3d&color=fff" class="rounded-circle me-3" width="50">
                                <div><h6 class="mb-0 fw-bold">Siti Aisyah</h6><small class="text-muted">Pasien MCU</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testi-card text-start">
                            <p class="fst-italic text-muted">"Pendaftaran online sangat membantu saya menghemat waktu. Fasilitasnya pun modern."</p>
                            <div class="d-flex align-items-center mt-4">
                                <img src="https://ui-avatars.com/api/?name=Budi+Setiawan&background=ff8a3d&color=fff" class="rounded-circle me-3" width="50">
                                <div><h6 class="mb-0 fw-bold">Budi Setiawan</h6><small class="text-muted">Pasien Spesialis</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<section class="container py-5 mb-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <h2 class="fw-bold mb-0">Artikel Kesehatan</h2>
        <a href="<?= base_url('artikel') ?>" class="text-orange fw-bold text-decoration-none">Lihat Semua →</a>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="blog-card card h-100">
                <img src="https://images.unsplash.com/photo-1505751172107-5739a00723a5?auto=format&fit=crop&w=500" class="card-img-top" alt="Artikel" height="200" style="object-fit: cover;">
                <div class="card-body p-4">
                    <h5 class="fw-bold">Manfaat Cek Kesehatan</h5>
                    <p class="text-muted small">Deteksi dini adalah kunci hidup sehat jangka panjang...</p>
                    <a href="#" class="text-orange fw-bold text-decoration-none small">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.swiper-testi', {
            loop: true,
            autoplay: { delay: 4000, disableOnInteraction: false },
            grabCursor: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: { el: '.swiper-pagination', clickable: true },
            breakpoints: {
                320: { slidesPerView: 1, spaceBetween: 20 },
                768: { slidesPerView: 2, spaceBetween: 30 },
                1024: { slidesPerView: 2, spaceBetween: 30 }
            }
        });
    });
</script>

<?= $this->endSection(); ?>