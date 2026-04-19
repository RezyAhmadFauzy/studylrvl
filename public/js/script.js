/* ================================================================
   SISTEM PENGADUAN SISWA - COMPREHENSIVE JAVASCRIPT
   Modern Dashboard & Authentication Functionality
   ================================================================ */

// ================================================================
// INITIALIZATION
// ================================================================

document.addEventListener("DOMContentLoaded", function () {
    initDarkMode();
    initSidebar();
    initNotifications();
    initDropdowns();
    initDashboard();
    initForms();
    initAOS();
});

// ================================================================
// DARK MODE FUNCTIONALITY
// ================================================================

function initDarkMode() {
    const btn = document.querySelector(".btn-dark-mode");
    const html = document.documentElement;

    if (!btn) return;

    // Check localStorage for saved preference
    const isDarkMode = localStorage.getItem("darkMode") === "true";

    if (isDarkMode) {
        document.body.classList.add("dark-mode");
        html.setAttribute("data-bs-theme", "dark");
        updateDarkModeIcon(true);
    }

    btn.addEventListener("click", toggleDarkMode);
}

function toggleDarkMode() {
    const body = document.body;
    const html = document.documentElement;
    const isDark = body.classList.toggle("dark-mode");

    if (isDark) {
        html.setAttribute("data-bs-theme", "dark");
        localStorage.setItem("darkMode", "true");
    } else {
        html.removeAttribute("data-bs-theme");
        localStorage.setItem("darkMode", "false");
    }

    updateDarkModeIcon(isDark);
}

function updateDarkModeIcon(isDark) {
    const btn = document.querySelector(".btn-dark-mode");
    if (!btn) return;

    const icon = btn.querySelector("i");
    if (icon) {
        icon.className = isDark ? "fas fa-sun" : "fas fa-moon";
    }
}

// ================================================================
// SIDEBAR FUNCTIONALITY
// ================================================================

function initSidebar() {
    const toggleBtn = document.querySelector(".btn-sidebar-toggle");
    const sidebar = document.querySelector(".sidebar");
    const wrapper = document.querySelector(".dashboard-wrapper");

    if (!toggleBtn || !sidebar) return;

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("active");
        wrapper.classList.toggle("sidebar-open");
    });

    // Close sidebar on link click (mobile)
    const navLinks = sidebar.querySelectorAll(".nav-link");
    navLinks.forEach((link) => {
        link.addEventListener("click", function () {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove("active");
                wrapper.classList.remove("sidebar-open");
            }
        });
    });

    // Close sidebar when clicking outside (mobile)
    document.addEventListener("click", function (e) {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                sidebar.classList.remove("active");
                wrapper.classList.remove("sidebar-open");
            }
        }
    });

    // Adjust on window resize
    window.addEventListener("resize", function () {
        if (window.innerWidth > 768) {
            sidebar.classList.remove("active");
            wrapper.classList.remove("sidebar-open");
        }
    });
}

// ================================================================
// NOTIFICATION FUNCTIONALITY
// ================================================================

function initNotifications() {
    // Notifications are handled via CSS hover state
    // This function can be expanded for backend integration
}

// ================================================================
// DROPDOWNS
// ================================================================

function initDropdowns() {
    const profileDropdown = document.querySelector(".profile-dropdown");

    if (profileDropdown) {
        const menu = profileDropdown.querySelector(".dropdown-menu");

        profileDropdown.addEventListener("click", function (e) {
            if (e.target.closest(".btn-profile")) {
                e.preventDefault();
                menu.classList.toggle("show");
            }
        });

        document.addEventListener("click", function (e) {
            if (!profileDropdown.contains(e.target)) {
                menu.classList.remove("show");
            }
        });
    }
}

// ================================================================
// DASHBOARD INITIALIZATION
// ================================================================

function initDashboard() {
    // Initialize charts if on dashboard
    const adminCharts = document.querySelector('[data-page="admin-dashboard"]');
    const studentCharts = document.querySelector(
        '[data-page="student-dashboard"]',
    );

    if (adminCharts) {
        initAdminCharts();
    }

    if (studentCharts) {
        initStudentCharts();
    }
}

// ================================================================
// CHART INITIALIZATION
// ================================================================

function initAdminCharts() {
    // Initialize Bar Chart (Monthly Complaints)
    const barCtx = document.getElementById("barChart");
    if (barCtx) {
        new Chart(barCtx, {
            type: "bar",
            data: {
                labels: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                datasets: [
                    {
                        label: "Pengaduan",
                        data: [12, 19, 8, 15, 22, 18, 14, 16, 20, 17, 13, 19],
                        backgroundColor: "rgba(10, 71, 168, 0.8)",
                        borderColor: "rgba(10, 71, 168, 1)",
                        borderRadius: 6,
                        borderSkipped: false,
                        borderWidth: 1,
                        tension: 0.4,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            font: { size: 12, weight: 600 },
                            color: "#666",
                            usePointStyle: true,
                        },
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        padding: 12,
                        titleFont: { size: 12, weight: 600 },
                        bodyFont: { size: 12 },
                        cornerRadius: 6,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: "rgba(0, 0, 0, 0.05)",
                            drawBorder: false,
                        },
                        ticks: {
                            font: { size: 12 },
                            color: "#999",
                        },
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            font: { size: 12 },
                            color: "#999",
                        },
                    },
                },
            },
        });
    }

    // Initialize Pie Chart (Status Distribution)
    const pieCtx = document.getElementById("pieChart");
    if (pieCtx) {
        new Chart(pieCtx, {
            type: "doughnut",
            data: {
                labels: ["Pending", "Diproses", "Selesai"],
                datasets: [
                    {
                        data: [6, 24, 98],
                        backgroundColor: [
                            "rgba(255, 193, 7, 0.8)",
                            "rgba(33, 150, 243, 0.8)",
                            "rgba(40, 167, 69, 0.8)",
                        ],
                        borderColor: [
                            "rgba(255, 193, 7, 1)",
                            "rgba(33, 150, 243, 1)",
                            "rgba(40, 167, 69, 1)",
                        ],
                        borderWidth: 2,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            font: { size: 12, weight: 600 },
                            color: "#666",
                            padding: 15,
                            usePointStyle: true,
                        },
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        padding: 12,
                        titleFont: { size: 12, weight: 600 },
                        bodyFont: { size: 12 },
                        cornerRadius: 6,
                        callbacks: {
                            label: function (context) {
                                return (
                                    context.label +
                                    ": " +
                                    context.parsed +
                                    " (" +
                                    Math.round((context.parsed / 128) * 100) +
                                    "%)"
                                );
                            },
                        },
                    },
                },
            },
        });
    }

    // Initialize Line Chart (7-day Activity)
    const lineCtx = document.getElementById("lineChart");
    if (lineCtx) {
        new Chart(lineCtx, {
            type: "line",
            data: {
                labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                datasets: [
                    {
                        label: "Pengaduan Masuk",
                        data: [12, 15, 10, 18, 22, 8, 16],
                        borderColor: "rgba(10, 71, 168, 1)",
                        backgroundColor: "rgba(10, 71, 168, 0.1)",
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(10, 71, 168, 1)",
                        pointBorderColor: "#fff",
                        pointBorderWidth: 2,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            font: { size: 12, weight: 600 },
                            color: "#666",
                            usePointStyle: true,
                        },
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        padding: 12,
                        titleFont: { size: 12, weight: 600 },
                        bodyFont: { size: 12 },
                        cornerRadius: 6,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: "rgba(0, 0, 0, 0.05)",
                            drawBorder: false,
                        },
                        ticks: {
                            font: { size: 12 },
                            color: "#999",
                        },
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            font: { size: 12 },
                            color: "#999",
                        },
                    },
                },
            },
        });
    }
}

function initStudentCharts() {
    const doughnutCtx = document.getElementById("doughnutChart");
    if (doughnutCtx) {
        new Chart(doughnutCtx, {
            type: "doughnut",
            data: {
                labels: ["Pending", "Diproses", "Selesai"],
                datasets: [
                    {
                        data: [2, 5, 5],
                        backgroundColor: [
                            "rgba(255, 193, 7, 0.8)",
                            "rgba(33, 150, 243, 0.8)",
                            "rgba(40, 167, 69, 0.8)",
                        ],
                        borderColor: [
                            "rgba(255, 193, 7, 1)",
                            "rgba(33, 150, 243, 1)",
                            "rgba(40, 167, 69, 1)",
                        ],
                        borderWidth: 2,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            font: { size: 12, weight: 600 },
                            color: "#666",
                            padding: 15,
                            usePointStyle: true,
                        },
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        padding: 12,
                        titleFont: { size: 12, weight: 600 },
                        bodyFont: { size: 12 },
                        cornerRadius: 6,
                    },
                },
            },
        });
    }
}

// ================================================================
// FORMS FUNCTIONALITY
// ================================================================

function initForms() {
    // Password toggle on auth pages
    initPasswordToggle();

    // Form validation
    initFormValidation();

    // Password strength meter
    initPasswordStrength();
}

function initPasswordToggle() {
    const toggleButtons = document.querySelectorAll('[data-toggle="password"]');

    toggleButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const input = this.closest(".input-group").querySelector("input");
            const icon = this.querySelector("i");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    });
}

function initFormValidation() {
    const forms = document.querySelectorAll('form[data-validate="true"]');

    forms.forEach((form) => {
        form.addEventListener("submit", function (e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });

        // Real-time validation on input
        form.querySelectorAll("input, select, textarea").forEach((field) => {
            field.addEventListener("change", function () {
                validateField(this);
            });
        });
    });
}

function validateForm(form) {
    let isValid = true;

    form.querySelectorAll("[required]").forEach((field) => {
        if (!validateField(field)) {
            isValid = false;
        }
    });

    return isValid;
}

function validateField(field) {
    const parent = field.closest(".form-group") || field.closest(".mb-3");
    if (!parent) return true;

    // Remove existing error message
    const existingError = parent.querySelector(".invalid-feedback");
    if (existingError) {
        existingError.remove();
    }

    let isValid = true;
    let errorMessage = "";

    if (field.hasAttribute("required") && !field.value.trim()) {
        isValid = false;
        errorMessage = "Field ini harus diisi";
    } else if (field.type === "email" && field.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(field.value)) {
            isValid = false;
            errorMessage = "Format email tidak valid";
        }
    } else if (field.name === "nis" && field.value) {
        if (!/^\d+$/.test(field.value)) {
            isValid = false;
            errorMessage = "NIS harus berupa angka";
        }
    } else if (field.name === "password" && field.value) {
        if (field.value.length < 8) {
            isValid = false;
            errorMessage = "Password harus minimal 8 karakter";
        }
    } else if (field.name === "password_confirmation" && field.value) {
        const passwordField = field.form.querySelector('[name="password"]');
        if (field.value !== passwordField.value) {
            isValid = false;
            errorMessage = "Konfirmasi password tidak sesuai";
        }
    }

    if (!isValid) {
        field.classList.add("is-invalid");
        const errorDiv = document.createElement("div");
        errorDiv.className = "invalid-feedback d-block";
        errorDiv.textContent = errorMessage;
        parent.appendChild(errorDiv);
    } else {
        field.classList.remove("is-invalid");
    }

    return isValid;
}

function initPasswordStrength() {
    const passwordInputs = document.querySelectorAll('input[name="password"]');

    passwordInputs.forEach((input) => {
        const parent = input.closest(".form-group") || input.closest(".mb-3");
        if (!parent) return;

        // Create strength indicator
        let strengthDiv = parent.querySelector(".password-strength");
        if (!strengthDiv) {
            strengthDiv = document.createElement("div");
            strengthDiv.className = "password-strength mt-2";
            strengthDiv.innerHTML = `
                <div class="strength-bar" style="height: 4px; background: #e9ecef; border-radius: 2px; overflow: hidden;">
                    <div class="strength-fill" style="height: 100%; width: 0%; transition: all 0.3s;"></div>
                </div>
                <small class="strength-text" style="display: block; margin-top: 4px; font-size: 12px;"></small>
            `;
            parent.appendChild(strengthDiv);
        }

        input.addEventListener("input", function () {
            updatePasswordStrength(this, strengthDiv);
        });
    });
}

function updatePasswordStrength(input, strengthDiv) {
    const password = input.value;
    const strengthFill = strengthDiv.querySelector(".strength-fill");
    const strengthText = strengthDiv.querySelector(".strength-text");

    let strength = 0;
    let strengthLabel = "Sangat Lemah";
    let strengthColor = "#dc3545";

    if (password.length >= 8) strength += 1;
    if (password.length >= 12) strength += 1;
    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 1;
    if (/\d/.test(password)) strength += 1;
    if (/[!@#$%^&*]/.test(password)) strength += 1;

    switch (strength) {
        case 0:
            strengthLabel = "Sangat Lemah";
            strengthColor = "#dc3545";
            break;
        case 1:
            strengthLabel = "Lemah";
            strengthColor = "#fd7e14";
            break;
        case 2:
            strengthLabel = "Sedang";
            strengthColor = "#ffc107";
            break;
        case 3:
            strengthLabel = "Kuat";
            strengthColor = "#20c997";
            break;
        case 4:
        case 5:
            strengthLabel = "Sangat Kuat";
            strengthColor = "#28a745";
            break;
    }

    const percentage = (strength / 5) * 100;
    strengthFill.style.width = percentage + "%";
    strengthFill.style.backgroundColor = strengthColor;
    strengthText.textContent = strengthLabel;
    strengthText.style.color = strengthColor;
}

// ================================================================
// AOS (Animate on Scroll) INITIALIZATION
// ================================================================

function initAOS() {
    if (typeof AOS !== "undefined") {
        AOS.init({
            duration: 600,
            easing: "ease-in-out-cubic",
            once: true,
            offset: 100,
        });
    }
}

// ================================================================
// UTILITY FUNCTIONS
// ================================================================

function formatCurrency(value) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(value);
}

function formatDate(date) {
    const options = {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    };
    return new Date(date).toLocaleDateString("id-ID", options);
}

function formatTime(date) {
    const options = {
        hour: "2-digit",
        minute: "2-digit",
    };
    return new Date(date).toLocaleTimeString("id-ID", options);
}

function showNotification(message, type = "info") {
    const alertDiv = document.createElement("div");
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.setAttribute("role", "alert");
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    const container = document.querySelector(".page-content") || document.body;
    container.insertBefore(alertDiv, container.firstChild);

    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}

function toggleLoader(show = true) {
    let loader = document.querySelector(".page-loader");

    if (!loader) {
        loader = document.createElement("div");
        loader.className = "page-loader";
        loader.innerHTML = `
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        `;
        document.body.appendChild(loader);
    }

    if (show) {
        loader.style.display = "flex";
    } else {
        loader.style.display = "none";
    }
}

// ================================================================
// EXPORT FOR GLOBAL USE
// ================================================================

window.DashboardUtils = {
    formatCurrency,
    formatDate,
    formatTime,
    showNotification,
    toggleLoader,
    toggleDarkMode,
    validateForm,
    validateField,
};
