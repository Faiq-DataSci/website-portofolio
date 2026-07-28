<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Form Certificate | Admin') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/tambah_project.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo"><h2>Faiq <span>| Data Science</span></h2></div>
            <nav class="sidebar-menu">
                <a href="<?= base_url('admin/dashboard') ?>">
                    <iconify-icon icon="solar:widget-5-bold"></iconify-icon><span>Dashboard</span>
                </a>
                <a href="<?= base_url('admin/project') ?>">
                    <iconify-icon icon="solar:folder-bold"></iconify-icon><span>Project</span>
                </a>
                <a href="<?= base_url('admin/skills') ?>">
                    <iconify-icon icon="solar:code-bold"></iconify-icon><span>Skills</span>
                </a>
                <a href="<?= base_url('admin/certificates') ?>" class="active">
                    <iconify-icon icon="solar:diploma-verified-bold"></iconify-icon><span>Certificate</span>
                </a>
            </nav>
            <div class="logout">
                <a href="<?= base_url('logout') ?>">
                    <iconify-icon icon="solar:logout-2-outline"></iconify-icon><span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="breadcrumb">
                <a href="<?= base_url('admin/certificates') ?>">
                    <iconify-icon icon="solar:alt-arrow-left-outline"></iconify-icon><span>Certificate</span>
                </a>
                <iconify-icon icon="solar:alt-arrow-right-outline" class="sep"></iconify-icon>
                <span class="active"><?= !empty($isEdit) ? 'Edit Certificate' : 'Tambah Certificate' ?></span>
            </div>

            <div class="page-header">
                <h1><?= !empty($isEdit) ? 'Edit Certificate' : 'Tambah Certificate' ?></h1>
                <p>Kelola certificate yang akan ditampilkan di halaman Skills</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error" style="background:#FFD5D6; color:#D32F2F; padding:12px 16px; border-radius:10px; margin-bottom:20px; display:flex; align-items:center; gap:10px;">
                    <iconify-icon icon="solar:danger-circle-bold" style="font-size:20px;"></iconify-icon>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <div class="card form-card">
                <h2>Informasi Certificate</h2>

                <?php 
                    $actionUrl     = !empty($isEdit) ? base_url('admin/certificates/update/' . $certificate['id']) : base_url('admin/certificates/store');
                    $title_val     = old('title') ?? ($certificate['title'] ?? '');
                    $issuer        = old('issuer') ?? ($certificate['issuer'] ?? '');
                    $issueDate     = old('issue_date') ?? ($certificate['issue_date'] ?? '');
                    $description   = old('description') ?? ($certificate['description'] ?? '');
                    $status        = old('status') ?? ($certificate['status'] ?? 'active');
                    $isShow        = old('is_show') ?? ($certificate['is_show'] ?? 1);
                ?>

                <form action="<?= $actionUrl ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-grid">
                        <div class="left-column">
                            <div class="form-group">
                                <label for="title">Nama Certificate *</label>
                                <input type="text" id="title" name="title" placeholder="Contoh: Data Science Specialization" value="<?= esc($title_val) ?>" required>
                                <small>Nama lengkap certificate</small>
                            </div>

                            <div class="form-group">
                                <label for="issuer">Penerbit Certificate</label>
                                <input type="text" id="issuer" name="issuer" placeholder="Contoh: Coursera, Google, Microsoft" value="<?= esc($issuer) ?>">
                                <small>Institusi/platform yang menerbitkan certificate</small>
                            </div>

                            <div class="form-group">
                                <label for="issue_date">Tanggal Terbit</label>
                                <input type="date" id="issue_date" name="issue_date" value="<?= esc($issueDate) ?>">
                                <small>Tanggal certificate diterbitkan (opsional)</small>
                            </div>

                            <div class="form-group">
                                <label for="image">Upload Gambar Certificate</label>
                                <label class="upload-dropzone" id="dropzone">
                                    <input type="file" name="image" id="image" accept="image/*" hidden>
                                    <div class="dropzone-content">
                                        <iconify-icon icon="solar:gallery-outline" class="upload-icon"></iconify-icon>
                                        <h4>Drag & drop gambar disini</h4>
                                        <p>atau klik untuk memilih file</p>
                                    </div>
                                    <div id="file-preview-name" class="file-preview-name"></div>
                                </label>
                                <small>Format: JPG, PNG, WebP. Max 2MB</small>
                            </div>
                        </div>

                        <div class="right-column">
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea id="description" name="description" rows="5" placeholder="Deskripsi singkat tentang certificate ini..."><?= esc($description) ?></textarea>
                                <small>Informasi tambahan (opsional)</small>
                            </div>

                            <div class="form-group">
                                <label>Status *</label>
                                <div class="status-radio-group">
                                    <label class="status-option">
                                        <input type="radio" name="status" value="active" <?= strtolower($status) == 'active' ? 'checked' : '' ?>>
                                        <span class="custom-radio"></span>
                                        <div class="status-text"><strong>Active</strong><small>Tampil di admin</small></div>
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status" value="inactive" <?= strtolower($status) == 'inactive' ? 'checked' : '' ?>>
                                        <span class="custom-radio"></span>
                                        <div class="status-text"><strong>Inactive</strong><small>Tidak tampil</small></div>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Ditampilkan di Frontend *</label>
                                <div class="status-radio-group">
                                    <label class="status-option">
                                        <input type="radio" name="is_show" value="1" <?= $isShow == 1 ? 'checked' : '' ?>>
                                        <span class="custom-radio"></span>
                                        <div class="status-text"><strong>Ya</strong><small>Tampil di Skills page</small></div>
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="is_show" value="0" <?= $isShow == 0 ? 'checked' : '' ?>>
                                        <span class="custom-radio"></span>
                                        <div class="status-text"><strong>Tidak</strong><small>Hanya di admin</small></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <iconify-icon icon="solar:diskette-bold"></iconify-icon><span>Simpan</span>
                        </button>
                        <a href="<?= base_url('admin/certificates') ?>" class="btn-cancel">Batal</a>
                    </div>
                </form>
            </div>

            <footer class="footer">Copyright: © 2026 Faiq • Data Scientist & AI Developer</footer>
        </main>
    </div>

    <!-- Drag & Drop File Upload JS -->
    <script>
        const fileInput = document.getElementById('image');
        const previewName = document.getElementById('file-preview-name');
        const dropzone = document.getElementById('dropzone');

        // File input change event
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                previewName.textContent = 'File terpilih: ' + fileInput.files[0].name;
                previewName.style.display = 'block';
            }
        });

        // Drag and drop events
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.style.borderColor = '#007BFF';
            dropzone.style.background = '#f0f8ff';
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.style.borderColor = '#ddd';
            dropzone.style.background = '#fafafa';
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.style.borderColor = '#ddd';
            dropzone.style.background = '#fafafa';

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                previewName.textContent = 'File terpilih: ' + files[0].name;
                previewName.style.display = 'block';
            }
        });
    </script>
</body>
</html>
