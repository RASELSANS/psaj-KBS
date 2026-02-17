<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<style>
    :root {
        --primary-orange: #ff8a3d; 
        --dark-navy: #2c3e50;    
        --maroon-accent: #8b0000; 
        --bg-light: #f9f9f9;
    }

    .about-page { font-family: 'Inter', sans-serif; color: #333; line-height: 1.6; }

    /* Hero Section - Fix Warna Tulisan */
    .about-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), 
                    url('<?= base_url('img/aa.jpg') ?>'); 
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 140px 0; 
        text-align: center;
        position: relative;
    }
    
    /* Paksa H1 dan P jadi putih, jangan kasih kendor */
    .about-hero h1, 
    .about-hero .display-3, 
    .about-hero p, 
    .about-hero .lead {
        color: #ffffff !important; 
        font-weight: 800;
        letter-spacing: 2px;
        text-shadow: 2px 4px 12px rgba(0, 0, 0, 0.7);
        margin-bottom: 0;
    }

    .hero-divider {
        width: 80px; height: 5px; 
        background: var(--primary-orange); 
        margin: 20px auto; 
        border-radius: 10px;
    }

    /* Section Penanggung Jawab */
    .leader-container {
        background: white; border-radius: 25px; overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.06); border: 1px solid #f0f0f0;
    }
    .leader-sidebar {
        background: var(--maroon-accent); color: white; padding: 50px;
        display: flex; flex-direction: column; justify-content: center;
    }
    .leader-img-box {
        background: white; padding: 12px; border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    /* Sejarah Section */
    .history-card {
        padding: 50px; background: var(--bg-light); 
        border-radius: 20px; border-left: 6px solid var(--primary-orange);
    }

    /* Visi Misi & Tujuan */
    .brand-label {
        background: var(--maroon-accent); 
        color: white; padding: 8px 25px;
        font-weight: 700; border-radius: 6px; display: inline-block;
        margin-bottom: 20px; text-transform: uppercase; font-size: 0.85rem;
    }
    
    .vm-card {
        background: white; border-radius: 20px; padding: 40px;
        height: 100%; border-bottom: 5px solid var(--primary-orange);
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        transition: all 0.3s ease;
    }
    .vm-card:hover { transform: translateY(-8px); }
    .vm-text { font-size: 1.1rem; color: #444; }

    /* Motto Section - Diperkecil & Dibuat Elegan */
    .motto-wrapper {
        text-align: center;
        margin-top: 80px;
        padding: 40px;
        position: relative;
    }

    .motto-line {
        display: inline-block;
        height: 2px;
        width: 50px;
        background: var(--primary-orange);
        vertical-align: middle;
    }

    .motto-text {
        color: var(--dark-navy);
        font-weight: 700;
        font-style: italic;
        font-size: 2rem; /* Ukuran pas, nggak lebay */
        margin: 0 20px;
        display: inline-block;
        vertical-align: middle;
    }

    .motto-sub {
        display: block;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: var(--primary-orange);
        font-size: 0.9rem;
        margin-bottom: 10px;
        font-weight: 600;
    }
</style>

<div class="about-page">
    <section class="about-hero">
        <div class="container">
            <h1 class="display-3">TENTANG KAMI</h1>
            <div class="hero-divider"></div>
            <p class="lead fs-4 opacity-90">Klinik Utama Rawat Jalan Brayan Sehat</p>
        </div>
    </section>

    <section class="py-5 mt-5">
        <div class="container">
            <div class="leader-container mb-5">
                <div class="row g-0">
                    <div class="col-lg-7 p-5">
                        <h2 class="fw-bold mb-4" style="color: var(--maroon-accent);">Klinik Brayan Sehat</h2>
                        <p class="fs-5 fst-italic mb-5 text-secondary" style="line-height: 1.8;">
                            "Klinik Utama Rawat Jalan didedikasikan sebagai Klinik Utama yang Profesional, memuliakan pasien, dan memberikan kemudahan bagi pasien dan pengunjung."
                        </p>
                        <div class="ps-4 border-start border-4" style="border-color: var(--primary-orange) !important;">
                            <h5 class="fw-bold mb-1">dr. Anton Sunaryo, S.T., M.K.K., AIFO-K</h5>
                            <p class="text-muted mb-0">Penanggung Jawab Klinik</p>
                        </div>
                    </div>
                    <div class="col-lg-5 leader-sidebar text-center">
                        <div class="leader-img-box mx-auto" style="max-width: 280px;">
                            <img src="<?= base_url('img/D6.png') ?>" class="img-fluid rounded" alt="dr. Anton Sunaryo">
                        </div>
                    </div>
                </div>
            </div>

          <section class="py-5">
    <div class="container">
        <div class="history-card shadow-sm" style="padding: 50px; background: #f9f9f9; border-radius: 20px; border-left: 6px solid var(--primary-orange);">
            <h3 class="fw-bold mb-4" style="color: var(--dark-navy);">Sejarah & Transformasi</h3>
            <div class="text-secondary" style="text-align: justify; line-height: 1.8;">
                
                <p class="mb-4">
                    <b>PT. Brayan Sehat Bareng</b> adalah badan usaha yang mengelola Klinik Utama Brayan Sehat, bergerak dalam bidang kesehatan yang didirikan pada tanggal <b>22 Februari 2016</b> di Purwokerto.
                </p>

                <p class="mb-4">
                    Perjalanan kami bermula dari tahun 2011 yang saat itu berbentuk praktek pribadi dokter umum dan pelayanan medical check-up fisis berbasis hyperkes. Kami berkeinginan serta berusaha untuk bertransformasi menjadi <b>Klinik Utama Rawat Jalan</b> untuk mendukung pelayanan medical check-up yang komprehensif. 
                </p>

                <p class="mb-4">
                    Layanan kami meliputi pemeriksaan fisis serta tes-tes penunjang medis seperti <b>Elektrokardiografi (EKG), Spirometri, Audiometri, Ultrasonografi (USG), dan Treadmill test</b>. Fasilitas ini disediakan untuk membantu mendiagnosis penyakit yang berhubungan dengan pekerjaan atau penyakit akibat kerja, sekaligus menyongsong era pelayanan kesehatan sejak diberlakukannya UU SSJN dan BPJS di tahun 2014.
                </p>

                <p>
                    Klinik Utama Brayan Sehat juga melayani konsultasi dalam bidang <b>Kedokteran Kerja (Okupasi)</b> yang mencakup Kesehatan dan Keselamatan Kerja (K3). Fokus kami adalah memastikan pelaksanaan upaya kesehatan kerja di dunia usaha dapat mencegah penyakit, mempertahankan, serta meningkatkan kapasitas kerja dan kesehatan pekerja demi perlindungan hak dan produktivitasnya.
                </p>

            </div>
        </div>
    </div>
</section>

    <section class="py-5 bg-white mb-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6">
                    <div class="vm-card text-center">
                        <div class="brand-label">VISI</div>
                        <p class="vm-text fw-bold">"Memberikan pelayanan kesehatan dengan prima dan profesional."</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="vm-card text-center">
                        <div class="brand-label">TUJUAN</div>
                        <p class="vm-text fw-bold">"Memberikan pelayanan yang aman, bermutu dan profesional."</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="vm-card">
                        <div class="brand-label">MISI</div>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-start mb-3">
                                <i class="fa-solid fa-circle-check text-warning me-3 mt-1 fs-5"></i>
                                <span>Memberikan pelayanan kesehatan profesional kepada para pekerja dan masyarakat.</span>
                            </li>
                            <li class="d-flex align-items-start mb-3">
                                <i class="fa-solid fa-circle-check text-warning me-3 mt-1 fs-5"></i>
                                <span>Meningkatkan kesadaran perilaku hidup sehat.</span>
                            </li>
                            <li class="d-flex align-items-start">
                                <i class="fa-solid fa-circle-check text-warning me-3 mt-1 fs-5"></i>
                                <span>Menyediakan sarana pelayanan kesehatan berbasis kompetensi.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="motto-wrapper">
                <span class="motto-sub">Motto Kami</span>
                <div>
                    <span class="motto-line"></span>
                    <h2 class="motto-text">"Mari Sehat Bersama"</h2>
                    <span class="motto-line"></span>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>