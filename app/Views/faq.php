<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    .faq-header { padding: 100px 0 50px; background: #fff2e7; text-align: center; }
    .accordion-item { border: none; margin-bottom: 15px; border-radius: 15px !important; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    .accordion-button:not(.collapsed) { background-color: #fff2e7; color: #ff8a3d; box-shadow: none; }
    .accordion-button:focus { box-shadow: none; border-color: rgba(0,0,0,.125); }
    .accordion-button::after { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ff8a3d'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e"); }
</style>

<section class="faq-header">
    <div class="container">
        <h1 class="fw-bold">Pertanyaan Umum (FAQ)</h1>
        <p class="text-muted">Punya pertanyaan? Mungkin jawabannya ada di sini.</p>
    </div>
</section>

<section class="py-5">
    <div class="container" style="max-width: 800px;">
        <div class="accordion" id="accordionFAQ">
            
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        Apakah Klinik Brayan Sehat melayani BPJS?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#accordionFAQ">
                    <div class="accordion-body">
                        Untuk saat ini kami melayani pasien umum dan asuransi swasta tertentu. Kami sedang dalam proses pengembangan untuk kerja sama dengan BPJS Kesehatan di masa mendatang.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        Jam berapa operasional klinik?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                    <div class="accordion-body">
                        Klinik kami buka setiap hari Senin - Sabtu pukul 08.00 - 21.00 WIB. Untuk layanan Farmasi tersedia 24 Jam.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        Bagaimana cara membuat janji temu (Reservasi)?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                    <div class="accordion-body">
                        Anda bisa langsung menekan tombol <strong>Reservasi</strong> di pojok kanan atas website ini untuk terhubung langsung dengan admin WhatsApp kami.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                        Apakah tersedia layanan Khitan di sini?
                    </button>
                </h2>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                    <div class="accordion-body">
                        Ya, kami memiliki <strong>Khitan Center</strong> dengan metode modern (tanpa suntik, tanpa jahit, tanpa perban) yang dilakukan oleh tenaga medis berpengalaman.
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?= $this->endSection(); ?>