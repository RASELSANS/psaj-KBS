<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    /* Hero Section Tentang Kami */
    .about-header { 
        padding: 100px 0 60px; 
        background: linear-gradient(rgba(255, 138, 61, 0.05), rgba(255, 255, 255, 1));
        text-align: center; 
    }
    
    .about-img-frame {
        position: relative;
        padding: 15px;
        background: white;
        border-radius: 30px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
    }
    
    .about-img-frame img {
        border-radius: 20px;
        width: 100%;
        display: block;
    }

    /* Visi Misi Card */
    .vision-mission-section { padding: 80px 0; }
    
    .card-vm {
        border: none;
        border-radius: 25px;
        padding: 40px;
        height: 100%;
        transition: 0.3s;
        background: #fff;
        border: 1px solid #eee;
    }
    
    .card-vm:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(255, 138, 61, 0.1);
        border-color: #ff8a3d;
    }

    .icon-box-orange {
        width: 60px;
        height: 60px;
        background: #fff2e7;
        color: #ff8a3d;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        font-size: 1.5rem;
    }

    .stat-box { text-align: center; padding: 30px; }
    .stat-number { font-size: 2.5rem; font-weight: 800; color: #ff8a3d; display: block; }
    .stat-label { color: #777; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 0.8rem; }
</style>

<section class="about-header">
    <div class="container">
        <div class="row align-items-center text-start">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="section-subtitle" style="color: #ff8a3d; font-weight: 700;">MENGENAL KAMI</span>
                <h1 class="display-4 fw-bold mt-2 mb-4">Melayani dengan Ketulusan Sejak Berdiri</h1>
                <p class="lead text-muted mb-4">Klinik Brayan Sehat hadir sebagai mitra kesehatan terpercaya bagi keluarga dan industri. Kami percaya bahwa setiap pasien berhak mendapatkan pelayanan medis berkualitas tinggi dengan sentuhan kemanusiaan.</p>
                <p class="text-secondary">Berawal dari semangat untuk meningkatkan akses kesehatan di lingkungan sekitar, kini kami telah berkembang menjadi klinik dengan fasilitas lengkap dan tenaga medis spesialis yang berpengalaman.</p>
            </div>
            <div class="col-lg-6">
                <div class="about-img-frame">
                    <img src="<?= base_url('img/klinik.jpeg') ?>" alt="Gedung Klinik Brayan Sehat">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <span class="stat-number">10+</span>
                    <span class="stat-label">Dokter Spesialis</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Layanan Farmasi</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <span class="stat-number">50k+</span>
                    <span class="stat-label">Pasien Puas</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <span class="stat-number">15+</span>
                    <span class="stat-label">Tahun Pengalaman</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="vision-mission-section bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Visi & Misi Kami</h2>
            <hr class="mx-auto" style="width: 60px; border: 2px solid #ff8a3d; opacity: 1;">
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card-vm">
                    <div class="icon-box-orange">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Visi Kami</h3>
                    <p class="text-secondary">Menjadi pusat pelayanan kesehatan primer dan kerja yang unggul, modern, serta menjadi pilihan utama masyarakat dengan mengutamakan keselamatan pasien dan profesionalisme medis.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-vm">
                    <div class="icon-box-orange">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Misi Kami</h3>
                    <ul class="text-secondary" style="padding-left: 20px;">
                        <li class="mb-2">Memberikan pelayanan kesehatan yang cepat, akurat, dan terjangkau.</li>
                        <li class="mb-2">Menyediakan tenaga medis yang kompeten dan ramah dalam melayani.</li>
                        <li class="mb-2">Mengembangkan fasilitas penunjang medis sesuai dengan perkembangan teknologi.</li>
                        <li class="mb-2">Membangun kerja sama yang harmonis dengan mitra industri dalam layanan kesehatan kerja.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container text-center py-5">
        <h2 class="fw-bold mb-5">Nilai-Nilai Utama</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <i class="fa-solid fa-heart-pulse fa-3x mb-3" style="color: #ff8a3d;"></i>
                <h5 class="fw-bold">Empati</h5>
                <p class="small text-muted">Melayani setiap pasien seperti keluarga sendiri.</p>
            </div>
            <div class="col-md-3">
                <i class="fa-solid fa-shield-halved fa-3x mb-3" style="color: #ff8a3d;"></i>
                <h5 class="fw-bold">Integritas</h5>
                <p class="small text-muted">Kejujuran dan etika medis adalah prioritas kami.</p>
            </div>
            <div class="col-md-3">
                <i class="fa-solid fa-users-gear fa-3x mb-3" style="color: #ff8a3d;"></i>
                <h5 class="fw-bold">Profesional</h5>
                <p class="small text-muted">Bekerja sesuai standar medis yang ketat.</p>
            </div>
            <div class="col-md-3">
                <i class="fa-solid fa-lightbulb fa-3x mb-3" style="color: #ff8a3d;"></i>
                <h5 class="fw-bold">Inovatif</h5>
                <p class="small text-muted">Terus belajar dan beradaptasi dengan teknologi baru.</p>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>