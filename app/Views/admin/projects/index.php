<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Faiq | Admin Projects') ?></title>

    <!-- Link CSS - Project -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/project.css') ?>">

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
                    <h1>Projects</h1>
                    <p>Kelola semua portofolio dengan mudah!</p>
                </div>

                <a href="<?= base_url('admin/project/create') ?>" class="btn-primary">
                    <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
                    Tambah Project
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
                        <h4>Total Project</h4>
                        <h2 class="stat-number blue"><?= $totalProjects ?? 12 ?></h2>
                    </div>

                    <div class="icon blue">
                        <iconify-icon icon="solar:users-group-rounded-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Publikasi</h4>
                        <h2 class="stat-number red"><?= $publishedCount ?? 12 ?></h2>
                    </div>

                    <div class="icon red">
                        <iconify-icon icon="solar:folder-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Draf</h4>
                        <h2 class="stat-number yellow"><?= $draftCount ?? 5 ?></h2>
                    </div>

                    <div class="icon yellow">
                        <iconify-icon icon="solar:code-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Archived</h4>
                        <h2 class="stat-number green"><?= $archivedCount ?? 5 ?></h2>
                    </div>

                    <div class="icon green">
                        <iconify-icon icon="solar:gallery-bold"></iconify-icon>
                    </div>
                </div>

            </section>

            <!-- ================= Table ================= -->
            <section class="card table-card">

                <div class="table-header">

                    <h2>Semua Project</h2>

                    <div class="table-action">

                        <div class="search-box">

                            <iconify-icon icon="solar:magnifer-outline"></iconify-icon>

                            <input
                                type="text"
                                placeholder="Search Project">

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
                            <th>Project</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($projects)): ?>
                            <?php foreach ($projects as $index => $item): ?>

                                <tr>

                                    <td><?= $index + 1 ?>.</td>

                                    <td>

                                        <div class="project-info">

                                            <?php if (!empty($item['thumbnail'])): ?>
                                                <img src="<?= base_url('uploads/projects/' . $item['thumbnail']) ?>" alt="Project">
                                            <?php else: ?>
                                                <div class="thumb-placeholder"></div>
                                            <?php endif; ?>

                                            <div>

                                                <h4><?= esc($item['title']) ?></h4>

                                                <small>
                                                    <?= esc($item['description'] ?? 'Website portofolio pribadi dengan desain moderen') ?>
                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    <td>

                                        <span class="badge-blue">
                                            <?= esc($item['category'] ?? 'Web Development') ?>
                                        </span>

                                    </td>

                                    <td>

                                        <?php 
                                            $st = strtolower($item['status'] ?? 'published');
                                        ?>
                                        <?php if ($st === 'published'): ?>
                                            <span class="badge-green">Published</span>
                                        <?php elseif ($st === 'draft'): ?>
                                            <span class="badge-warning" style="background:#FFECCC; color:#B8860B; padding:4px 14px; border-radius:20px; font-size:12px; font-weight:500;">Draft</span>
                                        <?php else: ?>
                                            <span class="badge-gray" style="background:#E5E5EA; color:#8E8E93; padding:4px 14px; border-radius:20px; font-size:12px; font-weight:500;">Archived</span>
                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?= !empty($item['created_at']) ? date('d M Y', strtotime($item['created_at'])) : '22 Mei 2026' ?>

                                    </td>

                                    <td>

                                        <div class="action-button">

                                            <a href="<?= !empty($item['github']) ? esc($item['github']) : '#' ?>" target="_blank" class="btn-view" title="Lihat Project">

                                                <iconify-icon
                                                    icon="solar:eye-outline">
                                                </iconify-icon>

                                            </a>

                                            <a href="<?= base_url('admin/project/edit/' . $item['id']) ?>" class="btn-edit" title="Edit Project">

                                                <iconify-icon
                                                    icon="solar:pen-outline">
                                                </iconify-icon>

                                            </a>

                                            <a href="<?= base_url('admin/project/delete/' . $item['id']) ?>" class="btn-delete" title="Hapus Project" onclick="return confirm('Apakah Anda yakin ingin menghapus project ini?');">

                                                <iconify-icon
                                                    icon="solar:trash-bin-trash-outline">
                                                </iconify-icon>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>
                        <?php endif; ?>

                    </tbody>

                </table>

                <!-- Footer Table -->
                <div class="table-footer">

                    <p>
                        Menampilkan 1 - <?= count($projects ?? []) ?> dari <?= $totalProjects ?? 12 ?> project
                    </p>

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