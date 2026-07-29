<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Form Technology Color | Admin') ?></title>

    <!-- Link CSS - Tambah Skills (reusing similar style) -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/tambah_skills.css') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Iconify for Icons -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <style>
        /* Color picker styling */
        .color-picker-wrapper {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 8px;
        }

        .color-input-group {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        input[type="color"] {
            width: 80px;
            height: 50px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        input[type="color"]:hover {
            border-color: #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .color-text-input {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            font-family: 'Courier New', monospace;
            transition: all 0.3s;
        }

        .color-text-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .color-preview {
            margin-top: 16px;
            padding: 20px;
            border-radius: 12px;
            background: #f8f9fa;
            border: 2px dashed #e0e0e0;
        }

        .preview-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .preview-badge::before {
            content: '●';
            font-size: 10px;
        }

        .preview-label {
            font-size: 13px;
            color: #666;
            margin-bottom: 8px;
            font-weight: 500;
        }
    </style>
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
                    <span>Dashboard</span>
                </a>

                <a href="<?= base_url('admin/project') ?>">
                    <iconify-icon icon="solar:folder-bold"></iconify-icon>
                    <span>Project</span>
                </a>

                <a href="<?= base_url('admin/skills') ?>">
                    <iconify-icon icon="solar:code-bold"></iconify-icon>
                    <span>Skills</span>
                </a>

                <a href="<?= base_url('admin/certificates') ?>">
                    <iconify-icon icon="solar:diploma-verified-bold"></iconify-icon>
                    <span>Certificate</span>
                </a>

                <a href="<?= base_url('admin/technology-colors') ?>" class="active">
                    <iconify-icon icon="solar:palette-bold"></iconify-icon>
                    <span>Tech Colors</span>
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
                <a href="<?= base_url('admin/technology-colors') ?>">
                    <iconify-icon icon="solar:alt-arrow-left-outline"></iconify-icon>
                    <span>Technology Colors</span>
                </a>
                <iconify-icon icon="solar:alt-arrow-right-outline" class="sep"></iconify-icon>
                <span class="active"><?= !empty($isEdit) ? 'Edit Technology' : 'Tambah Technology' ?></span>
            </div>

            <!-- Header -->
            <div class="page-header">
                <h1><?= !empty($isEdit) ? 'Edit Technology Color' : 'Tambah Technology Color' ?></h1>
                <p>Atur nama dan warna untuk teknologi yang akan ditampilkan di project</p>
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

                <h2>Informasi Technology</h2>

                <?php 
                    $actionUrl    = !empty($isEdit) ? base_url('admin/technology-colors/update/' . $technology['id']) : base_url('admin/technology-colors/store');
                    $currentName  = old('name') ?? ($technology['name'] ?? '');
                    $currentColor = old('color') ?? ($technology['color'] ?? '#667eea');
                ?>

                <form action="<?= $actionUrl ?>" method="POST">

                    <?= csrf_field() ?>

                    <div class="form-grid">

                        <div class="left-column">

                            <!-- Nama Technology -->
                            <div class="form-group">
                                <label for="name">Nama Technology</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    placeholder="Contoh: HTML, CSS, JavaScript"
                                    value="<?= esc($currentName) ?>"
                                    required>
                                <small>Masukan nama teknologi (harus unique)</small>
                            </div>

                            <!-- Warna Technology -->
                            <div class="form-group">
                                <label for="color">Warna Technology</label>
                                <div class="color-picker-wrapper">
                                    <input
                                        type="color"
                                        id="colorPicker"
                                        value="<?= esc($currentColor) ?>">
                                    <input
                                        type="text"
                                        id="color"
                                        name="color"
                                        class="color-text-input"
                                        placeholder="#667eea"
                                        value="<?= esc($currentColor) ?>"
                                        pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$"
                                        required>
                                </div>
                                <small>Pilih warna menggunakan color picker atau masukan kode hex manual</small>
                                
                                <!-- Preview -->
                                <div class="color-preview">
                                    <div class="preview-label">Preview:</div>
                                    <span id="previewBadge" class="preview-badge" style="background: <?= esc($currentColor) ?>15; color: <?= esc($currentColor) ?>; border: 1.5px solid <?= esc($currentColor) ?>30;">
                                        <?= esc($currentName ?: 'Technology Name') ?>
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <iconify-icon icon="solar:diskette-bold"></iconify-icon>
                            <span>Simpan Technology</span>
                        </button>
                        <a href="<?= base_url('admin/technology-colors') ?>" class="btn-cancel">
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

    <!-- Color Picker Sync JS -->
    <script>
        const colorPicker = document.getElementById('colorPicker');
        const colorInput = document.getElementById('color');
        const nameInput = document.getElementById('name');
        const previewBadge = document.getElementById('previewBadge');

        // Sync color picker with text input
        colorPicker.addEventListener('input', function() {
            colorInput.value = this.value;
            updatePreview();
        });

        // Sync text input with color picker
        colorInput.addEventListener('input', function() {
            const hexValue = this.value.trim();
            // Validate hex format
            if (/^#[0-9A-F]{6}$/i.test(hexValue)) {
                colorPicker.value = hexValue;
            }
            updatePreview();
        });

        // Update preview when name changes
        nameInput.addEventListener('input', function() {
            updatePreview();
        });

        // Function to update preview badge
        function updatePreview() {
            const color = colorInput.value || '#667eea';
            const name = nameInput.value || 'Technology Name';
            
            previewBadge.style.background = color + '15';
            previewBadge.style.color = color;
            previewBadge.style.borderColor = color + '30';
            previewBadge.textContent = name;
        }

        // Initialize preview on load
        updatePreview();
    </script>

</body>

</html>
