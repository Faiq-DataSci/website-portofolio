<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Faiq | Portofolio') ?></title>

    <!-- Link CSS - Navbar (Global) -->
    <link rel="stylesheet" href="<?= base_url('assets/css/navbar.css?v=1.0') ?>">
    
    <!-- Link CSS - Home -->
    <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Iconify for Tech Stack Icons -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>

<body>
    <div class="wrapper top-bg-white">
        <!-- Navigasi -->
        <header>
            <nav class="navbar">
                <ul class="nav-menu">
                    <li><a href="<?= base_url('/') ?>" class="active">Home</a></li>
                    <li><a href="<?= base_url('projects') ?>">Projects</a></li>
                    <li><a href="<?= base_url('skills') ?>">Skills</a></li>
                    <li><a href="<?= base_url('about') ?>">About</a></li>
                    <li><a href="<?= base_url('contact') ?>">Contact</a></li>
                </ul>
            </nav>
        </header>

        <!-- Bagian Pengenalan Website Portofolio -->
        <section id="home" class="hero">
            <div class="hero-content">
                <h1 class="hero-title">Faiq</h1>
                <h2 class="hero-subtitle">Data Scientist &<br>AI Developer</h2>
                <p class="hero-text">
                    Membangun model machine learning,<br>
                    menganalisis data, dan mengembangkan<br>
                    solusi AI yang berdampak nyata.
                </p>
            </div>
        </section>

        <!-- Bagian skill yang diinginkan -->
        <section id="skills" class="tech-stack-banner">
            <div class="tech-container">
                <div class="tech-item"><iconify-icon icon="logos:python"></iconify-icon> Python</div>
                <div class="tech-item"><iconify-icon icon="devicon:pandas"></iconify-icon> Pandas</div>
                <div class="tech-item"><iconify-icon icon="logos:numpy"></iconify-icon> Numpy</div>
                <div class="tech-item"><iconify-icon icon="logos:mysql"></iconify-icon> MySQL</div>
                <div class="tech-item"><iconify-icon icon="logos:tensorflow"></iconify-icon> TensorFlow</div>
                <div class="tech-item"><iconify-icon icon="logos:git-icon"></iconify-icon> Git</div>
            </div>
        </section>

        <!-- Pengenalan diri -->
        <section id="about" class="about-text-section">
            <p>
                Saya adalah mahasiswa Sains Data yang antusias mempelajari data, AI, dan teknologi untuk menciptakan solusi yang bermanfaat.
            </p>
        </section>
    </div>

    <div class="wrapper main-bg-gray">
        <!-- Pembuatan Vidio untuk project -->
        <section id="project" class="section-container">
            <h2 class="section-title">Project Terbaik</h2>
            <div class="project-card">
                <div class="project-info">
                    <h3>Project</h3>
                    <p>
                        Karya unggulan yang merepresentasikan keahlian saya<br>
                        dalam mengolah data kompleks menjadi solusi AI yang<br>
                        aplikatif dan berdampak nyata.
                    </p>
                    <a href="#" class="tour-link">Ikuti tur &rarr;</a>
                </div>
            </div>
        </section>

        <!-- Foto Foto untuk gambar diri -->
        <section class="section-container gallery">
            <h2 class="section-title">Foto - Foto</h2>
            <div class="gallery-grid">
                <div class="gallery-item bg-red"></div>
                <div class="gallery-item bg-orange"></div>
                <div class="gallery-item bg-yellow"></div>
                <div class="gallery-item bg-navy"></div>
            </div>
        </section>

        <!-- Menggunakan alat yang digunakan -->
        <section class="section-container bento-section">
            <div class="bento-header">
                <h2>
                    Mulai dengan sederhana.<br>
                    Tingkatkan skala saat Anda siap.
                </h2>
                <p>
                    Dari satu alat hingga alur kerja lengkap, sesuai kecepatan Anda.
                </p>
            </div>
            <div class="showcase-grid">
                <div class="box box-large bg-red"></div>
                <div class="right-side">
                    <div class="box box-top bg-navy"></div>
                    <div class="bottom">
                        <div class="box bg-yellow"></div>
                        <div class="box bg-coral"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer untuk website -->
    <footer id="contact">
        <div class="footer-content">
            <h3>Faiq</h3>
            <p>Data Scientist & AI Developer</p>
            <small>
                Copyright &copy; 2026 Faiq &bull; Data Scientist & AI Developer. All rights reserved.
            </small>
        </div>
    </footer>
</body>

</html>