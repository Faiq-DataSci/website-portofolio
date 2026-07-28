<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Faiq | Admin Skills') ?></title>

    <!-- Link CSS - Skills -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/skills.css') ?>">

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

            <!-- Header -->
            <section class="page-header">

                <div>
                    <h1>Skills</h1>
                    <p>kelola semua skills yang ditampilkan di portofolio</p>
                </div>

                <a href="<?= base_url('admin/skills/create') ?>" class="btn-primary">
                    <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
                    Tambah Skills
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
                        <h4>Total Skills</h4>
                        <h2 class="stat-number blue"><?= $totalSkills ?? 12 ?></h2>
                    </div>

                    <div class="icon blue">
                        <iconify-icon icon="solar:users-group-rounded-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Aktif</h4>
                        <h2 class="stat-number red"><?= $totalActive ?? 12 ?></h2>
                    </div>

                    <div class="icon red">
                        <iconify-icon icon="solar:folder-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Nonaktif</h4>
                        <h2 class="stat-number yellow"><?= $totalInactive ?? 5 ?></h2>
                    </div>

                    <div class="icon yellow">
                        <iconify-icon icon="solar:code-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Kategori</h4>
                        <h2 class="stat-number green"><?= $totalCategory ?? 5 ?></h2>
                    </div>

                    <div class="icon green">
                        <iconify-icon icon="solar:gallery-bold"></iconify-icon>
                    </div>
                </div>

            </section>

            <!-- ================= Table ================= -->
            <section class="card table-card">

                <div class="table-header">

                    <h2>Semua Skills</h2>

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
                            <th>Skills</th>
                            <th>Kategori</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($skills)): ?>
                            <?php foreach ($skills as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?>.</td>

                                    <td>
                                        <div class="skill-info">
                                            <?php 
                                                $iconValue = $item['icon'] ?? 'logos:react';
                                                if (strpos($iconValue, ':') === false && $iconValue !== 'more') {
                                                    $iconValue = 'logos:' . $iconValue;
                                                } elseif ($iconValue === 'more') {
                                                    $iconValue = 'solar:menu-dots-bold';
                                                }
                                            ?>
                                            <iconify-icon icon="<?= esc($iconValue) ?>" class="skill-logo"></iconify-icon>
                                            <span><?= esc($item['name']) ?></span>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge-blue"><?= esc($item['category'] ?? 'Frontend') ?></span>
                                    </td>

                                    <td>
                                        <div class="progress-wrapper">
                                            <span class="progress-text"><?= esc($item['level']) ?>%</span>
                                            <div class="progress-bar-bg">
                                                <div class="progress-bar-fill" style="width: <?= (int)$item['level'] ?>%;"></div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <?php if (!empty($item['status']) && $item['status'] == 1): ?>
                                            <span class="badge-green">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge-gray">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <div class="action-button">
                                            <a href="<?= base_url('admin/skills/edit/' . $item['id']) ?>" class="btn-edit" title="Edit Skill">
                                                <iconify-icon icon="solar:pen-outline"></iconify-icon>
                                            </a>
                                            <a href="<?= base_url('admin/skills/delete/' . $item['id']) ?>" class="btn-delete" title="Hapus Skill" onclick="return confirm('Apakah Anda yakin ingin menghapus skill ini?');">
                                                <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </tbody>

                </table>

            </section>

            <!-- Footer -->
            <footer class="footer">
                Copyright: © 2026 Faiq • Data Scientist & AI Developer. All rights reserved.
            </footer>

        </main>

    </div>

</body>

</html>