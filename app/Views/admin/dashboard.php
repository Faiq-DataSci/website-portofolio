<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Faiq | Admin') ?></title>

    <!-- Link CSS - Dashboard -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css') ?>">

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
                <h1>Dashboard</h1>
                <p>Selamat datang Faiq</p>
            </section>

            <!-- Statistik -->
            <section class="stats-grid">

                <div class="card stat-card">
                    <div>
                        <h4>Total Pengunjung</h4>
                        <h2 class="stat-number blue">12</h2>
                    </div>

                    <div class="icon blue">
                        <iconify-icon icon="solar:users-group-rounded-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Total Project</h4>
                        <h2 class="stat-number red">12</h2>
                    </div>

                    <div class="icon red">
                        <iconify-icon icon="solar:folder-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Total Skills</h4>
                        <h2 class="stat-number yellow">5</h2>
                    </div>

                    <div class="icon yellow">
                        <iconify-icon icon="solar:code-bold"></iconify-icon>
                    </div>
                </div>

                <div class="card stat-card">
                    <div>
                        <h4>Total Gambar</h4>
                        <h2 class="stat-number green">5</h2>
                    </div>

                    <div class="icon green">
                        <iconify-icon icon="solar:gallery-bold"></iconify-icon>
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
                                Pengunjung
                            </li>

                            <li>
                                <span class="dot red"></span>
                                Project
                            </li>

                            <li>
                                <span class="dot yellow"></span>
                                Skills
                            </li>

                            <li>
                                <span class="dot green"></span>
                                Gambar
                            </li>

                        </ul>

                    </div>

                </div>

            </section>

            <!-- Bottom -->
            <section class="bottom-grid">

                <!-- Project -->
                <div class="card latest-project">

                    <div class="card-header">
                        <h3>Project Terbaru</h3>
                    </div>

                    <div class="project-list">

                        <div class="project-item">

                            <div class="thumb"></div>

                            <div class="project-info">
                                <h4>Portofolio Website</h4>
                                <small>22 Mei 2024</small>
                            </div>

                            <span class="badge success">
                                Published
                            </span>

                        </div>

                        <div class="project-item">

                            <div class="thumb"></div>

                            <div class="project-info">
                                <h4>Portofolio Website</h4>
                                <small>22 Mei 2024</small>
                            </div>

                            <span class="badge warning">
                                Draft
                            </span>

                        </div>

                        <div class="project-item">

                            <div class="thumb"></div>

                            <div class="project-info">
                                <h4>Portofolio Website</h4>
                                <small>22 Mei 2024</small>
                            </div>

                            <span class="badge success">
                                Published
                            </span>

                        </div>

                        <div class="project-item">

                            <div class="thumb"></div>

                            <div class="project-info">
                                <h4>Portofolio Website</h4>
                                <small>22 Mei 2024</small>
                            </div>

                            <span class="badge success">
                                Published
                            </span>

                        </div>

                    </div>

                </div>

                <!-- Aktivitas -->
                <div class="card latest-activity">

                    <div class="card-header">
                        <h3>Aktivitas Terbaru</h3>
                    </div>

                    <div class="activity-list">

                        <div class="activity-item">

                            <div class="activity-icon red">
                                <iconify-icon icon="solar:folder-bold"></iconify-icon>
                            </div>

                            <div class="activity-info">
                                <h4>Project "Portofolio Website" Diperbaharui</h4>
                            </div>

                            <small>22 Mei 2026, 10:30</small>

                        </div>

                        <div class="activity-item">

                            <div class="activity-icon yellow">
                                <iconify-icon icon="solar:code-bold"></iconify-icon>
                            </div>

                            <div class="activity-info">
                                <h4>Skills "Portofolio Website" Ditambahkan</h4>
                            </div>

                            <small>22 Mei 2026, 10:30</small>

                        </div>

                        <div class="activity-item">

                            <div class="activity-icon green">
                                <iconify-icon icon="solar:gallery-bold"></iconify-icon>
                            </div>

                            <div class="activity-info">
                                <h4>Gambar "Portofolio Website" Ditambahkan</h4>
                            </div>

                            <small>22 Mei 2026, 10:30</small>

                        </div>

                        <div class="activity-item">

                            <div class="activity-icon green">
                                <iconify-icon icon="solar:gallery-bold"></iconify-icon>
                            </div>

                            <div class="activity-info">
                                <h4>Gambar "Portofolio Website" Ditambahkan</h4>
                            </div>

                            <small>22 Mei 2026, 10:30</small>

                        </div>

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
        // Line Chart - Statistik Kunjungan
        const visitCtx = document.getElementById('visitChart').getContext('2d');
        const gradient = visitCtx.createLinearGradient(0, 0, 0, 250);
        gradient.addColorStop(0, 'rgba(0, 136, 255, 0.35)');
        gradient.addColorStop(1, 'rgba(0, 136, 255, 0.02)');

        new Chart(visitCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Pengunjung',
                    data: [170, 190, 210, 190, 215, 205, 210],
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
                        max: 300,
                        ticks: {
                            stepSize: 100,
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
        new Chart(summaryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pengunjung', 'Project', 'Skills', 'Gambar'],
                datasets: [{
                    data: [40, 25, 15, 20],
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