<!-- Modal Overlay -->
<div class="modal-overlay" id="projectModal">
    <div class="modal-content">
        
        <!-- Loading State -->
        <div id="modalLoading" style="display:none; text-align:center; padding:80px 20px;">
            <iconify-icon icon="svg-spinners:blocks-shuffle-3" style="font-size:56px; color:#007BFF;"></iconify-icon>
            <p style="margin-top:20px; color:#666; font-size:16px;">Loading project details...</p>
        </div>

        <!-- Modal Content Container -->
        <div id="modalContentWrapper" style="display:none;">
            <!-- Close Button -->
            <button class="modal-close-btn" onclick="closeModal()" title="Close">
                <iconify-icon icon="solar:close-circle-bold"></iconify-icon>
            </button>

            <!-- Modal Header with Image -->
            <div class="modal-image-wrapper">
                <img src="" alt="Project Detail" class="modal-image" id="modalImage">
                <div class="modal-image-overlay"></div>
            </div>
            
            <div class="modal-body">
                <!-- Title Section -->
                <div class="modal-title-section">
                    <h2 class="modal-title" id="modalTitle">Loading...</h2>
                    <div class="modal-meta">
                        <span class="meta-badge" id="modalCategory"></span>
                        <span class="meta-divider">•</span>
                        <span class="meta-date" id="modalDate"></span>
                    </div>
                </div>

                <!-- Action Buttons (GitHub & Demo) -->
                <div class="modal-actions-bar">
                    <a href="#" id="modalGithubLink" class="action-btn github-btn" target="_blank" rel="noopener noreferrer" style="display:none;">
                        <iconify-icon icon="logos:github-icon"></iconify-icon>
                        <span>View on GitHub</span>
                    </a>
                    <a href="#" id="modalDemoLink" class="action-btn demo-btn" target="_blank" rel="noopener noreferrer" style="display:none;">
                        <iconify-icon icon="solar:link-bold"></iconify-icon>
                        <span>Live Demo</span>
                    </a>
                </div>
                
                <!-- Description / Content -->
                <div class="modal-description-section">
                    <h4 class="section-subtitle">About This Project</h4>
                    <div class="modal-text" id="modalDesc">
                        <p>Loading description...</p>
                    </div>
                </div>

                <!-- Technologies Section -->
                <div class="modal-tech-section" id="modalTechSection" style="display:none;">
                    <h4 class="section-subtitle">Technologies</h4>
                    <div class="modal-tech-chips" id="modalTechChips"></div>
                </div>

                <!-- Footer / Back Button -->
                <div class="modal-footer">
                    <button class="back-btn" onclick="closeModal()">
                        <iconify-icon icon="solar:alt-arrow-left-bold"></iconify-icon>
                        <span>Back to Projects</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Error State -->
        <div id="modalError" style="display:none; text-align:center; padding:80px 40px;">
            <iconify-icon icon="solar:danger-triangle-bold" style="font-size:72px; color:#D32F2F;"></iconify-icon>
            <h3 style="margin-top:24px; color:#333; font-size:20px; font-weight:600;">Failed to Load Project</h3>
            <p style="color:#666; margin-top:12px; font-size:15px;">The project details could not be loaded. Please try again later.</p>
            <button onclick="closeModal()" style="margin-top:28px; padding:12px 32px; background:#007BFF; color:#fff; border:none; border-radius:10px; cursor:pointer; font-weight:600; font-size:15px; transition:all 0.3s;">
                Close
            </button>
        </div>

    </div>
</div>

<style>
/* Modal Overlay */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.75);
    backdrop-filter: blur(8px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    padding: 20px;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.modal-overlay.active {
    display: flex;
}

/* Modal Content */
.modal-content {
    background: #fff;
    border-radius: 20px;
    max-width: 900px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    animation: slideUp 0.4s ease;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Close Button */
.modal-close-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 44px;
    height: 44px;
    background: rgba(255, 255, 255, 0.95);
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.modal-close-btn:hover {
    background: #fff;
    transform: rotate(90deg);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
}

.modal-close-btn iconify-icon {
    font-size: 28px;
    color: #333;
}

/* Image Wrapper */
.modal-image-wrapper {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: hidden;
    border-radius: 20px 20px 0 0;
}

.modal-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.modal-image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 150px;
    background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
}

/* Modal Body */
.modal-body {
    padding: 40px;
}

/* Title Section */
.modal-title-section {
    margin-bottom: 28px;
}

.modal-title {
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 12px 0;
    line-height: 1.3;
}

.modal-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.meta-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.3px;
}

/* Category Badge Gradient Colors */
.meta-badge[data-category="Web Development"] {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.meta-badge[data-category="Machine Learning"] {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.meta-badge[data-category="Data Science"] {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}

.meta-badge[data-category="Mobile App"] {
    background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
}

.meta-badge[data-category="Desktop App"] {
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    color: #333;
}

.meta-divider {
    color: #ddd;
    font-size: 16px;
}

.meta-date {
    color: #666;
    font-size: 14px;
    font-weight: 500;
}

/* Action Buttons Bar */
.modal-actions-bar {
    display: flex;
    gap: 12px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}

.action-btn {
    flex: 1;
    min-width: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 14px 24px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s;
    border: 2px solid;
}

.github-btn {
    background: #24292e;
    color: #fff;
    border-color: #24292e;
}

.github-btn:hover {
    background: #1a1e22;
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(36, 41, 46, 0.3);
}

.github-btn iconify-icon {
    font-size: 24px;
}

.demo-btn {
    background: #007BFF;
    color: #fff;
    border-color: #007BFF;
}

.demo-btn:hover {
    background: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(0, 123, 255, 0.3);
}

.demo-btn iconify-icon {
    font-size: 22px;
}

/* Section Subtitle */
.section-subtitle {
    font-size: 16px;
    font-weight: 700;
    color: #333;
    margin: 0 0 16px 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Tags Section */
.modal-tags-section {
    margin-bottom: 32px;
}

.modal-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tag-item {
    background: #f0f4ff;
    color: #4361ee;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    border: 1px solid #d4e1ff;
    transition: all 0.2s;
}

.tag-item:hover {
    background: #e0ebff;
    border-color: #b8d0ff;
}

/* Description Section */
.modal-description-section {
    margin-bottom: 32px;
}

.modal-text {
    color: #444;
    line-height: 1.8;
    font-size: 15px;
}

.modal-text p {
    margin: 0 0 16px 0;
}

.modal-text p:last-child {
    margin-bottom: 0;
}

/* Footer */
.modal-footer {
    border-top: 1px solid #eee;
    padding-top: 24px;
    margin-top: 32px;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: #f5f5f5;
    color: #333;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.back-btn:hover {
    background: #e8e8e8;
    border-color: #d0d0d0;
    transform: translateX(-4px);
}

.back-btn iconify-icon {
    font-size: 20px;
}

/* Technologies Section in Modal */
.modal-tech-section {
    margin-bottom: 32px;
}

.modal-tech-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tech-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 15px;
    background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
    color: #5a67d8;
    border: 1.5px solid #667eea30;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.2px;
    transition: all 0.2s;
    box-shadow: 0 2px 4px rgba(102, 126, 234, 0.1);
}

.tech-chip::before {
    content: '●';
    font-size: 8px;
    color: #667eea;
}

.tech-chip:hover {
    background: linear-gradient(135deg, #667eea25 0%, #764ba225 100%);
    border-color: #667eea;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(102, 126, 234, 0.2);
}

/* Scrollbar */
.modal-content::-webkit-scrollbar {
    width: 8px;
}

.modal-content::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.modal-content::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.modal-content::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Responsive */
@media (max-width: 768px) {
    .modal-image-wrapper {
        height: 250px;
    }

    .modal-body {
        padding: 28px 24px;
    }

    .modal-title {
        font-size: 24px;
    }

    .action-btn {
        min-width: 100%;
    }
}
</style>
