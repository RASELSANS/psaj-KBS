<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-orange: #ff8a3d;
        --orange-deep: #ff6b00;
        --dark-navy: #1e293b;
        --soft-orange: #fff2e7;
        --bg-light: #f8fafc;
        --panel: #ffffff;
    }

    body {
        background:
            radial-gradient(circle at 10% 0%, #fff1e5 0%, transparent 40%),
            radial-gradient(circle at 90% 20%, #ffe8d6 0%, transparent 38%),
            var(--bg-light);
    }

    /* --- Header Area --- */
    .mcu-header { 
        padding: 190px 0 120px;
        background: linear-gradient(145deg, #ffffff 0%, #fff5ec 60%, #fff0e3 100%);
        position: relative;
        overflow: hidden;
    }

    .mcu-header::before {
        content: 'MCU';
        position: absolute;
        font-size: 16vw;
        font-weight: 900;
        letter-spacing: 10px;
        color: rgba(255, 138, 61, 0.06);
        top: 52%;
        left: 52%;
        transform: translate(-50%, -50%) rotate(-6deg);
        z-index: 0;
        white-space: nowrap;
        pointer-events: none;
    }

    .mcu-header::after {
        content: '';
        position: absolute;
        width: 560px;
        height: 560px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 138, 61, 0.23) 0%, rgba(255, 138, 61, 0) 70%);
        right: -180px;
        top: -220px;
        z-index: 0;
    }

    .header-shape {
        position: absolute;
        width: 380px;
        height: 380px;
        background: radial-gradient(circle, rgba(255, 107, 0, 0.2) 0%, rgba(255,255,255,0) 70%);
        bottom: -150px;
        left: -120px;
        z-index: 0;
        border-radius: 50%;
    }

    .header-accent {
        width: 78px;
        height: 6px;
        background: linear-gradient(90deg, var(--primary-orange), var(--orange-deep));
        margin-bottom: 24px;
        border-radius: 99px;
        box-shadow: 0 8px 20px rgba(255, 138, 61, 0.35);
    }

    /* --- Section Spacing --- */
    .section-spacing {
        padding-top: 26px;
        padding-bottom: 100px;
        margin-top: 0;
        position: relative;
        z-index: 4;
    }

    .packages-shell {
        background: linear-gradient(180deg, #ffffff 0%, #fffaf6 100%);
        border: 1px solid rgba(255, 138, 61, 0.15);
        border-radius: 34px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        padding: 34px;
    }

    .packages-head {
        display: flex;
        justify-content: space-between;
        align-items: end;
        gap: 14px;
        margin-bottom: 30px;
    }

    .packages-head h2 {
        font-size: clamp(1.3rem, 2vw, 2rem);
        margin: 0;
        color: var(--dark-navy);
        font-weight: 800;
    }

    .packages-head p {
        margin: 0;
        color: #64748b;
    }

    .mcu-info-card {
        background: rgba(255, 255, 255, 0.88);
        border: 1px solid rgba(255, 138, 61, 0.16);
        border-radius: 22px;
        box-shadow: 0 14px 32px rgba(255, 138, 61, 0.1);
        backdrop-filter: blur(4px);
    }

    .mcu-summary-wrapper {
        background: #fff;
        border-radius: 34px;
        padding: 34px;
        box-shadow: 0 14px 36px rgba(15, 23, 42, 0.06);
        margin-top: -48px;
        position: relative;
        z-index: 10;
        border: 1px solid rgba(255, 138, 61, 0.12);
    }

    .procedure-title {
        font-weight: 800;
        color: var(--dark-navy);
        margin-bottom: 12px;
    }

    .procedure-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        color: var(--primary-orange);
        border: 1px solid rgba(255, 138, 61, 0.24);
        border-radius: 999px;
        padding: 7px 14px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .procedure-main {
        background: linear-gradient(160deg, #fffdfb 0%, #fff4e8 100%);
        border: 1px dashed rgba(255, 138, 61, 0.45);
        border-radius: 22px;
        padding: 24px;
        position: relative;
        overflow: hidden;
    }

    .procedure-main::after {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 138, 61, 0.18) 0%, rgba(255, 138, 61, 0) 70%);
        right: -60px;
        bottom: -70px;
        pointer-events: none;
    }

    .procedure-main p {
        margin: 0;
        color: #334155;
        line-height: 1.75;
        font-size: 0.98rem;
        position: relative;
        z-index: 1;
    }

    .procedure-purpose {
        margin-top: 14px;
        background: #ffffff;
        border: 1px solid rgba(148, 163, 184, 0.24);
        border-radius: 16px;
        padding: 14px 16px;
        color: #475569;
        font-size: 0.92rem;
    }

    .procedure-purpose strong {
        color: var(--dark-navy);
    }

    /* --- Grid System --- */
    .mcu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 22px;
        position: relative;
        z-index: 2;
    }

    /* --- Card Design --- */
    .mcu-card-modern {
        background: #fff;
        border-radius: 26px;
        padding: 30px 24px;
        border: 1px solid rgba(148, 163, 184, 0.2);
        transition: all 0.35s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
        cursor: pointer;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .mcu-card-modern::after {
        content: '';
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 138, 61, 0.18) 0%, rgba(255, 138, 61, 0) 72%);
        top: -44px;
        right: -46px;
        transition: 0.3s ease;
    }

    .mcu-card-modern::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(145deg, var(--primary-orange), var(--orange-deep));
        opacity: 0;
        z-index: -1;
        transition: 0.35s ease;
    }

    .mcu-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 22px 40px rgba(255, 138, 61, 0.28);
        border-color: transparent;
    }

    .mcu-card-modern:hover::before { opacity: 1; }
    .mcu-card-modern:hover::after { opacity: 0; }

    .icon-box {
        width: 68px;
        height: 68px;
        background: #f1f5f9;
        color: var(--primary-orange);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 18px;
        transition: 0.4s;
    }

    .mcu-card-modern:hover .icon-box {
        background: rgba(255,255,255,0.2);
        color: #fff;
        transform: rotate(-8deg) scale(1.04);
    }

    .mcu-card-modern h4 { font-weight: 800; color: var(--dark-navy); transition: 0.4s; font-size: 1.1rem; margin-bottom: 10px; }
    .mcu-card-modern p { font-size: 0.9rem; color: #64748b; transition: 0.4s; margin-bottom: 18px; }
    .mcu-card-modern:hover h4, .mcu-card-modern:hover p { color: #fff; }

    .price-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--primary-orange);
        margin-top: auto;
        transition: 0.4s;
        letter-spacing: 0.8px;
    }
    .mcu-card-modern:hover .price-label { color: rgba(255,255,255,0.8); }

    /* --- Modal Custom --- */
    .modal-content { border-radius: 30px; border: none; overflow: hidden; }
    .modal-header-orange {
        background: linear-gradient(135deg, var(--primary-orange), #ff6b00);
        padding: 40px; text-align: center; color: #fff;
    }
    .modal-header-orange i { font-size: 4rem; }
    .info-list { list-style: none; padding: 0; margin: 20px 0; }
    .info-list li { padding: 10px 0; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 10px; font-size: 0.95rem; }
    .info-list i { color: var(--primary-orange); font-size: 0.8rem; }

    @media (max-width: 991.98px) {
        .mcu-header {
            padding: 160px 0 90px;
        }

        .section-spacing {
            padding-top: 20px;
        }

        .packages-shell {
            border-radius: 26px;
            padding: 24px;
        }

        .mcu-summary-wrapper {
            border-radius: 24px;
            padding: 24px;
            margin-top: -34px;
        }

        .packages-head {
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 24px;
        }
    }

    @media (max-width: 575.98px) {
        .mcu-header {
            padding: 145px 0 82px;
        }

        .section-spacing {
            padding-top: 16px;
        }

        .packages-shell {
            border-radius: 22px;
            padding: 18px;
        }

        .mcu-summary-wrapper {
            border-radius: 20px;
            padding: 18px;
            margin-top: -28px;
        }
    }
</style>

<section class="mcu-header">
    <div class="header-shape"></div>
    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <div class="header-accent"></div>
                <h1 class="fw-bold display-3 mb-4" style="color: var(--dark-navy); line-height: 1.1;">
                    Medical <span style="color: var(--primary-orange);">Check Up</span>
                </h1>
                <p class="lead text-muted mb-0" style="max-width: 600px;">
                    Deteksi dini adalah kunci hidup sehat yang panjang. Layanan MCU kami membantu memantau kondisi tubuh secara berkala agar potensi masalah kesehatan dapat ditangani lebih awal.
                </p>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="mcu-summary-wrapper" data-aos="fade-up">
        <div class="row g-3">
            <div class="col-lg-12">
                <span class="procedure-chip"><i class="fa-solid fa-stethoscope"></i> Prosedur Pemeriksaan</span>
                <h3 class="procedure-title">Pemeriksaan Menyeluruh Secara Berkala</h3>
                <div class="procedure-main">
                    <p>Prosedur pemeriksaan kesehatan menyeluruh yang dilakukan secara berkala, bahkan saat seseorang merasa sehat atau tidak memiliki keluhan penyakit tertentu.</p>
                </div>
                <div class="procedure-purpose">
                    <strong>Tujuan:</strong> bukan untuk mengobati, melainkan untuk deteksi dini (skrining) potensi masalah kesehatan agar bisa dicegah atau ditangani lebih awal.
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section-spacing">
    <div class="container">
        <div class="packages-shell" data-aos="fade-up">
            <div class="packages-head">
                <div>
                    <h2>Pilihan Paket MCU</h2>
                    <p>Klik salah satu paket untuk melihat detail pemeriksaan lengkap.</p>
                </div>
                <span class="badge rounded-pill text-bg-light border px-3 py-2">Harga: Chat ke WA</span>
            </div>

            <div class="mcu-grid">
                <div class="mcu-card-modern" data-aos="fade-up" data-aos-delay="100" onclick="openModal('p1')">
                    <div class="icon-box"><i class="fa-solid fa-stethoscope"></i></div>
                    <h4>Paket Dasar</h4>
                    <p>Pemeriksaan kesehatan esensial untuk screening awal kondisi tubuh.</p>
                    <div class="price-label"><i class="fa-brands fa-whatsapp me-1"></i> Cek Harga via WA</div>
                </div>

                <div class="mcu-card-modern" data-aos="fade-up" data-aos-delay="150" onclick="openModal('p2')">
                    <div class="icon-box"><i class="fa-solid fa-notes-medical"></i></div>
                    <h4>Paket Komplit</h4>
                    <p>Evaluasi lebih mendalam dengan tambahan fungsi ginjal & diabetes.</p>
                    <div class="price-label"><i class="fa-brands fa-whatsapp me-1"></i> Cek Harga via WA</div>
                </div>

                <div class="mcu-card-modern" data-aos="fade-up" data-aos-delay="200" onclick="openModal('p3')">
                    <div class="icon-box"><i class="fa-solid fa-microscope"></i></div>
                    <h4>Paket Komplit 2</h4>
                    <p>Dilengkapi profil kolesterol lengkap (LDL & HDL) untuk screening jantung.</p>
                    <div class="price-label"><i class="fa-brands fa-whatsapp me-1"></i> Cek Harga via WA</div>
                </div>

                <div class="mcu-card-modern" data-aos="fade-up" data-aos-delay="250" onclick="openModal('p4')">
                    <div class="icon-box"><i class="fa-solid fa-hospital-user"></i></div>
                    <h4>Paket Komplit 3</h4>
                    <p>Paket premium dengan EKG, USG Abdomen, dan fungsi hati (SGPT).</p>
                    <div class="price-label"><i class="fa-brands fa-whatsapp me-1"></i> Cek Harga via WA</div>
                </div>

                <div class="mcu-card-modern" data-aos="fade-up" data-aos-delay="300" onclick="openModal('p5')">
                    <div class="icon-box"><i class="fa-solid fa-heart-pulse"></i></div>
                    <h4>Paket Jantung</h4>
                    <p>Pemeriksaan spesifik jantung dengan Treadmill & Echocardiografi.</p>
                    <div class="price-label"><i class="fa-brands fa-whatsapp me-1"></i> Cek Harga via WA</div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5" data-aos="zoom-in">
            <a href="https://wa.me/6285540441147?text=Halo%20Admin,%20saya%20ingin%20tanya%20harga%20paket%20MCU" class="btn fw-bold px-5 py-3 text-white shadow" style="background: var(--primary-orange); border-radius: 50px;">
                <i class="fa-brands fa-whatsapp me-2"></i> Konsultasi Harga Sekarang
            </a>
        </div>
    </div>
</section>

<div class="modal fade" id="p1" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header-orange"><i class="fa-solid fa-stethoscope"></i></div><div class="modal-body p-4"><h4 class="fw-bold text-center">Paket MCU Dasar</h4><ul class="info-list"><li><i class="fa-solid fa-check"></i> Konsultasi Dokter Umum</li><li><i class="fa-solid fa-check"></i> Gula Darah Sewaktu</li><li><i class="fa-solid fa-check"></i> Asam Urat</li><li><i class="fa-solid fa-check"></i> Kolesterol Total</li><li><i class="fa-solid fa-check"></i> Urine Lengkap</li></ul><p class="text-muted small mb-3"><i class="fa-brands fa-whatsapp me-1"></i>Harga: chat ke WA</p><button class="btn btn-dark w-100 rounded-pill py-2" data-bs-dismiss="modal">Tutup</button></div></div></div></div>

<div class="modal fade" id="p2" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header-orange"><i class="fa-solid fa-notes-medical"></i></div><div class="modal-body p-4"><h4 class="fw-bold text-center">Paket Komplit</h4><ul class="info-list"><li><i class="fa-solid fa-check"></i> Konsultasi Dokter Umum</li><li><i class="fa-solid fa-check"></i> Gula Darah Sewaktu</li><li><i class="fa-solid fa-check"></i> Asam Urat</li><li><i class="fa-solid fa-check"></i> Kolesterol Total</li><li><i class="fa-solid fa-check"></i> Kreatinin</li><li><i class="fa-solid fa-check"></i> Trigliserida</li><li><i class="fa-solid fa-check"></i> HBA1C</li></ul><p class="text-muted small mb-3"><i class="fa-brands fa-whatsapp me-1"></i>Harga: chat ke WA</p><button class="btn btn-dark w-100 rounded-pill py-2" data-bs-dismiss="modal">Tutup</button></div></div></div></div>

<div class="modal fade" id="p3" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header-orange"><i class="fa-solid fa-microscope"></i></div><div class="modal-body p-4"><h4 class="fw-bold text-center">Paket Komplit 2</h4><ul class="info-list"><li><i class="fa-solid fa-check"></i> Konsultasi Dokter Umum</li><li><i class="fa-solid fa-check"></i> Gula Darah Sewaktu</li><li><i class="fa-solid fa-check"></i> Asam Urat</li><li><i class="fa-solid fa-check"></i> Kolesterol Total</li><li><i class="fa-solid fa-check"></i> Kreatinin</li><li><i class="fa-solid fa-check"></i> Trigliserida</li><li><i class="fa-solid fa-check"></i> HBA1C</li><li><i class="fa-solid fa-check"></i> LDL</li><li><i class="fa-solid fa-check"></i> HDL</li></ul><p class="text-muted small mb-3"><i class="fa-brands fa-whatsapp me-1"></i>Harga: chat ke WA</p><button class="btn btn-dark w-100 rounded-pill py-2" data-bs-dismiss="modal">Tutup</button></div></div></div></div>

<div class="modal fade" id="p4" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header-orange"><i class="fa-solid fa-hospital-user"></i></div><div class="modal-body p-4"><h4 class="fw-bold text-center">Paket Komplit 3</h4><ul class="info-list"><li><i class="fa-solid fa-check"></i> Gula Darah Sewaktu/Puasa</li><li><i class="fa-solid fa-check"></i> Asam Urat</li><li><i class="fa-solid fa-check"></i> Kolesterol Total</li><li><i class="fa-solid fa-check"></i> Darah Lengkap</li><li><i class="fa-solid fa-check"></i> Urin Lengkap</li><li><i class="fa-solid fa-check"></i> Trigliserida</li><li><i class="fa-solid fa-check"></i> Kreatinin</li><li><i class="fa-solid fa-check"></i> SGPT</li><li><i class="fa-solid fa-check"></i> EKG</li><li><i class="fa-solid fa-check"></i> USG Abdomen</li></ul><p class="text-muted small mb-3"><i class="fa-brands fa-whatsapp me-1"></i>Harga: chat ke WA</p><button class="btn btn-dark w-100 rounded-pill py-2" data-bs-dismiss="modal">Tutup</button></div></div></div></div>

<div class="modal fade" id="p5" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header-orange"><i class="fa-solid fa-heart-pulse"></i></div><div class="modal-body p-4"><h4 class="fw-bold text-center">Paket Pemeriksaan Jantung</h4><ul class="info-list"><li><i class="fa-solid fa-check"></i> Konsultasi Dokter Sp. Jantung (Admin)</li><li><i class="fa-solid fa-check"></i> Darah Lengkap</li><li><i class="fa-solid fa-check"></i> Kolesterol Total</li><li><i class="fa-solid fa-check"></i> LDL</li><li><i class="fa-solid fa-check"></i> HDL</li><li><i class="fa-solid fa-check"></i> Trigliserida</li><li><i class="fa-solid fa-check"></i> Treadmill Test</li><li><i class="fa-solid fa-check"></i> Echocardiografi (USG Jantung)</li></ul><p class="text-muted small mb-3"><i class="fa-brands fa-whatsapp me-1"></i>Harga: chat ke WA</p><button class="btn btn-dark w-100 rounded-pill py-2" data-bs-dismiss="modal">Tutup</button></div></div></div></div>

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