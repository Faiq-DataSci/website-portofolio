<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Faiq | About') ?></title>
    
    <!-- Link CSS - Navbar (Global) -->
    <link rel="stylesheet" href="<?= base_url('assets/css/navbar.css?v=1.0') ?>">
    
    <!-- Link CSS - About -->
    <link rel="stylesheet" href="<?= base_url('assets/css/abouts.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>

<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar">
            <ul class="nav-menu">
                <li><a href="<?= base_url('/') ?>">Home</a></li>
                <li><a href="<?= base_url('projects') ?>">Projects</a></li>
                <li><a href="<?= base_url('skills') ?>">Skills</a></li>
                <li><a href="<?= base_url('about') ?>" class="active">About</a></li>
                <li><a href="<?= base_url('contact') ?>">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main class="wrapper container">
        <!-- Intro Section -->
        <section class="about-intro">
            <span class="subtitle">Get to know me</span>
            <h1 class="title">Behind the Code</h1>
            <p class="description">
                Saya adalah seorang Data Scientist, AI Developer, dan Software Engineer yang berdedikasi untuk mengubah data menjadi wawasan bermakna serta membangun solusi AI yang memberikan dampak nyata.
            </p>
        </section>

        <!-- Main Content 3 Columns -->
        <section class="about-grid">
            <!-- Column 1: My Story -->
            <article class="card story-card">
                <h2>My Story</h2>
                <div class="story-content">
                    <p>Saya memulai perjalanan di bidang teknologi dan data sejak tahun 2020. Ketertarikan saya berawal dari rasa ingin tahu tentang bagaimana data dapat memberikan insight yang berharga dan bagaimana AI dapat menyelesaikan masalah nyata.</p>
                    <p>Sejak itu, saya terus belajar, membangun project, dan mengasah kemampuan saya di bidang Data Science, Machine Learning, dan Software Development.</p>
                    <p>Tujuan saya adalah seorang engineer yang tidak hanya menguasai teknologi, tetapi juga mampu memberikan dampak bagi banyak orang.</p>
                </div>
            </article>

            <!-- Column 2: My Core Values -->
            <article class="card values-card">
                <h2>My Core Values</h2>
                <div class="list-group">
                    <div class="list-item">
                        <div class="icon-circle blue"><iconify-icon icon="fluent:shield-check-24-regular"></iconify-icon></div>
                        <div class="item-info">
                            <h3>Integrity</h3>
                            <p>Saya percaya dan tanggung jawab adalah fondasi dari setiap pekerjaan yang berkualitas.</p>
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="icon-circle red"><iconify-icon icon="fluent:star-24-regular"></iconify-icon></div>
                        <div class="item-info">
                            <h3>Excellence</h3>
                            <p>Selalu berusaha memberikan hasil terbaik dan terus meningkatkan kualitas diri.</p>
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="icon-circle yellow"><iconify-icon icon="fluent:lightbulb-24-regular"></iconify-icon></div>
                        <div class="item-info">
                            <h3>Curiosity</h3>
                            <p>Selalu ingin tahu dan tidak berhenti belajar hal-hal baru dalam dunia teknologi.</p>
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="icon-circle green"><iconify-icon icon="fluent:target-arrow-24-regular"></iconify-icon></div>
                        <div class="item-info">
                            <h3>Impact</h3>
                            <p>Berfokus pada pembuatan solusi yang bermanfaat dan memberikan dampak positif.</p>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Column 3: What I Do -->
            <article class="card do-card">
                <h2>What I Do</h2>
                <div class="list-group">
                    <div class="list-item">
                        <div class="icon-circle blue"><iconify-icon icon="fluent:data-pie-24-regular"></iconify-icon></div>
                        <div class="item-info">
                            <h3>Data Analysis</h3>
                            <p>Mengolah dan menganalisis data untuk menghasilkan insight yang actionable.</p>
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="icon-circle red"><iconify-icon icon="fluent:bot-24-regular"></iconify-icon></div>
                        <div class="item-info">
                            <h3>Machine Learning</h3>
                            <p>Membangun model ML untuk prediksi, klasifikasi, dan rekomendasi.</p>
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="icon-circle yellow"><iconify-icon icon="fluent:brain-circuit-24-regular"></iconify-icon></div>
                        <div class="item-info">
                            <h3>AI Development</h3>
                            <p>Mengembangkan solusi AI seperti NLP, Computer Vision, dan LLM.</p>
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="icon-circle green"><iconify-icon icon="fluent:code-24-regular"></iconify-icon></div>
                        <div class="item-info">
                            <h3>Web Development</h3>
                            <p>Membangun aplikasi web yang moderen responsive, dan user-friendly.</p>
                        </div>
                    </div>
                </div>
            </article>
        </section>

        <!-- Education & Journey Section -->
        <section class="journey-section card">
            <h2>Education & Journey</h2>
            <div class="journey-timeline">
                <div class="journey-item">
                    <div class="journey-icon-circle"><iconify-icon icon="logos:python" width="32"></iconify-icon></div>
                    <div class="journey-info">
                        <h3>2024</h3>
                        <p>Mulai belajar Python dan dasar pemrograman</p>
                    </div>
                </div>
                <div class="journey-item">
                    <div class="journey-icon-circle red-border"><iconify-icon icon="fluent:data-line-24-regular" style="color: #dc3545;" width="32"></iconify-icon></div>
                    <div class="journey-info">
                        <h3>2025</h3>
                        <p>Fokus belajar Data Science dan Machine Learning</p>
                    </div>
                </div>
                <div class="journey-item">
                    <div class="journey-icon-circle yellow-border"><iconify-icon icon="fluent:sparkle-24-regular" style="color: #ffc107;" width="32"></iconify-icon></div>
                    <div class="journey-info">
                        <h3>2026</h3>
                        <p>Membangun project AI dan analisis data</p>
                    </div>
                </div>
                <div class="journey-item">
                    <div class="journey-icon-circle green-border"><iconify-icon icon="fluent:arrow-trending-24-regular" style="color: #198754;" width="32"></iconify-icon></div>
                    <div class="journey-info">
                        <h3>Now</h3>
                        <p>Terus berkembang & Siap untuk peluang baru.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer id="contact">
        <div class="container footer-content">
            <h3>Faiq</h3>
            <p>Data Scientist & AI Developer</p>
            <small>Copyright &copy; 2026 Faiq &bull; Data Scientist & AI Developer. All rights reserved.</small>
        </div>
    </footer>
</body>

</html>