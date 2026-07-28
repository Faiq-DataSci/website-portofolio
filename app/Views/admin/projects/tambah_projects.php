<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Tambah Project | Admin') ?></title>

    <!-- Link CSS - Tambah Project -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/tambah_project.css') ?>">

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

                <a href="<?= base_url('admin/project') ?>" class="active">
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
                <a href="<?= base_url('admin/project') ?>">
                    <iconify-icon icon="solar:alt-arrow-left-outline"></iconify-icon>
                    <span>Project</span>
                </a>
                <iconify-icon icon="solar:alt-arrow-right-outline" class="sep"></iconify-icon>
                <span class="active"><?= !empty($isEdit) ? 'Edit Project' : 'Tambah Project' ?></span>
            </div>

            <!-- Header -->
            <div class="page-header">
                <h1><?= !empty($isEdit) ? 'Edit Project' : 'Tambah Project' ?></h1>
                <p>Tambah Project baru untuk ditampilkan pada portofolio</p>
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

                <h2>Informasi Project</h2>

                <?php 
                    $actionUrl       = !empty($isEdit) ? base_url('admin/project/update/' . $project['id']) : base_url('admin/project/store');
                    $currentTitle    = old('title') ?? ($project['title'] ?? '');
                    $currentDesc     = old('description') ?? ($project['description'] ?? '');
                    $currentGithub   = old('github') ?? ($project['github'] ?? '');
                    $currentCategory = old('category') ?? ($project['category'] ?? '');
                    $currentStatus   = old('status') ?? ($project['status'] ?? 'published');
                ?>

                <form action="<?= $actionUrl ?>" method="POST" enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="form-grid">

                        <!-- Left Column -->
                        <div class="left-column">

                            <!-- Judul Project -->
                            <div class="form-group">
                                <label for="title">Judul Project</label>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    placeholder="Contoh : Portofolio Website"
                                    value="<?= esc($currentTitle) ?>"
                                    required>
                                <small>Masukan judul project yang akan ditampilkan</small>
                            </div>

                            <!-- Deskripsi Project -->
                            <div class="form-group">
                                <label for="description">Deskripsi Project</label>
                                <textarea
                                    id="description"
                                    name="description"
                                    rows="5"
                                    placeholder="Ceritakan tentang project ini, teknologi yang digunakan, fitur utama, dan tujuan project."><?= esc($currentDesc) ?></textarea>
                                <small>Tulis deskripsi detail tentang project</small>
                            </div>

                            <!-- Foto Project -->
                            <div class="form-group">
                                <label>Foto Project</label>

                                <label class="upload-dropzone" id="dropzone">
                                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" hidden>
                                    <div class="dropzone-content">
                                        <iconify-icon icon="solar:gallery-outline" class="upload-icon"></iconify-icon>
                                        <h4>Drag & drop gambar disini</h4>
                                        <p>atau klik untuk memilih file</p>
                                    </div>
                                    <div id="file-preview-name" class="file-preview-name"></div>
                                </label>

                                <small>Gunakan gambar dengan rasio 16 : 9 untuk hasil terbaik. maks 2 Mb (jpg,png)</small>
                            </div>

                        </div>

                        <!-- Right Column -->
                        <div class="right-column">

                            <!-- Link GitHub -->
                            <div class="form-group">
                                <label for="github">Link GitHub</label>
                                <div class="input-with-icon">
                                    <iconify-icon icon="mdi:github" class="input-icon"></iconify-icon>
                                    <input
                                        type="text"
                                        id="github"
                                        name="github"
                                        placeholder="https://github.com/"
                                        value="<?= esc($currentGithub) ?>">
                                </div>
                                <small>Masukan link github project anda</small>
                            </div>

                            <!-- Kategori Project -->
                            <div class="form-group">
                                <label for="category">Kategori Project</label>
                                <div class="select-wrapper">
                                    <select id="category" name="category" required>
                                        <option value="" disabled <?= empty($currentCategory) ? 'selected' : '' ?>>Pilih kategori project</option>
                                        <option value="Web Development" <?= $currentCategory == 'Web Development' ? 'selected' : '' ?>>Web Development</option>
                                        <option value="Machine Learning" <?= $currentCategory == 'Machine Learning' ? 'selected' : '' ?>>Machine Learning</option>
                                        <option value="Data Science" <?= $currentCategory == 'Data Science' ? 'selected' : '' ?>>Data Science</option>
                                        <option value="Mobile App" <?= $currentCategory == 'Mobile App' ? 'selected' : '' ?>>Mobile App</option>
                                        <option value="Desktop App" <?= $currentCategory == 'Desktop App' ? 'selected' : '' ?>>Desktop App</option>
                                    </select>
                                    <iconify-icon icon="solar:alt-arrow-down-outline" class="select-icon"></iconify-icon>
                                </div>
                                <small>Masukan kategori yang anda inginkan</small>
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label>Status</label>
                                <div class="status-radio-group">

                                    <label class="status-option">
                                        <input type="radio" name="status" value="published" <?= strtolower($currentStatus) == 'published' ? 'checked' : '' ?>>
                                        <span class="custom-radio"></span>
                                        <div class="status-text">
                                            <strong>Published</strong>
                                            <small>Project akan ditampilkan di portofolio</small>
                                        </div>
                                    </label>

                                    <label class="status-option">
                                        <input type="radio" name="status" value="draft" <?= strtolower($currentStatus) == 'draft' ? 'checked' : '' ?>>
                                        <span class="custom-radio"></span>
                                        <div class="status-text">
                                            <strong>Draft</strong>
                                            <small>Project belum akan ditampilkan di portofolio</small>
                                        </div>
                                    </label>

                                    <label class="status-option">
                                        <input type="radio" name="status" value="archived" <?= strtolower($currentStatus) == 'archived' ? 'checked' : '' ?>>
                                        <span class="custom-radio"></span>
                                        <div class="status-text">
                                            <strong>Archived</strong>
                                            <small>Project belum akan ditampilkan di portofolio</small>
                                        </div>
                                    </label>

                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Technologies Section (Full Width) -->
                    <div class="technologies-section">
                        <h3>Technologies</h3>
                        <p class="tech-subtitle">Pilih teknologi yang digunakan dalam project ini</p>
                        
                        <?php
                            // Daftar teknologi yang tersedia
                            $availableTechs = [
                                'Python', 'Pandas', 'Jupyter', 'NumPy', 'Scikit-learn', 'TensorFlow', 'PyTorch',
                                'Matplotlib', 'Seaborn', 'SQL', 'MySQL', 'PostgreSQL', 'MongoDB',
                                'PHP', 'JavaScript', 'TypeScript', 'React', 'Vue.js', 'Angular',
                                'Node.js', 'Express', 'Laravel', 'CodeIgniter', 'Django', 'Flask',
                                'HTML', 'CSS', 'Bootstrap', 'Tailwind CSS', 'Docker', 'Git', 'AWS', 'Azure'
                            ];

                            // Ambil technologies yang sudah dipilih (untuk edit)
                            $selectedTechs = [];
                            if (!empty($project['technologies'])) {
                                $selectedTechs = json_decode($project['technologies'], true);
                                if (!is_array($selectedTechs)) {
                                    $selectedTechs = [];
                                }
                            }
                        ?>

                        <div class="tech-stack-grid">
                            <?php foreach ($availableTechs as $tech): ?>
                                <label class="tech-item <?= in_array($tech, $selectedTechs) ? 'active' : '' ?>">
                                    <input 
                                        type="checkbox" 
                                        name="technologies[]" 
                                        value="<?= esc($tech) ?>"
                                        <?= in_array($tech, $selectedTechs) ? 'checked' : '' ?>>
                                    <span class="tech-label"><?= esc($tech) ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <iconify-icon icon="solar:diskette-bold"></iconify-icon>
                            <span>Simpan Project</span>
                        </button>
                        <a href="<?= base_url('admin/project') ?>" class="btn-cancel">
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
        const fileInput = document.getElementById('thumbnail');
        const previewName = document.getElementById('file-preview-name');

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                previewName.textContent = 'File terpilih: ' + fileInput.files[0].name;
                previewName.style.display = 'block';
            }
        });
    </script>

    <!-- Tech Stack Chip Toggle JS -->
    <script>
        document.querySelectorAll('.tech-item').forEach(function(label) {
            label.addEventListener('click', function() {
                const checkbox = this.querySelector('input[type="checkbox"]');
                // Toggle checked state (click already does this, but we sync the visual)
                setTimeout(() => {
                    if (checkbox.checked) {
                        this.classList.add('active');
                    } else {
                        this.classList.remove('active');
                    }
                }, 0);
            });
        });
    </script>

</body>

</html>