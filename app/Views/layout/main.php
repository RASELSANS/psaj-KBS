<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Klinik Brayan Sehat'; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Efek scroll halus untuk navigasi ID */
        html {
            scroll-behavior: smooth;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #ffffff; 
            color: #333;
        }

        /* Navbar Custom Styles */
        .nav-link { 
            color: #333 !important; 
            font-weight: 500; 
            margin: 0 10px; 
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active { 
            border-bottom: 3px solid #ccc; 
        }

        .btn-orange { 
            background-color: #ff8a3d; 
            color: white; 
            border-radius: 10px; 
            padding: 8px 25px; 
            border: none; 
            font-weight: 600;
        }

        .btn-orange:hover { 
            background-color: #e6762d; 
            color: white; 
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255, 138, 61, 0.3);
        }

        /* Padding tambahan agar saat discroll section tidak tertutup navbar jika fixed */
        section {
            padding-top: 20px;
        }
    </style>
    <?= $this->renderSection('extra-css'); ?>
</head>
<body>

    <?= $this->include('layout/navbar'); ?>

    <main>
        <?= $this->renderSection('content'); ?>
    </main>

    <footer class="py-4 text-center border-top mt-5">
        <p class="text-muted small">&copy; <?= date('Y') ?> Klinik Brayan Sehat. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('extra-js'); ?>
</body>
</html>