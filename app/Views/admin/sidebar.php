<!-- Sidebar Navigation Component -->
<aside class="admin-sidebar" id="adminSidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <button class="sidebar-close d-lg-none" onclick="toggleSidebar()">
            <i class="fas fa-times"></i>
        </button>
        <a href="<?= base_url('admin') ?>" class="sidebar-brand">
            <i class="fas fa-hospital"></i>
            <span>KBS Admin</span>
        </a>
    </div>

    <!-- Sidebar Menu -->
    <nav class="sidebar-nav">
        <ul class="nav-list">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="<?= base_url('admin/dashboard') ?>" 
                   class="nav-link <?= strpos(uri_string(), 'admin/dashboard') !== false ? 'active' : '' ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Data Management Section -->
            <li class="nav-section-title">Manajemen Data</li>

            <li class="nav-item">
                <a href="<?= base_url('admin/dokter') ?>" 
                   class="nav-link <?= strpos(uri_string(), 'admin/dokter') !== false ? 'active' : '' ?>">
                    <i class="fas fa-user-doctor"></i>
                    <span>Dokter</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('admin/spesialis') ?>" 
                   class="nav-link <?= strpos(uri_string(), 'admin/spesialis') !== false ? 'active' : '' ?>">
                    <i class="fas fa-star"></i>
                    <span>Spesialis</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('admin/poli') ?>" 
                   class="nav-link <?= strpos(uri_string(), 'admin/poli') !== false ? 'active' : '' ?>">
                    <i class="fas fa-clinic-medical"></i>
                    <span>Poli</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('admin/jadwal') ?>" 
                   class="nav-link <?= strpos(uri_string(), 'admin/jadwal') !== false ? 'active' : '' ?>">
                    <i class="fas fa-calendar"></i>
                    <span>Jadwal</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('admin/artikel') ?>" 
                   class="nav-link <?= strpos(uri_string(), 'admin/artikel') !== false ? 'active' : '' ?>">
                    <i class="fas fa-newspaper"></i>
                    <span>Artikel</span>
                </a>
            </li>

            <!-- Media Section -->
            <li class="nav-section-title">Media</li>

            <li class="nav-item">
                <a href="<?= base_url('admin/gallery') ?>" 
                   class="nav-link <?= strpos(uri_string(), 'admin/gallery') !== false ? 'active' : '' ?>">
                    <i class="fas fa-images"></i>
                    <span>Galeri Gambar</span>
                </a>
            </li>

            <!-- Account Section -->
            <li class="nav-section-title">Akun</li>

            <li class="nav-item">
                <a href="<?= base_url('admin/profile') ?>" 
                   class="nav-link <?= strpos(uri_string(), 'admin/profile') !== false ? 'active' : '' ?>">
                    <i class="fas fa-user-circle"></i>
                    <span>Profil</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="javascript:void(0);" onclick="logoutAdmin()" class="nav-link nav-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <small>Klinik Brayan Sehat © 2026</small>
    </div>
</aside>

<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay d-lg-none" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<style>
    /* Sidebar Styles */
    .admin-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 250px;
        background: #1a1a1a;
        color: white;
        display: flex;
        flex-direction: column;
        z-index: 1050;
        border-right: 1px solid #ff8a3d;
        transition: transform 0.3s ease;
    }

    .sidebar-header {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(255, 138, 61, 0.2);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .sidebar-brand {
        color: #ff8a3d;
        font-weight: 700;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        transition: 0.3s;
    }

    .sidebar-brand:hover {
        color: #fff;
        transform: translateX(5px);
    }

    .sidebar-close {
        background: none;
        border: none;
        color: #ff8a3d;
        font-size: 1.5rem;
        cursor: pointer;
        display: none;
    }

    .sidebar-nav {
        flex: 1;
        overflow-y: auto;
        padding: 1.5rem 0;
        scrollbar-width: thin;
        scrollbar-color: #ff8a3d transparent;
    }

    .sidebar-nav::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-nav::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
        background: #ff8a3d;
        border-radius: 3px;
    }

    .nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .nav-section-title {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #999;
        padding: 1rem 1.5rem 0.5rem;
        letter-spacing: 1px;
    }

    .nav-item {
        margin: 0;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem 1.5rem;
        color: #bbb;
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    .nav-link:hover {
        color: #ff8a3d;
        padding-left: 1.8rem;
        background: rgba(255, 138, 61, 0.05);
    }

    .nav-link.active {
        color: #ff8a3d;
        border-left-color: #ff8a3d;
        background: rgba(255, 138, 61, 0.1);
        font-weight: 600;
    }

    .nav-link i {
        width: 20px;
        text-align: center;
    }

    .nav-logout {
        color: #e74c3c;
    }

    .nav-logout:hover {
        color: #fff;
        background: rgba(231, 76, 60, 0.1);
    }

    .sidebar-footer {
        padding: 1.5rem;
        border-top: 1px solid rgba(255, 138, 61, 0.1);
        text-align: center;
        color: #666;
        font-size: 0.8rem;
    }

    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1040;
    }

    /* Mobile Responsive */
    @media (max-width: 991px) {
        .admin-sidebar {
            width: 280px;
            transform: translateX(-100%);
        }

        .admin-sidebar.show {
            transform: translateX(0);
        }

        .sidebar-overlay.show {
            display: block;
        }

        .sidebar-close {
            display: block;
        }

        .sidebar-header {
            justify-content: space-between;
        }

        .sidebar-brand span {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .admin-sidebar {
            width: 100%;
        }

        .sidebar-brand span {
            display: inline;
        }
    }
</style>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    }

    // Close sidebar when clicking nav link on mobile
    if (window.innerWidth < 992) {
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (!this.getAttribute('onclick')) {
                    toggleSidebar();
                }
            });
        });
    }
</script>
