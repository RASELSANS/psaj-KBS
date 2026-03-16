<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<style>
    .artikel-detail-header {
        padding: 120px 0 60px;
        background: linear-gradient(135deg, #fff5ee 0%, #ffe8d6 100%);
        position: relative;
        overflow: hidden;
    }
    .artikel-detail-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 138, 61, 0.1);
        border-radius: 50%;
    }
    .artikel-content {
        background: white;
        border-radius: 30px;
        padding: 40px;
        margin-top: -40px;
        position: relative;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    }
    .artikel-thumbnail {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 20px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .artikel-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f5f5f5;
        flex-wrap: wrap;
    }
    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
        font-size: 0.9rem;
    }
    .meta-item i {
        color: #ff8a3d;
    }
    .artikel-body {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #444;
    }
    .artikel-body p {
        margin-bottom: 1.5rem;
    }
    .artikel-body h2, .artikel-body h3 {
        color: #222;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .artikel-body img {
        max-width: 100%;
        height: auto;
        border-radius: 15px;
        margin: 20px 0;
    }
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #ff8a3d;
        text-decoration: none;
        font-weight: 600;
        padding: 10px 20px;
        border: 2px solid #ff8a3d;
        border-radius: 12px;
        transition: 0.3s;
    }
    .back-button:hover {
        background: #ff8a3d;
        color: white;
    }
    
    /* Sidebar Artikel Lain */
    .sidebar-artikel {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        position: sticky;
        top: 100px;
    }
    .sidebar-artikel h4 {
        color: #222;
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid #ff8a3d;
    }
    .artikel-sidebar-item {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
        text-decoration: none;
        color: inherit;
        transition: 0.3s;
    }
    .artikel-sidebar-item:hover {
        transform: translateX(5px);
        color: inherit;
    }
    .artikel-sidebar-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .sidebar-thumbnail {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        flex-shrink: 0;
    }
    .sidebar-content h6 {
        font-size: 0.9rem;
        font-weight: 600;
        line-height: 1.4;
        margin-bottom: 5px;
        color: #333;
    }
    .sidebar-date {
        font-size: 0.75rem;
        color: #999;
    }
    .sidebar-preview {
        font-size: 0.8rem;
        color: #666;
        line-height: 1.4;
        margin-bottom: 8px;
    }
    .sidebar-kategori {
        background: #fff5ee;
        color: #ff8a3d;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    
    @media (max-width: 768px) {
        .artikel-content {
            padding: 30px 20px;
        }
        .artikel-detail-header {
            padding: 100px 0 40px;
        }
        .sidebar-artikel {
            margin-top: 30px;
            position: static;
        }
    }
</style>

<section class="artikel-detail-header">
    <div class="container">
        <a href="<?= base_url('artikel') ?>" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali ke Artikel
        </a>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <?php if (isset($artikel)): ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="artikel-content">
                        <h1 class="fw-bold mb-4" style="color: #222; font-size: 2.2rem; line-height: 1.3;">
                            <?= esc($artikel['judul']) ?>
                        </h1>

                        <div class="artikel-meta">
                            <div class="meta-item">
                                <i class="far fa-calendar"></i>
                                <span><?= date('d F Y', strtotime($artikel['tanggal_publish'])) ?></span>
                            </div>
                            <div class="meta-item">
                                <i class="far fa-clock"></i>
                                <span><?= date('H:i', strtotime($artikel['created_at'])) ?> WIB</span>
                            </div>
                        </div>

                        <?php if (!empty($artikel['thumbnail'])): ?>
                            <img src="<?= base_url('uploads/articles/' . $artikel['thumbnail']) ?>" 
                                 alt="<?= esc($artikel['judul']) ?>" 
                                 class="artikel-thumbnail"
                                 onerror="this.src='<?= base_url('img/artikel1.png') ?>'">
                        <?php endif; ?>

                        <div class="artikel-body">
                            <?= $artikel['isi'] ?>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <a href="<?= base_url('artikel') ?>" class="btn btn-orange">
                                <i class="fas fa-arrow-left me-2"></i> Lihat Artikel Lainnya
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Artikel Lain (30%) -->
                <div class="col-lg-4">
                    <div class="sidebar-artikel">
                        <h4>Artikel Lainnya</h4>
                        
                        <?php if (!empty($otherArtikels)): ?>
                            <?php foreach ($otherArtikels as $other): ?>
                                <a href="<?= base_url('artikel/' . $other['id_artikel']) ?>" class="artikel-sidebar-item">
                                    <?php 
                                    $otherThumbnail = !empty($other['thumbnail']) 
                                        ? 'uploads/articles/' . $other['thumbnail']
                                        : 'img/artikel1.png';
                                    ?>
                                    <img src="<?= base_url($otherThumbnail) ?>" 
                                         alt="<?= esc($other['judul']) ?>" 
                                         class="sidebar-thumbnail"
                                         onerror="this.src='<?= base_url('img/artikel1.png') ?>'">
                                    <div class="sidebar-content">
                                        <h6><?= esc($other['judul']) ?></h6>
                                        <p class="sidebar-preview"><?= substr(strip_tags($other['isi']), 0, 60) ?>...</p>
                                        <div class="sidebar-date">
                                            <?php if (!empty($other['kategori'])): ?>
                                                <span class="sidebar-kategori"><?= esc($other['kategori']) ?></span> • 
                                            <?php endif; ?>
                                            <?= date('d M Y', strtotime($other['tanggal_publish'])) ?>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted text-center">Belum ada artikel lain.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-4x mb-4" style="color: #ddd;"></i>
                <h2 style="font-weight: 700; color: #444;">Artikel tidak ditemukan.</h2>
                <p class="text-muted">Mungkin artikel telah dihapus atau link tidak valid.</p>
                <a href="<?= base_url('artikel') ?>" class="btn btn-orange mt-3">
                    Kembali ke Daftar Artikel
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection(); ?>
