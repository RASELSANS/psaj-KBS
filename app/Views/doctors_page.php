<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<style>
    .doctors-page { padding: 60px 0; background: #f8f9fa; }
    .filter-sidebar { 
        background: white; padding: 25px; border-radius: 20px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); position: sticky; top: 100px;
    }
    .doctor-card {
        background: white; border-radius: 20px; overflow: hidden; border: 1px solid #eee;
        transition: 0.3s; height: 100%; display: flex; flex-direction: column;
    }
    .doctor-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); border-color: #ff8a3d; }
    .doc-img-box { background: #f1f1f1; position: relative; padding-top: 110%; overflow: hidden; }
    .doc-img-box img { position: absolute; top: 0; width: 100%; height: 100%; object-fit: cover; }
    .doc-info { padding: 20px; text-align: center; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
    .doc-name { font-weight: 700; color: #222; height: 2.8em; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
    .doc-spec { color: #ff8a3d; font-size: 0.75rem; font-weight: 700; background: #fff5ee; padding: 4px 12px; border-radius: 50px; display: inline-block; margin-bottom: 12px; }
    .btn-more-info { background: #ff8a3d; color: white; padding: 10px 0; border-radius: 12px; font-weight: 600; text-align: center; transition: 0.3s; border: 1px solid #ff8a3d; text-decoration: none; }
    .btn-more-info:hover { background: white; color: #ff8a3d; }
</style>

<div class="doctors-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="filter-sidebar">
                    <h5 class="fw-bold mb-3 border-bottom pb-2">Cari Dokter</h5>
                    <input type="text" id="searchDoctor" class="form-control mb-3" placeholder="Nama dokter...">
                    
                    <p class="fw-bold mb-2">Pilih Spesialis</p>
                    <?php 
                    $specs = ['GIGI' => 'Poli Gigi', 'SARAF' => 'Poli Saraf', 'UMUM' => 'Poli Umum', 'JANTUNG' => 'Poli Jantung', 'THT' => 'Poli THT'];
                    foreach($specs as $key => $val): ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input spec-filter" type="checkbox" value="<?= $key ?>" id="check<?= $key ?>">
                            <label class="form-check-label small" for="check<?= $key ?>"><?= $val ?></label>
                        </div>
                    <?php endforeach; ?>
                    
                    <button class="btn btn-outline-secondary btn-sm w-100 mt-3" onclick="resetFilter()">Reset Filter</button>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row row-cols-1 row-cols-md-3 g-4" id="doctorContainer">
                    <?php foreach($doctors as $d): ?>
                        <div class="col d-flex doctor-item" data-specialist="<?= $d['spec_key'] ?>">
                            <div class="doctor-card w-100">
                                <div class="doc-img-box">
                                    <img src="<?= base_url('img/'.$d['img']) ?>" alt="<?= $d['name'] ?>">
                                </div>
                                <div class="doc-info">
                                    <div>
                                        <span class="doc-spec"><?= $d['spec'] ?></span>
                                        <div class="doc-name"><?= $d['name'] ?></div>
                                    </div>
                                    <a href="<?= base_url('doctors/detail/'.$d['slug']) ?>" class="btn-more-info">LIHAT PROFIL</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div id="noMatch" class="text-center py-5 d-none">
                    <i class="fa-solid fa-user-slash fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Maaf, dokter tidak ditemukan.</p>
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
        const searchTerm = searchInput.value.toLowerCase();
        const activeSpecs = Array.from(checkboxes).filter(i => i.checked).map(i => i.value);
        let countVisible = 0;

        doctorItems.forEach(item => {
            const name = item.querySelector('.doc-name').textContent.toLowerCase();
            const spec = item.getAttribute('data-specialist');
            const matchName = name.includes(searchTerm);
            const matchSpec = activeSpecs.length === 0 || activeSpecs.includes(spec);

            if (matchName && matchSpec) {
                item.classList.replace('d-none', 'd-flex');
                countVisible++;
            } else {
                item.classList.replace('d-flex', 'd-none');
            }
        });
        noMatchMsg.classList.toggle('d-none', countVisible > 0);
    }

    function resetFilter() {
        searchInput.value = '';
        checkboxes.forEach(i => i.checked = false);
        filterDoctors();
    }

    searchInput.addEventListener('keyup', filterDoctors);
    checkboxes.forEach(cb => cb.addEventListener('change', filterDoctors));
</script>

<?= $this->endSection(); ?>