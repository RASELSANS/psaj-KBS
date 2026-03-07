<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-orange: #ff8a3d;
        --dark-navy: #1e293b;
        --soft-orange: #fff5ed;
        --bg-light: #f8fafc;
    }

    body { background-color: var(--bg-light); overflow-x: hidden; }

    /* --- HEADER SECTION --- */
    .poli-header { 
        padding: 200px 0 120px; 
        background: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .poli-header::before {
        content: 'CLINIC';
        position: absolute;
        font-size: 15vw;
        font-weight: 900;
        color: rgba(255, 138, 61, 0.03);
        bottom: -20px;
        right: -50px;
        z-index: 0;
        white-space: nowrap;
    }

    .header-tagline {
        display: inline-block;
        padding: 8px 20px;
        background: var(--soft-orange);
        color: var(--primary-orange);
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 20px;
    }

    .display-title { font-weight: 800; color: var(--dark-navy); line-height: 1.1; margin-bottom: 25px; position: relative; z-index: 2; }

    .header-desc {
        font-size: 1.1rem;
        color: #64748b;
        border-left: 4px solid var(--primary-orange);
        padding-left: 25px;
        margin-bottom: 30px;
        max-width: 550px;
        position: relative;
        z-index: 2;
    }

    .visual-decor { 
        position: relative; 
        height: 400px; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
    }

    .circle-bg {
        width: 350px; height: 350px; 
        background: var(--soft-orange); 
        border-radius: 50%; 
        opacity: 0.6;
        position: absolute;
    }

    .floating-info {
        background: white;
        padding: 18px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        position: absolute;
        z-index: 3;
        border: 1px solid rgba(255, 138, 61, 0.1);
        min-width: 200px;
    }

    .float-top { top: 10%; left: -10%; animation: float 4s ease-in-out infinite; }
    .float-bottom { bottom: 10%; right: -5%; animation: float 4s ease-in-out infinite 2s; }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    /* --- CARD 3D FLIP SYSTEM --- */
    .poli-card-container {
        perspective: 1000px;
        height: 380px;
        cursor: pointer;
    }

    .poli-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transform-style: preserve-3d;
    }

    .poli-card-container:hover .poli-card-inner,
    .poli-card-container.is-flipped .poli-card-inner {
        transform: rotateY(180deg);
    }

    .card-front, .card-back {
        position: absolute;
        width: 100%; height: 100%;
        backface-visibility: hidden;
        border-radius: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 40px 25px;
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.04);
    }

    .card-back {
        background: linear-gradient(135deg, var(--primary-orange), #ff6a00);
        color: white;
        transform: rotateY(180deg);
    }

    .service-badge {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--primary-orange);
        background: var(--soft-orange);
        padding: 5px 15px;
        border-radius: 50px;
        margin-bottom: 20px;
    }

    .icon-wrapper {
        width: 85px; height: 85px;
        background: var(--bg-light);
        color: var(--primary-orange);
        border-radius: 25px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 20px;
        font-size: 2.2rem;
    }

    .card-title-small { font-weight: 800; color: var(--dark-navy); font-size: 1.25rem; text-align: center; }
    .card-back .card-title-small { color: white; margin-bottom: 15px; }
    .card-desc-small { font-size: 0.95rem; line-height: 1.6; text-align: center; opacity: 0.9; }

    .btn-detail {
        margin-top: 20px;
        background: rgba(255,255,255,0.2);
        border: 1px solid white;
        color: white;
        padding: 8px 25px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-detail:hover { background: white; color: var(--primary-orange); }
    .section-spacing { padding: 100px 0; }
</style>

<section class="poli-header">
    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="header-tagline">Excellence in Healthcare</span>
                <h1 class="display-4 display-title">Layanan <span style="color: var(--primary-orange);">Poliklinik</span> Spesialis Kami</h1>
                <p class="header-desc">
                    Akses kesehatan terpadu dengan standar medis internasional, didukung oleh tim dokter ahli dan fasilitas modern untuk kenyamanan Anda.
                </p>
                <div class="d-flex gap-3">
                    <a href="#layanan" class="btn btn-warning px-5 py-3 rounded-pill fw-bold text-white shadow-sm" style="background: var(--primary-orange); border: none;">Eksplorasi Poli</a>
                </div>
            </div>
            
            <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left">
                <div class="visual-decor">
                    <div class="circle-bg"></div>
                    <div class="floating-info float-top">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-wrapper m-0" style="width: 45px; height: 45px; font-size: 1rem; background: var(--soft-orange);">
                                <i class="fa-solid fa-user-check"></i>
                            </div>
                            <div class="text-start">
                                <h6 class="mb-0 fw-bold">Tenaga Ahli</h6>
                                <small class="text-muted">Dokter Berlisensi</small>
                            </div>
                        </div>
                    </div>
                    <div class="floating-info float-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-wrapper m-0" style="width: 45px; height: 45px; font-size: 1rem; background: #e8f5e9; color: #2e7d32;">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div class="text-start">
                                <h6 class="mb-0 fw-bold">24/7 Respon</h6>
                                <small class="text-muted">Layanan Darurat</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-spacing" id="layanan">
    <div class="container">
        <div class="row g-4">
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up">
                <div class="poli-card-container" onclick="this.classList.toggle('is-flipped')">
                    <div class="poli-card-inner shadow-sm">
                        <div class="card-front">
                            <div class="service-badge">Layanan Utama</div>
                            <div class="icon-wrapper"><i class="fa-solid fa-user-md"></i></div>
                            <h5 class="card-title-small">Poli Umum</h5>
                            <small class="text-muted mt-2"><i class="fa-solid fa-rotate"></i> Klik untuk info</small>
                        </div>
                        <div class="card-back">
                            <h5 class="card-title-small">Poli Umum</h5>
                            <p class="card-desc-small">Pemeriksaan kesehatan rutin, konsultasi medis awal, dan manajemen kesehatan dasar untuk keluarga.</p>
                            <button class="btn btn-detail" onclick="sendWhatsApp('Poli Umum')">Daftar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="poli-card-container" onclick="this.classList.toggle('is-flipped')">
                    <div class="poli-card-inner shadow-sm">
                        <div class="card-front">
                            <div class="service-badge">Dental Care</div>
                            <div class="icon-wrapper"><i class="fa-solid fa-tooth"></i></div>
                            <h5 class="card-title-small">Poli Gigi</h5>
                            <small class="text-muted mt-2"><i class="fa-solid fa-rotate"></i> Klik untuk info</small>
                        </div>
                        <div class="card-back">
                            <h5 class="card-title-small">Poli Gigi</h5>
                            <p class="card-desc-small">Perawatan gigi komprehensif mulai dari pembersihan karang (scaling) hingga tindakan estetik.</p>
                            <button class="btn btn-detail" onclick="sendWhatsApp('Poli Gigi')">Daftar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="poli-card-container" onclick="this.classList.toggle('is-flipped')">
                    <div class="poli-card-inner shadow-sm">
                        <div class="card-front">
                            <div class="service-badge">Kardiovaskular</div>
                            <div class="icon-wrapper"><i class="fa-solid fa-heart-pulse"></i></div>
                            <h5 class="card-title-small">Jantung & Pembuluh Darah</h5>
                            <small class="text-muted mt-2"><i class="fa-solid fa-rotate"></i> Klik untuk info</small>
                        </div>
                        <div class="card-back">
                            <h5 class="card-title-small">Poli Jantung</h5>
                            <p class="card-desc-small">Pusat diagnosa kardiovaskular untuk penanganan masalah jantung secara akurat oleh spesialis.</p>
                            <button class="btn btn-detail" onclick="sendWhatsApp('Poli Jantung')">Daftar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up">
                <div class="poli-card-container" onclick="this.classList.toggle('is-flipped')">
                    <div class="poli-card-inner shadow-sm">
                        <div class="card-front">
                            <div class="service-badge">Spesialis</div>
                            <div class="icon-wrapper"><i class="fa-solid fa-ear-deaf"></i></div>
                            <h5 class="card-title-small">Poli THT</h5>
                            <small class="text-muted mt-2"><i class="fa-solid fa-rotate"></i> Klik untuk info</small>
                        </div>
                        <div class="card-back">
                            <h5 class="card-title-small">Poli THT</h5>
                            <p class="card-desc-small">Layanan diagnosis dan terapi untuk gangguan kesehatan pada telinga, hidung, serta tenggorokan.</p>
                            <button class="btn btn-detail" onclick="sendWhatsApp('Poli THT')">Daftar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="poli-card-container" onclick="this.classList.toggle('is-flipped')">
                    <div class="poli-card-inner shadow-sm">
                        <div class="card-front">
                            <div class="service-badge">Internal Medis</div>
                            <div class="icon-wrapper"><i class="fa-solid fa-stethoscope"></i></div>
                            <h5 class="card-title-small">Penyakit Dalam</h5>
                            <small class="text-muted mt-2"><i class="fa-solid fa-rotate"></i> Klik untuk info</small>
                        </div>
                        <div class="card-back">
                            <h5 class="card-title-small">Penyakit Dalam</h5>
                            <p class="card-desc-small">Penanganan medis mendalam untuk diabetes, hipertensi, ginjal, dan berbagai masalah organ dalam.</p>
                            <button class="btn btn-detail" onclick="sendWhatsApp('Poli Penyakit Dalam')">Daftar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="poli-card-container" onclick="this.classList.toggle('is-flipped')">
                    <div class="poli-card-inner shadow-sm">
                        <div class="card-front">
                            <div class="service-badge">Penunjang</div>
                            <div class="icon-wrapper"><i class="fa-solid fa-x-ray"></i></div>
                            <h5 class="card-title-small">Radiologi</h5>
                            <small class="text-muted mt-2"><i class="fa-solid fa-rotate"></i> Klik untuk info</small>
                        </div>
                        <div class="card-back">
                            <h5 class="card-title-small">Radiologi</h5>
                            <p class="card-desc-small">Layanan pendukung medis melalui pencitraan (X-Ray & USG) untuk diagnosa yang tepat.</p>
                            <button class="btn btn-detail" onclick="sendWhatsApp('Layanan Radiologi')">Daftar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up">
                <div class="poli-card-container" onclick="this.classList.toggle('is-flipped')">
                    <div class="poli-card-inner shadow-sm">
                        <div class="card-front">
                            <div class="service-badge">Pediatric</div>
                            <div class="icon-wrapper"><i class="fa-solid fa-baby-carriage"></i></div>
                            <h5 class="card-title-small">Poli Anak</h5>
                            <small class="text-muted mt-2"><i class="fa-solid fa-rotate"></i> Klik untuk info</small>
                        </div>
                        <div class="card-back">
                            <h5 class="card-title-small">Poli Anak</h5>
                            <p class="card-desc-small">Pemantauan tumbuh kembang anak, imunisasi, dan pengobatan spesifik untuk kesehatan si kecil.</p>
                            <button class="btn btn-detail" onclick="sendWhatsApp('Poli Anak')">Daftar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="poli-card-container" onclick="this.classList.toggle('is-flipped')">
                    <div class="poli-card-inner shadow-sm">
                        <div class="card-front">
                            <div class="service-badge">Mental Health</div>
                            <div class="icon-wrapper"><i class="fa-solid fa-brain"></i></div>
                            <h5 class="card-title-small">Kedokteran Jiwa</h5>
                            <p class="small text-muted mb-0">(Psikiater)</p>
                        </div>
                        <div class="card-back">
                            <h5 class="card-title-small">Psikiater</h5>
                            <p class="card-desc-small">Layanan klinis untuk kesehatan mental, manajemen stres, depresi, dan gangguan kecemasan.</p>
                            <button class="btn btn-detail" onclick="sendWhatsApp('Poli Psikiater')">Daftar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="poli-card-container" onclick="this.classList.toggle('is-flipped')">
                    <div class="poli-card-inner shadow-sm">
                        <div class="card-front">
                            <div class="service-badge">Mental Health</div>
                            <div class="icon-wrapper"><i class="fa-solid fa-user-friends"></i></div>
                            <h5 class="card-title-small">Psikolog</h5>
                            <small class="text-muted mt-2"><i class="fa-solid fa-rotate"></i> Klik untuk info</small>
                        </div>
                        <div class="card-back">
                            <h5 class="card-title-small">Psikolog</h5>
                            <p class="card-desc-small">Layanan konseling, psikotes, dan terapi emosional untuk mendukung kesehatan mental Anda.</p>
                            <button class="btn btn-detail" onclick="sendWhatsApp('Layanan Psikolog')">Daftar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Fungsi untuk mengirim pesan ke WhatsApp
    function sendWhatsApp(poliName) {
        // GANTI NOMOR DI BAWAH INI (Gunakan kode negara, misal 62)
        const phoneNumber = "6285540441147"; 
        
        const message = `Halo Admin, saya ingin melakukan pendaftaran online di *${poliName}*. Mohon info jadwal dokter dan persyaratannya. Terima kasih.`;
        const encodedMessage = encodeURIComponent(message);
        const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
        
        window.open(whatsappUrl, '_blank');
    }

    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ 
            duration: 1000, 
            once: true, 
            easing: 'ease-out-back' 
        });
    });
</script>
<?= $this->endSection(); ?>