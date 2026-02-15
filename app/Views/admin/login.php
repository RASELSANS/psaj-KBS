<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Klinik Brayan Sehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #ff8a3d 0%, #ff6b3d 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 1rem;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 2.5rem;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header .logo-icon {
            font-size: 3rem;
            color: #ff8a3d;
            margin-bottom: 1rem;
        }

        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
        }

        .login-header p {
            color: #999;
            margin: 0.5rem 0 0 0;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 0.95rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #ff8a3d;
            background: white;
            box-shadow: 0 0 0 3px rgba(255, 138, 61, 0.1);
        }

        .form-group input::placeholder {
            color: #ccc;
        }

        .btn-login {
            width: 100%;
            padding: 0.75rem 1rem;
            background: linear-gradient(135deg, #ff8a3d 0%, #ff6b3d 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 138, 61, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border: none;
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: #ffebee;
            color: #c62828;
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .alert-warning {
            background: #fff3e0;
            color: #e65100;
        }

        .login-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
            color: #999;
            font-size: 0.9rem;
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.2em;
            margin-right: 0.5rem;
        }

        /* Loading state */
        .btn-login.loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-login.loading:hover {
            transform: none;
            box-shadow: none;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                padding: 2rem;
            }

            .login-header h1 {
                font-size: 1.5rem;
            }

            .login-header .logo-icon {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="logo-icon">
                    <i class="fas fa-clinical"></i>
                </div>
                <h1>Admin Panel</h1>
                <p>Klinik Brayan Sehat</p>
            </div>

            <!-- Alert Messages -->
            <div id="alertContainer">
                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle"></i> <?= session('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i> <?= session('success') ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Login Form -->
            <form id="loginForm" action="<?= base_url('api/admin/login') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="username">
                        <i class="fas fa-user" style="color: #ff8a3d; margin-right: 0.5rem;"></i>
                        Username
                    </label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="Masukkan username"
                        required
                        autocomplete="username"
                    >
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock" style="color: #ff8a3d; margin-right: 0.5rem;"></i>
                        Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Masukkan password"
                        required
                        autocomplete="current-password"
                    >
                </div>

                <button type="submit" class="btn-login" id="loginBtn">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                <p style="margin: 0;">
                    <i class="fas fa-shield-alt" style="color: #ff8a3d;"></i>
                    Login tersecure & terenkripsi
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');

        // Handle form submission
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const username = usernameInput.value.trim();
            const password = passwordInput.value;

            // Validation
            if (!username) {
                showAlert('Username tidak boleh kosong', 'warning');
                usernameInput.focus();
                return;
            }

            if (!password) {
                showAlert('Password tidak boleh kosong', 'warning');
                passwordInput.focus();
                return;
            }

            // Set loading state
            loginBtn.classList.add('loading');
            loginBtn.disabled = true;
            loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

            try {
                const response = await fetch('<?= base_url('api/admin/login') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new URLSearchParams({
                        '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                        username: username,
                        password: password
                    })
                });

                const data = await response.json();

                if (data.status) {
                    showAlert('Login berhasil! Mengalihkan...', 'success');
                    setTimeout(() => {
                        window.location.href = '<?= base_url('admin/dashboard') ?>';
                    }, 500);
                } else {
                    showAlert(data.message || 'Login gagal. Silakan periksa kembali username dan password.', 'danger');
                    loginBtn.classList.remove('loading');
                    loginBtn.disabled = false;
                    loginBtn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Masuk';
                    passwordInput.value = '';
                    passwordInput.focus();
                }
            } catch (error) {
                console.error('Login error:', error);
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'danger');
                loginBtn.classList.remove('loading');
                loginBtn.disabled = false;
                loginBtn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Masuk';
            }
        });

        function showAlert(message, type) {
            const alertContainer = document.getElementById('alertContainer');
            const alertHTML = `
                <div class="alert alert-${type}" role="alert">
                    <i class="fas fa-${type === 'danger' ? 'exclamation-circle' : type === 'success' ? 'check-circle' : 'info-circle'}"></i>
                    ${message}
                </div>
            `;
            alertContainer.innerHTML = alertHTML;
        }

        // Clear error when user starts typing
        usernameInput.addEventListener('focus', function() {
            const alert = document.querySelector('.alert');
            if (alert) alert.style.display = 'none';
        });

        passwordInput.addEventListener('focus', function() {
            const alert = document.querySelector('.alert');
            if (alert) alert.style.display = 'none';
        });

        // Auto-focus username
        window.addEventListener('load', () => {
            usernameInput.focus();
        });
    </script>
</body>
</html>