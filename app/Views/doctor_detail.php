<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    .detail-container { padding: 80px 0; background-color: #fcfcfc; }
    
    /* Sticky Sidebar Logic */
    .sticky-box {
        position: -webkit-sticky;
        position: sticky;
        top: 100px; /* Jarak dari batas atas layar */
        z-index: 10;
    }

    /* Frame Foto Dokter dengan Animasi */
    .doc-img-wrapper {
        position: relative;
        padding: 15px;
        background: white;
        border-radius: 30px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.07);
        overflow: hidden;
        animation: fadeInUp 0.8s ease-out;
    }
    
    .doc-img-bg {
        background: linear-gradient(135deg, #ff8a3d 0%, #ffc107 100%);
        border-radius: 20px;
        padding-top: 30px;
        display: flex;
        justify-content: center;
        align-items: flex-end;
    }

    .doc-img-bg img {
        max-width: 90%;
        filter: drop-shadow(0 10px 15px rgba(0,0,0,0.2));
        transition: transform 0.5s ease;
    }

    .doc-img-wrapper:hover .doc-img-bg img {
        transform: scale(1.05);
    }

    /* Content Styling */
    .doc-detail-name { 
        font-weight: 800; 
        font-size: 2.2rem; 
        color: #2c3e50; 
        margin-bottom: 5px;
        line-height: 1.2;
    }
    
    .doc-spec-label {
        color: #ff8a3d;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
        display: block;
        margin-bottom: 20px;
    }

    .doc-bio { 
        font-size: 1.05rem; 
        color: #6c757d; 
        margin-bottom: 30px; 
        line-height: 1.8; 
    }

    .section-title { 
        font-weight: 700; 
        font-size: 1.15rem; 
        color: #333;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    
    .section-title i { color: #ff8a3d; margin-right: 10px; }

    /* List Pelayanan Modern */
    .list-pelayanan { 
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
        padding: 0;
        list-style: none;
    }

    .list-pelayanan li {
        background: #fff;
        padding: 12px 15px;
        border-radius: 12px;
        font-size: 0.95rem;
        color: #444;
        border: 1px solid #eee;
        transition: 0.3s;
        display: flex;
        align-items: center;
    }
    .list-pelayanan li:hover { 
        border-color: #ff8a3d; 
        transform: translateX(8px);
        background: #fffaf7;
    }

    /* Kotak Jadwal */
    .schedule-card { 
        background: white; 
        padding: 25px; 
        border-radius: 20px; 
        margin-top: 40px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border: 1px solid #f1f1f1;
    }

    .schedule-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px dashed #eee;
    }
    .schedule-item:last-child { border-bottom: none; }
    .day { font-weight: 600; color: #555; }
    .time { color: #ff8a3d; font-weight: 700; }

    /* Button */
    .btn-booking { 
        background: #ff8a3d; 
        color: white !important; 
        border: none; 
        padding: 15px 40px; 
        border-radius: 50px; 
        font-weight: 700; 
        width: 100%;
        margin-top: 25px;
        transition: 0.3s;
        box-shadow: 0 8px 20px rgba(255, 138, 61, 0.3);
        display: inline-block;
        text-align: center;
        text-decoration: none;
    }
    .btn-booking:hover { 
        background: #e6762d; 
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(255, 138, 61, 0.4);
    }

    /* Keyframes Animasi */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive adjustment */
    @media (max-width: 991px) {
        .sticky-box { position: relative; top: 0; }
        .detail-container { padding: 40px 0; }
    }
</style>

<div class="detail-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="sticky-box">
                    <div class="doc-img-wrapper">
                        <div class="doc-img-bg">
                            <img src="<?= base_url('img/card1.png') ?>" class="img-fluid" alt="Dokter">
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <span class="badge rounded-pill bg-light text-success border px-3 py-2">
                            <i class="fas fa-circle me-1 small"></i> Tersedia Hari Ini
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 ps-lg-5">
                <span class="doc-spec-label">Spesialis Gigi & Mulut</span>
                <h1 class="doc-detail-name">drg. Savira Aska Nourmalita</h1>
                
                <p class="doc-bio">
                    Lulusan Fakultas Kedokteran Gigi Universitas Indonesia. Berpengalaman dalam menangani berbagai kasus kesehatan gigi anak maupun dewasa dengan pendekatan yang ramah dan profesional. Fokus pada restorasi estetik dan pencegahan dini penyakit mulut.
                </p>

                <h5 class="section-title">
                    <i class="fas fa-hand-holding-medical"></i> Layanan Medis
                </h5>
                <ul class="list-pelayanan">
                    <li><i class="fas fa-check-circle me-2 text-warning"></i> Konsultasi Gigi</li>
                    <li><i class="fas fa-check-circle me-2 text-warning"></i> Scaling Gigi</li>
                    <li><i class="fas fa-check-circle me-2 text-warning"></i> Penambalan Estetik</li>
                    <li><i class="fas fa-check-circle me-2 text-warning"></i> Pencabutan Gigi</li>
                </ul>

                <div class="schedule-card">
                    <h5 class="section-title">
                        <i class="fas fa-calendar-alt"></i> Jadwal Praktek
                    </h5>
                    <div class="schedule-item">
                        <span class="day">Senin - Jum'at</span>
                        <span class="time">09.00 - 13.00 WIB</span>
                    </div>
                    <div class="schedule-item">
                        <span class="day">Sabtu</span>
                        <span class="time">10.30 - 14.30 WIB</span>
                    </div>
                    
                    <a href="https://wa.me/628112519001" class="btn-booking" target="_blank">
                        <i class="fab fa-whatsapp me-2"></i> Reservasi Sekarang
                    </a>
                    <p class="text-center small text-muted mt-3 mb-0 italic">
                        *Jadwal dapat berubah sewaktu-waktu.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>