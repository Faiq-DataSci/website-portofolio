<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin Certificate | Faiq Portfolio') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/skills.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
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
                <a href="<?= base_url('admin/certificates') ?>" class="active">
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

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <section class="page-header">
                <div>
                    <h1>Certificate</h1>
                    <p>Kelola semua certificate yang ditampilkan di portofolio</p>
                </div>
                <a href="<?= base_url('admin/certificates/create') ?>" class="btn-primary">
                    <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
                    Tambah Certificate
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
                        <h4>Total Certificate</h4>
                        <h2 class="stat-number blue"><?= $totalCertificate ?? 0 ?></h2>
                    </div>
                    <div class="icon blue">
                        <iconify-icon icon="solar:diploma-verified-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Aktif</h4>
                        <h2 class="stat-number red"><?= $totalActive ?? 0 ?></h2>
                    </div>
                    <div class="icon red">
                        <iconify-icon icon="solar:check-circle-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Ditampilkan</h4>
                        <h2 class="stat-number yellow"><?= $totalShow ?? 0 ?></h2>
                    </div>
                    <div class="icon yellow">
                        <iconify-icon icon="solar:eye-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Tersembunyi</h4>
                        <h2 class="stat-number green"><?= $totalHidden ?? 0 ?></h2>
                    </div>
                    <div class="icon green">
                        <iconify-icon icon="solar:eye-closed-bold"></iconify-icon>
                    </div>
                </div>
            </section>

            <!-- Table -->
            <section class="card table-card">
                <div class="table-header">
                    <h2>Semua Certificate</h2>
                    <div class="table-action">
                        <div class="search-box">
                            <iconify-icon icon="solar:magnifer-outline"></iconify-icon>
                            <input type="text" placeholder="Search Certificate">
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
                            <th>Preview</th>
                            <th>Certificate</th>
                            <th>Penerbit</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Tampil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($certificates) && count($certificates) > 0): ?>
                            <?php foreach ($certificates as $index => $cert): ?>
                                <tr>
                                    <td><?= $index + 1 ?>.</td>
                                    <td>
                                        <?php if (!empty($cert['image']) && $cert['image'] !== 'default.jpg'): ?>
                                            <img class="table-image" src="<?= base_url('uploads/certificates/' . $cert['image']) ?>" alt="<?= esc($cert['title']) ?>" style="width:60px; height:60px; object-fit:cover; border-radius:8px;">
                                        <?php else: ?>
                                            <div style="width:60px; height:60px; background:#f0f0f0; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                                <iconify-icon icon="solar:diploma-bold" style="font-size:24px; color:#ccc;"></iconify-icon>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="skill-info">
                                            <strong><?= esc($cert['title']) ?></strong>
                                            <?php if (!empty($cert['description'])): ?>
                                                <small style="display:block; color:#666; margin-top:4px;">
                                                    <?= esc(mb_substr($cert['description'], 0, 50)) ?><?= mb_strlen($cert['description']) > 50 ? '...' : '' ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if (!empty($cert['issuer'])): ?>
                                            <span class="badge-blue"><?= esc($cert['issuer']) ?></span>
                                        <?php else: ?>
                                            <span style="color:#999;">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($cert['issue_date'])): ?>
                                            <?= date('d M Y', strtotime($cert['issue_date'])) ?>
                                        <?php else: ?>
                                            <span style="color:#999;">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($cert['status']) && strtolower($cert['status']) === 'active'): ?>
                                            <span class="badge-green">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge-gray">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($cert['is_show']) && $cert['is_show'] == 1): ?>
                                            <span class="badge-green">Ya</span>
                                        <?php else: ?>
                                            <span class="badge-gray">Tidak</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="action-button">
                                            <a href="<?= base_url('admin/certificates/edit/' . $cert['id']) ?>" class="btn-edit" title="Edit Certificate">
                                                <iconify-icon icon="solar:pen-outline"></iconify-icon>
                                            </a>
                                            <a href="<?= base_url('admin/certificates/delete/' . $cert['id']) ?>" class="btn-delete" title="Hapus Certificate" onclick="return confirm('Apakah Anda yakin ingin menghapus certificate ini?');">
                                                <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" style="text-align:center; padding:60px 20px; color:#999;">
                                    <iconify-icon icon="solar:diploma-bold" style="font-size:64px; color:#ddd; display:block; margin:0 auto 16px;"></iconify-icon>
                                    <h3 style="color:#666; margin-bottom:8px;">Belum Ada Certificate</h3>
                                    <p>Klik tombol "Tambah Certificate" untuk menambahkan data</p>
                                </td>
                            </tr>
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
