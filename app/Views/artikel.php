<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    .artikel-header { padding: 100px 0 50px; background: #fff2e7; text-align: center; }
    .blog-card { 
        border: none; border-radius: 20px; transition: 0.3s; overflow: hidden; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: 100%;
        display: flex; flex-direction: column;
    }
    .blog-card:hover { 
        transform: translateY(-10px); 
        box-shadow: 0 15px 35px rgba(255, 138, 61, 0.2); 
    }
    .blog-card img {
        height: 200px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .blog-card:hover img {
        transform: scale(1.05);
    }
    .text-orange { color: #ff8a3d; }
    .btn-read-more { 
        color: #ff8a3d; 
        font-weight: 600; 
        text-decoration: none; 
        font-size: 0.9rem;
        transition: 0.3s;
    }
    .btn-read-more:hover {
        color: #e6762d;
        transform: translateX(5px);
    }
    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .card-body > a {
        margin-top: auto;
    }
</style>

<section class="artikel-header">
    <div class="container">
        <h1 class="fw-bold">Artikel Kesehatan</h1>
        <p class="text-muted">Edukasi dan tips kesehatan terbaru dari tim medis kami.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <?php if (!empty($artikels)): ?>
            <div class="row g-4">
                <?php foreach ($artikels as $artikel): ?>
                    <div class="col-md-4">
                        <div class="blog-card card">
                            <?php 
                            $thumbnail = !empty($artikel['thumbnail']) ? $artikel['thumbnail'] : 'artikel1.png';
                            // Jika ada thumbnail dari database, gunakan path uploads/articles
                            // Jika tidak ada, gunakan default dari img/
                            $thumbnailPath = !empty($artikel['thumbnail']) 
                                ? 'uploads/articles/' . $artikel['thumbnail']
                                : 'img/' . $thumbnail;
                            ?>
                            <img src="<?= base_url($thumbnailPath) ?>" 
                                class="card-img-top" 
                                alt="<?= esc($artikel['judul']) ?>"
                                onerror="this.src='<?= base_url('img/artikel1.png') ?>'">
                            <div class="card-body p-4">
                                <div class="mb-2">
                                    <?php if (!empty($artikel['kategori'])): ?>
                                        <span class="badge bg-light text-orange">
                                            <?= esc($artikel['kategori']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-orange">
                                            <i class="far fa-calendar me-1"></i>
                                            <?= date('d M Y', strtotime($artikel['tanggal_publish'])) ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <h5 class="fw-bold"><?= esc($artikel['judul']) ?></h5>
                                <p class="text-muted small">
                                    <?= substr(strip_tags($artikel['isi']), 0, 100) ?>...
                                </p>
                                <a href="<?= base_url('artikel/' . $artikel['id_artikel']) ?>" class="btn-read-more">
                                    Baca Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-4x mb-4" style="color: #ddd;"></i>
                <h4 class="text-secondary">Belum ada artikel tersedia</h4>
                <p class="text-muted">Artikel kesehatan akan segera hadir.</p>
            </div>
        <?php endif; ?>
    </div>
</section>
<?= $this->endSection(); ?>