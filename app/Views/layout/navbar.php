<style>
    /* CSS Dropdown Hover & Clickable */
    @media (min-width: 992px) {
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0; 
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .nav-item.dropdown:hover > .nav-link {
            color: #ff8a3d !important;
        }
    }

    /* Styling Dropdown Menu */
    .dropdown-menu {
        transition: all 0.3s ease;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        border: none;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-radius: 12px;
        padding: 10px;
    }

    .dropdown-item {
        padding: 10px 15px;
        border-radius: 8px;
        font-weight: 500;
        color: #333;
        transition: 0.2s;
    }

    .dropdown-item:hover {
        background-color: #fffaf7;
        color: #ff8a3d;
        transform: translateX(5px);
    }

    /* Navbar Link Active State */
    .nav-link.active {
        color: #ff8a3d !important;
        font-weight: 600;
    }
    
    .btn-orange {
        background-color: #ff8a3d;
        color: white;
        border-radius: 50px;
        padding: 8px 25px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-orange:hover {
        background-color: #e66e1f;
        color: white;
        box-shadow: 0 4px 15px rgba(255, 138, 61, 0.4);
    }
</style>

<nav class="navbar navbar-expand-lg py-2 fixed-top bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>">
            <img src="<?= base_url('img/logo.png') ?>" alt="Logo" class="me-2" style="height: 45px;"> 
            <span class="fw-bold">Klinik Brayan Sehat</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link <?= (uri_string() == '') ? 'active' : '' ?>" href="<?= base_url() ?>">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= (url_is('layanan*')) ? 'active' : '' ?>" 
                       href="<?= base_url('layanan') ?>" 
                       id="layananDropdown">
                        Layanan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="layananDropdown">
                        <li><a class="dropdown-item" href="<?= base_url('layanan/penunjang-diagnostik') ?>">Penunjang Diagnostik</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('layanan/poliklinik') ?>">Poliklinik</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('layanan/khitan-center') ?>">Khitan Center</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('layanan/vaksin') ?>">Vaksinasi</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= (uri_string() == 'doctors') ? 'active' : '' ?>" href="<?= base_url('doctors') ?>">Dokter</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= (url_is('about') || url_is('artikel') || url_is('faq')) ? 'active' : '' ?>" 
                       href="#" 
                       id="infoDropdown">
                        Informasi Penting
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="infoDropdown">
                        <li><a class="dropdown-item" href="<?= base_url('about') ?>">Tentang Kami</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('artikel') ?>">Artikel</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('faq') ?>">FAQ</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= (uri_string() == 'kontak') ? 'active' : '' ?>" href="<?= base_url('kontak') ?>">Hubungi Kami</a>
                </li>
            </ul>
            <a href="https://wa.me/6285540441147" class="btn btn-orange">Reservasi</a>
        </div>
    </div>
</nav>

<script>
    // Agar Parent Menu bisa diklik langsung di Desktop
    document.querySelectorAll('.nav-item.dropdown').forEach(function(everydropdown) {
        everydropdown.addEventListener('click', function(e) {
            if (window.innerWidth >= 992) {
                let link = this.querySelector('.dropdown-toggle').getAttribute('href');
                if(link && link !== '#' && link !== '') {
                    window.location.href = link;
                }
            }
        });
    });
</script>