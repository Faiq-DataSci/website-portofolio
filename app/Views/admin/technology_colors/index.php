<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Technology Colors | Admin') ?></title>

    <!-- Link CSS - Skills (reusing similar style) -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/skills.css') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Iconify for Icons -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <style>
        /* Additional styles for color preview */
        .color-badge {
            display: inline-block;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .tech-name-cell {
            font-weight: 600;
            color: #333;
        }

        .color-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .color-code {
            font-family: 'Courier New', monospace;
            font-size: 13px;
            color: #666;
            background: #f5f5f5;
            padding: 4px 8px;
            border-radius: 4px;
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

            <!-- Header -->
            <section class="page-header">

                <div>
                    <h1>Technology Colors</h1>
                    <p>Kelola warna untuk setiap teknologi yang ditampilkan di project</p>
                </div>

                <a href="<?= base_url('admin/technology-colors/create') ?>" class="btn-primary">
                    <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
                    Tambah Technology
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

                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <iconify-icon icon="solar:palette-bold"></iconify-icon>
                    </div>
                    <div class="stat-info">
                        <h3><?= $totalTech ?></h3>
                        <p>Total Technologies</p>
                    </div>
                </div>

            </section>

            <!-- Tabel Technology Colors -->
            <section class="card table-card">

                <div class="table-header">
                    <h2>Daftar Technology Colors</h2>
                    <div class="table-actions">
                        <div class="search-box">
                            <iconify-icon icon="solar:magnifer-outline"></iconify-icon>
                            <input type="text" id="searchInput" placeholder="Cari technology...">
                        </div>
                    </div>
                </div>

                <?php if (empty($technologies)): ?>
                    <div style="text-align:center; padding:60px 20px; color:#888;">
                        <iconify-icon icon="solar:palette-outline" style="font-size:80px; opacity:0.3;"></iconify-icon>
                        <h3 style="margin-top:20px; color:#666;">Belum ada technology colors</h3>
                        <p style="margin-top:8px;">Silakan tambahkan technology color untuk mulai mengatur warna</p>
                    </div>
                <?php else: ?>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 60px;">#</th>
                                    <th>Nama Technology</th>
                                    <th>Warna</th>
                                    <th style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="techTableBody">
                                <?php $no = 1; ?>
                                <?php foreach ($technologies as $tech): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td class="tech-name-cell"><?= esc($tech['name']) ?></td>
                                        <td>
                                            <div class="color-info">
                                                <div class="color-badge" style="background-color: <?= esc($tech['color']) ?>;"></div>
                                                <span class="color-code"><?= esc($tech['color']) ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="<?= base_url('admin/technology-colors/edit/' . $tech['id']) ?>" class="btn-action btn-edit" title="Edit">
                                                    <iconify-icon icon="solar:pen-bold"></iconify-icon>
                                                </a>
                                                <button onclick="confirmDelete(<?= $tech['id'] ?>, '<?= esc($tech['name']) ?>')" class="btn-action btn-delete" title="Hapus">
                                                    <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

            </section>

            <!-- Footer -->
            <footer class="footer">
                Copyright: © 2026 Faiq • Data Scientist & AI Developer. All rights reserved.
            </footer>

        </main>

    </div>

    <!-- Search Filter JS -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('techTableBody');
        
        if (searchInput && tableBody) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = tableBody.getElementsByTagName('tr');
                
                for (let row of rows) {
                    const techName = row.querySelector('.tech-name-cell');
                    if (techName) {
                        const text = techName.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                }
            });
        }
    </script>

    <!-- Delete Confirmation JS -->
    <script>
        function confirmDelete(id, name) {
            if (confirm(`Apakah Anda yakin ingin menghapus technology "${name}"?`)) {
                window.location.href = `<?= base_url('admin/technology-colors/delete/') ?>${id}`;
            }
        }
    </script>

</body>

</html>
