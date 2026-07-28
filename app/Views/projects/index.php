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
            <?php if (!empty($projects) && count($projects) > 0): ?>
                <?php foreach ($projects as $project): ?>
                    <!-- Card Project dari Database -->
                    <article class="project-card" 
                             data-category="<?= esc($project['category'] ?? '') ?>"
                             data-id="<?= $project['id'] ?>"
                             onclick="openProjectDetail(<?= $project['id'] ?>)"
                             style="cursor:pointer;">
                        <?php if (!empty($project['thumbnail'])): ?>
                            <img src="<?= base_url('uploads/projects/' . esc($project['thumbnail'])) ?>" 
                                 alt="<?= esc($project['title']) ?>" 
                                 class="card-image">
                        <?php else: ?>
                            <div class="card-image" style="background:#f4f5f0; min-height:200px; display:flex; align-items:center; justify-content:center;">
                                <iconify-icon icon="solar:gallery-outline" style="font-size:48px; color:#ccc;"></iconify-icon>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body">
                            <div class="project-tags">
                                <?php 
                                    $category = $project['category'] ?? 'Web Development';
                                    $tagClass = 'blue';
                                    if (stripos($category, 'Machine Learning') !== false) $tagClass = 'green';
                                    elseif (stripos($category, 'Data Science') !== false) $tagClass = 'blue';
                                    elseif (stripos($category, 'Mobile') !== false) $tagClass = 'purple';
                                    elseif (stripos($category, 'Desktop') !== false) $tagClass = 'yellow';
                                ?>
                                <span class="tag <?= $tagClass ?>"><?= esc($category) ?></span>
                            </div>
                            <h3><?= esc($project['title']) ?></h3>
                            <p>
                                <?= esc(mb_substr($project['description'] ?? 'Deskripsi belum tersedia.', 0, 120)) ?>
                                <?= mb_strlen($project['description'] ?? '') > 120 ? '...' : '' ?>
                            </p>
                            
                            <?php if (!empty($project['github']) || !empty($project['demo'])): ?>
                                <div class="card-links" style="margin-top:12px; display:flex; gap:8px;">
                                    <?php if (!empty($project['github'])): ?>
                                        <a href="<?= esc($project['github']) ?>" target="_blank" 
                                           style="display:inline-flex; align-items:center; gap:4px; color:#007BFF; font-size:14px; text-decoration:none;"
                                           onclick="event.stopPropagation();">
                                            <iconify-icon icon="mdi:github"></iconify-icon>
                                            GitHub
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty($project['demo'])): ?>
                                        <a href="<?= esc($project['demo']) ?>" target="_blank" 
                                           style="display:inline-flex; align-items:center; gap:4px; color:#28A745; font-size:14px; text-decoration:none;"
                                           onclick="event.stopPropagation();">
                                            <iconify-icon icon="solar:link-outline"></iconify-icon>
                                            Demo
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Empty State -->
                <div style="grid-column: 1 / -1; text-align:center; padding:60px 20px;">
                    <iconify-icon icon="solar:folder-open-outline" style="font-size:80px; color:#ccc;"></iconify-icon>
                    <h3 style="margin-top:20px; color:#666;">Belum Ada Project</h3>
                    <p style="color:#999;">Project yang dipublikasikan akan muncul di sini</p>
                </div>
            <?php endif; ?>
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
        // Global variable untuk menyimpan data project yang sedang dibuka
        let currentProject = null;

        /**
         * Open project detail modal
         * @param {number} projectId - ID project yang akan ditampilkan
         */
        async function openProjectDetail(projectId) {
            const modal = document.getElementById('projectModal');
            const loading = document.getElementById('modalLoading');
            const content = document.getElementById('modalContentWrapper');
            const error = document.getElementById('modalError');

            // Show modal
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';

            // Show loading state
            loading.style.display = 'block';
            content.style.display = 'none';
            error.style.display = 'none';

            try {
                // Fetch project data from API
                const response = await fetch(`<?= base_url('projects/detail/') ?>${projectId}`);
                const result = await response.json();

                if (result.success && result.data) {
                    currentProject = result.data;
                    renderProjectDetail(result.data);
                    
                    // Hide loading, show content
                    loading.style.display = 'none';
                    content.style.display = 'block';
                } else {
                    throw new Error(result.message || 'Failed to load project');
                }
            } catch (err) {
                console.error('Error loading project:', err);
                
                // Hide loading, show error
                loading.style.display = 'none';
                error.style.display = 'block';
            }
        }

        /**
         * Render project data to modal
         * @param {object} project - Project data object
         */
        function renderProjectDetail(project) {
            // Update thumbnail
            const modalImage = document.getElementById('modalImage');
            if (project.thumbnail) {
                modalImage.src = project.thumbnail;
                modalImage.alt = project.title;
                modalImage.style.display = 'block';
            } else {
                modalImage.style.display = 'none';
            }

            // Update title
            document.getElementById('modalTitle').textContent = project.title || 'Untitled Project';

            // Update category badge in meta
            document.getElementById('modalCategory').textContent = project.category || 'General';

            // Update date
            const date = project.created_at ? new Date(project.created_at).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            }) : 'No date';
            document.getElementById('modalDate').textContent = date;

            // Update description
            const description = project.description || 'No description available.';
            document.getElementById('modalDesc').innerHTML = formatDescription(description);

            // --- Technologies Section ---
            const techSection = document.getElementById('modalTechSection');
            const techChips   = document.getElementById('modalTechChips');

            if (project.technologies && Array.isArray(project.technologies) && project.technologies.length > 0) {
                techChips.innerHTML = project.technologies.map(tech =>
                    `<span class="tech-chip">${escapeHtml(tech)}</span>`
                ).join('');
                techSection.style.display = 'block';
            } else {
                techSection.style.display = 'none';
            }

            // Update GitHub link
            const githubLink = document.getElementById('modalGithubLink');
            if (project.github) {
                githubLink.href = project.github;
                githubLink.style.display = 'inline-flex';
            } else {
                githubLink.style.display = 'none';
            }

            // Update Demo link
            const demoLink = document.getElementById('modalDemoLink');
            if (project.demo) {
                demoLink.href = project.demo;
                demoLink.style.display = 'inline-flex';
            } else {
                demoLink.style.display = 'none';
            }
        }

        /**
         * Format description with paragraphs
         * @param {string} text - Description text
         * @returns {string} Formatted HTML
         */
        function formatDescription(text) {
            // Split by double line breaks for paragraphs
            const paragraphs = text.split('\n\n').filter(p => p.trim());
            return paragraphs.map(p => `<p>${escapeHtml(p.trim())}</p>`).join('');
        }

        /**
         * Escape HTML to prevent XSS
         * @param {string} text - Text to escape
         * @returns {string} Escaped text
         */
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        /**
         * Close modal
         */
        function closeModal() {
            const modal = document.getElementById('projectModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
            currentProject = null;
        }

        // Close when clicking overlay outside content
        document.getElementById('projectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Prevent card links from triggering modal
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.card-links a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        });
    </script>
</body>

</html>