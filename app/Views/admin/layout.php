<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin - Klinik Brayan Sehat'; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            overflow-x: hidden;
        }

        /* Main Layout */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }

        /* Topbar */
        .admin-topbar {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #ff8a3d;
            cursor: pointer;
            display: none;
            transition: 0.3s;
        }

        .sidebar-toggle:hover {
            color: #1a1a1a;
        }

        .topbar-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            background: #f8f9fa;
            cursor: pointer;
            transition: 0.3s;
        }

        .topbar-user:hover {
            background: #ff8a3d;
            color: white;
        }

        .topbar-user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #ff8a3d;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Main Content */
        .admin-main {
            flex: 1;
            padding: 2rem 1.5rem;
            overflow-y: auto;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .page-subtitle {
            color: #999;
            font-size: 0.95rem;
        }

        /* Alert Container */
        .alert-container {
            margin-bottom: 2rem;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .alert {
            border-radius: 12px;
            border: none;
            animation: slideDown 0.3s ease;
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.1);
            color: #2e7d32;
            border-left: 4px solid #4CAF50;
        }

        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            color: #c62828;
            border-left: 4px solid #e74c3c;
        }

        .alert-warning {
            background: rgba(255, 152, 0, 0.1);
            color: #e65100;
            border-left: 4px solid #ff9800;
        }

        .alert-info {
            background: rgba(33, 150, 243, 0.1);
            color: #1565c0;
            border-left: 4px solid #2196F3;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Data Card */
        .data-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid #e9ecef;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .data-card:hover {
            box-shadow: 0 8px 24px rgba(255, 138, 61, 0.1);
            border-color: #ff8a3d;
        }

        .data-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .data-card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0;
        }

        /* Buttons */
        .btn-add {
            background: #ff8a3d;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-add:hover {
            background: #e66e1f;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(255, 138, 61, 0.3);
            color: white;
        }

        .btn-action {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .btn-edit {
            background: #4CAF50;
            color: white;
        }

        .btn-edit:hover {
            background: #45a049;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .btn-modal-save {
            background: #ff8a3d;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-modal-save:hover {
            background: #e66e1f;
            transform: translateY(-2px);
        }

        /* Custom Modal Confirmation */
        .confirm-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease;
        }

        .confirm-modal-overlay.show {
            display: flex;
        }

        .confirm-modal-content {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            padding: 2rem;
            max-width: 400px;
            width: 90%;
            animation: slideUp 0.3s ease;
        }

        .confirm-modal-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 28px;
        }

        .confirm-modal-icon.warning {
            background: #fff3cd;
            color: #856404;
        }

        .confirm-modal-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 1rem 0 0.5rem;
            text-align: center;
        }

        .confirm-modal-message {
            color: #666;
            text-align: center;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .confirm-modal-buttons {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .confirm-modal-buttons button {
            padding: 10px 24px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-confirm-cancel {
            background: #e9ecef;
            color: #666;
        }

        .btn-confirm-cancel:hover {
            background: #dee2e6;
        }

        .btn-confirm-yes {
            background: #e74c3c;
            color: white;
        }

        .btn-confirm-yes:hover {
            background: #c0392b;
        }

        .btn-logout-yes {
            background: #ff8a3d;
            color: white;
        }

        .btn-logout-yes:hover {
            background: #e66e1f;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Table Styles */
        .table-wrapper {
            overflow-x: auto;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f8f9fa;
            color: #1a1a1a;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
            padding: 1rem;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
            transform: scale(1.01);
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            border-bottom: 1px solid #e9ecef;
            padding: 1.5rem;
        }

        .modal-title {
            font-weight: 600;
            color: #1a1a1a;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1.5rem;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-control,
        .form-select {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #ff8a3d;
            box-shadow: 0 0 0 0.2rem rgba(255, 138, 61, 0.25);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #999;
        }

        .empty-state i {
            font-size: 60px;
            color: #ddd;
            margin-bottom: 1rem;
            display: block;
        }

        .empty-state p {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        /* Loading Spinner */
        .loading-state {
            text-align: center;
            padding: 2rem;
        }

        .spinner-border {
            color: #ff8a3d;
        }

        /* Filter Bar */
        .filter-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .search-input {
            flex: 1;
            min-width: 200px;
        }

        .filter-select {
            min-width: 150px;
        }

        /* Pagination */
        .pagination {
            margin-top: 2rem;
        }

        .page-link {
            color: #ff8a3d;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background: #ff8a3d;
            color: white;
            border-color: #ff8a3d;
            transform: translateY(-2px);
        }

        .page-item.active .page-link {
            background: #ff8a3d;
            border-color: #ff8a3d;
        }

        .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Mobile Responsive */
        @media (max-width: 991px) {
            .admin-content-wrapper {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }

            .topbar-title {
                margin-left: 1rem;
            }

            .admin-main {
                padding: 1rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .data-card {
                padding: 1.5rem;
            }

            .data-card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .btn-add {
                width: 100%;
                justify-content: center;
            }

            .filter-bar {
                flex-direction: column;
            }

            .search-input,
            .filter-select {
                width: 100%;
                min-width: auto;
            }

            .table-wrapper {
                font-size: 0.875rem;
            }

            .table thead th,
            .table tbody td {
                padding: 0.75rem 0.5rem;
            }
        }
    </style>

    <?= $this->renderSection('page_styles'); ?>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <?= $this->include('admin/sidebar'); ?>

        <!-- Main Content -->
        <div class="admin-content-wrapper">
            <!-- Topbar -->
            <div class="admin-topbar">
                <div class="topbar-left">
                    <button class="sidebar-toggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="topbar-title"><?= $pageTitle ?? 'Dashboard'; ?></h1>
                </div>

                <div class="topbar-right">
                    <div class="topbar-user">
                        <div class="topbar-user-avatar">A</div>
                        <span id="adminName">Admin</span>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <main class="admin-main">
                <!-- Alert Container -->
                <div class="alert-container" id="alertContainer"></div>

                <!-- Page Content -->
                <?= $this->renderSection('admin_content'); ?>
            </main>
        </div>
    </div>

    <!-- Confirm Modal -->
    <div id="confirmModalOverlay" class="confirm-modal-overlay">
        <div class="confirm-modal-content">
            <div class="confirm-modal-icon warning">
                <i class="fas fa-exclamation"></i>
            </div>
            <h2 class="confirm-modal-title" id="confirmTitle">Konfirmasi</h2>
            <p class="confirm-modal-message" id="confirmMessage">Anda yakin dengan aksi ini?</p>
            <div class="confirm-modal-buttons">
                <button type="button" class="btn-confirm-cancel" onclick="closeConfirmModal()">
                    Batal
                </button>
                <button type="button" class="btn-confirm-yes" id="confirmYesBtn" onclick="executeConfirmAction()">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const API_URL = '<?= base_url('api/admin') ?>';

        // Toggle Sidebar (Mobile)
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar) {
                sidebar.classList.toggle('show');
                overlay?.classList.toggle('show');
            }
        }

        // Show Alert
        function showAlert(message, type = 'info') {
            const alertHTML = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    <strong>${type === 'success' ? '✓' : type === 'danger' ? '✕' : 'ℹ'}</strong>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            
            const container = document.getElementById('alertContainer');
            if (container) {
                container.innerHTML = alertHTML;
                
                // Auto-dismiss after 5 seconds
                setTimeout(() => {
                    const alert = container.querySelector('.alert');
                    if (alert) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, 5000);
            }
        }

        // Confirm Modal Management
        let confirmModalAction = null;

        function showConfirmModal(title, message, yesButtonText = 'Ya, Hapus', onConfirm = null) {
            document.getElementById('confirmTitle').textContent = title;
            document.getElementById('confirmMessage').textContent = message;
            document.getElementById('confirmYesBtn').textContent = yesButtonText;
            confirmModalAction = onConfirm;
            document.getElementById('confirmModalOverlay').classList.add('show');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModalOverlay').classList.remove('show');
            confirmModalAction = null;
        }

        function executeConfirmAction() {
            if (confirmModalAction) {
                confirmModalAction();
            }
            closeConfirmModal();
        }

        // Confirm Delete - Pass callback function
        function confirmDelete(entityName, onConfirm) {
            showConfirmModal(
                'Hapus ' + entityName,
                `Yakin ingin menghapus ${entityName} ini? Aksi ini tidak bisa dibatalkan.`,
                'Ya, Hapus',
                onConfirm
            );
        }

        // Logout
        async function logoutAdmin() {
            const overlay = document.getElementById('confirmModalOverlay');
            showConfirmModal(
                'Logout',
                'Yakin ingin logout dari sistem admin?',
                'Ya, Logout',
                async () => {
                    try {
                        const response = await fetch(`${API_URL}/logout`, {
                            method: 'POST'
                        });
                        const data = await response.json();
                        
                        if (data.status) {
                            window.location.href = '/';
                        } else {
                            showAlert('Gagal logout', 'danger');
                        }
                    } catch (error) {
                        console.error('Logout error:', error);
                        showAlert('Gagal logout', 'danger');
                    }
                }
            );
            
            // Style the button for logout action
            const yesBtn = document.getElementById('confirmYesBtn');
            yesBtn.className = 'btn-logout-yes';
        }

        // Close modal when clicking overlay
        document.addEventListener('DOMContentLoaded', function() {
            const overlay = document.getElementById('confirmModalOverlay');
            if (overlay) {
                overlay.addEventListener('click', function(e) {
                    if (e.target === overlay) {
                        closeConfirmModal();
                    }
                });
            }
        });

        // Load admin name on page load
        document.addEventListener('DOMContentLoaded', async function() {
            try {
                const response = await fetch(`${API_URL}/profile`, {credentials: 'include'});
                const data = await response.json();
                
                if (data.status) {
                    document.getElementById('adminName').textContent = data.data.username;
                    document.querySelector('.topbar-user-avatar').textContent = 
                        data.data.username.charAt(0).toUpperCase();
                }
            } catch (error) {
                console.error('Error loading profile:', error);
            }
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('adminSidebar');
            const toggle = document.querySelector('.sidebar-toggle');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (window.innerWidth < 992 && sidebar?.classList.contains('show')) {
                if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                    sidebar.classList.remove('show');
                    overlay?.classList.remove('show');
                }
            }
        });
    </script>

    <?= $this->renderSection('admin_scripts'); ?>
</body>
</html>
