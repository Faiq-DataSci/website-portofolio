<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Faiq | Admin Gambar') ?></title>

    <!-- Link CSS - Gambar -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/gambar.css') ?>">

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

            <!-- Header -->
            <section class="page-header">

                <div>
                    <h1>Gambar</h1>
                    <p>Kelola semua gambar yang ditampilkan di portofolio</p>
                </div>

                <a href="<?= base_url('admin/gallery/create') ?>" class="btn-primary">
                    <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
                    Tambah Gambar
                </a>

            </section>

            <!-- Flash Alert Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success" style="background:#D4F5DD; color:#1B8A3A; padding:12px 16px; border-radius:10px; margin-bottom:20px; font-weight:500; display:flex; align-items:center; gap:10px;">
                    <iconify-icon icon="solar:check-circle-bold" style="font-size:20px;"></iconify-icon>
                    <span><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error" style="background:#FFD5D6; color:#D32F2F; padding:12px 16px; border-radius:10px; margin-bottom:20px; font-weight:500; display:flex; align-items:center; gap:10px;">
                    <iconify-icon icon="solar:danger-circle-bold" style="font-size:20px;"></iconify-icon>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <!-- Statistik -->
            <section class="stats-grid">

                <div class="card stat-card">
                    <div>
                        <h4>Total Gambar</h4>
                        <h2 class="stat-number blue"><?= $totalImage ?? 12 ?></h2>
                    </div>

                    <div class="icon blue">
                        <iconify-icon icon="solar:users-group-rounded-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Total Aktif</h4>
                        <h2 class="stat-number red"><?= $totalActive ?? 12 ?></h2>
                    </div>

                    <div class="icon red">
                        <iconify-icon icon="solar:folder-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Total Ditampilkan</h4>
                        <h2 class="stat-number yellow"><?= $totalShow ?? 5 ?></h2>
                    </div>

                    <div class="icon yellow">
                        <iconify-icon icon="solar:code-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Tersembunyi</h4>
                        <h2 class="stat-number green"><?= $totalHidden ?? 5 ?></h2>
                    </div>

                    <div class="icon green">
                        <iconify-icon icon="solar:gallery-bold"></iconify-icon>
                    </div>
                </div>

            </section>

            <!-- ================= Table ================= -->
            <section class="card table-card">

                <div class="table-header">

                    <h2>Semua Gambar</h2>

                    <div class="table-action">

                        <div class="search-box">
                            <iconify-icon icon="solar:magnifer-outline"></iconify-icon>
                            <input type="text" placeholder="Search Project">
                        </div>

                        <button class="btn-filter">
                            <iconify-icon icon="solar:filter-outline"></iconify-icon>
                            Filter
                        </button>

                    </div>

                </div>

                <table>

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Gambar</th>
                            <th>Kategori</th>
                            <th>Ukuran</th>
                            <th>Status</th>
                            <th>Ditampilkan</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($images)): ?>
                            <?php foreach ($images as $index => $image): ?>
                                <tr>
                                    <td><?= $index + 1 ?>.</td>
                                    <td>
                                        <img class="table-image" src="<?= base_url('uploads/gallery/' . $image['image']) ?>" alt="<?= esc($image['title']) ?>">
                                    </td>
                                    <td>
                                        <div class="image-info">
                                            <h4><?= esc($image['title']) ?></h4>
                                            <small><?= esc(mb_substr(strip_tags($image['description'] ?? ''), 0, 40)) ?><?= mb_strlen(strip_tags($image['description'] ?? '')) > 40 ? '...' : '' ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-blue"><?= esc($image['category'] ?? 'Home') ?></span>
                                    </td>
                                    <td><?= esc($image['size'] ?? '450 KB') ?></td>
                                    <td>
                                        <span class="badge-green"><?= ($image['status'] ?? 'active') == 'active' ? 'Aktif' : 'Nonaktif' ?></span>
                                    </td>
                                    <td>
                                        <span class="is-show-status">
                                            <iconify-icon icon="solar:check-circle-linear" class="check-icon"></iconify-icon>
                                            Ya
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-button">
                                            <a href="<?= base_url('uploads/gallery/' . $image['image']) ?>" target="_blank" class="btn-view" title="Lihat Gambar">
                                                <iconify-icon icon="solar:eye-outline"></iconify-icon>
                                            </a>
                                            <a href="<?= base_url('admin/gallery/edit/' . $image['id']) ?>" class="btn-edit" title="Edit Gambar">
                                                <iconify-icon icon="solar:pen-outline"></iconify-icon>
                                            </a>
                                            <a href="<?= base_url('admin/gallery/delete/' . $image['id']) ?>" class="btn-delete" title="Hapus Gambar" onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini?');">
                                                <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <tr>
                                    <td><?= $i ?>.</td>
                                    <td>
                                        <div class="thumb-placeholder"></div>
                                    </td>
                                    <td>
                                        <div class="image-info">
                                            <h4>Foto Diri</h4>
                                            <small>Foto diri ini adalah...</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-blue">Home</span>
                                    </td>
                                    <td>450 KB</td>
                                    <td>
                                        <span class="badge-green">Aktif</span>
                                    </td>
                                    <td>
                                        <span class="is-show-status">
                                            <iconify-icon icon="solar:check-circle-linear" class="check-icon"></iconify-icon>
                                            Ya
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-button">
                                            <a href="#" class="btn-view" title="Lihat Gambar">
                                                <iconify-icon icon="solar:eye-outline"></iconify-icon>
                                            </a>
                                            <a href="<?= base_url('admin/gallery/edit/' . $i) ?>" class="btn-edit" title="Edit Gambar">
                                                <iconify-icon icon="solar:pen-outline"></iconify-icon>
                                            </a>
                                            <a href="<?= base_url('admin/gallery/delete/' . $i) ?>" class="btn-delete" title="Hapus Gambar" onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini?');">
                                                <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        <?php endif; ?>

                    </tbody>

                </table>

                <!-- Footer Table -->
                <div class="table-footer">

                    <p>Menampilkan 1 - 5</p>

                    <div class="pagination">
                        <a href="#">
                            <iconify-icon icon="solar:alt-arrow-left-outline"></iconify-icon>
                        </a>
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">
                            <iconify-icon icon="solar:alt-arrow-right-outline"></iconify-icon>
                        </a>
                    </div>

                </div>

            </section>

            <!-- Footer -->
            <footer class="footer">
                Copyright: © 2026 Faiq • Data Scientist & AI Developer. All rights reserved.
            </footer>

        </main>

    </div>

</body>

</html>