<style>
    /* --- ELITE ORANGE THEME SETUP --- */
    :root {
        --kbs-orange: #ff8a3d;
        --kbs-dark-orange: #e6762d;
    }

    /* --- GLOBAL NAVBAR STYLE --- */
    .navbar {
        background: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .navbar-brand span {
        color: var(--kbs-orange) !important;
        letter-spacing: -0.5px;
    }

    /* --- DESKTOP NAVIGATION (992px Ke Atas) --- */
    @media (min-width: 992px) {
        .nav-link {
            color: #444 !important;
            font-weight: 600;
            margin: 0 12px;
            position: relative;
            transition: 0.3s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0; height: 2px;
            bottom: -2px; left: 0;
            background-color: var(--kbs-orange);
            transition: 0.3s;
        }

        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        .nav-link:hover, .nav-link.active { color: var(--kbs-orange) !important; }

        .nav-item.dropdown:hover .dropdown-menu {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            border-radius: 18px;
            padding: 12px;
            display: block;
            opacity: 0;
            visibility: hidden;
            transform: translateY(15px);
            transition: all 0.3s ease;
        }
    }

    /* --- MOBILE SLIDE-IN (ASTRA STYLE - NO OVERLAP) --- */
    @media (max-width: 991px) {
        .navbar-collapse {
            position: fixed;
            top: 0;
            right: -100%; 
            width: 85%;
            height: 100vh;
            background: var(--kbs-orange) !important;
            padding: 25px;
            transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 9999;
            display: block !important;
            box-shadow: -10px 0 30px rgba(0,0,0,0.2);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .navbar-collapse.show {
            right: 0;
        }

        /* --- LAYER SUBMENU (FIXED: INI YANG BIKIN GAK TABRAKAN) --- */
        .mobile-submenu-wrapper {
            position: fixed; 
            top: 0;
            right: -100%; /* Sembunyi di kanan luar */
            width: 85%; /* Sama lebarnya ama menu utama */
            height: 100vh;
            background: var(--kbs-orange) !important; /* Warna Solid */
            padding: 25px;
            transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 10000; /* Di atas menu utama */
            visibility: hidden;
            overflow-y: auto;
        }

        .mobile-submenu-wrapper.active {
            right: 0; /* Slide masuk nutupin menu utama */
            visibility: visible;
        }

        /* Font Mobile Extra Bold */
        .nav-link, .dropdown-item {
            color: white !important;
            font-size: 1.2rem !important;
            font-weight: 900 !important;
            padding: 22px 0 !important;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-transform: uppercase;
        }

        .btn-back {
            background: white !important;
            color: var(--kbs-orange) !important;
            padding: 10px 22px;
            border-radius: 50px;
            margin-bottom: 30px;
            display: inline-flex;
            align-items: center;
            font-weight: 800;
            font-size: 0.85rem;
            cursor: pointer;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .navbar-nav { padding-top: 10px; }
    }

    /* Button Reservasi */
    .btn-reservasi {
        background-color: var(--kbs-orange);
        color: white !important;
        border-radius: 12px;
        padding: 10px 25px;
        font-weight: 700;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-reservasi:hover {
        background-color: var(--kbs-dark-orange);
        transform: translateY(-2px);
    }
</style>

<nav class="navbar navbar-expand-lg fixed-top shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center text-decoration-none" href="<?= base_url() ?>">
            <img src="<?= base_url('img/logo.png') ?>" alt="Logo" class="me-2" style="height: 40px;"> 
            <span class="fw-bold fs-4">Klinik Brayan Sehat</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" onclick="toggleMobileMenu()">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="d-lg-none d-flex justify-content-between align-items-center mb-4">
                <span class="fw-bold text-white fs-4">MENU UTAMA</span>
                <i class="fa-solid fa-xmark text-white fs-2" style="cursor:pointer" onclick="toggleMobileMenu()"></i>
            </div>

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link <?= (uri_string() == '') ? 'active' : '' ?>" href="<?= base_url() ?>">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link d-flex d-lg-none" href="javascript:void(0)" onclick="openSubmenu('sub-layanan')">
                        Layanan <i class="fa-solid fa-chevron-right fs-6 text-white-50"></i>
                    </a>
                    <a class="nav-link d-none d-lg-block dropdown-toggle <?= (url_is('layanan*')) ? 'active' : '' ?>" 
                       href="<?= base_url('layanan') ?>">Layanan</a>
                    
                    <div class="mobile-submenu-wrapper d-lg-none" id="sub-layanan">
                        <div class="btn-back" onclick="closeSubmenu('sub-layanan')">
                            <i class="fa-solid fa-arrow-left me-2"></i> KEMBALI
                        </div>
                        <h4 class="text-white fw-bold mb-4">LAYANAN KAMI</h4>
                        <a class="dropdown-item" href="<?= base_url('layanan/penunjang-diagnostik') ?>">Penunjang Diagnostik</a>
                        <a class="dropdown-item" href="<?= base_url('layanan/poliklinik') ?>">Poliklinik</a>
                        <a class="dropdown-item" href="<?= base_url('layanan/khitan-center') ?>">Khitan Center</a>
                        <a class="dropdown-item" href="<?= base_url('layanan/vaksin') ?>">Vaksinasi</a>
                    </div>
                    
                    <ul class="dropdown-menu d-none d-lg-block">
                        <li><a class="dropdown-item" href="<?= base_url('layanan/penunjang-diagnostik') ?>">Penunjang Diagnostik</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('layanan/poliklinik') ?>">Poliklinik</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('layanan/khitan-center') ?>">Khitan Center</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('layanan/vaksin') ?>">Vaksinasi</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= (url_is('doctors*')) ? 'active' : '' ?>" href="<?= base_url('doctors') ?>">Dokter</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link d-flex d-lg-none" href="javascript:void(0)" onclick="openSubmenu('sub-info')">
                        Informasi <i class="fa-solid fa-chevron-right fs-6 text-white-50"></i>
                    </a>
                    <a class="nav-link d-none d-lg-block dropdown-toggle <?= (url_is('about*') || url_is('artikel*') || url_is('faq*')) ? 'active' : '' ?>" 
                       href="#">Informasi</a>

                    <div class="mobile-submenu-wrapper d-lg-none" id="sub-info">
                        <div class="btn-back" onclick="closeSubmenu('sub-info')">
                            <i class="fa-solid fa-arrow-left me-2"></i> KEMBALI
                        </div>
                        <h4 class="text-white fw-bold mb-4">INFORMASI</h4>
                        <a class="dropdown-item" href="<?= base_url('about') ?>">Tentang Kami</a>
                        <a class="dropdown-item" href="<?= base_url('artikel') ?>">Artikel</a>
                        <a class="dropdown-item" href="<?= base_url('faq') ?>">FAQ</a>
                    </div>

                    <ul class="dropdown-menu d-none d-lg-block">
                        <li><a class="dropdown-item" href="<?= base_url('about') ?>">Tentang Kami</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('artikel') ?>">Artikel</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('faq') ?>">FAQ</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= (uri_string() == 'kontak') ? 'active' : '' ?>" href="<?= base_url('kontak') ?>">Hubungi Kami</a>
                </li>
            </ul>

            <div class="d-lg-block d-none ms-3">
                <a href="https://wa.me/628112519001" target="_blank" class="btn-reservasi">
                    <i class="fab fa-whatsapp me-2"></i>Reservasi
                </a>
            </div>

            <div class="d-lg-none mt-4">
                <a href="https://wa.me/628112519001" target="_blank" class="btn btn-light w-100 fw-bold py-3" style="color: var(--kbs-orange); border-radius: 15px;">
                    <i class="fab fa-whatsapp me-2"></i> WHATSAPP SEKARANG
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const nav = document.getElementById('navbarNav');
        nav.classList.toggle('show');
        // Kalo menu ditutup, reset submenu
        if (!nav.classList.contains('show')) {
            document.querySelectorAll('.mobile-submenu-wrapper').forEach(el => el.classList.remove('active'));
        }
    }

    function openSubmenu(id) {
        document.getElementById(id).classList.add('active');
    }

    function closeSubmenu(id) {
        document.getElementById(id).classList.remove('active');
    }

    // Handle klik parent link di desktop (Direct link)
    document.querySelectorAll('.nav-link.dropdown-toggle').forEach(function(el) {
        el.addEventListener('click', function(e) {
            if (window.innerWidth >= 992) {
                const url = this.getAttribute('href');
                if (url && url !== '#') window.location.href = url;
            }
        });
    });
</script>