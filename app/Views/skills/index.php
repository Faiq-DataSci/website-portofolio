<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Nama Dokumen -->
    <title><?= esc($title ?? 'Faiq | Skills') ?></title>

    <!-- Link CSS - Navbar (Global) -->
    <link rel="stylesheet" href="<?= base_url('assets/css/navbar.css?v=1.0') ?>">

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

            <!-- Hard Skills Section - Dynamic from Database -->
            <section class="hard-skills section-box">
                <h2 class="section-title">Skills & Expertise</h2>
                
                <?php if (!empty($skillsGrouped) && count($skillsGrouped) > 0): ?>
                    <div class="hard-skills-grid">
                        <?php foreach ($skillsGrouped as $category => $skills): ?>
                            <!-- <?= esc($category) ?> Category -->
                            <article class="skill-category">
                                <h3>
                                    <iconify-icon icon="fluent:code-24-regular" style="color: #0d6efd;"></iconify-icon>
                                    <?= esc($category) ?>
                                </h3>
                                <div class="skill-list">
                                    <?php foreach ($skills as $skill): ?>
                                        <div class="skill-item">
                                            <div class="skill-info">
                                                <span style="display:flex; align-items:center; gap:8px;">
                                                    <?php if (!empty($skill['icon'])): ?>
                                                        <iconify-icon icon="<?= esc($skill['icon']) ?>" style="font-size:20px;"></iconify-icon>
                                                    <?php endif; ?>
                                                    <?= esc($skill['name']) ?>
                                                </span>
                                                <?php 
                                                    $percent = (int)($skill['level'] ?? 50);
                                                    // Determine badge color based on percentage
                                                    $badgeClass = 'level-intermediate';
                                                    if ($percent >= 80) {
                                                        $badgeClass = 'level-expert';
                                                    } elseif ($percent >= 60) {
                                                        $badgeClass = 'level-advanced';
                                                    } elseif ($percent >= 40) {
                                                        $badgeClass = 'level-intermediate';
                                                    } else {
                                                        $badgeClass = 'level-beginner';
                                                    }
                                                ?>
                                                <span class="level-badge <?= $badgeClass ?>">
                                                    <?= $percent ?>%
                                                </span>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="progress blue" style="width: <?= $percent ?>%;"></div>
                                            </div>
                                            <?php if (!empty($skill['description'])): ?>
                                                <small style="color:#666; font-size:12px; margin-top:4px; display:block;">
                                                    <?= esc($skill['description']) ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <!-- Empty State -->
                    <div style="text-align:center; padding:60px 20px;">
                        <iconify-icon icon="fluent:code-24-regular" style="font-size:80px; color:#ddd;"></iconify-icon>
                        <h3 style="margin-top:20px; color:#666;">Belum Ada Skills</h3>
                        <p style="color:#999;">Skills akan ditampilkan di sini setelah ditambahkan dari admin panel</p>
                    </div>
                <?php endif; ?>
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
                
                <?php if (!empty($certificates) && count($certificates) > 0): ?>
                    <div class="certificate-grid">
                        <?php foreach ($certificates as $cert): ?>
                            <div class="certificate-card" title="<?= esc($cert['title']) ?>" style="position:relative; overflow:hidden;">
                                <?php if (!empty($cert['image']) && $cert['image'] !== 'default.jpg'): ?>
                                    <img src="<?= base_url('uploads/certificates/' . $cert['image']) ?>" 
                                         alt="<?= esc($cert['title']) ?>"
                                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px; transition: transform 0.3s;">
                                <?php else: ?>
                                    <div style="width:100%; height:100%; display:flex; flex-direction:column; align-items:center; justify-content:center; background:#f5f5f5; border-radius:12px; padding:20px; text-align:center;">
                                        <iconify-icon icon="solar:diploma-bold" style="font-size:48px; color:#ccc; margin-bottom:12px;"></iconify-icon>
                                        <strong style="font-size:14px; color:#666; margin-bottom:4px;"><?= esc($cert['title']) ?></strong>
                                        <?php if (!empty($cert['issuer'])): ?>
                                            <small style="font-size:12px; color:#999;"><?= esc($cert['issuer']) ?></small>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Overlay with certificate info -->
                                <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.85), transparent); color:white; padding:16px 12px; border-radius:0 0 12px 12px; opacity:0; transition:opacity 0.3s;" class="cert-overlay">
                                    <strong style="display:block; font-size:13px; margin-bottom:6px; font-weight:600;"><?= esc($cert['title']) ?></strong>
                                    <?php if (!empty($cert['issuer'])): ?>
                                        <small style="display:block; font-size:11px; opacity:0.95; margin-bottom:3px;">
                                            <iconify-icon icon="solar:verified-check-bold" style="font-size:12px;"></iconify-icon>
                                            <?= esc($cert['issuer']) ?>
                                        </small>
                                    <?php endif; ?>
                                    <?php if (!empty($cert['issue_date'])): ?>
                                        <small style="display:block; font-size:11px; opacity:0.9;">
                                            <iconify-icon icon="solar:calendar-bold" style="font-size:12px;"></iconify-icon>
                                            <?= date('M Y', strtotime($cert['issue_date'])) ?>
                                        </small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div style="text-align:center; padding:60px 20px; color:#999;">
                        <iconify-icon icon="solar:diploma-bold" style="font-size:80px; color:#ddd; display:block; margin:0 auto 20px;"></iconify-icon>
                        <p style="font-size:16px; color:#666;">Belum ada certificate untuk ditampilkan</p>
                    </div>
                <?php endif; ?>
            </section>
            
            <style>
                .certificate-card:hover .cert-overlay {
                    opacity: 1 !important;
                }
                .certificate-card:hover img {
                    transform: scale(1.05);
                }
                .certificate-card {
                    cursor: pointer;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                    transition: box-shadow 0.3s, transform 0.3s;
                }
                .certificate-card:hover {
                    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
                    transform: translateY(-4px);
                }
            </style>
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