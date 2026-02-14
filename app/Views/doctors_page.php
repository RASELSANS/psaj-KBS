<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    .doctors-page { padding: 60px 0; background-color: #f8f9fa; }
    
    /* Sidebar Filter */
    .filter-sidebar { 
        background: white; 
        padding: 25px; 
        border-radius: 20px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        position: sticky;
        top: 100px;
        border: 1px solid #eee;
    }
    .filter-group-title { font-weight: 700; margin: 20px 0 10px; font-size: 1rem; color: #333; }

    /* Doctor Card Clean Version */
    .doctor-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #eee;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .doctor-card:hover { 
        transform: translateY(-5px); 
        box-shadow: 0 15px 30px rgba(0,0,0,0.1); 
        border-color: #ff8a3d; /* Highlight warna klinik saat hover */
    }

    /* Box Gambar - Rasio Tetap */
    .doc-img-box {
        background-color: #f1f1f1;
        position: relative;
        width: 100%;
        padding-top: 110%; 
        overflow: hidden;
    }

    .doc-img-box img { 
        position: absolute;
        top: 0;
        left: 0;
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
    }

    /* Area Info Dokter */
    .doc-info { 
        padding: 20px; 
        text-align: center; 
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Menjaga konten atas & tombol tetap rapi */
        min-height: 160px; 
    }

    .doc-name { 
        font-weight: 700; 
        font-size: 1rem; 
        color: #222; 
        margin-bottom: 8px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 2.8em;
    }

    .doc-spec { 
        color: #ff8a3d; 
        font-size: 0.75rem; 
        font-weight: 700; 
        text-transform: uppercase;
        background: #fff5ee;
        padding: 4px 12px;
        border-radius: 50px;
        display: inline-block;
        margin-bottom: 12px;
    }

    /* Tombol More Info - Selalu Muncul */
    .btn-more-info {
        background: #ff8a3d;
        color: white;
        padding: 10px 0;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.85rem;
        transition: 0.3s;
        display: block;
        width: 100%;
        border: 1px solid #ff8a3d;
    }

    .btn-more-info:hover { 
        background: white; 
        color: #ff8a3d; 
    }
</style>

<div class="doctors-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="filter-sidebar">
                    <h5 class="fw-bold mb-3 border-bottom pb-2">Cari Dokter</h5>
                    <div class="mb-3">
                        <input type="text" id="searchDoctor" class="form-control" placeholder="Nama dokter...">
                    </div>

                    <div class="filter-group">
                        <div class="filter-group-title">Pilih Spesialis</div>
                        <div class="form-check mb-2">
                            <input class="form-check-input spec-filter" type="checkbox" value="GIGI" id="checkGigi">
                            <label class="form-check-label small" for="checkGigi">Poli Gigi</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input spec-filter" type="checkbox" value="SARAF" id="checkSaraf">
                            <label class="form-check-label small" for="checkSaraf">Poli Saraf</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input spec-filter" type="checkbox" value="UMUM" id="checkumum">
                            <label class="form-check-label small" for="checkumum">Poli Umum</label>
                        </div>
                    </div>
                    
                    <button class="btn btn-outline-secondary btn-sm w-100 mt-3" onclick="resetFilter()">Reset Filter</button>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row row-cols-1 row-cols-md-3 g-4" id="doctorContainer">
                    
                    <div class="col d-flex doctor-item" data-specialist="UMUM">
                        <div class="doctor-card w-100">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter3.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div>
                                    <span class="doc-spec">Poli Umum</span>
                                    <div class="doc-name">drg. Theresa Irina Sukma</div>
                                </div>
                                <a href="<?= base_url('doctors/detail/anton') ?>" class="btn-more-info">LIHAT PROFIL</a>
                            </div>
                        </div>
                    </div>

                    <div class="col d-flex doctor-item" data-pspecialist="UMUM">
                        <div class="doctor-card w-100">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter2.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div>
                                    <span class="doc-spec">Poli Umum</span>
                                    <div class="doc-name">drg. Nur Farida Marbun</div>
                                </div>
                                <a href="<?= base_url('doctors/detail/adelia') ?>" class="btn-more-info">LIHAT PROFIL</a>
                            </div>
                        </div>
                    </div>

                    <div class="col d-flex doctor-item" data-specialist="GIGI">
                        <div class="doctor-card w-100">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter111.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div>
                                    <span class="doc-spec">Spesialis Gigi</span>
                                    <div class="doc-name">drg. Savira Aska Nourmalita</div>
                                </div>
                                <a href="<?= base_url('doctors/detail/savira') ?>" class="btn-more-info">LIHAT PROFIL</a>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex doctor-item" data-specialist="GIGI">
                        <div class="doctor-card w-100">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter4.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div>
                                    <span class="doc-spec">Spesialis Gigi</span>
                                    <div class="doc-name">drg. Savira Aska Nourmalita</div>
                                </div>
                                <a href="<?= base_url('doctors/detail/savira') ?>" class="btn-more-info">LIHAT PROFIL</a>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex doctor-item" data-specialist="GIGI">
                        <div class="doctor-card w-100">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter5.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div>
                                    <span class="doc-spec">Spesialis Gigi</span>
                                    <div class="doc-name">drg. Savira Aska Nourmalita</div>
                                </div>
                                <a href="<?= base_url('doctors/detail/savira') ?>" class="btn-more-info">LIHAT PROFIL</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col d-flex doctor-item" data-specialist="GIGI">
                        <div class="doctor-card w-100">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter6.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div>
                                    <span class="doc-spec">Spesialis Gigi</span>
                                    <div class="doc-name">drg. Savira Aska Nourmalita</div>
                                </div>
                                <a href="<?= base_url('doctors/detail/savira') ?>" class="btn-more-info">LIHAT PROFIL</a>
                            </div>
                        </div>
                    </div>
                      <div class="col d-flex doctor-item" data-specialist="GIGI">
                        <div class="doctor-card w-100">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter111.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div>
                                    <span class="doc-spec">Spesialis Gigi</span>
                                    <div class="doc-name">drg. Savira Aska Nourmalita</div>
                                </div>
                                <a href="<?= base_url('doctors/detail/savira') ?>" class="btn-more-info">LIHAT PROFIL</a>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex doctor-item" data-specialist="GIGI">
                        <div class="doctor-card w-100">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter4.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div>
                                    <span class="doc-spec">Spesialis Gigi</span>
                                    <div class="doc-name">drg. Savira Aska Nourmalita</div>
                                </div>
                                <a href="<?= base_url('doctors/detail/savira') ?>" class="btn-more-info">LIHAT PROFIL</a>
                            </div>
                        </div>
                    </div>
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
        const activeSpecs = Array.from(checkboxes)
            .filter(i => i.checked)
            .map(i => i.value);

        let countVisible = 0;

        doctorItems.forEach(item => {
            const name = item.querySelector('.doc-name').textContent.toLowerCase();
            const spec = item.getAttribute('data-specialist');
            
            const matchName = name.includes(searchTerm);
            const matchSpec = activeSpecs.length === 0 || activeSpecs.includes(spec);

            if (matchName && matchSpec) {
                item.classList.remove('d-none');
                item.classList.add('d-flex');
                countVisible++;
            } else {
                item.classList.remove('d-flex');
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

    searchInput.addEventListener('keyup', filterDoctors);
    checkboxes.forEach(cb => cb.addEventListener('change', filterDoctors));
</script>

<?= $this->endSection(); ?>