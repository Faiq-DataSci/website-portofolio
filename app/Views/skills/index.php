<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Nama Dokumen -->
    <title><?= esc($title ?? 'Faiq | Skills') ?></title>

    <!-- Link CSS - Skills -->
    <link rel="stylesheet" href="<?= base_url('assets/css/skills.css') ?>">

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
                    <li><a href="<?= base_url('projects') ?>">Projects</a></li>
                    <li><a href="<?= base_url('skills') ?>" class="active">Skills</a></li>
                    <li><a href="<?= base_url('about') ?>">About</a></li>
                    <li><a href="<?= base_url('contact') ?>">Contact</a></li>
                </ul>
            </nav>
        </header>

        <main class="wrapper container">
            <!-- Hero Section -->
            <section class="skills-hero">
                <div class="hero-content">
                    <h1>Skills & Expertise</h1>
                    <p>Kombinasi kemampuan teknis, tools, dan soft skills yang saya gunakan untuk membangun solusi data dan AI yang berdampak.</p>

                    <div class="hero-stats">
                        <div class="stat-card green">
                            <div class="stat-icon">
                                <iconify-icon icon="fluent:code-24-filled" width="32"></iconify-icon>
                            </div>
                            <div class="stat-info">
                                <h2>5+</h2>
                                <span>Programming Language</span>
                            </div>
                        </div>
                        <div class="stat-card yellow">
                            <div class="stat-icon">
                                <iconify-icon icon="fluent:brain-circuit-24-filled" width="32"></iconify-icon>
                            </div>
                            <div class="stat-info">
                                <h2>2+</h2>
                                <span>Years of Learning</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="<?= base_url('assets/img/skills.jpg') ?>" alt="Skills Illustration" onerror="this.src='https://placehold.co/500x400?text=Skill+Illustration'">
                </div>
            </section>

            <!-- Hard Skills Section -->
            <section class="hard-skills section-box">
                <h2 class="section-title">Hard Skills</h2>
                <div class="hard-skills-grid">
                    <!-- Data Science -->
                    <article class="skill-category">
                        <h3><iconify-icon icon="fluent:data-area-24-regular" style="color: #0d6efd;"></iconify-icon> Data Science</h3>
                        <div class="skill-list">
                            <div class="skill-item">
                                <div class="skill-info"><span>Python</span><span>90%</span></div>
                                <div class="progress-bar">
                                    <div class="progress blue" style="width: 90%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>Pandas</span><span>70%</span></div>
                                <div class="progress-bar">
                                    <div class="progress blue" style="width: 70%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>Numpy</span><span>70%</span></div>
                                <div class="progress-bar">
                                    <div class="progress blue" style="width: 70%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>Mathplotlib</span><span>70%</span></div>
                                <div class="progress-bar">
                                    <div class="progress blue" style="width: 70%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>SQL</span><span>70%</span></div>
                                <div class="progress-bar">
                                    <div class="progress blue" style="width: 70%;"></div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Machine Learning -->
                    <article class="skill-category">
                        <h3><iconify-icon icon="fluent:clipboard-data-bar-24-regular" style="color: #dc3545;"></iconify-icon> Machine Learning</h3>
                        <div class="skill-list">
                            <div class="skill-item">
                                <div class="skill-info"><span>Scikit-Learn</span><span>50%</span></div>
                                <div class="progress-bar">
                                    <div class="progress red" style="width: 50%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>TensorFlow</span><span>60%</span></div>
                                <div class="progress-bar">
                                    <div class="progress red" style="width: 60%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>PyTorch</span><span>70%</span></div>
                                <div class="progress-bar">
                                    <div class="progress red" style="width: 70%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>XGBoost</span><span>50%</span></div>
                                <div class="progress-bar">
                                    <div class="progress red" style="width: 50%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>Deep Learning</span><span>40%</span></div>
                                <div class="progress-bar">
                                    <div class="progress red" style="width: 40%;"></div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Artificial Intelligence -->
                    <article class="skill-category">
                        <h3><iconify-icon icon="fluent:sparkle-24-regular" style="color: #ffc107;"></iconify-icon> Artificial Intelligence</h3>
                        <div class="skill-list">
                            <div class="skill-item">
                                <div class="skill-info"><span>NLP</span><span>90%</span></div>
                                <div class="progress-bar">
                                    <div class="progress yellow-bar" style="width: 90%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>Transformers</span><span>70%</span></div>
                                <div class="progress-bar">
                                    <div class="progress yellow-bar" style="width: 70%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>OpenCV</span><span>70%</span></div>
                                <div class="progress-bar">
                                    <div class="progress yellow-bar" style="width: 70%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>Computer Vision</span><span>70%</span></div>
                                <div class="progress-bar">
                                    <div class="progress yellow-bar" style="width: 70%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>Prompt Engineering</span><span>70%</span></div>
                                <div class="progress-bar">
                                    <div class="progress yellow-bar" style="width: 70%;"></div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Web Development -->
                    <article class="skill-category">
                        <h3><iconify-icon icon="fluent:code-24-regular" style="color: #198754;"></iconify-icon> Web Development</h3>
                        <div class="skill-list">
                            <div class="skill-item">
                                <div class="skill-info"><span>HTML</span><span>90%</span></div>
                                <div class="progress-bar">
                                    <div class="progress green-bar" style="width: 90%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>CSS</span><span>70%</span></div>
                                <div class="progress-bar">
                                    <div class="progress green-bar" style="width: 70%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>JavaScript</span><span>70%</span></div>
                                <div class="progress-bar">
                                    <div class="progress green-bar" style="width: 70%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>PHP</span><span>70%</span></div>
                                <div class="progress-bar">
                                    <div class="progress green-bar" style="width: 70%;"></div>
                                </div>
                            </div>
                            <div class="skill-item">
                                <div class="skill-info"><span>FastAPI</span><span>70%</span></div>
                                <div class="progress-bar">
                                    <div class="progress green-bar" style="width: 70%;"></div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>

            <!-- Soft Skills Section -->
            <section class="soft-skills section-box">
                <h2 class="section-title">Soft Skills</h2>
                <div class="soft-skills-grid">
                    <article class="soft-card">
                        <div class="icon-box blue-box">
                            <iconify-icon icon="fluent:brain-circuit-24-regular"></iconify-icon>
                        </div>
                        <div class="soft-info">
                            <h3>Problem Solving</h3>
                            <p>Mampu menganalisis masalah kompleks dan menemukan solusi yang efektif.</p>
                        </div>
                    </article>
                    <article class="soft-card">
                        <div class="icon-box red-box">
                            <iconify-icon icon="fluent:data-line-24-regular"></iconify-icon>
                        </div>
                        <div class="soft-info">
                            <h3>Analytical Thinking</h3>
                            <p>Terbiasa mengambil keputusan berdasarkan data dan insight yang akurat.</p>
                        </div>
                    </article>
                    <article class="soft-card">
                        <div class="icon-box yellow-box">
                            <iconify-icon icon="fluent:chat-bubbles-question-24-regular"></iconify-icon>
                        </div>
                        <div class="soft-info">
                            <h3>Communication</h3>
                            <p>Mampu menyampaikan ide teknis dengan jelas kepada tim.</p>
                        </div>
                    </article>
                    <article class="soft-card">
                        <div class="icon-box green-box">
                            <iconify-icon icon="fluent:people-team-24-regular"></iconify-icon>
                        </div>
                        <div class="soft-info">
                            <h3>Teamwork</h3>
                            <p>Bekerja kolaboratif dalam tim untuk mencapai tujuan bersama.</p>
                        </div>
                    </article>
                </div>
            </section>

            <!-- Tools & Education Layout -->
            <div class="tools-edu-layout">
                <!-- Tools Section -->
                <section class="tools-section section-box">
                    <h2 class="section-title">Tools & Technologies</h2>
                    <div class="tools-grid">
                        <div class="tool-card"><iconify-icon icon="logos:jupyter" width="40"></iconify-icon><span>Jupyter</span></div>
                        <div class="tool-card"><iconify-icon icon="logos:visual-studio-code" width="40"></iconify-icon><span>VS Code</span></div>
                        <div class="tool-card"><iconify-icon icon="logos:git-icon" width="40"></iconify-icon><span>Git</span></div>
                        <div class="tool-card"><iconify-icon icon="logos:github-icon" width="40"></iconify-icon><span>Github</span></div>
                        <div class="tool-card"><iconify-icon icon="logos:docker-icon" width="40"></iconify-icon><span>Docker</span></div>
                        <div class="tool-card"><iconify-icon icon="simple-icons:googlecolab" style="color: #F9AB00;" width="40"></iconify-icon><span>Google Colab</span></div>
                        <div class="tool-card"><iconify-icon icon="devicon:mysql" width="40"></iconify-icon><span>MySQL</span></div>
                        <div class="tool-card"><iconify-icon icon="logos:linux-tux" width="40"></iconify-icon><span>Linux</span></div>
                    </div>
                </section>

                <!-- Education Section -->
                <section class="education-section section-box">
                    <h2 class="section-title">Education</h2>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="dot blue"></div>
                            <div class="timeline-content">
                                <h4>SD Negeri 1 Adikarto</h4>
                                <span>2013 - 2018</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="dot red"></div>
                            <div class="timeline-content">
                                <h4>SMP Negeri 2 Adimulyo</h4>
                                <span>2018 - 2021</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="dot yellow"></div>
                            <div class="timeline-content">
                                <h4>SMK Negeri 1 Gombong</h4>
                                <span>2021 - 2024</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="dot green"></div>
                            <div class="timeline-content">
                                <h4>Universitas Putra Bangsa</h4>
                                <span>2025 - Now</span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Certificate Section -->
            <section class="certificate-section">
                <h2 class="section-title text-center">Certificate</h2>
                <div class="certificate-grid">
                    <div class="certificate-card"></div>
                    <div class="certificate-card"></div>
                    <div class="certificate-card"></div>
                    <div class="certificate-card"></div>
                    <div class="certificate-card"></div>
                    <div class="certificate-card"></div>
                    <div class="certificate-card"></div>
                    <div class="certificate-card"></div>
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