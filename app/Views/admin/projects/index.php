<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Faiq | Admin Projects') ?></title>

    <!-- Link CSS - Project -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/project.css?v=2.0') ?>">

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
                        <h2 class="stat-number blue"><?= $totalProjects ?? 0 ?></h2>
                    </div>

                    <div class="icon blue">
                        <iconify-icon icon="solar:folder-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Published</h4>
                        <h2 class="stat-number green"><?= $publishedCount ?? 0 ?></h2>
                    </div>

                    <div class="icon green">
                        <iconify-icon icon="solar:check-circle-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Draft</h4>
                        <h2 class="stat-number yellow"><?= $draftCount ?? 0 ?></h2>
                    </div>

                    <div class="icon yellow">
                        <iconify-icon icon="solar:file-text-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Archived</h4>
                        <h2 class="stat-number red"><?= $archivedCount ?? 0 ?></h2>
                    </div>

                    <div class="icon red">
                        <iconify-icon icon="solar:archive-bold"></iconify-icon>
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

                        <?php if (!empty($projects) && count($projects) > 0): ?>
                            <?php foreach ($projects as $index => $item): ?>

                                <tr>

                                    <td><?= $index + 1 ?>.</td>

                                    <td>

                                        <div class="project-info">

                                            <?php if (!empty($item['thumbnail'])): ?>
                                                <img src="<?= base_url('uploads/projects/' . $item['thumbnail']) ?>" alt="Project">
                                            <?php else: ?>
                                                <div class="thumb-placeholder" style="width:50px; height:50px; background:#f0f0f0; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                                    <iconify-icon icon="solar:gallery-outline" style="font-size:24px; color:#ccc;"></iconify-icon>
                                                </div>
                                            <?php endif; ?>

                                            <div>

                                                <h4><?= esc($item['title']) ?></h4>

                                                <small style="color:#8E8E93; font-size:13px;">
                                                    <?php 
                                                        $desc = $item['description'] ?? 'Belum ada deskripsi';
                                                        echo esc(mb_substr($desc, 0, 60));
                                                        echo mb_strlen($desc) > 60 ? '...' : '';
                                                    ?>
                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    <td>
                                        <?php 
                                            $category = $item['category'] ?? 'Web Development';
                                            // Determine gradient class based on category
                                            $categoryClass = 'category-default';
                                            if ($category === 'Web Development') $categoryClass = 'category-web';
                                            elseif ($category === 'Machine Learning') $categoryClass = 'category-ml';
                                            elseif ($category === 'Data Science') $categoryClass = 'category-ds';
                                            elseif ($category === 'Mobile App') $categoryClass = 'category-mobile';
                                            elseif ($category === 'Desktop App') $categoryClass = 'category-desktop';
                                        ?>
                                        <span class="badge-category <?= $categoryClass ?>">
                                            <?= esc($category) ?>
                                        </span>
                                    </td>

                                    <td>

                                        <?php 
                                            $st = strtolower($item['status'] ?? 'published');
                                        ?>
                                        <?php if ($st === 'published'): ?>
                                            <span class="badge-green" style="background:#D4F5DD; color:#1B8A3A; padding:4px 14px; border-radius:20px; font-size:12px; font-weight:500;">Published</span>
                                        <?php elseif ($st === 'draft'): ?>
                                            <span class="badge-warning" style="background:#FFECCC; color:#B8860B; padding:4px 14px; border-radius:20px; font-size:12px; font-weight:500;">Draft</span>
                                        <?php else: ?>
                                            <span class="badge-gray" style="background:#E5E5EA; color:#8E8E93; padding:4px 14px; border-radius:20px; font-size:12px; font-weight:500;">Archived</span>
                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?= !empty($item['created_at']) ? date('d M Y', strtotime($item['created_at'])) : '-' ?>

                                    </td>

                                    <td>

                                        <div class="action-button">

                                            <a href="<?= !empty($item['github']) ? esc($item['github']) : '#' ?>" target="_blank" class="btn-view" title="Lihat Project" <?= empty($item['github']) ? 'style="opacity:0.5; pointer-events:none;"' : '' ?>>

                                                <iconify-icon
                                                    icon="solar:eye-outline">
                                                </iconify-icon>

                                            </a>

                                            <a href="<?= base_url('admin/project/edit/' . $item['id']) ?>" class="btn-edit" title="Edit Project">

                                                <iconify-icon
                                                    icon="solar:pen-outline">
                                                </iconify-icon>

                                            </a>

                                            <a href="<?= base_url('admin/project/delete/' . $item['id']) ?>" 
                                               class="btn-delete" 
                                               title="Hapus Project" 
                                               onclick="return confirmDelete('<?= esc($item['title'], 'js') ?>');">

                                                <iconify-icon
                                                    icon="solar:trash-bin-trash-outline">
                                                </iconify-icon>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Empty State -->
                            <tr>
                                <td colspan="6" style="text-align:center; padding:60px 20px; background:#FAFAFA; border-radius:12px;">
                                    <div style="display:flex; flex-direction:column; align-items:center; gap:16px;">
                                        <iconify-icon icon="solar:folder-open-outline" style="font-size:80px; color:#D0D0D0;"></iconify-icon>
                                        <div>
                                            <h3 style="color:#666; font-size:18px; margin:0 0 8px 0;">Belum Ada Project</h3>
                                            <p style="color:#999; font-size:14px; margin:0 0 20px 0;">Mulai tambahkan project pertama Anda untuk ditampilkan di portofolio</p>
                                            <a href="<?= base_url('admin/project/create') ?>" style="display:inline-flex; align-items:center; gap:8px; background:#007BFF; color:#fff; padding:10px 24px; border-radius:8px; text-decoration:none; font-weight:500; font-size:14px;">
                                                <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
                                                Tambah Project Pertama
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>

                </table>

                <!-- Footer Table -->
                <?php if (!empty($projects) && count($projects) > 0): ?>
                <div class="table-footer">

                    <p>
                        Menampilkan <strong>1 - <?= count($projects) ?></strong> dari <strong><?= $totalProjects ?></strong> project
                    </p>

                    <!-- Pagination (Coming Soon) -->
                    <!-- <div class="pagination">

                        <a href="#">
                            <iconify-icon icon="solar:alt-arrow-left-outline"></iconify-icon>
                        </a>

                        <a href="#" class="active">1</a>

                        <a href="#">2</a>

                        <a href="#">3</a>

                        <a href="#">
                            <iconify-icon icon="solar:alt-arrow-right-outline"></iconify-icon>
                        </a>

                    </div> -->

                </div>
                <?php endif; ?>

            </section>

            <!-- Footer -->
            <footer class="footer">
                Copyright: © 2026 Faiq • Data Scientist & AI Developer. All rights reserved.
            </footer>

        </main>

    </div>

    <script>
        function confirmDelete(projectTitle) {
            return confirm('Apakah Anda yakin ingin menghapus project "' + projectTitle + '"?\n\nTindakan ini tidak dapat dibatalkan.');
        }

        // Auto-hide flash messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>

</body>

</html>