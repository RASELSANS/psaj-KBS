<style>
    /* CSS khusus untuk Dropdown Hover */
    @media (min-width: 992px) {
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0; 
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    }

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
    }

    .dropdown-item:hover {
        background-color: #fffaf7;
        color: #ff8a3d;
        transform: translateX(5px);
    }
</style>

<nav class="navbar navbar-expand-lg py-2 fixed-top bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>">
            <img src="<?= base_url('img/logo.png') ?>" alt="Logo" class="me-1" style="height: 50px;"> 
            <span class="fw-bold">Klinik brayan sehat</span>
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
                    <a class="nav-link dropdown-toggle <?= (uri_string() == 'layanan') ? 'active' : '' ?>" href="#" id="distDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Layanan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="distDropdown">
                        <li><a class="dropdown-item" href="<?= base_url('layanan/penunjang-diagnostik') ?>">Penunjang Diagnostik</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('layanan/poliklinik') ?>">Poliklinik</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('layanan/khitan-center') ?>">Khitan Center</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= (uri_string() == 'doctors') ? 'active' : '' ?>" href="<?= base_url('doctors') ?>">Dokter</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('kontak') ?>">Hubungi Kami</a>
                </li>
            </ul>
            <a href="https://wa.me/6285540441147" class="btn btn-orange">Reservasi</a>
        </div>
    </div>
</nav>