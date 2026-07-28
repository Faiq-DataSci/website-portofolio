<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin Login | Faiq Portofolio') ?></title>

    <!-- Link CSS - Login -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/login.css') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Iconify for Icons -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>

<body>

    <div class="login-wrapper">

        <div class="login-card">

            <!-- Header / Logo -->
            <div class="login-header">
                <h2>Faiq <span>| Data Science</span></h2>
                <h1>Admin Portal</h1>
                <p>Silakan login untuk mengelola portofolio Anda</p>
            </div>

            <!-- Flash Alert Messages -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    <iconify-icon icon="solar:danger-circle-bold"></iconify-icon>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <iconify-icon icon="solar:check-circle-bold"></iconify-icon>
                    <span><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?= base_url('login') ?>" method="POST" class="login-form">

                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="username">Username / Email</label>
                    <div class="input-wrapper">
                        <iconify-icon icon="solar:user-bold" class="input-icon"></iconify-icon>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="Masukkan username atau email"
                            value="<?= old('username') ?>"
                            required
                            autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <iconify-icon icon="solar:lock-password-bold" class="input-icon"></iconify-icon>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required>
                        <button type="button" class="btn-toggle-password" id="togglePasswordBtn">
                            <iconify-icon icon="solar:eye-bold" id="eyeIcon"></iconify-icon>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <span>Masuk ke Dashboard</span>
                    <iconify-icon icon="solar:alt-arrow-right-outline"></iconify-icon>
                </button>

            </form>

            <div class="login-footer">
                <p>Copyright © 2026 Faiq • Data Scientist & AI Developer</p>
            </div>

        </div>

    </div>

    <!-- Toggle Password JS -->
    <script>
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        toggleBtn.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('icon', 'solar:eye-closed-bold');
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('icon', 'solar:eye-bold');
            }
        });
    </script>

</body>

</html>
