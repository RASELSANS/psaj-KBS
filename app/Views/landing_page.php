<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    :root {
        --primary-orange: #ff8a3d;
        --dark-bg: #1a1a1a;
    }

    /* --- Hero Section --- */
    .hero-section { padding: 60px 0 20px 0; overflow: hidden; }
    .badge-health { background-color: #fff2e7; color: var(--primary-orange); font-size: 12px; font-weight: 600; padding: 8px 15px; display: inline-block; margin-bottom: 20px; border-radius: 8px; }
    .hero-title { font-weight: 800; font-size: 3.5rem; line-height: 1.2; margin-bottom: 20px; color: #2c3e50; }
    .hero-desc { color: #777; margin-bottom: 30px; max-width: 450px; }
    .hero-img { border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); width: 100%; height: 450px; object-fit: cover; }

    /* --- Services Section --- */
    .services-section { padding: 100px 0; background-color: #fffaf7; }
    .section-subtitle { color: var(--primary-orange); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; }
    .section-title { font-weight: 800; font-size: 2.8rem; margin-top: 10px; margin-bottom: 60px; color: #2c3e50; }
    
    .service-card {
        background-color: #fff; border-radius: 25px; padding: 60px 30px 40px;
        transition: all 0.4s ease; position: relative; margin-top: 40px;
        border: 1px solid #f0f0f0; height: 100%;
    }
    .service-card:hover { transform: translateY(-15px); box-shadow: 0 25px 50px rgba(255, 138, 61, 0.15); border-color: var(--primary-orange); }
    
    .icon-wrapper {
        width: 75px; height: 75px; background: var(--primary-orange); color: white; border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        position: absolute; top: -38px; left: 35px; box-shadow: 0 10px 20px rgba(255, 138, 61, 0.3);
    }
    .btn-more { color: var(--primary-orange); font-weight: 700; text-decoration: none; font-size: 0.9rem; }

    /* --- KEUNGGULAN --- */
    .why-us-section { 
        padding: 100px 0; background-color: var(--dark-bg); color: white; 
        border-radius: 50px; margin: 60px 15px; position: relative; overflow: hidden;
    }
    .feature-item { 
        padding: 26px 22px; background: rgba(255, 255, 255, 0.03); 
        border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 24px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); height: 100%;
    }
    .feature-item:hover { 
        background: rgba(255, 138, 61, 0.05); border-color: var(--primary-orange); transform: translateY(-12px);
    }
    .feature-item i { color: var(--primary-orange); font-size: 2.1rem; margin-bottom: 16px; display: inline-block; }
    .feature-item h5 { font-size: 1.05rem; margin-bottom: 8px; }
    .feature-item p { font-size: 0.92rem; margin-bottom: 0; }

    /* --- TESTIMONI --- */
    .testi-section { padding: 100px 0; background: #fff; }
    .testi-container { position: relative; max-width: 1100px; margin: 0 auto; padding: 0 60px; }
    .swiper-testi { padding-bottom: 60px !important; } 
    .testi-card { 
        background: white; padding: 35px; border-radius: 25px; 
        border: 1px solid #eee; box-shadow: 0 10px 30px rgba(0,0,0,0.03); 
        height: 100%; transition: 0.3s; margin: 5px;
    }
    .testi-card:hover { border-color: var(--primary-orange); }

    .swiper-button-next, .swiper-button-prev {
        color: var(--primary-orange) !important; background: white;
        width: 45px !important; height: 45px !important;
        border-radius: 50%; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border: 1px solid var(--primary-orange);
        top: 45% !important;
    }
    .swiper-button-prev { left: 0px !important; }
    .swiper-button-next { right: 0px !important; }
    .swiper-button-next:after, .swiper-button-prev:after { font-size: 18px !important; font-weight: bold; }

    .swiper-pagination-bullet-active { background: var(--primary-orange) !important; }
    .swiper-pagination { bottom: 0 !important; }

    /* --- Blog --- */
    .blog-card { border: none; border-radius: 25px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: 0.3s; }
    .blog-card:hover { transform: translateY(-10px); }
    .text-orange { color: var(--primary-orange); }

    .btn-orange { background-color: var(--primary-orange); color: white; border-radius: 12px; transition: 0.3s; border: none; }
    .btn-orange:hover { background-color: #e6762d; color: white; transform: scale(1.05); }

    /* Responsive */
    @media (max-width: 991px) {
        .testi-container { padding: 0 15px; }
        .swiper-button-next, .swiper-button-prev { display: none !important; }
        .hero-title { font-size: 2.2rem; }
        .why-us-section { border-radius: 30px; margin: 40px 10px; }
    }
</style>

<section class="hero-section mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center text-lg-start" data-aos="fade-right">
                <div class="badge-health">SOLUSI KESEHATAN TERPERCAYA</div>
                <h1 class="hero-title">Memberikan Pelayanan terbaik dengan ketulusan</h1>
                <p class="hero-desc mx-auto mx-lg-0">Konsultasikan kesehatan Anda dengan tim dokter ahli kami. Pelayanan medis modern yang mengutamakan kenyamanan pasien.</p>
                <a href="https://wa.me/628112519001" class="btn btn-orange btn-lg px-5 shadow fw-bold">Reservasi</a>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
                <img src="<?= base_url('img/klinik.jpeg') ?>" alt="Klinik Brayan Sehat" class="hero-img">
            </div> 
        </div> 
    </div> 
</section>

<section id="services" class="services-section">
    <div class="container text-center">
        <span class="section-subtitle" data-aos="fade-up">Layanan Unggulan</span>
        <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">Solusi Medis Lengkap</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="service-card d-flex flex-column text-start">
                    <div class="icon-wrapper"><i class="fa-solid fa-hand-holding-medical fa-2x"></i></div>
                    <h4 class="fw-bold">Layanan Utama</h4>
                    <p class="text-muted">Medical Check Up Okupasi, Lab, Farmasi, Rawat Luka Modern, & Khitan Center.</p>
                    <div class="mt-auto"><a href="<?= base_url('layanan') ?>" class="btn-more">Selengkapnya <i class="fa-solid fa-arrow-right ms-2"></i></a></div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="service-card d-flex flex-column text-start">
                    <div class="icon-wrapper"><i class="fa-solid fa-microscope fa-2x"></i></div>
                    <h4 class="fw-bold">Penunjang Diagnostik</h4>
                    <p class="text-muted">Treadmill, Spirometri, Audiometri, EKG, USG (Abdomen/Tiroid), & Tes MMPI.</p>
                    <div class="mt-auto"><a href="<?= base_url('layanan/penunjang-diagnostik') ?>" class="btn-more">Selengkapnya <i class="fa-solid fa-arrow-right ms-2"></i></a></div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
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
    <div class="container py-lg-4">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0 px-lg-4" data-aos="fade-right">
                <span class="section-subtitle">Kenapa Kami?</span>
                <h2 class="text-white fw-bold mb-4 display-6">Standar Medis Terbaik Untuk Keluarga</h2>
                <p class="text-secondary fs-5 mb-4">Perpaduan teknologi modern dengan pelayanan tulus dari hati.</p>
                <div class="d-none d-lg-block">
                    <div class="mb-3"><i class="fa-solid fa-check-circle text-orange me-2"></i> <span class="text-white-50">Tenaga Medis Berlisensi</span></div>
                    <div><i class="fa-solid fa-check-circle text-orange me-2"></i> <span class="text-white-50">Peralatan Mutakhir</span></div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row g-4">
                    <div class="col-sm-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-item">
                            <i class="fa-solid fa-user-doctor"></i>
                            <h5>Dokter Spesialis</h5>
                            <p>Ditangani oleh barisan dokter ahli berpengalaman.</p>
                        </div>
                    </div>
                    <div class="col-sm-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-item">
                            <i class="fa-solid fa-microchip"></i>
                            <h5>Alat Modern</h5>
                            <p>Diagnosa akurat dengan teknologi medis terbaru.</p>
                        </div>
                    </div>
                    <div class="col-sm-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-item">
                            <i class="fa-solid fa-clock"></i>
                            <h5>Respon Cepat</h5>
                            <p>Sistem manajemen efisien, antrean lebih singkat.</p>
                        </div>
                    </div>
                    <div class="col-sm-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-item">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                            <h5>Pelayanan Tulus</h5>
                            <p>Melayani dengan keramahan dan empati tinggi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testi-section">
    <div class="container text-center">
        <h2 class="fw-bold mb-2" data-aos="fade-up">Apa Kata Pasien Kami?</h2>
        <p class="text-muted mb-5 fs-5" data-aos="fade-up" data-aos-delay="100">Pengalaman nyata dari mereka yang telah berkunjung.</p>
        
        <div class="testi-container" data-aos="zoom-in" data-aos-delay="200">
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
    <div class="d-flex justify-content-between align-items-end mb-4" data-aos="fade-up">
        <h2 class="fw-bold mb-0">Artikel Kesehatan</h2>
        <a href="<?= base_url('artikel') ?>" class="text-orange fw-bold text-decoration-none">Lihat Semua →</a>
    </div>
    <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="blog-card card h-100">
                <img src="<?= base_url('img/artikel1.png') ?>" class="card-img-top" alt="Vaksinasi" height="200" style="object-fit: cover;">
                <div class="card-body p-4">
                    <h5 class="fw-bold">Proses Vaksinasi</h5>
                    <p class="text-muted small">Pentingnya vaksin influenza untuk daya tahan tubuh di musim pancaroba...</p>
                    <a href="#" class="text-orange fw-bold text-decoration-none small">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Init AOS dengan efek bolak-balik
        AOS.init({
            duration: 1000,
            once: false, // Animasi muncul lagi saat scroll ke atas
            mirror: true, // Animasi elemen saat melewati viewport kembali
            offset: 100
        });

        // Swiper Config
        new Swiper('.swiper-testi', {
            loop: true,
            autoplay: { delay: 4000, disableOnInteraction: false },
            grabCursor: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: { 
                el: '.swiper-pagination', 
                clickable: true 
            },
            breakpoints: {
                320: { slidesPerView: 1, spaceBetween: 10 },
                768: { slidesPerView: 2, spaceBetween: 20 }
            }
        });
    });
</script>

<?= $this->endSection(); ?>