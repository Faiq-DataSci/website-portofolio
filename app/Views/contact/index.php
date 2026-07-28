<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Faiq | Contact') ?></title>
    
    <!-- Link CSS - Navbar (Global) -->
    <link rel="stylesheet" href="<?= base_url('assets/css/navbar.css?v=1.0') ?>">
    
    <!-- Link CSS - Contact -->
    <link rel="stylesheet" href="<?= base_url('assets/css/contact.css') ?>">
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
                <li><a href="<?= base_url('about') ?>">About</a></li>
                <li><a href="<?= base_url('contact') ?>" class="active">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <!-- Hero Text -->
        <section class="contact-hero">
            <div class="hero-text">
                <h1>Let's Connect!</h1>
                <p>
                    Punya pertanyaan, ide project, atau ingin berkolaborasi ? Saya selalu terbuka untuk diskusi dan kesempatan baru.
                </p>
            </div>
            <div class="hero-photo">
                <img src="/website-portofolio/public/assets/img/foto-profile.jpg" alt="Foto Profil Faiq" onerror="this.style.display='none'; this.parentElement.classList.add('placeholder')">
            </div>
        </section>

        <!-- Two-Column Layout -->
        <section class="contact-layout">

            <!-- Left Card: Contact Information -->
            <article class="contact-card">
                <h2>Contact Information</h2>
                <div class="contact-list">
                    <a href="mailto:athafaiq313@gmail.com" class="contact-item">
                        <iconify-icon icon="mdi:email-outline"></iconify-icon>
                        <span>Email</span>
                    </a>
                    <a href="https://www.linkedin.com/in/faiq-atha-rulloh-baa2a83b1?utm_source=share_via&utm_content=profile&utm_medium=member_android" target="_blank" class="contact-item">
                        <iconify-icon icon="mdi:linkedin"></iconify-icon>
                        <span>LinkedIn</span>
                    </a>
                    <a href="https://github.com/Faiq-DataSci" target="_blank" class="contact-item">
                        <iconify-icon icon="mdi:github"></iconify-icon>
                        <span>GitHub</span>
                    </a>
                    <a href="https://maps.app.goo.gl/Y7Kn5WjZtn2joHmz5" class="contact-item">
                        <iconify-icon icon="mdi:map-marker-outline"></iconify-icon>
                        <span>Location</span>
                    </a>
                    <a href="https://www.facebook.com/share/1DMA26hCjX/" target="_blank" class="contact-item">
                        <iconify-icon icon="logos:facebook"></iconify-icon>
                        <span>Facebook</span>
                    </a>
                    <a href="https://youtube.com/@faiqv2?si=BIazNslwHQMf23rq" target="_blank" class="contact-item">
                        <iconify-icon icon="logos:youtube-icon"></iconify-icon>
                        <span>YouTube</span>
                    </a>
                    <a href="https://instagram.com/faiqfixe/" target="_blank" class="contact-item">
                        <iconify-icon icon="skill-icons:instagram"></iconify-icon>
                        <span>Instagram</span>
                    </a>
                    <a href="https://tiktok.com" target="_blank" class="contact-item">
                        <iconify-icon icon="logos:tiktok-icon"></iconify-icon>
                        <span>Tik Tok</span>
                    </a>
                </div>
            </article>

            <!-- Right Card: Let's Work Together -->
            <article class="cta-card">
                <div class="cta-icon">
                    <iconify-icon icon="fluent:handshake-24-regular" style="color: #198754;" width="52"></iconify-icon>
                </div>
                <h2>Let's Work Together</h2>
                <p>Saya tertarik dengan peluang baru, proyek menarik, dan kolaborasi yang bisa menciptakan dampak positif</p>

                <ul class="cta-list">
                    <li>
                        <iconify-icon icon="mdi:check-circle-outline" style="color: #198754;"></iconify-icon>
                        <span>Web & Development</span>
                    </li>
                    <li>
                        <iconify-icon icon="mdi:check-circle-outline" style="color: #198754;"></iconify-icon>
                        <span>UI/UX Design</span>
                    </li>
                    <li>
                        <iconify-icon icon="mdi:check-circle-outline" style="color: #198754;"></iconify-icon>
                        <span>Open Source Colaboration</span>
                    </li>
                    <li>
                        <iconify-icon icon="mdi:check-circle-outline" style="color: #198754;"></iconify-icon>
                        <span>Tech Discussion</span>
                    </li>
                </ul>

                <a href="https://wa.me/088227301218" target="_blank" class="cta-btn">
                    <iconify-icon icon="logos:whatsapp-icon" width="24"></iconify-icon>
                    <span>Call Me !</span>
                </a>
            </article>

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