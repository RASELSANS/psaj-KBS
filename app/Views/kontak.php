<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    :root {
        --primary-orange: #ff8a3d;
        --bg-soft-orange: #fff2e7;
        --dark-navy: #2c3e50;
    }

    .contact-header { 
        padding: 120px 0 60px; 
        background: var(--bg-soft-orange); 
        text-align: center; 
    }
    
    .contact-header h1 {
        font-weight: 800;
        color: var(--dark-navy);
    }

    .contact-card { 
        border: none; 
        border-radius: 25px; 
        box-shadow: 0 15px 35px rgba(0,0,0,0.05); 
        overflow: hidden; 
        background: #fff;
    }

    .info-icon { 
        width: 55px; height: 55px; 
        background: var(--bg-soft-orange); 
        color: var(--primary-orange); 
        border-radius: 15px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        margin-right: 20px; 
        font-size: 1.3rem; 
        flex-shrink: 0;
        transition: 0.3s;
    }

    .info-item { display: flex; align-items: flex-start; margin-bottom: 30px; }
    .info-item:hover .info-icon { background: var(--primary-orange); color: white; transform: translateY(-5px); }

    .form-control { 
        border-radius: 12px; 
        padding: 14px 18px; 
        border: 1px solid #eee; 
        background-color: #fcfcfc;
    }

    /* CUSTOM DROPDOWN ARROW */
    .form-select-custom {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ff8a3d' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1.25rem center;
        background-size: 16px 12px;
        cursor: pointer;
    }

    .form-control:focus { 
        border-color: var(--primary-orange); 
        box-shadow: 0 0 0 0.2rem rgba(255, 138, 61, 0.1); 
        outline: none;
    }

    .btn-orange { 
        background-color: var(--primary-orange); 
        color: white; 
        border-radius: 12px; 
        transition: 0.3s; 
        padding: 15px;
        border: none;
    }

    .btn-orange:hover { 
        background-color: #e66e1f; 
        color: white; 
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 138, 61, 0.3);
    }
</style>

<section class="contact-header">
    <div class="container">
        <h1 class="display-4 fw-bold">Hubungi Kami</h1>
        <div style="width: 60px; height: 5px; background: var(--primary-orange); margin: 15px auto; border-radius: 10px;"></div>
        <p class="text-muted fs-5">Kami siap melayani Anda dengan sepenuh hati.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <h3 class="fw-bold mb-4" style="color: var(--dark-navy);">Kirim Pesan</h3>
                
                <form id="waForm" class="mb-5">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" id="nama" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" id="email" class="form-control" placeholder="Email Anda" required>
                        </div>
                        <div class="col-12">
                            <select id="subjek" class="form-control form-select-custom" required>
                                <option value="" disabled selected>Pilih Keperluan / Subjek</option>
                                <option value="Tanya Layanan Medis">Tanya Layanan Medis (MCU, EKG, dll)</option>
                                <option value="Pendaftaran Pasien Baru">Pendaftaran Pasien Baru</option>
                                <option value="Konsultasi Dokter Kerja (Okupasi)">Konsultasi Dokter Kerja (Okupasi)</option>
                                <option value="Kerjasama Instansi/Perusahaan">Kerjasama Instansi/Perusahaan</option>
                                <option value="Kritik & Saran">Kritik & Saran</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <textarea id="pesan" class="form-control" rows="5" placeholder="Tuliskan pesan Anda..." required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="button" onclick="sendToWhatsapp()" class="btn btn-orange w-100 fw-bold fs-5">
                                <i class="fa-brands fa-whatsapp me-2"></i> Kirim ke WhatsApp
                            </button>
                        </div>
                    </div>
                </form>

                <hr class="my-5">

                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Alamat Klinik</h5>
                        <p class="text-muted mb-0">Jl. S. Parman No.74A, Karangbawang, Purwokerto Selatan, Kab. Banyumas, Jawa Tengah 53141.</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Telepon / WhatsApp</h5>
                        <p class="text-muted mb-0">+62 281 7772941 / +62 855-4044-1147</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-clock"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Jam Operasional</h5>
                        <p class="text-muted mb-0">
                            <strong>Senin - Jumat:</strong> 07:00 - 21:00 WIB<br>
                            <strong>Sabtu:</strong> 07:00 - 14:00 WIB<br>
                            <strong>Minggu:</strong> Tutup
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="contact-card h-100">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.2820232531703!2d109.24115517500138!3d-7.43401269257677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655e84791bcbab%3A0x5dbb0427a97ff630!2sKlinik%20Brayan%20Sehat%20(KBS)!5e0!3m2!1sid!2sid!4v1771343341433!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                     
                  
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function sendToWhatsapp() {
    const nama = document.getElementById('nama').value;
    const email = document.getElementById('email').value;
    const subjek = document.getElementById('subjek').value;
    const pesan = document.getElementById('pesan').value;

    if (!nama || !subjek || !pesan) {
        alert("Lengkapi datanya dulu yaa!");
        return;
    }

    const nomorWA = "6285540441147"; 
    const teksPesan = 
        "*KONTAK DARI WEBSITE*%0A" +
        "------------------------------------%0A" +
        "*Nama:* " + nama + "%0A" +
        "*Email:* " + email + "%0A" +
        "*Keperluan:* " + subjek + "%0A" +
        "------------------------------------%0A" +
        "*Isi Pesan:*%0A" + pesan;

    window.open(`https://api.whatsapp.com/send?phone=${nomorWA}&text=${teksPesan}`, '_blank');
}
</script>
<?= $this->endSection(); ?>