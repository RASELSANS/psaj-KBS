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
    }

    body { background-color: var(--bg-light); }

    /* --- Header Area --- */
    .diagnostik-header { 
        padding: 220px 0 100px; /* Padding atas ditambah biar ga mentok nav */
        background-color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .diagnostik-header::before {
        content: 'DIAGNOSTIC';
        position: absolute;
        font-size: 15vw;
        font-weight: 900;
        color: rgba(255, 138, 61, 0.03);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 0;
        white-space: nowrap;
    }

    .header-shape {
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, var(--soft-orange) 0%, rgba(255,255,255,0) 70%);
        top: -100px;
        right: -100px;
        z-index: 0;
        border-radius: 50%;
    }

    .header-accent {
        width: 60px; height: 5px; background: var(--primary-orange);
        margin-bottom: 25px; border-radius: 10px;
    }

    /* --- Spacing Section --- */
    .section-spacing {
        padding-top: 80px; /* Jarak ekstra antara header dan kartu */
        padding-bottom: 100px;
    }

    /* --- Grid System --- */
    .diag-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px; /* Gap diperlebar dikit biar lega */
        position: relative;
        z-index: 2;
    }

    @media (max-width: 1200px) { .diag-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 992px) { .diag-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px) { .diag-grid { grid-template-columns: 1fr; } }

    /* --- Card Design --- */
    .diag-card-modern {
        background: #fff;
        border-radius: 30px;
        padding: 40px 30px;
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        z-index: 1;
        cursor: pointer;
        height: 100%;
    }

    .diag-card-modern::before {
        content: ''; position: absolute; top: 0; left: 0; 
        width: 100%; height: 100%; 
        background: linear-gradient(135deg, var(--primary-orange), #ff6b00);
        opacity: 0; z-index: -1; transition: 0.5s;
    }

    .diag-card-modern:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 50px -12px rgba(255, 138, 61, 0.3);
    }

    .diag-card-modern:hover::before { opacity: 1; }

    .icon-box {
        width: 70px; height: 70px;
        background: #f1f5f9;
        color: var(--primary-orange);
        border-radius: 22px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem; margin-bottom: 25px;
        transition: 0.4s;
    }

    .diag-card-modern:hover .icon-box {
        background: rgba(255,255,255,0.2);
        color: #fff;
        transform: rotate(-10deg);
    }

    .diag-card-modern h4 { font-weight: 800; color: var(--dark-navy); transition: 0.4s; }
    .diag-card-modern p { font-size: 0.95rem; color: #64748b; transition: 0.4s; }
    .diag-card-modern:hover h4, .diag-card-modern:hover p { color: #fff; }

    .card-number {
        position: absolute; right: -10px; bottom: -20px;
        font-size: 8rem; font-weight: 900; color: rgba(0,0,0,0.03);
        z-index: -1; transition: 0.4s;
    }
    .diag-card-modern:hover .card-number { color: rgba(255,255,255,0.1); }

    /* --- Modal Custom --- */
    .modal-content { border-radius: 30px; border: none; overflow: hidden; }
    .modal-header-orange {
        background: linear-gradient(135deg, var(--primary-orange), #ff6b00);
        padding: 40px; text-align: center; color: #fff;
    }
    .modal-header-orange i { font-size: 4rem; }
    .info-list { list-style: none; padding: 0; margin: 20px 0; }
    .info-list li { padding: 12px 0; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 10px; }
    .info-list i { color: var(--primary-orange); }

    /* Smooth Modal Effect */
    .modal.fade .modal-dialog {
        transform: scale(0.8);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .modal.show .modal-dialog {
        transform: scale(1);
    }
</style>

<section class="diagnostik-header">
    <div class="header-shape"></div>
    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="header-accent"></div>
                <h1 class="fw-bold display-3 mb-0" style="color: var(--dark-navy); line-height: 1.1;">
                    Fasilitas <br><span style="color: var(--primary-orange);">Diagnostik</span>
                </h1>
            </div>
            <div class="col-lg-5 offset-lg-1" data-aos="fade-left">
                <div class="ps-lg-4 border-start border-4" style="border-color: var(--primary-orange) !important;">
                    <p class="lead text-muted mb-0">
                        Kami menghadirkan fasilitas pemeriksaan lengkap dengan standar teknologi terbaru untuk memastikan diagnosa yang akurat bagi kesehatan Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-spacing">
    <div class="container">
        <div class="diag-grid">
            <div class="diag-card-modern" data-aos="fade-up" data-aos-delay="100" onclick="openModal('m1')">
                <div class="card-number">01</div>
                <div class="icon-box"><i class="fa-solid fa-heart-pulse"></i></div>
                <h4>Treadmill Test</h4>
                <p>Analisa performa jantung saat beraktivitas maksimal.</p>
            </div>
            <div class="diag-card-modern" data-aos="fade-up" data-aos-delay="150" onclick="openModal('m2')">
                <div class="card-number">02</div>
                <div class="icon-box"><i class="fa-solid fa-lungs"></i></div>
                <h4>Spirometri</h4>
                <p>Uji fungsi paru untuk memantau kapasitas pernapasan.</p>
            </div>
            <div class="diag-card-modern" data-aos="fade-up" data-aos-delay="200" onclick="openModal('m3')">
                <div class="card-number">03</div>
                <div class="icon-box"><i class="fa-solid fa-ear-listen"></i></div>
                <h4>Audiometri</h4>
                <p>Pemeriksaan tajam pendengaran berstandar medis.</p>
            </div>
            <div class="diag-card-modern" data-aos="fade-up" data-aos-delay="250" onclick="openModal('m4')">
                <div class="card-number">04</div>
                <div class="icon-box"><i class="fa-solid fa-wave-square"></i></div>
                <h4>Rekam Jantung</h4>
                <p>Rekam aktivitas listrik jantung dengan hasil instan.</p>
            </div>
            <div class="diag-card-modern" data-aos="fade-up" data-aos-delay="300" onclick="openModal('m5')">
                <div class="card-number">05</div>
                <div class="icon-box"><i class="fa-solid fa-laptop-medical"></i></div>
                <h4>Echocardiogra..</h4>
                <p>Visualisasi struktur jantung melalui teknologi USG Jantung.</p>
            </div>
            <div class="diag-card-modern" data-aos="fade-up" data-aos-delay="350" onclick="openModal('m6')">
                <div class="card-number">06</div>
                <div class="icon-box"><i class="fa-solid fa-person-rays"></i></div>
                <h4>USG Lengkap</h4>
                <p>Abdomen, Thyroid, Mamae, dan organ lainnya.</p>
            </div>
            <div class="diag-card-modern" data-aos="fade-up" data-aos-delay="400" onclick="openModal('m7')">
                <div class="card-number">07</div>
                <div class="icon-box"><i class="fa-solid fa-brain"></i></div>
                <h4>MMPI Test</h4>
                <p>Evaluasi psikometri profesional untuk kesehatan mental.</p>
            </div>
            <div class="diag-card-modern" data-aos="fade-up" data-aos-delay="450" onclick="openModal('m8')">
                <div class="card-number">08</div>
                <div class="icon-box"><i class="fa-solid fa-x-ray"></i></div>
                <h4>Rontgen</h4>
                <p>Radiologi modern dengan dosis radiasi rendah.</p>
            </div>
        </div>

        <div class="text-center mt-5" data-aos="zoom-in">
            <div class="p-4 rounded-5 d-inline-block shadow-sm bg-white border border-dashed" style="border-style: dashed !important; border-color: var(--primary-orange) !important;">
                <p class="mb-3 fw-bold text-muted">Butuh pemeriksaan lainnya?</p>
                <a href="https://wa.me/6285540441147" class="btn fw-bold px-5 py-3 text-white" style="background: var(--primary-orange); border-radius: 50px;">
                    <i class="fa-brands fa-whatsapp me-2"></i> Hubungi Kami 
                </a>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="m1" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header-orange"><i class="fa-solid fa-heart-pulse"></i></div><div class="modal-body p-4 text-center"><h4 class="fw-bold">Treadmill Test</h4><p class="text-muted">Uji beban jantung untuk deteksi gangguan koroner.</p><ul class="info-list text-start"><li><i class="fa-solid fa-circle-check"></i> Monitor irama jantung saat aktivitas</li><li><i class="fa-solid fa-circle-check"></i> Cek kapasitas daya tahan jantung</li></ul><button class="btn btn-dark w-100 rounded-pill py-2" data-bs-dismiss="modal">Tutup</button></div></div></div></div>

<div class="modal fade" id="m2" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header-orange"><i class="fa-solid fa-lungs"></i></div><div class="modal-body p-4 text-center"><h4 class="fw-bold">Spirometri</h4><p class="text-muted">Tes fungsi paru untuk mengukur volume udara napas.</p><ul class="info-list text-start"><li><i class="fa-solid fa-circle-check"></i> Diagnosa Asma & PPOK</li><li><i class="fa-solid fa-circle-check"></i> Evaluasi kesehatan saluran napas</li></ul><button class="btn btn-dark w-100 rounded-pill py-2" data-bs-dismiss="modal">Tutup</button></div></div></div></div>

<div class="modal fade" id="m3" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header-orange"><i class="fa-solid fa-ear-listen"></i></div><div class="modal-body p-4 text-center"><h4 class="fw-bold">Audiometri</h4><p class="text-muted">Tes ketajaman pendengaran di ruang kedap suara.</p><ul class="info-list text-start"><li><i class="fa-solid fa-circle-check"></i> Screening fungsi telinga</li><li><i class="fa-solid fa-circle-check"></i> Deteksi tingkat gangguan pendengaran</li></ul><button class="btn btn-dark w-100 rounded-pill py-2" data-bs-dismiss="modal">Tutup</button></div></div></div></div>

<div class="modal fade" id="m4" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header-orange"><i class="fa-solid fa-wave-square"></i></div><div class="modal-body p-4 text-center"><h4 class="fw-bold">Rekam Jantung</h4><p class="text-muted">Rekam listrik jantung untuk deteksi irama jantung.</p><ul class="info-list text-start"><li><i class="fa-solid fa-circle-check"></i> Deteksi kelainan irama (Aritmia)</li><li><i class="fa-solid fa-circle-check"></i> Prosedur cepat & akurat</li></ul><button class="btn btn-dark w-100 rounded-pill py-2" data-bs-dismiss="modal">Tutup</button></div></div></div></div>

<div class="modal fade" id="m5" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header-orange"><i class="fa-solid fa-laptop-medical"></i></div><div class="modal-body p-4 text-center"><h4 class="fw-bold">Echocardiography</h4><p class="text-muted">USG Jantung untuk melihat struktur organ secara visual.</p><ul class="info-list text-start"><li><i class="fa-solid fa-circle-check"></i> Cek kondisi katup & otot jantung</li><li><i class="fa-solid fa-circle-check"></i> Menilai kekuatan pompa jantung</li></ul><button class="btn btn-dark w-100 rounded-pill py-2" data-bs-dismiss="modal">Tutup</button></div></div></div></div>

<div class="modal fade" id="m6" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 30px;">
            <div class="modal-header-orange" style="background: linear-gradient(135deg, var(--primary-orange), #ff6b00); padding: 40px; text-align: center; color: #fff; border-radius: 30px 30px 0 0;">
                <i class="fa-solid fa-person-rays" style="font-size: 3.5rem;"></i>
            </div>

            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <h4 class="fw-bold text-dark">Layanan USG Lengkap</h4>
                    <p class="text-muted small">Pemeriksaan organ dalam dengan Ultrasonografi (USG).</p>
                </div>

                <div class="px-2">
                    <ul class="info-list" style="list-style: none; padding: 0;">
                        <li class="py-2 border-bottom d-flex align-items-start gap-3">
                            <i class="fa-solid fa-circle-check mt-1" style="color: var(--primary-orange);"></i>
                            <span><strong>USG Small Part</strong><br><small class="text-muted">Abdomen, Thyroid, Mammae, Inguinal, Leher, Soft Tissue</small></span>
                        </li>
                        <li class="py-2 border-bottom d-flex align-items-start gap-3">
                            <i class="fa-solid fa-circle-check mt-1" style="color: var(--primary-orange);"></i>
                            <span><strong>USG Musculoskeletal</strong><br><small class="text-muted">Shoulder, Genu, Ankle, Elbow, Wrist</small></span>
                        </li>
                        <li class="py-2 border-bottom d-flex align-items-start gap-3">
                            <i class="fa-solid fa-circle-check mt-1" style="color: var(--primary-orange);"></i>
                            <span><strong>USG Jantung / Echocardiography</strong></span>
                        </li>
                        <li class="py-2 border-bottom d-flex align-items-start gap-3">
                            <i class="fa-solid fa-circle-check mt-1" style="color: var(--primary-orange);"></i>
                            <span><strong>USG Testis</strong></span>
                        </li>
                        <li class="py-2 d-flex align-items-start gap-3">
                            <i class="fa-solid fa-circle-check mt-1" style="color: var(--primary-orange);"></i>
                            <span><strong>USG Doppler</strong></span>
                        </li>
                    </ul>
                </div>

                <div class="mt-4">
                    <button class="btn btn-dark w-100 rounded-pill py-3 fw-bold shadow-sm" data-bs-dismiss="modal">
                        Tutup 
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="m7" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header-orange"><i class="fa-solid fa-brain"></i></div><div class="modal-body p-4 text-center"><h4 class="fw-bold">MMPI Test</h4><p class="text-muted">Tes psikometri untuk profil kepribadian & kesehatan mental.</p><ul class="info-list text-start"><li><i class="fa-solid fa-circle-check"></i> Syarat pemeriksaan kesehatan jiwa kerja</li><li><i class="fa-solid fa-circle-check"></i> Evaluasi kepribadian objektif</li></ul><button class="btn btn-dark w-100 rounded-pill py-2" data-bs-dismiss="modal">Tutup</button></div></div></div></div>

<div class="modal fade" id="m8" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 35px; border: none; overflow: hidden;">
            <div class="modal-header-orange" style="background: var(--soft-orange); padding: 40px 40px 10px; text-align: center; color: var(--primary-orange); font-size: 3rem;">
                <i class="fa-solid fa-x-ray"></i>
            </div>
            
            <div class="modal-body p-4 text-center">
                <h4 class="fw-bold mb-2">Rontgen</h4>
                <p class="text-muted small mb-4">Prosedur yang menggunakan radiasi elektromagnetik untuk menampilkan gambar bagian dalam tubuh.</p>
                
                <div class="info-box-modal text-start" style="background: #f1f5f9; padding: 20px; border-radius: 20px;">
                    <h6 class="fw-bold mb-3" style="color: var(--dark-navy); font-size: 0.9rem;">
                        <i class="fa-solid fa-clipboard-list text-success me-2"></i>Layanan Pemeriksaan:
                    </h6>
                    <ul class="info-list list-unstyled small text-muted mb-0">
                        <li class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Rontgen Thorax</li>
                        <li class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Rontgen Abdomen</li>
                        <li class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Rontgen Pelvis</li>
                        <li class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Rontgen Bagian Kepala <span class="d-block ms-4 opacity-75">(Cranium, Nasal, Sinus)</span></li>
                        <li class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Rontgen Bagian Vertebrae <span class="d-block ms-4 opacity-75">(Cervical, Thoracal, Lumbosacral, Lumbal, Sacrum)</span></li>
                        <li class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Rontgen Bagian Ekstremitas Atas</li>
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i>Rontgen Bagian Ekstremitas Bawah</li>
                    </ul>
                </div>

                <button class="btn btn-dark w-100 rounded-pill py-3 mt-3 shadow-sm fw-bold" data-bs-dismiss="modal" style="border: none;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });

    function openModal(modalId) {
        var targetModal = document.getElementById(modalId);
        if (targetModal) {
            var myModal = new bootstrap.Modal(targetModal);
            myModal.show();
        }
    }
</script>
<?= $this->endSection(); ?>