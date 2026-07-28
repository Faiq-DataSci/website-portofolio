<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Tambah Skills | Admin') ?></title>

    <!-- Link CSS - Tambah Skills -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/tambah_skills.css') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Iconify for Tech Stack Icons -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>

<body>

    <div class="container">

        <!-- ================= Sidebar ================= -->
        <aside class="sidebar">

            <div class="logo">
                <h2>Faiq <span>| Data Science</span></h2>
            </div>

            <nav class="sidebar-menu">

                <a href="<?= base_url('admin/dashboard') ?>">
                    <iconify-icon icon="solar:widget-5-bold"></iconify-icon>
                    <span>Dasboard</span>
                </a>

                <a href="<?= base_url('admin/project') ?>">
                    <iconify-icon icon="solar:folder-bold"></iconify-icon>
                    <span>Project</span>
                </a>

                <a href="<?= base_url('admin/skills') ?>" class="active">
                    <iconify-icon icon="solar:code-bold"></iconify-icon>
                    <span>Skills</span>
                </a>

                <a href="<?= base_url('admin/gallery') ?>">
                    <iconify-icon icon="solar:gallery-outline"></iconify-icon>
                    <span>Gambar</span>
                </a>

            </nav>

            <div class="logout">
                <a href="<?= base_url('logout') ?>">
                    <iconify-icon icon="solar:logout-2-outline"></iconify-icon>
                    <span>Logout</span>
                </a>
            </div>

        </aside>

        <!-- ================= Main Content ================= -->
        <main class="main-content">

            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="<?= base_url('admin/skills') ?>">
                    <iconify-icon icon="solar:alt-arrow-left-outline"></iconify-icon>
                    <span>Skills</span>
                </a>
                <iconify-icon icon="solar:alt-arrow-right-outline" class="sep"></iconify-icon>
                <span class="active"><?= !empty($isEdit) ? 'Edit Skills' : 'Tambah Skills' ?></span>
            </div>

            <!-- Header -->
            <div class="page-header">
                <h1><?= !empty($isEdit) ? 'Edit Skills' : 'Tambah Skills' ?></h1>
                <p>Tambah Skills baru untuk ditampilkan di portofolio</p>
            </div>

            <!-- Flash Alert -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    <iconify-icon icon="solar:danger-circle-bold"></iconify-icon>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <!-- Card Form -->
            <div class="card form-card">

                <h2>Informasi Skills</h2>

                <?php 
                    $actionUrl = !empty($isEdit) ? base_url('admin/skills/update/' . $skill['id']) : base_url('admin/skills/store');
                    $currentIcon = old('icon') ?? ($skill['icon'] ?? 'logos:react');
                    $currentStatus = old('status') ?? ($skill['status'] ?? 1);
                    $currentLevel = old('level') ?? ($skill['level'] ?? 80);
                    $currentCategory = old('category') ?? ($skill['category'] ?? '');
                    $currentName = old('skill_name') ?? old('name') ?? ($skill['name'] ?? '');
                ?>

                <form action="<?= $actionUrl ?>" method="POST">

                    <?= csrf_field() ?>

                    <div class="form-grid">

                        <!-- Left Column -->
                        <div class="left-column">

                            <!-- Nama Skill -->
                            <div class="form-group">
                                <label for="skill_name">Nama Skill</label>
                                <input
                                    type="text"
                                    id="skill_name"
                                    name="skill_name"
                                    placeholder="Contoh : React.js"
                                    value="<?= esc($currentName) ?>"
                                    required>
                                <small>Masukkan nama skill yang akan ditampilkan</small>
                            </div>

                            <!-- Level Presentase Skill -->
                            <div class="form-group">
                                <label for="level_range">Level Presentase Skill</label>

                                <div class="range-wrapper">
                                    <input
                                        type="range"
                                        id="level_range"
                                        name="level"
                                        min="0"
                                        max="100"
                                        value="<?= esc($currentLevel) ?>">

                                    <div class="range-value-box">
                                        <input
                                            type="number"
                                            id="level_number"
                                            min="0"
                                            max="100"
                                            value="<?= esc($currentLevel) ?>">
                                        <span>%</span>
                                    </div>
                                </div>

                                <small>Tentukan penguasaan skill dalam persen (0% - 100%).</small>
                            </div>

                            <!-- Icon Selector -->
                            <div class="form-group">
                                <label>Icon</label>

                                <div class="icon-selector-grid">

                                    <label class="icon-option <?= ($currentIcon == 'logos:react' || $currentIcon == 'react') ? 'active' : '' ?>">
                                        <input type="radio" name="icon" value="logos:react" <?= ($currentIcon == 'logos:react' || $currentIcon == 'react') ? 'checked' : '' ?>>
                                        <iconify-icon icon="logos:react"></iconify-icon>
                                    </label>

                                    <label class="icon-option <?= ($currentIcon == 'logos:javascript' || $currentIcon == 'javascript') ? 'active' : '' ?>">
                                        <input type="radio" name="icon" value="logos:javascript" <?= ($currentIcon == 'logos:javascript' || $currentIcon == 'javascript') ? 'checked' : '' ?>>
                                        <iconify-icon icon="logos:javascript"></iconify-icon>
                                    </label>

                                    <label class="icon-option <?= ($currentIcon == 'logos:nodejs-icon' || $currentIcon == 'nodejs') ? 'active' : '' ?>">
                                        <input type="radio" name="icon" value="logos:nodejs-icon" <?= ($currentIcon == 'logos:nodejs-icon' || $currentIcon == 'nodejs') ? 'checked' : '' ?>>
                                        <iconify-icon icon="logos:nodejs-icon"></iconify-icon>
                                    </label>

                                    <label class="icon-option <?= ($currentIcon == 'logos:python' || $currentIcon == 'python') ? 'active' : '' ?>">
                                        <input type="radio" name="icon" value="logos:python" <?= ($currentIcon == 'logos:python' || $currentIcon == 'python') ? 'checked' : '' ?>>
                                        <iconify-icon icon="logos:python"></iconify-icon>
                                    </label>

                                    <label class="icon-option <?= ($currentIcon == 'logos:html-5' || $currentIcon == 'html') ? 'active' : '' ?>">
                                        <input type="radio" name="icon" value="logos:html-5" <?= ($currentIcon == 'logos:html-5' || $currentIcon == 'html') ? 'checked' : '' ?>>
                                        <iconify-icon icon="logos:html-5"></iconify-icon>
                                    </label>

                                    <label class="icon-option <?= ($currentIcon == 'solar:menu-dots-bold' || $currentIcon == 'more') ? 'active' : '' ?>">
                                        <input type="radio" name="icon" value="solar:menu-dots-bold" <?= ($currentIcon == 'solar:menu-dots-bold' || $currentIcon == 'more') ? 'checked' : '' ?>>
                                        <iconify-icon icon="solar:menu-dots-bold" style="color: #000;"></iconify-icon>
                                    </label>

                                </div>

                                <small>Pilih icon yang mewakili skill ini ( pilih salah satu saja )</small>
                            </div>

                        </div>

                        <!-- Divider Line -->
                        <div class="vertical-divider"></div>

                        <!-- Right Column -->
                        <div class="right-column">

                            <!-- Kategori -->
                            <div class="form-group">
                                <label for="category">Kategori</label>
                                <div class="select-wrapper">
                                    <select id="category" name="category" required>
                                        <option value="" disabled <?= empty($currentCategory) ? 'selected' : '' ?>>Pilih Kategori skill</option>
                                        <option value="Frontend" <?= $currentCategory == 'Frontend' ? 'selected' : '' ?>>Frontend</option>
                                        <option value="Backend" <?= $currentCategory == 'Backend' ? 'selected' : '' ?>>Backend</option>
                                        <option value="Database" <?= $currentCategory == 'Database' ? 'selected' : '' ?>>Database</option>
                                        <option value="Machine Learning" <?= $currentCategory == 'Machine Learning' ? 'selected' : '' ?>>Machine Learning</option>
                                        <option value="DevOps" <?= $currentCategory == 'DevOps' ? 'selected' : '' ?>>DevOps</option>
                                    </select>
                                    <iconify-icon icon="solar:alt-arrow-down-outline" class="select-icon"></iconify-icon>
                                </div>
                                <small>Pilih Kategori yang sesuai untuk skill ini</small>
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label>Status</label>
                                <div class="status-radio-group">

                                    <label class="status-option">
                                        <input type="radio" name="status" value="1" <?= $currentStatus == 1 ? 'checked' : '' ?>>
                                        <span class="custom-radio"></span>
                                        <div class="status-text">
                                            <strong>Aktif</strong>
                                            <small>Project akan ditampilkan di portofolio</small>
                                        </div>
                                    </label>

                                    <label class="status-option">
                                        <input type="radio" name="status" value="0" <?= $currentStatus == 0 ? 'checked' : '' ?>>
                                        <span class="custom-radio"></span>
                                        <div class="status-text">
                                            <strong>Nonaktif</strong>
                                            <small>Project belum akan ditampilkan di portofolio</small>
                                        </div>
                                    </label>

                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <iconify-icon icon="solar:diskette-bold"></iconify-icon>
                            <span>Simpan Skill</span>
                        </button>
                        <a href="<?= base_url('admin/skills') ?>" class="btn-cancel">
                            Batal
                        </a>
                    </div>

                </form>

            </div>

            <!-- Footer -->
            <footer class="footer">
                Copyright: © 2026 Faiq • Data Scientist & AI Developer. All rights reserved.
            </footer>

        </main>

    </div>

    <!-- Sync Range Slider JS & Icon Radio Selector -->
    <script>
        const levelRange = document.getElementById('level_range');
        const levelNumber = document.getElementById('level_number');

        levelRange.addEventListener('input', () => {
            levelNumber.value = levelRange.value;
            updateRangeFill();
        });

        levelNumber.addEventListener('input', () => {
            let val = parseInt(levelNumber.value) || 0;
            if (val > 100) val = 100;
            if (val < 0) val = 0;
            levelRange.value = val;
            updateRangeFill();
        });

        function updateRangeFill() {
            const percent = levelRange.value;
            levelRange.style.background = `linear-gradient(to right, #0088FF 0%, #0088FF ${percent}%, #E5E5EA ${percent}%, #E5E5EA 100%)`;
        }
        updateRangeFill();

        // Icon options interactive click
        const iconOptions = document.querySelectorAll('.icon-option');
        iconOptions.forEach(option => {
            option.addEventListener('click', () => {
                iconOptions.forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');
                const radio = option.querySelector('input[type="radio"]');
                if (radio) radio.checked = true;
            });
        });
    </script>

</body>

</html>