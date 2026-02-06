    <?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<style>
    .doctors-page { padding: 40px 0; background-color: #f8f9fa; }
    
    /* Filter Sidebar */
    .filter-sidebar { 
        background: white; 
        padding: 25px; 
        border-radius: 15px; 
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        position: sticky;
        top: 100px;
        z-index: 10;
    }
    .filter-group-title { font-weight: 700; margin: 20px 0 10px; font-size: 1rem; color: #333; }
    
    /* Doctor Card - Ditambahkan position relative untuk overlay */
    .doctor-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative; 
    }
    .doctor-card:hover { transform: translateY(-8px); box-shadow: 0 12px 20px rgba(0,0,0,0.1); }

    /* Overlay More Info (Muncul saat Hover) */
    .more-info-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 0; /* Sembunyi secara default */
        background: rgba(255, 138, 61, 0.95); /* Warna oranye klinik */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        transition: height 0.3s ease-in-out;
        z-index: 5;
    }

    /* Saat card di-hover, overlay muncul setinggi area info */
    .doctor-card:hover .more-info-overlay {
        height: 115px; 
    }

    .btn-more-info {
        border: 2px solid white;
        color: white;
        padding: 6px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.85rem;
        transition: 0.3s;
    }
    .btn-more-info:hover { background: white; color: #ff8a3d; }

    .doc-img-box {
        background-color: #ff8a3d; 
        height: 280px; 
        display: flex;
        align-items: flex-end;
        justify-content: center;
        overflow: hidden;
    }
    .doc-img-box img { width: 100%; height: 100%; object-fit: cover; }

    .doc-info { 
        padding: 20px 15px; 
        text-align: center; 
        height: 115px; 
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .doc-name { 
        font-weight: 700; 
        font-size: 1.05rem; 
        color: #222; 
        margin-bottom: 5px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.3;
    }

    .doc-spec { 
        color: #ff8a3d; 
        font-size: 0.85rem; 
        font-weight: 600; 
        text-transform: uppercase;
    }
</style>

<div class="doctors-page">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="mb-4">
                <div class="filter-sidebar">
                    <h5 class="font-bold mb-3 pb-2 border-b">Cari Dokter</h5>
                    <div class="mb-3">
                        <input type="text" id="searchDoctor" class="w-full px-3 py-2 border border-gray-300 rounded" placeholder="Ketik nama dokter...">
                    </div>

                    <div class="filter-group">
                        <div class="filter-group-title">Pilih Spesialis</div>
                        <div class="mb-2">
                            <input class="spec-filter" type="checkbox" value="GIGI" id="checkGigi">
                            <label class="ml-2 text-sm" for="checkGigi">Poli Gigi</label>
                        </div>
                        <div class="mb-2">
                            <input class="spec-filter" type="checkbox" value="SARAF" id="checkSaraf">
                            <label class="ml-2 text-sm" for="checkSaraf">Poli Saraf</label>
                        </div>
                        <div class="mb-2">
                            <input class="spec-filter" type="checkbox" value="UMUM" id="checkumum">
                            <label class="ml-2 text-sm" for="checkumum">Poli Umum</label>
                        </div>
                    </div>
                    
                    <button class="w-full px-4 py-2 mt-3 border border-gray-400 text-gray-700 rounded hover:bg-gray-100" onclick="resetFilter()">Reset Filter</button>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4" id="doctorContainer">
                    
                    <div class="doctor-item" data-specialist="UMUM">
                        <div class="doctor-card w-full">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter1.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div class="doc-name">dr. Anton Sunaryo,ST.,M.K.K., AIFO-K</div>
                                <div class="doc-spec">Poli Umum</div>
                            </div>
                            <div class="more-info-overlay">
                                <a href="<?= base_url('doctors/detail/savira') ?>" class="btn-more-info">MORE INFO</a>
                            </div>
                        </div>
                    </div>

                    <div class="doctor-item" data-specialist="UMUM">
                        <div class="doctor-card w-full">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter1.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div class="doc-name">dr. Adelia Budhie Puspita Sari</div>
                                <div class="doc-spec">Poli Umum</div>
                            </div>
                            <div class="more-info-overlay">
                                <a href="<?= base_url('doctors/detail/savira') ?>" class="btn-more-info">MORE INFO</a>
                            </div>
                        </div>
                    </div>

                    <div class="doctor-item" data-specialist="UMUM">
                        <div class="doctor-card w-full">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter1.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div class="doc-name">dr. Tri Setyaningrum</div>
                                <div class="doc-spec">Poli Umum</div>
                            </div>
                            <div class="more-info-overlay">
                                <a href="<?= base_url('doctors/detail/savira') ?>" class="btn-more-info">MORE INFO</a>
                            </div>
                        </div>
                    </div>
                    <div class="doctor-item" data-specialist="UMUM">
                        <div class="doctor-card w-full">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter1.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div class="doc-name">dr. Nurkholis Majid</div>
                                <div class="doc-spec">Poli Umum</div>
                            </div>
                            <div class="more-info-overlay">
                                <a href="<?= base_url('doctors/detail/savira') ?>" class="btn-more-info">MORE INFO</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="doctor-item" data-specialist="GIGI">
                        <div class="doctor-card w-full">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter1.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div class="doc-name">drg. Savira Aska Nourmalita</div>
                                <div class="doc-spec">Spesialis Gigi</div>
                            </div>
                            <div class="more-info-overlay">
                                <a href="<?= base_url('doctors/detail/savira') ?>" class="btn-more-info">MORE INFO</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="doctor-item" data-specialist="GIGI">
                        <div class="doctor-card w-full">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter1.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div class="doc-name">drg. Savira Aska Nourmalita</div>
                                <div class="doc-spec">Spesialis Gigi</div>
                            </div>
                            <div class="more-info-overlay">
                                <a href="<?= base_url('doctors/detail/savira') ?>" class="btn-more-info">MORE INFO</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="doctor-item" data-specialist="GIGI">
                        <div class="doctor-card w-full">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter1.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div class="doc-name">drg. Savira Aska Nourmalita</div>
                                <div class="doc-spec">Spesialis Gigi</div>
                            </div>
                            <div class="more-info-overlay">
                                <a href="<?= base_url('doctors/detail/savira') ?>" class="btn-more-info">MORE INFO</a>
                            </div>
                        </div>
                    </div>

                    <div class="doctor-item" data-specialist="BEDAH">
                        <div class="doctor-card w-full">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter2.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div class="doc-name">drg. Nur Farida Marbun</div>
                                <div class="doc-spec">Spesialis Bedah</div>
                            </div>
                            <div class="more-info-overlay">
                                <a href="<?= base_url('doctors/detail/farida') ?>" class="btn-more-info">MORE INFO</a>
                            </div>
                        </div>
                    </div>

                    <div class="doctor-item" data-specialist="SARAF">
                        <div class="doctor-card w-full">
                            <div class="doc-img-box">
                                <img src="<?= base_url('img/Dokter3.png') ?>" alt="Dokter">
                            </div>
                            <div class="doc-info">
                                <div class="doc-name">drg. Theresa Irina Sukma</div>
                                <div class="doc-spec">Spesialis Saraf</div>
                            </div>
                            <div class="more-info-overlay">
                                <a href="<?= base_url('doctors/detail/theresa') ?>" class="btn-more-info">MORE INFO</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="noMatch" class="text-center py-5 hidden">
                    <i class="fa-solid fa-user-slash fa-3x text-gray-400 mb-3"></i>
                    <p class="text-gray-400">Maaf, dokter tidak ditemukan.</p>
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
                item.classList.remove('hidden');
                item.classList.add('block');
                countVisible++;
            } else {
                item.classList.remove('block');
                item.classList.add('hidden');
            }
        });

        noMatchMsg.classList.toggle('hidden', countVisible > 0);
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