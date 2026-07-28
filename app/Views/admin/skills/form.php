<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Form Skill | Admin') ?></title>
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
                <a href="<?= base_url('admin/skills') ?>" class="active">
                    <iconify-icon icon="solar:code-bold"></iconify-icon><span>Skills</span>
                </a>
                <a href="<?= base_url('admin/certificates') ?>">
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
                <a href="<?= base_url('admin/skills') ?>">
                    <iconify-icon icon="solar:alt-arrow-left-outline"></iconify-icon><span>Skills</span>
                </a>
                <iconify-icon icon="solar:alt-arrow-right-outline" class="sep"></iconify-icon>
                <span class="active"><?= !empty($isEdit) ? 'Edit Skill' : 'Tambah Skill' ?></span>
            </div>

            <div class="page-header">
                <h1><?= !empty($isEdit) ? 'Edit Skill' : 'Tambah Skill' ?></h1>
                <p>Kelola skills yang akan ditampilkan di halaman frontend</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error" style="background:#FFD5D6; color:#D32F2F; padding:12px 16px; border-radius:10px; margin-bottom:20px; display:flex; align-items:center; gap:10px;">
                    <iconify-icon icon="solar:danger-circle-bold" style="font-size:20px;"></iconify-icon>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <div class="card form-card">
                <h2>Informasi Skill</h2>

                <?php 
                    $actionUrl = !empty($isEdit) ? base_url('admin/skills/update/' . $skill['id']) : base_url('admin/skills/store');
                    $name = old('name') ?? ($skill['name'] ?? '');
                    $category = old('category') ?? ($skill['category'] ?? '');
                    $level = old('level') ?? ($skill['level'] ?? 50);
                    $icon = old('icon') ?? ($skill['icon'] ?? '');
                    $desc = old('description') ?? ($skill['description'] ?? '');
                    $order = old('order_index') ?? ($skill['order_index'] ?? 0);
                    $status = old('status') ?? ($skill['status'] ?? 'active');
                ?>

                <form action="<?= $actionUrl ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="form-grid">
                        <div class="left-column">
                            <div class="form-group">
                                <label for="name">Nama Skill *</label>
                                <input type="text" id="name" name="name" placeholder="Contoh: Python" value="<?= esc($name) ?>" required>
                                <small>Nama skill (min 2 karakter)</small>
                            </div>

                            <div class="form-group">
                                <label for="category">Kategori *</label>
                                <input type="text" id="category" name="category" placeholder="Contoh: Programming" value="<?= esc($category) ?>" list="cats" required>
                                <datalist id="cats">
                                    <option value="Programming"><option value="Framework"><option value="Database">
                                    <option value="Tools"><option value="Cloud"><option value="Design">
                                </datalist>
                                <small>Kategori untuk grouping (Hard Skills, Soft Skills, Tools, dll)</small>
                            </div>

                            <div class="form-group">
                                <label for="level">Level Kemampuan (%) *</label>
                                <div style="display:flex; align-items:center; gap:16px;">
                                    <input type="range" id="levelRange" min="0" max="100" value="<?= esc($level) ?>" 
                                           oninput="document.getElementById('level').value = this.value; document.getElementById('levelDisplay').textContent = this.value + '%'"
                                           style="flex:1; height:8px; border-radius:4px; background:#e0e0e0; cursor:pointer;">
                                    <span id="levelDisplay" style="font-weight:600; font-size:20px; color:#007BFF; min-width:60px; text-align:right;"><?= esc($level) ?>%</span>
                                </div>
                                <input type="hidden" id="level" name="level" value="<?= esc($level) ?>" required>
                                <small>Geser slider untuk menentukan persentase kemampuan (0-100%)</small>
                            </div>

                            <div class="form-group">
                                <label for="icon">Icon (Iconify)</label>
                                <div style="display:flex; gap:12px; align-items:center;">
                                    <input type="text" id="icon" name="icon" placeholder="logos:python" value="<?= esc($icon) ?>" style="flex:1;" oninput="preview()">
                                    <div id="prev" style="width:48px; height:48px; border:1px solid #ddd; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:32px;">
                                        <?php if ($icon): ?><iconify-icon icon="<?= esc($icon) ?>"></iconify-icon>
                                        <?php else: ?><span style="font-size:12px; color:#999;">?</span><?php endif; ?>
                                    </div>
                                </div>
                                <small>Cari di <a href="https://icon-sets.iconify.design/" target="_blank" style="color:#007BFF;">Iconify</a></small>
                            </div>
                        </div>

                        <div class="right-column">
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea id="description" name="description" rows="4" placeholder="Deskripsi skill..."><?= esc($desc) ?></textarea>
                                <small>Max 500 karakter (opsional)</small>
                            </div>

                            <div class="form-group">
                                <label for="order_index">Urutan</label>
                                <input type="number" id="order_index" name="order_index" value="<?= esc($order) ?>" min="0">
                                <small>Urutan tampilan (0 = paling awal)</small>
                            </div>

                            <div class="form-group">
                                <label>Status *</label>
                                <div class="status-radio-group">
                                    <label class="status-option">
                                        <input type="radio" name="status" value="active" <?= strtolower($status) == 'active' ? 'checked' : '' ?>>
                                        <span class="custom-radio"></span>
                                        <div class="status-text"><strong>Active</strong><small>Tampil di frontend</small></div>
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status" value="inactive" <?= strtolower($status) == 'inactive' ? 'checked' : '' ?>>
                                        <span class="custom-radio"></span>
                                        <div class="status-text"><strong>Inactive</strong><small>Tidak tampil</small></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <iconify-icon icon="solar:diskette-bold"></iconify-icon><span>Simpan</span>
                        </button>
                        <a href="<?= base_url('admin/skills') ?>" class="btn-cancel">Batal</a>
                    </div>
                </form>
            </div>

            <footer class="footer">Copyright: © 2026 Faiq • Data Scientist & AI Developer</footer>
        </main>
    </div>

    <script>
        function preview() {
            const val = document.getElementById('icon').value.trim();
            document.getElementById('prev').innerHTML = val ? `<iconify-icon icon="${val}"></iconify-icon>` : '<span style="font-size:12px;color:#999;">?</span>';
        }
    </script>
</body>
</html>
