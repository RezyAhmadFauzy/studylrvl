// ===== Sidebar Toggle =====
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("toggleSidebar");
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.querySelector(".main-content");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("show");
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener("click", function (e) {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                sidebar.classList.remove("show");
            }
        }
    });

    // Handle window resize
    window.addEventListener("resize", function () {
        if (window.innerWidth > 768) {
            sidebar.classList.remove("show");
        }
    });
});

// ===== Active Navigation Item =====
document.addEventListener("DOMContentLoaded", function () {
    const navItems = document.querySelectorAll(".nav-item");
    const currentUrl = window.location.pathname;

    navItems.forEach((item) => {
        if (item.getAttribute("href") === currentUrl) {
            item.classList.add("active");
        }
    });
});

// ===== Notification Animation =====
document.addEventListener("DOMContentLoaded", function () {
    const notificationDropdown = document.getElementById(
        "notificationDropdown",
    );

    if (notificationDropdown) {
        notificationDropdown.addEventListener("show.bs.dropdown", function () {
            const badge = this.querySelector(".badge-notification");
            if (badge) {
                badge.style.animation = "pulse 0.6s ease-out";
            }
        });
    }
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

// ===== Chart Animation Delay =====
document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".stat-card, .card");

    cards.forEach((card, index) => {
        card.style.animation = `fadeIn 0.6s ease-out ${index * 0.1}s both`;
    });
});

// ===== Table Row Hover Effect =====
document.addEventListener("DOMContentLoaded", function () {
    const tableRows = document.querySelectorAll(".table tbody tr");

    tableRows.forEach((row) => {
        row.addEventListener("mouseenter", function () {
            this.style.backgroundColor = "#f0f3ff";
        });

        row.addEventListener("mouseleave", function () {
            this.style.backgroundColor = "";
        });
    });
});

// ===== Tooltip Initialization =====
document.addEventListener("DOMContentLoaded", function () {
    // Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]'),
    );
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// ===== Number Animation for Stats =====
function animateCounter(element, target, duration = 1000) {
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
}

// Animate stat values on page load
document.addEventListener("DOMContentLoaded", function () {
    const statValues = document.querySelectorAll(".stat-value");

    statValues.forEach((element) => {
        const value = parseInt(element.textContent);
        if (!isNaN(value)) {
            element.textContent = "0";

            // Trigger animation when element is visible
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target, value, 800);
                        observer.unobserve(entry.target);
                    }
                });
            });

            observer.observe(element);
        }
    });
});

// ===== Keyboard Navigation =====
document.addEventListener("keydown", function (e) {
    // ESC key to close sidebar on mobile
    if (e.key === "Escape") {
        const sidebar = document.getElementById("sidebar");
        if (window.innerWidth <= 768) {
            sidebar.classList.remove("show");
        }
    }
});

// ===== Loading Animation =====
function showLoadingSpinner() {
    const spinner = document.createElement("div");
    spinner.className = "loading-spinner";
    spinner.innerHTML =
        '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
    document.body.appendChild(spinner);

    return spinner;
}

function hideLoadingSpinner(spinner) {
    if (spinner) {
        spinner.remove();
    }
}

// ===== Page Visibility Change =====
document.addEventListener("visibilitychange", function () {
    if (document.visibilityState === "visible") {
        // Page is visible - you can refresh data here if needed
        console.log("Dashboard is visible");
    } else {
        // Page is hidden
        console.log("Dashboard is hidden");
    }
});

// ===== Form Validation =====
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (form) {
        form.addEventListener("submit", function (e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add("was-validated");
        });
    }
}

// ===== Data Export Functions =====
function exportToCSV(tableId, filename = "data.csv") {
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

    downloadCSV(csv.join("\n"), filename);
}

function downloadCSV(csv, filename) {
    const csvFile = new Blob([csv], { type: "text/csv" });
    const downloadLink = document.createElement("a");
    downloadLink.href = URL.createObjectURL(csvFile);
    downloadLink.download = filename;
    downloadLink.click();
}

// ===== Print Page =====
function printDashboard() {
    window.print();
}

// ===== Real-time Clock =====
function updateClock() {
    const now = new Date();
    const timeString = now.toLocaleTimeString("id-ID");

    // If you want to display clock somewhere
    const clockElement = document.getElementById("current-time");
    if (clockElement) {
        clockElement.textContent = timeString;
    }
}

setInterval(updateClock, 1000);
updateClock();

// ===== Notification Sound =====
function playNotificationSound() {
    const audioContext = new (
        window.AudioContext || window.webkitAudioContext
    )();
    const oscillator = audioContext.createOscillator();
    const gainNode = audioContext.createGain();

    oscillator.connect(gainNode);
    gainNode.connect(audioContext.destination);

    oscillator.frequency.value = 800;
    oscillator.type = "sine";

    gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
    gainNode.gain.exponentialRampToValueAtTime(
        0.01,
        audioContext.currentTime + 0.5,
    );

    oscillator.start(audioContext.currentTime);
    oscillator.stop(audioContext.currentTime + 0.5);
}

// ===== Responsive Check =====
function isMobile() {
    return window.innerWidth <= 768;
}

function isTablet() {
    return window.innerWidth > 768 && window.innerWidth <= 1024;
}

function isDesktop() {
    return window.innerWidth > 1024;
}

// ===== Custom Alert Functions =====
function showAlert(message, type = "info", duration = 5000) {
    const alertElement = document.createElement("div");
    alertElement.className = `alert alert-${type} alert-dismissible fade show`;
    alertElement.setAttribute("role", "alert");
    alertElement.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    document
        .querySelector(".page-content")
        .insertAdjacentElement("afterbegin", alertElement);

    if (duration) {
        setTimeout(() => {
            alertElement.remove();
        }, duration);
    }
}

// ===== Export object for use in other scripts =====
window.Dashboard = {
    showAlert,
    exportToCSV,
    printDashboard,
    isMobile,
    isTablet,
    isDesktop,
    playNotificationSound,
};
