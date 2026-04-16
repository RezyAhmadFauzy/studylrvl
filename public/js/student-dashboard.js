// ===== Student Dashboard JavaScript =====

document.addEventListener("DOMContentLoaded", function () {
    // ===== Sidebar Toggle =====
    const toggleBtn = document.getElementById("toggleSidebarBtn");
    const sidebar = document.getElementById("studentSidebar");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("active");
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener("click", function (e) {
        if (window.innerWidth <= 768) {
            if (
                sidebar &&
                !sidebar.contains(e.target) &&
                !toggleBtn.contains(e.target)
            ) {
                sidebar.classList.remove("active");
            }
        }
    });

    // ===== Auto-hide sidebar on larger screens =====
    window.addEventListener("resize", function () {
        if (window.innerWidth > 768 && sidebar) {
            sidebar.classList.remove("active");
        }
    });

    // ===== Set Active Nav Item =====
    const currentUrl = window.location.pathname;
    document.querySelectorAll(".nav-item").forEach((item) => {
        if (item.getAttribute("href") === currentUrl) {
            item.classList.add("active");
        }
    });

    // ===== Notification Bell Animation =====
    const notificationBell = document.querySelector(".notification-bell");
    if (notificationBell) {
        notificationBell.addEventListener("click", function () {
            this.style.animation = "none";
            setTimeout(() => {
                this.style.animation = "ring 0.5s ease-in-out";
            }, 10);
        });
    }

    // ===== Form Validation =====
    const forms = document.querySelectorAll("form");
    forms.forEach((form) => {
        form.addEventListener("submit", function (e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML =
                    '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            }
        });
    });

    // ===== Character Counter =====
    const textarea = document.getElementById("isi_laporan");
    const charCount = document.getElementById("charCount");
    if (textarea && charCount) {
        textarea.addEventListener("input", function () {
            charCount.textContent = this.value.length;

            // Change color if approaching limit
            if (this.value.length > 400) {
                charCount.style.color = "#ffc107";
            } else {
                charCount.style.color = "inherit";
            }
        });
    }

    // ===== Alert Auto-Dismiss =====
    const alerts = document.querySelectorAll(".alert");
    alerts.forEach((alert) => {
        setTimeout(() => {
            const closeBtn = alert.querySelector(".btn-close");
            if (closeBtn) {
                closeBtn.click();
            }
        }, 5000);
    });

    // ===== Smooth Scroll =====
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const href = this.getAttribute("href");
            if (href !== "#" && document.querySelector(href)) {
                e.preventDefault();
                document.querySelector(href).scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    // ===== Number Animation =====
    const statValues = document.querySelectorAll(".stat-value");
    statValues.forEach((element) => {
        const value = parseInt(element.textContent);
        if (!isNaN(value)) {
            element.textContent = "0";

            let start = 0;
            const increment = value / 30;
            const interval = setInterval(() => {
                start += increment;
                if (start >= value) {
                    element.textContent = value;
                    clearInterval(interval);
                } else {
                    element.textContent = Math.floor(start);
                }
            }, 30);
        }
    });

    // ===== Complaint Card Animation =====
    const complaintCards = document.querySelectorAll(".complaint-card");
    complaintCards.forEach((card, index) => {
        card.style.animation = `fadeInUp 0.5s ease-out ${index * 0.1}s backwards`;
    });

    // ===== Responsive Behavior =====
    function handleResponsive() {
        if (window.innerWidth <= 768) {
            // Mobile view
            document.body.classList.add("mobile-view");
        } else {
            // Desktop view
            document.body.classList.remove("mobile-view");
        }
    }

    handleResponsive();
    window.addEventListener("resize", handleResponsive);

    // ===== Keyboard Navigation =====
    document.addEventListener("keydown", function (e) {
        // ESC key to close sidebar
        if (e.key === "Escape" && window.innerWidth <= 768) {
            const sidebar = document.getElementById("studentSidebar");
            if (sidebar) {
                sidebar.classList.remove("active");
            }
        }
    });

    // ===== Page Visibility =====
    document.addEventListener("visibilitychange", function () {
        if (document.visibilityState === "visible") {
            // Page is visible
            console.log("Dashboard is visible");
        } else {
            // Page is hidden
            console.log("Dashboard is hidden");
        }
    });

    // ===== Tooltip Init =====
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]'),
    );
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// ===== Animations CSS =====
const style = document.createElement("style");
style.textContent = `
    @keyframes ring {
        0%, 100% { transform: rotate(0deg); }
        10%, 20% { transform: rotate(-10deg); }
        30%, 50%, 70%, 90% { transform: rotate(10deg); }
        40%, 60%, 80% { transform: rotate(-10deg); }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .stat-card,
    .modern-card,
    .complaint-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
`;
document.head.appendChild(style);

// ===== Export Functions =====
window.StudentDashboard = {
    // Logout function
    logout: function () {
        if (confirm("Apakah Anda yakin ingin logout?")) {
            document.querySelector('form[action*="logout"]').submit();
        }
    },

    // Refresh data
    refreshData: function () {
        location.reload();
    },

    // Show notification
    showNotification: function (message, type = "info") {
        const alertDiv = document.createElement("div");
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        const contentDiv = document.querySelector(".student-content");
        if (contentDiv) {
            contentDiv.insertAdjacentElement("afterbegin", alertDiv);

            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }
    },

    // Export to CSV
    exportToCSV: function (tableId, filename = "data.csv") {
        const table = document.getElementById(tableId);
        if (!table) return;

        let csv = [];
        const rows = table.querySelectorAll("tr");

        rows.forEach((row) => {
            const cols = row.querySelectorAll("td, th");
            const csvCols = [];
            cols.forEach((col) => {
                csvCols.push(col.textContent.trim());
            });
            csv.push(csvCols.join(","));
        });

        const csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
        const downloadLink = document.createElement("a");
        downloadLink.href = URL.createObjectURL(csvFile);
        downloadLink.download = filename;
        downloadLink.click();
    },

    // Print page
    printPage: function () {
        window.print();
    },

    // Device detection
    isMobile: function () {
        return window.innerWidth <= 768;
    },

    isTablet: function () {
        return window.innerWidth > 768 && window.innerWidth <= 1024;
    },

    isDesktop: function () {
        return window.innerWidth > 1024;
    },

    // Toggle sidebar
    toggleSidebar: function () {
        const sidebar = document.getElementById("studentSidebar");
        if (sidebar) {
            sidebar.classList.toggle("active");
        }
    },

    // Animate number
    animateNumber: function (element, target, duration = 1000) {
        let start = 0;
        const increment = target / (duration / 16);

        const timer = setInterval(() => {
            start += increment;
            if (start >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(start);
            }
        }, 16);
    },
};

// ===== Intersection Observer for Animations =====
const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.style.animation = "fadeInUp 0.5s ease-out forwards";
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe stat cards
document.querySelectorAll(".stat-card").forEach((card) => {
    observer.observe(card);
});

// Observe modern cards
document.querySelectorAll(".modern-card").forEach((card) => {
    observer.observe(card);
});
