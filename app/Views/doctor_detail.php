<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<section style="padding: 120px 0 80px; background: #f8f9fa;">
    <div class="container">
        <?php if (isset($doctor)): ?>
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div style="background: linear-gradient(135deg, #ff8a3d 0%, #ffb382 100%); border-radius: 30px; padding: 30px; position: relative; overflow: hidden; box-shadow: 0 15px 35px rgba(255, 138, 61, 0.2);">
                        <?php 
                            $img = (isset($doctor['img']) && $doctor['img'] != '') ? $doctor['img'] : 'DEFAULT.JPG'; 
                        ?>
                        <img src="<?= base_url('uploads/doctors/' . $img) ?>" alt="<?= $doctor['name'] ?>" 
                             style="width: 100%; border-radius: 20px; filter: drop-shadow(0 15px 25px rgba(0,0,0,0.2)); transition: transform 0.3s ease;">
                        
                        <div style="position: absolute; bottom: -20px; right: -20px; width: 150px; height: 150px; background: rgba(255,255,255,0.15); border-radius: 50%;"></div>
                    </div>
                </div>

                <div class="col-lg-7 ps-lg-5">
                    <div class="badge mb-3" style="padding: 10px 20px; border-radius: 50px; font-weight: 700; background: #fff5ee; color: #ff8a3d; border: 1px solid #ffdec9; text-transform: uppercase; letter-spacing: 0.5px;">
                        <?= $doctor['spec'] ?? 'Umum' ?>
                    </div>

                    <h1 style="font-weight: 800; color: #222; font-size: 2.8rem; line-height: 1.2; margin-bottom: 20px;">
                        <?= $doctor['name'] ?? 'Nama Dokter' ?>
                    </h1>

                   <p style="color: #666; font-size: 1.1rem; line-height: 1.8; margin-bottom: 35px;">
    <?= $doctor['desc'] ?? 'Melayani pasien dengan sepenuh hati di Klinik Brayan Sehat. Kami berkomitmen memberikan pelayanan medis terbaik.' ?>
</p>
                    <div style="background: white; border-radius: 25px; padding: 30px; border: 1px solid #eee; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                        <div class="d-flex align-items-center mb-4">
                            <div style="width: 50px; height: 50px; background: #fff5ee; border-radius: 15px; display: flex; align-items: center; justify-content: center; color: #ff8a3d; margin-right: 15px; font-size: 1.2rem;">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div>
                                <h5 style="margin: 0; font-weight: 700; color: #222;">Jadwal Praktek</h5>
                                <small class="text-muted">Waktu operasional klinik</small>
                            </div>
                        </div>
                        
                        <div style="background: #fdfdfd; padding: 20px; border-radius: 15px; border-left: 5px solid #ff8a3d; border-top: 1px solid #f1f1f1; border-right: 1px solid #f1f1f1; border-bottom: 1px solid #f1f1f1;">
                            <span style="font-weight: 700; color: #ff8a3d; font-size: 1.1rem;">
                                <?= isset($doctor['jadwal']) ? $doctor['jadwal'] : 'Hubungi Admin untuk Jadwal' ?>
                            </span>
                        </div>

                        <?php $whatsapp_name = isset($doctor['name']) ? urlencode($doctor['name']) : 'Dokter'; ?>
                        <a href="https://wa.me/628112519001?text=Halo%20Admin,%20saya%20mau%20buat%20janji%20dengan%20<?= $whatsapp_name ?>" 
                           target="_blank" 
                           class="btn w-100 mt-4" 
                           style="padding: 15px; border-radius: 15px; font-weight: 700; background: #ff8a3d; color: white; border: none; box-shadow: 0 8px 20px rgba(255, 138, 61, 0.3); transition: 0.3s;">
                            <i class="fab fa-whatsapp me-2" style="font-size: 1.2rem;"></i> RESERVASI SEKARANG
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-user-md fa-4x mb-4" style="color: #ddd;"></i>
                <h2 style="font-weight: 700; color: #444;">Data dokter tidak ditemukan.</h2>
                <p class="text-muted">Mungkin terjadi kesalahan link atau data telah diperbarui.</p>
                <a href="<?= base_url('doctors') ?>" class="btn mt-3" style="background: #ff8a3d; color: white; border-radius: 10px; padding: 10px 25px;">Kembali ke Daftar Dokter</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
    .btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        color: white;
    }
</style>

<?= $this->endSection(); ?>