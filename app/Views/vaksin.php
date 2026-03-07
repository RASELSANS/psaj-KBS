<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-orange: #ff8a3d;
        --soft-orange: #fff2e7;
        --dark-navy: #1e293b;
    }

    body { background-color: #f8fafc; }

    /* --- HEADER PREMIUM --- */
    .vaksin-header { 
        padding: 180px 0 100px; 
        background: linear-gradient(135deg, #ffffff 0%, var(--soft-orange) 100%);
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .vaksin-header::after {
        content: 'VACCINE';
        position: absolute;
        font-size: 12vw;
        font-weight: 900;
        color: rgba(255, 138, 61, 0.05);
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 0;
        white-space: nowrap;
    }

    .header-tagline {
        display: inline-block;
        padding: 8px 25px;
        background: white;
        color: var(--primary-orange);
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        box-shadow: 0 5px 15px rgba(255, 138, 61, 0.1);
        margin-bottom: 20px;
    }

    /* --- VAKSIN CARDS --- */
    .vaksin-card { 
        border-radius: 30px; 
        border: 1px solid rgba(0,0,0,0.03); 
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        background: #fff;
        padding: 40px 30px;
        position: relative;
        z-index: 1;
        cursor: pointer;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .vaksin-card:hover { 
        transform: translateY(-12px);
        box-shadow: 0 25px 50px rgba(255, 138, 61, 0.15);
        border-color: var(--primary-orange);
    }

    .icon-box {
        width: 80px; height: 80px;
        background: var(--soft-orange);
        color: var(--primary-orange);
        border-radius: 22px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 25px;
        transition: 0.3s;
    }

    .vaksin-card:hover .icon-box {
        background: var(--primary-orange);
        color: white;
        transform: rotate(-10deg);
    }

    /* --- MODAL STYLING --- */
    .modal-content { border-radius: 35px; border: none; overflow: hidden; }
    .modal-header { background: var(--soft-orange); border: none; padding: 40px 40px 10px; position: relative; }
    .modal-body { padding: 10px 40px 40px; text-align: center; }
    .badge-vaksin { 
        background: var(--primary-orange); 
        color: white; 
        font-weight: 700; 
        padding: 10px 20px; 
        border-radius: 12px; 
        margin-bottom: 20px; 
        display: inline-block; 
        text-transform: uppercase;
    }

    .info-box-modal { background: #f1f5f9; padding: 20px; border-radius: 20px; text-align: left; margin-bottom: 20px; }
    .info-box-modal h6 { font-weight: 800; color: var(--dark-navy); }

    .btn-register {
        background: var(--primary-orange);
        color: white;
        border: none;
        border-radius: 20px;
        padding: 15px;
        font-weight: 700;
        width: 100%;
        display: block;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-register:hover { background: var(--dark-navy); color: white; transform: translateY(-3px); }
</style>

<section class="vaksin-header">
    <div class="container position-relative" style="z-index: 1;">
        <div data-aos="zoom-in">
            <span class="header-tagline">Proteksi Sejak Dini</span>
            <h1 class="display-4 fw-bold mb-3">Layanan <span class="text-orange" style="color: var(--primary-orange);">Vaksinasi</span></h1>
            <p class="text-muted mx-auto" style="max-width: 600px;">
                Investasi terbaik untuk kesehatan masa depan. Pilih jenis vaksin untuk melihat informasi detail mengenai manfaat dan pencegahan.
            </p>
        </div>
    </div>
</section>

<section class="py-5" style="margin-top: -50px;">
    <div class="container">
        <div class="row g-4">
            
            <?php 
                $vaksins = [
                    ['id' => 'Influenza', 'icon' => 'fa-syringe', 'title' => 'Vaksin Influenza', 'desc' => 'Mencegah virus flu musiman yang menyerang pernapasan.'],
                    ['id' => 'Hepatitis', 'icon' => 'fa-shield-virus', 'title' => 'Vaksin Hepatitis B', 'desc' => 'Perlindungan organ hati dari virus Hepatitis B kronis.'],
                    ['id' => 'PCV', 'icon' => 'fa-lungs', 'title' => 'Vaksin PCV', 'desc' => 'Mencegah Radang Paru, Meningitis, dan Infeksi Telinga.'],
                    ['id' => 'HPV', 'icon' => 'fa-virus-slash', 'title' => 'Vaksin HPV', 'desc' => 'Pencegahan utama Kanker Serviks dan kutil kelamin.'],
                    ['id' => 'MMR', 'icon' => 'fa-baby', 'title' => 'Vaksin MMR', 'desc' => 'Mencegah Campak, Gondongan, dan Campak Jerman.'],
                    ['id' => 'Tipes', 'icon' => 'fa-bacteria', 'title' => 'Vaksin Tipes', 'desc' => 'Perlindungan dari demam tifoid akibat makanan terkontaminasi.'],
                ];
                foreach($vaksins as $index => $v):
            ?>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                <div class="vaksin-card text-center" data-bs-toggle="modal" data-bs-target="#modal<?= $v['id'] ?>">
                    <div class="icon-box"><i class="fa-solid <?= $v['icon'] ?> fs-2"></i></div>
                    <h5 class="fw-bold"><?= $v['title'] ?></h5>
                    <p class="text-muted small mb-4"><?= $v['desc'] ?></p>
                    <div class="mt-auto">
                        <span class="btn btn-sm rounded-pill px-4 shadow-sm" style="background: #f1f5f9; color: var(--primary-orange); font-weight: 600;">Lihat Detail</span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<div class="modal fade" id="modalInfluenza" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="fw-bold mb-0">Detail Vaksin</h4>
                <button type="button" class="btn-close position-absolute end-0 me-4" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="badge-vaksin">INFLUENZA</div>
                <p class="text-muted">Flu bukan sekadar batuk pilek biasa. Virus ini terus bermutasi dan bisa menyebabkan radang paru (pneumonia) berat.</p>
                <div class="info-box-modal">
                    <h6 class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Kenapa Harus Vaksin?</h6>
                    <ul class="text-muted small mb-0 ps-3">
                        <li>Mencegah penularan ke keluarga di rumah.</li>
                        <li>Sangat disarankan untuk yang sering bekerja di AC.</li>
                        <li>Diberikan rutin 1 kali setiap tahun.</li>
                    </ul>
                </div>
                <a href="https://wa.me/628112519001" class="btn btn-register shadow-lg"><i class="fa-brands fa-whatsapp me-2"></i>Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHepatitis" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="fw-bold mb-0">Detail Vaksin</h4>
                <button type="button" class="btn-close position-absolute end-0 me-4" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="badge-vaksin">HEPATITIS B</div>
                <p class="text-muted">Hepatitis B menyerang organ hati secara diam-diam dan dapat berujung pada kanker hati.</p>
                <div class="info-box-modal">
                    <h6 class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Manfaat Utama:</h6>
                    <ul class="text-muted small mb-0 ps-3">
                        <li>Perlindungan jangka panjang terhadap infeksi hati kronis.</li>
                        <li>Penting bagi pasangan pranikah & tenaga kesehatan.</li>
                        <li>Mencegah penularan virus melalui cairan tubuh.</li>
                    </ul>
                </div>
                <a href="https://wa.me/628112519001" class="btn btn-register shadow-lg"><i class="fa-brands fa-whatsapp me-2"></i>Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPCV" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="fw-bold mb-0">Detail Vaksin</h4>
                <button type="button" class="btn-close position-absolute end-0 me-4" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="badge-vaksin">PCV (PNEUMOKOKUS)</div>
                <p class="text-muted">Melindungi dari bakteri penyebab radang paru-paru, meningitis, dan infeksi telinga.</p>
                <div class="info-box-modal">
                    <h6 class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Siapa yang Perlu?</h6>
                    <ul class="text-muted small mb-0 ps-3">
                        <li>Balita (sebagai imunisasi dasar wajib).</li>
                        <li>Lansia (>50 tahun) untuk menjaga fungsi paru-paru.</li>
                        <li>Individu dengan imunitas rendah.</li>
                    </ul>
                </div>
                <a href="https://wa.me/628112519001" class="btn btn-register shadow-lg"><i class="fa-brands fa-whatsapp me-2"></i>Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHPV" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="fw-bold mb-0">Detail Vaksin</h4>
                <button type="button" class="btn-close position-absolute end-0 me-4" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="badge-vaksin">HPV (ANTI KANKER)</div>
                <p class="text-muted">Vaksin krusial untuk mencegah virus HPV penyebab utama Kanker Serviks.</p>
                <div class="info-box-modal">
                    <h6 class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Penting Diketahui:</h6>
                    <ul class="text-muted small mb-0 ps-3">
                        <li>Dianjurkan sejak usia remaja (mulai 9 tahun).</li>
                        <li>Efektif mencegah kutil kelamin dan kanker mulut rahim.</li>
                        <li>Diberikan dalam 2 atau 3 dosis sesuai usia.</li>
                    </ul>
                </div>
                <a href="https://wa.me/628112519001" class="btn btn-register shadow-lg"><i class="fa-brands fa-whatsapp me-2"></i>Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalMMR" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="fw-bold mb-0">Detail Vaksin</h4>
                <button type="button" class="btn-close position-absolute end-0 me-4" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="badge-vaksin">MMR</div>
                <p class="text-muted">Perlindungan dari tiga penyakit sekaligus: Campak, Gondongan, dan Rubella.</p>
                <div class="info-box-modal">
                    <h6 class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Mencegah Komplikasi:</h6>
                    <ul class="text-muted small mb-0 ps-3">
                        <li>Radang otak dan paru akibat virus campak.</li>
                        <li>Kemandulan akibat gondongan pada pria dewasa.</li>
                        <li>Kecacatan janin (Rubella) pada ibu hamil.</li>
                    </ul>
                </div>
                <a href="https://wa.me/628112519001" class="btn btn-register shadow-lg"><i class="fa-brands fa-whatsapp me-2"></i>Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTipes" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="fw-bold mb-0">Detail Vaksin</h4>
                <button type="button" class="btn-close position-absolute end-0 me-4" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="badge-vaksin">TYPHIM (TIPES)</div>
                <p class="text-muted">Melindungi pencernaan dari bakteri Salmonella typhi akibat makanan tidak higienis.</p>
                <div class="info-box-modal">
                    <h6 class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Rekomendasi:</h6>
                    <ul class="text-muted small mb-0 ps-3">
                        <li>Sangat penting bagi yang hobi wisata kuliner (jajan).</li>
                        <li>Mencegah demam tinggi berulang akibat tipes.</li>
                        <li>Perlu diulang (booster) setiap 3 tahun sekali.</li>
                    </ul>
                </div>
                <a href="https://wa.me/628112519001" class="btn btn-register shadow-lg"><i class="fa-brands fa-whatsapp me-2"></i>Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 1000, once: true });
    });
</script>
<?= $this->endSection(); ?>