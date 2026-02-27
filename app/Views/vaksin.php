<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    .vaksin-header { padding: 120px 0 60px; background: #fff2e7; text-align: center; }
    
    .vaksin-card { 
        border-radius: 20px; 
        border: 1px solid #eee; 
        transition: 0.3s; 
        background: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        cursor: pointer; /* Biar user tau ini bisa diklik */
    }
    
    .vaksin-card:hover { 
        border-color: #ff8a3d; 
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(255, 138, 61, 0.2);
    }

    .icon-box {
        width: 60px; height: 60px;
        background: #fff2e7;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 15px;
    }

    .text-orange { color: #ff8a3d; }
    
    /* Modal Styling */
    .modal-content { border-radius: 25px; border: none; }
    .modal-header { border-bottom: none; padding: 30px 30px 10px; }
    .modal-body { padding: 10px 30px 40px; }
    .badge-vaksin { background: #fff2e7; color: #ff8a3d; font-weight: 700; padding: 8px 15px; border-radius: 10px; margin-bottom: 15px; display: inline-block; }
</style>

<section class="vaksin-header">
    <div class="container">
        <h1 class="fw-bold">Layanan Vaksinasi</h1>
        <p class="text-muted">Pilih jenis vaksin untuk melihat informasi detail mengenai manfaat dan pencegahan.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            
            <div class="col-md-4">
                <div class="vaksin-card p-4 text-center h-100" data-bs-toggle="modal" data-bs-target="#modalInfluenza">
                    <div class="icon-box"><i class="fa-solid fa-syringe text-orange fs-3"></i></div>
                    <h5 class="fw-bold">Vaksin Influenza</h5>
                    <p class="text-muted small">Mencegah virus flu musiman yang menyerang pernapasan.</p>
                    <span class="badge rounded-pill bg-light text-orange border">Lihat Detail</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="vaksin-card p-4 text-center h-100" data-bs-toggle="modal" data-bs-target="#modalHepatitis">
                    <div class="icon-box"><i class="fa-solid fa-shield-virus text-orange fs-3"></i></div>
                    <h5 class="fw-bold">Vaksin Hepatitis B</h5>
                    <p class="text-muted small">Perlindungan organ hati dari virus Hepatitis B kronis.</p>
                    <span class="badge rounded-pill bg-light text-orange border">Lihat Detail</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="vaksin-card p-4 text-center h-100" data-bs-toggle="modal" data-bs-target="#modalPCV">
                    <div class="icon-box"><i class="fa-solid fa-lungs text-orange fs-3"></i></div>
                    <h5 class="fw-bold">Vaksin PCV</h5>
                    <p class="text-muted small">Mencegah Radang Paru, Meningitis, dan Infeksi Telinga.</p>
                    <span class="badge rounded-pill bg-light text-orange border">Lihat Detail</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="vaksin-card p-4 text-center h-100" data-bs-toggle="modal" data-bs-target="#modalHPV">
                    <div class="icon-box"><i class="fa-solid fa-virus-slash text-orange fs-3"></i></div>
                    <h5 class="fw-bold">Vaksin HPV</h5>
                    <p class="text-muted small">Pencegahan utama Kanker Serviks dan kutil kelamin.</p>
                    <span class="badge rounded-pill bg-light text-orange border">Lihat Detail</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="vaksin-card p-4 text-center h-100" data-bs-toggle="modal" data-bs-target="#modalMMR">
                    <div class="icon-box"><i class="fa-solid fa-baby text-orange fs-3"></i></div>
                    <h5 class="fw-bold">Vaksin MMR</h5>
                    <p class="text-muted small">Mencegah Campak, Gondongan, dan Campak Jerman.</p>
                    <span class="badge rounded-pill bg-light text-orange border">Lihat Detail</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="vaksin-card p-4 text-center h-100" data-bs-toggle="modal" data-bs-target="#modalTipes">
                    <div class="icon-box"><i class="fa-solid fa-bacteria text-orange fs-3"></i></div>
                    <h5 class="fw-bold">Vaksin Tipes (Typhim)</h5>
                    <p class="text-muted small">Perlindungan dari demam tifoid akibat makanan tidak higienis.</p>
                    <span class="badge rounded-pill bg-light text-orange border">Lihat Detail</span>
                </div>
            </div>

        </div>
    </div>
</section>

<div class="modal fade" id="modalInfluenza" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><h4 class="fw-bold mb-0">Detail Vaksin</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="badge-vaksin">INFLUENZA</div>
                <p class="text-muted">Flu bukan sekadar batuk pilek biasa. Virus ini terus bermutasi dan bisa menyebabkan radang paru-paru (pneumonia) yang berat.</p>
                <h6 class="fw-bold">Kenapa Harus Vaksin?</h6>
                <ul class="text-muted small">
                    <li>Mencegah penularan ke keluarga di rumah.</li>
                    <li>Sangat disarankan untuk yang sering bekerja di ruangan AC atau bepergian jauh.</li>
                    <li>Diberikan 1 kali setiap tahun.</li>
                </ul>
                <a href="https://wa.me/628112519001" class="btn btn-warning w-100 fw-bold py-3 text-white mt-3" style="background:#ff8a3d; border-radius:15px;">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHepatitis" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><h4 class="fw-bold mb-0">Detail Vaksin</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="badge-vaksin">HEPATITIS B</div>
                <p class="text-muted">Hepatitis B menyerang organ hati secara diam-diam. Infeksi kronis dapat berujung pada pengerasan hati (Sirosis) hingga kanker hati.</p>
                <h6 class="fw-bold">Manfaat:</h6>
                <ul class="text-muted small">
                    <li>Perlindungan jangka panjang (bisa seumur hidup).</li>
                    <li>Penting bagi pasangan yang ingin menikah atau tenaga kesehatan.</li>
                </ul>
                <a href="https://wa.me/628112519001" class="btn btn-warning w-100 fw-bold py-3 text-white mt-3" style="background:#ff8a3d; border-radius:15px;">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPCV" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><h4 class="fw-bold mb-0">Detail Vaksin</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="badge-vaksin">PCV (PNEUMOKOKUS)</div>
                <p class="text-muted">Melindungi dari bakteri Pneumokokus, penyebab utama kematian akibat radang paru (pneumonia) pada anak-anak dan lansia.</p>
                <h6 class="fw-bold">Sasaran:</h6>
                <p class="text-muted small">Balita untuk imunisasi dasar, dan orang dewasa di atas 50 tahun untuk menjaga fungsi paru.</p>
                <a href="https://wa.me/628112519001" class="btn btn-warning w-100 fw-bold py-3 text-white mt-3" style="background:#ff8a3d; border-radius:15px;">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHPV" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><h4 class="fw-bold mb-0">Detail Vaksin</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="badge-vaksin">HPV (ANTI KANKER SERVIKS)</div>
                <p class="text-muted">Satu-satunya vaksin yang dapat mencegah kanker. Melindungi dari virus HPV penyebab kanker serviks dan kutil kelamin.</p>
                <h6 class="fw-bold">Penting:</h6>
                <p class="text-muted small">Sangat efektif diberikan sebelum aktif secara seksual. Untuk dewasa, diberikan dalam 3 dosis.</p>
                <a href="https://wa.me/628112519001" class="btn btn-warning w-100 fw-bold py-3 text-white mt-3" style="background:#ff8a3d; border-radius:15px;">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalMMR" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><h4 class="fw-bold mb-0">Detail Vaksin</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="badge-vaksin">MMR</div>
                <p class="text-muted">Mencegah Measles (Campak), Mumps (Gondongan), dan Rubella (Campak Jerman). Penyakit ini sangat menular melalui udara.</p>
                <h6 class="fw-bold">Komplikasi yang dicegah:</h6>
                <ul class="text-muted small">
                    <li>Radang otak (akibat Campak).</li>
                    <li>Kemandulan (akibat Gondongan pada pria dewasa).</li>
                    <li>Kecacatan janin (akibat Rubella pada ibu hamil).</li>
                </ul>
                <a href="https://wa.me/628112519001" class="btn btn-warning w-100 fw-bold py-3 text-white mt-3" style="background:#ff8a3d; border-radius:15px;">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTipes" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><h4 class="fw-bold mb-0">Detail Vaksin</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="badge-vaksin">TYPHIM (DEMAM TIFOID)</div>
                <p class="text-muted">Mencegah penyakit Tipes akibat bakteri Salmonella typhi yang masuk melalui makanan atau minuman yang terkontaminasi.</p>
                <h6 class="fw-bold">Rekomendasi:</h6>
                <p class="text-muted small">Sangat penting bagi penyuka "kulineran" atau jajan di luar rumah. Vaksin perlu diulang setiap 3 tahun.</p>
                <a href="https://wa.me/628112519001" class="btn btn-warning w-100 fw-bold py-3 text-white mt-3" style="background:#ff8a3d; border-radius:15px;">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>