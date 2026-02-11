<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    .contact-header { padding: 100px 0 50px; background: #fff2e7; text-align: center; }
    .contact-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; }
    .info-item { display: flex; align-items: flex-start; margin-bottom: 25px; }
    .info-icon { 
        width: 50px; height: 50px; background: #fff2e7; color: #ff8a3d; 
        border-radius: 12px; display: flex; align-items: center; justify-content: center; 
        margin-right: 20px; font-size: 1.2rem; flex-shrink: 0;
    }
    .form-control { border-radius: 10px; padding: 12px 15px; border: 1px solid #eee; }
    .form-control:focus { border-color: #ff8a3d; box-shadow: none; }
    .btn-orange { background-color: #ff8a3d; color: white; border-radius: 10px; transition: 0.3s; }
    .btn-orange:hover { background-color: #e66e1f; color: white; }
</style>

<section class="contact-header">
    <div class="container">
        <h1 class="fw-bold">Hubungi Kami</h1>
        <p class="text-muted">Kami siap melayani Anda dengan sepenuh hati.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <h3 class="fw-bold mb-4">Kirim Pesan</h3>
                <form action="#" method="POST" class="mb-5">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" placeholder="Email Anda" required>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Subjek (Contoh: Tanya Layanan)" required>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" rows="5" placeholder="Pesan Anda..." required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-orange w-100 py-3 fw-bold">Kirim Pesan Sekarang</button>
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
                            Senin - Jumat: 07:00 - 21:00 WIB<br>
                            Sabtu: 07:00 - 14:00 WIB<br>
                            Minggu: Tutup
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="contact-card h-100 shadow-sm" style="min-height: 450px;">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.2820232531703!2d109.24115517500138!3d-7.43401269257677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655e84791bcbab%3A0x5dbb0427a97ff630!2sKlinik%20Brayan%20Sehat%20(KBS)!5e0!3m2!1sid!2sid!4v1770796834495!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>