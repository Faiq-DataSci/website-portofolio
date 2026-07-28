<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Tambah Gambar | Admin') ?></title>

    <!-- Link CSS - Tambah Gambar -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/tambah_gambar.css') ?>">

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

                <a href="<?= base_url('admin/skills') ?>">
                    <iconify-icon icon="solar:code-bold"></iconify-icon>
                    <span>Skills</span>
                </a>

                <a href="<?= base_url('admin/gallery') ?>" class="active">
                    <iconify-icon icon="solar:gallery-bold"></iconify-icon>
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
                <a href="<?= base_url('admin/gallery') ?>">
                    <iconify-icon icon="solar:alt-arrow-left-outline"></iconify-icon>
                    <span>Gambar</span>
                </a>
                <iconify-icon icon="solar:alt-arrow-right-outline" class="sep"></iconify-icon>
                <span class="active"><?= !empty($isEdit) ? 'Edit Gambar' : 'Tambah Gambar' ?></span>
            </div>

            <!-- Header -->
            <div class="page-header">
                <h1><?= !empty($isEdit) ? 'Edit Gambar' : 'Tambah Gambar' ?></h1>
                <p>Tentukan gambar baru yang akan ditampilkan di halaman utama</p>
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

                <h2>Informasi Gambar</h2>

                <?php 
                    $actionUrl       = !empty($isEdit) ? base_url('admin/gallery/update/' . $image['id']) : base_url('admin/gallery/store');
                    $currentTitle    = old('title') ?? ($image['title'] ?? '');
                    $currentCategory = strtolower(old('category') ?? ($image['category'] ?? 'home'));
                    $currentStatus   = strtolower(old('status') ?? ($image['status'] ?? 'active'));
                    $currentShow     = old('is_show') ?? ($image['is_show'] ?? 1);
                ?>

                <form action="<?= $actionUrl ?>" method="POST" enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="form-grid">

                        <!-- Left Column -->
                        <div class="left-column">

                            <!-- Judul Gambar -->
                            <div class="form-group">
                                <label for="title">Judul Gambar</label>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    placeholder="Contoh : Portofolio Website"
                                    value="<?= esc($currentTitle) ?>"
                                    required>
                                <small>Masukan judul yang akan ditampilkan di halaman utama</small>
                            </div>

                            <!-- Foto Gambar -->
                            <div class="form-group">
                                <label>Foto Gambar</label>

                                <label class="upload-dropzone" id="dropzone">
                                    <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.webp" hidden>
                                    <div class="dropzone-content">
                                        <iconify-icon icon="solar:gallery-outline" class="upload-icon"></iconify-icon>
                                        <h4>Drag & drop gambar disini</h4>
                                        <p>atau klik untuk memilih file</p>
                                    </div>
                                    <div id="file-preview-name" class="file-preview-name"></div>
                                </label>

                                <small>Gunakan gambar dengan rasio 16:9 untuk hasil terbaik.<br>Maks. 2 Mb (jpg,PNG, WebP)</small>
                            </div>

                        </div>

                        <!-- Right Column -->
                        <div class="right-column">

                            <!-- Kategori Gambar -->
                            <div class="form-group">
                                <label for="category">Kategori Gambar</label>
                                <div class="select-wrapper">
                                    <select id="category" name="category" required>
                                        <option value="" disabled <?= empty($currentCategory) ? 'selected' : '' ?>>Pilih kategori</option>
                                        <option value="home" <?= $currentCategory == 'home' ? 'selected' : '' ?>>Home</option>
                                        <option value="about" <?= $currentCategory == 'about' ? 'selected' : '' ?>>About</option>
                                        <option value="project" <?= $currentCategory == 'project' ? 'selected' : '' ?>>Project</option>
                                        <option value="certificate" <?= $currentCategory == 'certificate' ? 'selected' : '' ?>>Certificate</option>
                                        <option value="other" <?= $currentCategory == 'other' ? 'selected' : '' ?>>Lainnya</option>
                                    </select>
                                    <iconify-icon icon="solar:alt-arrow-down-outline" class="select-icon"></iconify-icon>
                                </div>
                                <small>Masukan kategori yang anda inginkan</small>
                            </div>

                            <!-- Status Gambar -->
                            <div class="form-group">
                                <label for="status">Status Gambar</label>
                                <div class="select-wrapper">
                                    <select id="status" name="status" required>
                                        <option value="active" <?= $currentStatus == 'active' ? 'selected' : '' ?>>Aktif</option>
                                        <option value="inactive" <?= $currentStatus == 'inactive' ? 'selected' : '' ?>>Nonaktif</option>
                                    </select>
                                    <iconify-icon icon="solar:alt-arrow-down-outline" class="select-icon"></iconify-icon>
                                </div>
                                <small>Status gambar aktif atau tidak</small>
                            </div>

                            <!-- Ditampilkan -->
                            <div class="form-group">
                                <label for="is_show">Ditampilkan</label>
                                <div class="select-wrapper">
                                    <select id="is_show" name="is_show" required>
                                        <option value="1" <?= $currentShow == 1 ? 'selected' : '' ?>>Ya</option>
                                        <option value="0" <?= $currentShow == 0 ? 'selected' : '' ?>>Tidak</option>
                                    </select>
                                    <iconify-icon icon="solar:alt-arrow-down-outline" class="select-icon"></iconify-icon>
                                </div>
                                <small>Gambar ditampilkan atau tidak</small>
                            </div>

                        </div>

                    </div>

                    <div class="divider-line"></div>

                    <!-- Action Buttons -->
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <iconify-icon icon="solar:diskette-bold"></iconify-icon>
                            <span>Simpan Gambar</span>
                        </button>
                        <a href="<?= base_url('admin/gallery') ?>" class="btn-cancel">
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

    <!-- Drag & Drop File Upload JS -->
    <script>
        const fileInput = document.getElementById('image');
        const previewName = document.getElementById('file-preview-name');

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                previewName.textContent = 'File terpilih: ' + fileInput.files[0].name;
                previewName.style.display = 'block';
            }
        });
    </script>

</body>

</html>