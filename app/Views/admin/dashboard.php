<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Faiq | Admin') ?></title>

    <!-- Link CSS - Dashboard -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css?v=2.1') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Iconify for Tech Stack Icons -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
</head>

<body>

    <div class="container">

        <!-- ================= Sidebar ================= -->
        <aside class="sidebar">

            <div class="logo">
                <h2>Faiq <span>| Data Science</span></h2>
            </div>

            <nav class="sidebar-menu">

                <a href="<?= base_url('admin/dashboard') ?>" class="active">
                    <iconify-icon icon="solar:widget-5-bold"></iconify-icon>
                    <span>Dasboard</span>
                </a>

                <a href="<?= base_url('admin/project') ?>">
                    <iconify-icon icon="solar:folder-outline"></iconify-icon>
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
                <h1>Dashboard</h1>
                <p>Selamat datang Faiq</p>
            </section>

            <!-- Statistik -->
            <section class="stats-grid">

                <div class="card stat-card">
                    <div>
                        <h4>Total Pengunjung</h4>
                        <h2 class="stat-number purple"><?= $totalVisitors ?? 0 ?></h2>
                        <small style="color:#666; font-size:12px;">Sepanjang Masa</small>
                    </div>

                    <div class="icon purple">
                        <iconify-icon icon="solar:users-group-rounded-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Hari Ini</h4>
                        <h2 class="stat-number blue"><?= $visitorsToday ?? 0 ?></h2>
                        <small style="color:#666; font-size:12px;">Pengunjung Hari Ini</small>
                    </div>

                    <div class="icon blue">
                        <iconify-icon icon="solar:calendar-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Minggu Ini</h4>
                        <h2 class="stat-number green"><?= $visitorsThisWeek ?? 0 ?></h2>
                        <small style="color:#666; font-size:12px;">Pengunjung Minggu Ini</small>
                    </div>

                    <div class="icon green">
                        <iconify-icon icon="solar:graph-up-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Bulan Ini</h4>
                        <h2 class="stat-number orange"><?= $visitorsThisMonth ?? 0 ?></h2>
                        <small style="color:#666; font-size:12px;">Pengunjung Bulan Ini</small>
                    </div>

                    <div class="icon orange">
                        <iconify-icon icon="solar:chart-2-bold"></iconify-icon>
                    </div>
                </div>

            </section>

            <!-- Grafik -->
            <section class="chart-grid">

                <div class="card chart-card">

                    <div class="card-header">
                        <h3>Statistik Kunjungan</h3>
                    </div>

                    <div class="card-body">
                        <canvas id="visitChart"></canvas>
                    </div>

                </div>

                <div class="card summary-card">

                    <div class="card-header">
                        <h3>Ringkasan</h3>
                    </div>

                    <div class="summary-content">

                        <div class="donut-wrapper">
                            <canvas id="summaryChart"></canvas>
                        </div>

                        <ul class="legend-list">

                            <li>
                                <span class="dot blue"></span>
                                Skills: <strong><?= $totalSkills ?? 0 ?></strong>
                            </li>

                            <li>
                                <span class="dot red"></span>
                                Project: <strong><?= $totalProjects ?? 0 ?></strong>
                            </li>

                            <li>
                                <span class="dot yellow"></span>
                                Certificate: <strong><?= $totalCertificates ?? 0 ?></strong>
                            </li>

                            <li>
                                <span class="dot green"></span>
                                Published: <strong><?= $publishedProjects ?? 0 ?></strong>
                            </li>

                        </ul>

                    </div>

                </div>

            </section>

            <!-- Bottom -->
            <section class="bottom-grid">

                <div class="card latest-project">

                    <div class="card-header">
                        <h3>Project Terbaru</h3>
                        <a href="<?= base_url('admin/project') ?>" class="view-all-link">
                            Lihat Semua
                            <iconify-icon icon="solar:arrow-right-linear"></iconify-icon>
                        </a>
                    </div>

                    <div class="project-list">
                        <?php if (!empty($recentProjects)): ?>
                            <?php foreach ($recentProjects as $project): ?>
                                <div class="project-item">
                                    <?php if (!empty($project['thumbnail'])): ?>
                                        <img src="<?= base_url('uploads/projects/' . $project['thumbnail']) ?>" alt="<?= esc($project['title']) ?>" class="thumb" style="width:60px; height:60px; object-fit:cover; border-radius:8px;">
                                    <?php else: ?>
                                        <div class="thumb"></div>
                                    <?php endif; ?>

                                    <div class="project-info">
                                        <h4><?= esc($project['title']) ?></h4>
                                        <small><?= !empty($project['created_at']) ? date('d M Y', strtotime($project['created_at'])) : '-' ?></small>
                                    </div>

                                    <?php 
                                        $statusClass = strtolower($project['status'] ?? 'draft') === 'published' ? 'success' : 'warning';
                                        $statusText = ucfirst($project['status'] ?? 'Draft');
                                    ?>
                                    <span class="badge <?= $statusClass ?>">
                                        <?= $statusText ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div style="text-align:center; padding:40px 20px; color:#999;">
                                <iconify-icon icon="solar:folder-bold" style="font-size:48px; color:#ddd;"></iconify-icon>
                                <p style="margin-top:12px;">Belum ada project</p>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

                <!-- Aktivitas -->
                <div class="card latest-activity">

                    <div class="card-header">
                        <h3>Aktivitas Terbaru</h3>
                    </div>

                    <div class="activity-list">
                        
                        <!-- Recent Projects -->
                        <?php if (!empty($recentProjects)): ?>
                            <?php foreach (array_slice($recentProjects, 0, 2) as $project): ?>
                                <div class="activity-item">
                                    <div class="activity-icon red">
                                        <iconify-icon icon="solar:folder-bold"></iconify-icon>
                                    </div>
                                    <div class="activity-info">
                                        <h4>Project "<?= esc($project['title']) ?>" ditambahkan</h4>
                                    </div>
                                    <small><?= !empty($project['created_at']) ? date('d M Y, H:i', strtotime($project['created_at'])) : '-' ?></small>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Recent Skills -->
                        <?php if (!empty($recentSkills)): ?>
                            <?php foreach (array_slice($recentSkills, 0, 1) as $skill): ?>
                                <div class="activity-item">
                                    <div class="activity-icon yellow">
                                        <iconify-icon icon="solar:code-bold"></iconify-icon>
                                    </div>
                                    <div class="activity-info">
                                        <h4>Skill "<?= esc($skill['name']) ?>" ditambahkan</h4>
                                    </div>
                                    <small><?= !empty($skill['created_at']) ? date('d M Y, H:i', strtotime($skill['created_at'])) : '-' ?></small>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Recent Certificates -->
                        <?php if (!empty($recentCertificates)): ?>
                            <?php foreach (array_slice($recentCertificates, 0, 1) as $cert): ?>
                                <div class="activity-item">
                                    <div class="activity-icon green">
                                        <iconify-icon icon="solar:diploma-verified-bold"></iconify-icon>
                                    </div>
                                    <div class="activity-info">
                                        <h4>Certificate "<?= esc($cert['title']) ?>" ditambahkan</h4>
                                    </div>
                                    <small><?= !empty($cert['created_at']) ? date('d M Y, H:i', strtotime($cert['created_at'])) : '-' ?></small>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Empty State -->
                        <?php if (empty($recentProjects) && empty($recentSkills) && empty($recentCertificates)): ?>
                            <div style="text-align:center; padding:40px 20px; color:#999;">
                                <iconify-icon icon="solar:bell-bold" style="font-size:48px; color:#ddd;"></iconify-icon>
                                <p style="margin-top:12px;">Belum ada aktivitas</p>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>

            </section>

            <!-- Footer -->
            <footer class="footer">
                Copyright: © 2026 Faiq • Data Scientist & AI Developer. All rights reserved.
            </footer>

        </main>

    </div>

    <!-- Charts Script -->
    <script>
        // Data dari Controller
        const chartLabels = <?= $chartLabels ?? '["Mon","Tue","Wed","Thu","Fri","Sat","Sun"]' ?>;
        const chartData = <?= $chartData ?? '[0,0,0,0,0,0,0]' ?>;

        // Line Chart - Statistik Kunjungan
        const visitCtx = document.getElementById('visitChart').getContext('2d');
        const gradient = visitCtx.createLinearGradient(0, 0, 0, 250);
        gradient.addColorStop(0, 'rgba(0, 136, 255, 0.35)');
        gradient.addColorStop(1, 'rgba(0, 136, 255, 0.02)');

        // Calculate max value for Y axis
        const maxDataValue = Math.max(...chartData);
        const yAxisMax = maxDataValue > 0 ? Math.ceil(maxDataValue / 100) * 100 + 100 : 300;

        new Chart(visitCtx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Pengunjung',
                    data: chartData,
                    borderColor: '#0088FF',
                    backgroundColor: gradient,
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#0088FF',
                    pointBorderColor: '#FFFFFF',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: yAxisMax,
                        ticks: {
                            stepSize: Math.ceil(yAxisMax / 3),
                            color: '#54555A',
                            font: { family: 'Inter', size: 12 }
                        },
                        grid: { color: '#DBDEE4' },
                        border: { color: '#54555A' }
                    },
                    x: {
                        ticks: {
                            color: '#54555A',
                            font: { family: 'Inter', size: 12 }
                        },
                        grid: { display: false },
                        border: { color: '#54555A' }
                    }
                }
            }
        });

        // Doughnut Chart - Ringkasan
        const summaryCtx = document.getElementById('summaryChart').getContext('2d');
        
        // Data dinamis dari controller
        const totalSkills = <?= $totalSkills ?? 0 ?>;
        const totalProjects = <?= $totalProjects ?? 0 ?>;
        const totalCertificates = <?= $totalCertificates ?? 0 ?>;
        const publishedProjects = <?= $publishedProjects ?? 0 ?>;
        
        new Chart(summaryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Skills', 'Project', 'Certificate', 'Published'],
                datasets: [{
                    data: [totalSkills, totalProjects, totalCertificates, publishedProjects],
                    backgroundColor: ['#0088FF', '#FF383C', '#FFCC00', '#34C759'],
                    borderWidth: 0,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>

</body>

</html>