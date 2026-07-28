<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Faiq | Projects') ?></title>

    <!-- Link CSS - Project -->
    <link rel="stylesheet" href="<?= base_url('assets/css/project.css') ?>">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>

<body>
    <div class="wrapper top-bg-white">
        <!-- Navigasi -->
        <header>
            <nav class="navbar">
                <ul class="nav-menu">
                    <li><a href="<?= base_url('/') ?>">Home</a></li>
                    <li><a href="<?= base_url('projects') ?>" class="active">Projects</a></li>
                    <li><a href="<?= base_url('skills') ?>">Skills</a></li>
                    <li><a href="<?= base_url('about') ?>">About</a></li>
                    <li><a href="<?= base_url('contact') ?>">Contact</a></li>
                </ul>
            </nav>
        </header>

        <!-- hero -->
        <section class="project-hero">
            <div class="hero-text">
                <h1>My Project</h1>
                <p>
                    Berikut adalah beberapa project yang telah saya kerjakan. Setiap dibuat untuk menyelesaikan masalah nyata menggunakan teknologi dan data.
                </p>
            </div>
            <div class="hero-image">
                <img src="<?= base_url('assets/img/project.png') ?>" alt="Projects Illustration" style="width:100%; max-width:400px; object-fit:contain; border-radius: 12px;">
            </div>
        </section>

        <!-- Filter -->
        <section class="filters-section">
            <button class="filter-btn btn-all">All</button>
            <button class="filter-btn btn-data-science">Data Science</button>
            <button class="filter-btn btn-python">Python</button>
            <button class="filter-btn btn-ml">Machine Learning</button>
            <button class="filter-btn btn-ai">AI</button>
        </section>

        <!-- project list -->
        <main class="project-grid">
            <!-- Card 1 -->
            <article class="project-card">
                <img src="images/project-1.jpg" alt="Project 1" class="card-image" style="background:#f4f5f0;">
                <div class="card-body">
                    <div class="project-tags">
                        <span class="tag blue">Data Science</span>
                        <span class="tag yellow">Python</span>
                    </div>
                    <h3>Data Science</h3>
                    <p>
                        Model Machine Learning untuk memprediksi harga rumah berdasarkan berbagai fitur menggunakan XGBoost.
                    </p>
                </div>
            </article>

            <!-- Card 2 -->
            <article class="project-card">
                <img src="images/project-2.jpg" alt="Project 2" class="card-image" style="background:#f4f5f0;">
                <div class="card-body">
                    <div class="project-tags">
                        <span class="tag green">Machine Learning</span>
                        <span class="tag purple">AI</span>
                    </div>
                    <h3>Data Science</h3>
                    <p>
                        Model Machine Learning untuk memprediksi harga rumah berdasarkan berbagai fitur menggunakan XGBoost.
                    </p>
                </div>
            </article>

            <!-- Card 3 -->
            <article class="project-card">
                <img src="images/project-3.jpg" alt="Project 3" class="card-image" style="background:#f4f5f0;">
                <div class="card-body">
                    <div class="project-tags">
                        <span class="tag green">Machine Learning</span>
                        <span class="tag purple">AI</span>
                    </div>
                    <h3>Data Science</h3>
                    <p>
                        Model Machine Learning untuk memprediksi harga rumah berdasarkan berbagai fitur menggunakan XGBoost.
                    </p>
                </div>
            </article>

            <!-- Card 4 -->
            <article class="project-card">
                <img src="images/project-4.jpg" alt="Project 4" class="card-image" style="background:#f4f5f0;">
                <div class="card-body">
                    <div class="project-tags">
                        <span class="tag blue">Data Science</span>
                        <span class="tag yellow">Python</span>
                    </div>
                    <h3>Data Science</h3>
                    <p>
                        Model Machine Learning untuk memprediksi harga rumah berdasarkan berbagai fitur menggunakan XGBoost.
                    </p>
                </div>
            </article>

            <!-- Card 5 -->
            <article class="project-card">
                <img src="images/project-5.jpg" alt="Project 5" class="card-image" style="background:#f4f5f0;">
                <div class="card-body">
                    <div class="project-tags">
                        <span class="tag green">Machine Learning</span>
                        <span class="tag purple">AI</span>
                    </div>
                    <h3>Data Science</h3>
                    <p>
                        Model Machine Learning untuk memprediksi harga rumah berdasarkan berbagai fitur menggunakan XGBoost.
                    </p>
                </div>
            </article>

            <!-- Card 6 -->
            <article class="project-card">
                <img src="images/project-6.jpg" alt="Project 6" class="card-image" style="background:#f4f5f0;">
                <div class="card-body">
                    <div class="project-tags">
                        <span class="tag green">Machine Learning</span>
                        <span class="tag purple">AI</span>
                    </div>
                    <h3>Data Science</h3>
                    <p>
                        Model Machine Learning untuk memprediksi harga rumah berdasarkan berbagai fitur menggunakan XGBoost.
                    </p>
                </div>
            </article>
        </main>

        <!-- Pagination -->
        <section class="pagination">
            <button class="page-btn">&lsaquo;</button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-btn">&rsaquo;</button>
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
    <!-- Modal Detail -->
    <?= $this->include('projects/detail') ?>

    <script>
        // Make cards clickable to open modal
        document.querySelectorAll('.project-card').forEach(card => {
            card.addEventListener('click', function() {
                openModal();
            });
        });

        function openModal() {
            document.getElementById('projectModal').classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling in background
        }

        function closeModal() {
            document.getElementById('projectModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close when clicking overlay outside content
        document.getElementById('projectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>

</html>