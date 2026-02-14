<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> | KBS Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --sidebar-dark: #1a1c23; --orange-kbs: #ff8a3d; --bg-body: #f0f2f5; }
        body { background-color: var(--bg-body); font-family: 'Inter', sans-serif; }
        .sidebar { width: 260px; height: 100vh; background: var(--sidebar-dark); position: fixed; color: white; border-radius: 0 25px 25px 0; z-index: 1000; }
        .sidebar-brand { padding: 30px 20px; font-weight: bold; font-size: 1.25rem; color: white; text-decoration: none; display: block; }
        .nav-link { color: #9ca3af; margin: 5px 15px; border-radius: 12px; padding: 12px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background: rgba(255,138,61,0.15); color: var(--orange-kbs); }
        .main-content { margin-left: 260px; padding: 30px; }
        .admin-card { background: white; border-radius: 20px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.03); padding: 20px; margin-bottom: 20px; }
        .btn-orange { background: var(--orange-kbs); color: white; border: none; }
        .btn-orange:hover { background: #e67a2e; color: white; }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="#" class="sidebar-brand">Admin <span style="color:var(--orange-kbs)">KBS</span></a>
    <nav class="nav flex-column">
        <a class="nav-link <?= ($page == 'dashboard') ? 'active' : '' ?>" href="<?= base_url('admin') ?>">
            <i class="fa fa-gauge-high me-2"></i> Dashboard
        </a>
        <a class="nav-link <?= ($page == 'doctors') ? 'active' : '' ?>" href="<?= base_url('admin/doctors') ?>">
            <i class="fa fa-user-doctor me-2"></i> Kelola Dokter
        </a>
        <a class="nav-link" href="#"><i class="fa fa-calendar-check me-2"></i> Janji Temu</a>
        <hr class="mx-3 opacity-25">
        <a class="nav-link" href="<?= base_url('/') ?>" target="_blank"><i class="fa fa-earth-asia me-2"></i> Lihat Web</a>
        <a class="nav-link text-danger mt-5" href="#"><i class="fa fa-right-from-bracket me-2"></i> Logout</a>
    </nav>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0"><?= $title; ?></h4>
        <div class="d-flex align-items-center">
            <span class="me-2 small fw-bold text-muted">Halo, Admin</span>
            <div class="bg-orange p-2 rounded-circle text-white shadow-sm" style="width: 35px; height: 35px; background: var(--orange-kbs); display:flex; align-items:center; justify-content:center;">AD</div>
        </div>
    </div>
    <?= $this->renderSection('admin_content'); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>