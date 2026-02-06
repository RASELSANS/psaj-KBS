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

<nav class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50 py-2">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
        <a class="flex items-center gap-2" href="<?= base_url() ?>">
            <img src="<?= base_url('img/logo.png') ?>" alt="Logo" style="height: 50px;"> 
            <span class="font-bold text-lg hidden sm:inline">Klinik brayan sehat</span>
        </a>
        
        <div class="hidden lg:flex items-center gap-10">
            <ul class="flex gap-4">
                <li>
                    <a class="nav-link <?= (uri_string() == '') ? 'border-b-2 border-gray-400' : '' ?>" href="<?= base_url() ?>">Home</a>
                </li>

                <li class="relative group">
                    <button class="nav-link <?= (uri_string() == 'layanan') ? 'border-b-2 border-gray-400' : '' ?> flex items-center gap-1">
                        Layanan
                    </button>
                    <ul class="dropdown-menu absolute left-0 mt-0 hidden group-hover:block">
                        <li class="px-4 py-2 hover:bg-orange-50 hover:text-orange-500"><a href="<?= base_url('layanan/penunjang-diagnostik') ?>">Penunjang Diagnostik</a></li>
                        <li class="px-4 py-2 hover:bg-orange-50 hover:text-orange-500"><a href="<?= base_url('layanan/poliklinik') ?>">Poliklinik</a></li>
                        <li class="px-4 py-2 hover:bg-orange-50 hover:text-orange-500"><a href="<?= base_url('layanan/khitan-center') ?>">Khitan Center</a></li>
                    </ul>
                </li>

                <li>
                    <a class="nav-link <?= (uri_string() == 'doctors') ? 'border-b-2 border-gray-400' : '' ?>" href="<?= base_url('doctors') ?>">Dokter</a>
                </li>

                <li>
                    <a class="nav-link" href="<?= base_url('kontak') ?>">Hubungi Kami</a>
                </li>
            </ul>
            <a href="https://wa.me/6285540441147" class="btn btn-orange">Reservasi</a>
        </div>
        
        <button class="lg:hidden p-2" type="button" onclick="toggleMobileNav()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>
    
    <div id="mobileNav" class="hidden lg:hidden bg-white border-t">
        <ul class="flex flex-col">
            <li class="px-4 py-2 hover:bg-gray-100"><a href="<?= base_url() ?>">Home</a></li>
            <li class="px-4 py-2 hover:bg-gray-100"><a href="<?= base_url('layanan') ?>">Layanan</a></li>
            <li class="px-4 py-2 hover:bg-gray-100"><a href="<?= base_url('doctors') ?>">Dokter</a></li>
            <li class="px-4 py-2 hover:bg-gray-100"><a href="<?= base_url('kontak') ?>">Hubungi Kami</a></li>
            <li class="px-4 py-2"><a href="https://wa.me/6285540441147" class="btn btn-orange inline-block">Reservasi</a></li>
        </ul>
    </div>
</nav>

<script>
function toggleMobileNav() {
    const nav = document.getElementById('mobileNav');
    nav.classList.toggle('hidden');
}
</script>