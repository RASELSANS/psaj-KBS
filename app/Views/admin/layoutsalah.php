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
        }

        /* Admin Navbar */
        .admin-navbar {
            background: white;
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .admin-navbar .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            color: #ff8a3d;
        }

        .admin-navbar .nav-link {
            color: #666 !important;
            font-weight: 500;
            margin: 0 10px;
            transition: 0.3s;
        }

        .admin-navbar .nav-link:hover,
        .admin-navbar .nav-link.active {
            color: #ff8a3d !important;
        }

        .admin-navbar .btn-logout {
            background-color: #ff8a3d;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            transition: 0.3s;
        }

        .admin-navbar .btn-logout:hover {
            background-color: #e66e1f;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 138, 61, 0.4);
        }

        /* Main Container */
        .admin-container {
            padding: 40px 0;
            min-height: calc(100vh - 80px);
        }

        /* Section Title */
        .section-title-admin {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: #333;
        }

        .subtitle-admin {
            color: #ff8a3d;
            font-weight: 600;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        /* Data Table Card */
        .data-card {
            background: white;
            border-radius: 20px;
            border: 1px solid #eee;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 30px;
            margin-bottom: 30px;
        }

        .data-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .data-card-title {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .btn-add {
            background-color: #ff8a3d;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 20px;
            font-weight: 600;
            transition: 0.3s;
            cursor: pointer;
        }

        .btn-add:hover {
            background-color: #e66e1f;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 138, 61, 0.4);
        }

        /* Table Styling */
        .table-wrapper {
            overflow-x: auto;
        }

        .table {
            margin: 0;
            font-size: 0.95rem;
        }

        .table thead {
            background-color: #f8f9fa;
            border-bottom: 2px solid #eee;
        }

        .table thead th {
            color: #333;
            font-weight: 700;
            border: none;
            padding: 15px;
        }

        .table tbody td {
            border: none;
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }

        .table tbody tr:hover {
            background-color: #fffaf7;
        }

        /* Action Buttons */
        .btn-action {
            padding: 6px 12px;
            font-size: 0.85rem;
            border-radius: 8px;
            margin-right: 5px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }

        .btn-edit:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
        }

        /* Modal Styling */
        .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        }

        .modal-header {
            background-color: #fffaf7;
            border: none;
            border-radius: 20px 20px 0 0;
            border-bottom: 1px solid #eee;
        }

        .modal-header .modal-title {
            font-weight: 700;
            color: #333;
        }

        .modal-header .btn-close {
            filter: brightness(0);
        }

        .modal-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .form-control,
        .form-select {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px 15px;
            font-family: 'Poppins', sans-serif;
            transition: 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #ff8a3d;
            box-shadow: 0 0 0 0.2rem rgba(255, 138, 61, 0.15);
        }

        .modal-footer {
            border: none;
            padding: 20px 30px;
        }

        .btn-modal-save {
            background-color: #ff8a3d;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 20px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-modal-save:hover {
            background-color: #e66e1f;
        }

        /* Alert Messages */
        .alert-custom {
            border: none;
            border-radius: 15px;
            padding: 15px 20px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Loading & Empty State */
        .loading {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f0f0f0;
            border-top: 4px solid #ff8a3d;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 15px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .section-title-admin {
                font-size: 1.5rem;
            }

            .data-card {
                padding: 20px;
            }

            .data-card-header {
                flex-direction: column;
            }

            .btn-add {
                width: 100%;
            }

            .table {
                font-size: 0.85rem;
            }

            .table thead th,
            .table tbody td {
                padding: 10px;
            }

            .btn-action {
                padding: 5px 8px;
                font-size: 0.75rem;
                display: block;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <!-- Admin Navbar -->
    <nav class="admin-navbar">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="<?= base_url() ?>">
                    <i class="fas fa-hospital"></i> Admin KBS
                </a>
                <div class="d-flex gap-3">
                    <a href="<?= base_url('admin/dokter') ?>" class="nav-link <?= strpos(uri_string(), 'admin/dokter') !== false ? 'active' : '' ?>">
                        <i class="fas fa-user-doctor"></i> Dokter
                    </a>
                    <a href="<?= base_url('admin/spesialis') ?>" class="nav-link <?= strpos(uri_string(), 'admin/spesialis') !== false ? 'active' : '' ?>">
                        <i class="fas fa-star"></i> Spesialis
                    </a>
                    <a href="<?= base_url('admin/poli') ?>" class="nav-link <?= strpos(uri_string(), 'admin/poli') !== false ? 'active' : '' ?>">
                        <i class="fas fa-clinic-medical"></i> Poli
                    </a>
                    <a href="<?= base_url('admin/jadwal') ?>" class="nav-link <?= strpos(uri_string(), 'admin/jadwal') !== false ? 'active' : '' ?>">
                        <i class="fas fa-calendar"></i> Jadwal
                    </a>
                    <a href="<?= base_url('admin/artikel') ?>" class="nav-link <?= strpos(uri_string(), 'admin/artikel') !== false ? 'active' : '' ?>">
                        <i class="fas fa-newspaper"></i> Artikel
                    </a>
                    <button class="btn-logout" onclick="logoutAdmin()">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="admin-container">
        <div class="container-fluid">
            <?= $this->renderSection('admin_content'); ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const API_URL = '<?= base_url('api/admin') ?>';

        // Logout Admin
        function logoutAdmin() {
            if (confirm('Anda yakin ingin logout?')) {
                fetch('<?= base_url('api/admin/logout') ?>', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                    },
                    credentials: 'include'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        window.location.href = '<?= base_url() ?>';
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        // Show Alert
        function showAlert(message, type) {
            const alert = document.createElement('div');
            alert.className = `alert alert-custom alert-${type} alert-dismissible fade show`;
            alert.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.querySelector('.container-fluid').insertBefore(alert, document.querySelector('.container-fluid').firstChild);
            
            setTimeout(() => alert.remove(), 5000);
        }

        // Delete with confirmation
        function confirmDelete(typeOrId, callbackOrType) {
            // Support two calling patterns:
            // 1. confirmDelete('dokter', callback) - where callbackOrType is a function
            // 2. confirmDelete(id, type) - where callbackOrType is a string (legacy)
            
            let message, callback;
            
            if (typeof callbackOrType === 'function') {
                // New pattern: confirmDelete(type, callback)
                message = `Anda yakin ingin menghapus ${typeOrId} ini?`;
                callback = callbackOrType;
            } else {
                // Legacy pattern: confirmDelete(id, type)
                message = `Anda yakin ingin menghapus ${callbackOrType} ini?`;
                callback = null;
            }
            
            if (confirm(message)) {
                if (callback && typeof callback === 'function') {
                    callback();
                }
                return true;
            }
            return false;
        }
    </script>

    <?= $this->renderSection('admin_scripts'); ?>
</body>
</html>
