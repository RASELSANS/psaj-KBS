<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<style>
    .doctors-page { padding: 60px 0; background: #f8f9fa; }
    
    /* Sidebar Filter */
    .filter-sidebar { 
        background: white; padding: 25px; border-radius: 20px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); position: sticky; top: 100px;
        border: 1px solid #eee;
    }

    /* Doctor Card */
    .doctor-card {
        background: white; border-radius: 20px; overflow: hidden; border: 1px solid #eee;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); 
        height: 100%; display: flex; flex-direction: column;
    }
    .doctor-card:hover { 
        transform: translateY(-8px); 
        box-shadow: 0 15px 35px rgba(255, 138, 61, 0.15); 
        border-color: #ff8a3d; 
    }

    /* Box Gambar */
    .doc-img-box { background: #f1f1f1; position: relative; padding-top: 110%; overflow: hidden; }
    .doc-img-box img { 
        position: absolute; top: 0; width: 100%; height: 100%; 
        object-fit: cover; transition: transform 0.5s ease;
    }
    .doctor-card:hover .doc-img-box img { transform: scale(1.05); }

    /* Info Dokter */
    .doc-info { 
        padding: 20px 15px; 
        text-align: center; 
        flex-grow: 1; 
        display: flex; 
        flex-direction: column; 
        justify-content: space-between; 
        min-height: 190px; 
    }

    /* Nama Dokter */
    .doc-name { 
        font-weight: 700; 
        color: #222; 
        font-size: 0.95rem; 
        line-height: 1.4;
        padding: 0 8px;
        margin-bottom: 8px;
        height: 2.8em; 
        overflow: hidden; 
        display: -webkit-box; 
        -webkit-line-clamp: 2; 
        -webkit-box-orient: vertical; 
    }

    /* Badge Spesialis */
    .doc-spec { 
        color: #ff8a3d; font-size: 0.72rem; font-weight: 700; background: #fff5ee; 
        padding: 5px 14px; border-radius: 50px; display: inline-block; 
        margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;
    }

    /* Tombol Profil */
    .btn-more-info { 
        background: #ff8a3d; color: white; padding: 11px 0; border-radius: 12px; 
        font-weight: 600; text-align: center; transition: 0.3s; border: 2px solid #ff8a3d; 
        text-decoration: none; font-size: 0.85rem; width: 100%;
    }
    .btn-more-info:hover { background: white; color: #ff8a3d; }
</style>

<div class="doctors-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="filter-sidebar">
                    <h5 class="fw-bold mb-3 border-bottom pb-2">Cari Dokter</h5>
                    <div class="input-group mb-4">
                        <input type="text" id="searchDoctor" class="form-control border-end-0" placeholder="Nama dokter...">
                        <span class="input-group-text bg-white border-start-0 text-muted">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                    </div>
                    
                    <p class="fw-bold mb-3">Pilih Spesialis</p>
                    <div class="filter-options">
                        <?php 
                        $specs = [
                            'GIGI' => 'Poli Gigi', 
                            'SARAF' => 'Psikolog/Psikiater', 
                            'UMUM' => 'Poli Umum', 
                            'JANTUNG' => 'Poli Jantung', 
                            'THT' => 'Poli THT',
                            'ANAK' => 'Poli Anak',
                            'DALAM' => 'Penyakit Dalam',
                            'PATOLOGI' => 'Patologi Klinik',
                            'RADIOLOGI' => 'Radiologi'
                        ];
                        foreach($specs as $key => $val): ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input spec-filter" type="checkbox" value="<?= $key ?>" id="check<?= $key ?>">
                                <label class="form-check-label small text-secondary" for="check<?= $key ?>"><?= $val ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <button class="btn btn-light btn-sm w-100 mt-4 border" onclick="resetFilter()">
                        <i class="fa-solid fa-rotate-left me-1"></i> Reset Filter
                    </button>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4" id="doctorContainer">
                    <?php if(!empty($doctors)): ?>
                        <?php foreach($doctors as $d): ?>
                            <div class="col doctor-item" data-specialist="<?= $d['spec_key'] ?>">
                                <div class="doctor-card">
                                    <div class="doc-img-box">
                                        <img src="<?= base_url('img/'.$d['img']) ?>" alt="<?= $d['name'] ?>" onerror="this.src='<?= base_url('img/default-doctor.png') ?>'">
                                    </div>
                                    <div class="doc-info">
                                        <div>
                                            <span class="doc-spec"><?= $d['spec'] ?></span>
                                            <div class="doc-name" title="<?= $d['name'] ?>"><?= $d['name'] ?></div>
                                        </div>
                                        <a href="<?= base_url('doctors/detail/'.$d['slug']) ?>" class="btn-more-info">LIHAT PROFIL</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div id="noMatch" class="text-center py-5 d-none">
                    <div class="mb-3">
                        <i class="fa-solid fa-user-slash fa-4x text-light-emphasis"></i>
                    </div>
                    <h5 class="text-secondary">Maaf, dokter tidak ditemukan.</h5>
                    <p class="text-muted small">Coba cari dengan kata kunci lain atau reset filter.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchDoctor');
    const checkboxes = document.querySelectorAll('.spec-filter');
    const doctorItems = document.querySelectorAll('.doctor-item');
    const noMatchMsg = document.getElementById('noMatch');

    function filterDoctors() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const activeSpecs = Array.from(checkboxes).filter(i => i.checked).map(i => i.value);
        let countVisible = 0;

        doctorItems.forEach(item => {
            const name = item.querySelector('.doc-name').textContent.toLowerCase();
            const spec = item.getAttribute('data-specialist');
            
            const matchName = name.includes(searchTerm);
            const matchSpec = activeSpecs.length === 0 || activeSpecs.includes(spec);

            if (matchName && matchSpec) {
                item.classList.remove('d-none');
                countVisible++;
            } else {
                item.classList.add('d-none');
            }
        });

        noMatchMsg.classList.toggle('d-none', countVisible > 0);
    }

    function resetFilter() {
        searchInput.value = '';
        checkboxes.forEach(i => i.checked = false);
        filterDoctors();
    }

    searchInput.addEventListener('input', filterDoctors);
    checkboxes.forEach(cb => cb.addEventListener('change', filterDoctors));
</script>

<?= $this->endSection(); ?>