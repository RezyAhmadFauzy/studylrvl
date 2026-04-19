/* =============================================
   AUTH PAGES JAVASCRIPT (Login & Register)
   ============================================= */

// =====================================
// PAGE INITIALIZATION
// =====================================

document.addEventListener("DOMContentLoaded", function () {
    initAuthFeatures();
});

function initAuthFeatures() {
    setupPasswordToggle();
    setupPasswordStrengthMeter();
    setupFormValidation();
    setupFormSubmission();
    setupAnimations();
}

// =====================================
// PASSWORD TOGGLE
// =====================================

function setupPasswordToggle() {
    const toggleBtns = document.querySelectorAll(".toggle-password");

    toggleBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
            const input = this.parentElement.querySelector(
                'input[type="password"], input[type="text"]',
            );

            if (input.type === "password") {
                input.type = "text";
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
                this.classList.add("active");
            } else {
                input.type = "password";
                this.innerHTML = '<i class="fas fa-eye"></i>';
                this.classList.remove("active");
            }
        });
    });
}

// =====================================
// PASSWORD STRENGTH METER
// =====================================

function setupPasswordStrengthMeter() {
    const passwordInput = document.getElementById("password");

    if (!passwordInput) return;

    passwordInput.addEventListener("input", function () {
        updatePasswordStrength(this.value);
    });
}

function updatePasswordStrength(password) {
    const strengthMeterFill = document.querySelector(".strength-meter-fill");
    const strengthText = document.querySelector(".strength-text");

    if (!strengthMeterFill || !strengthText) return;

    let strength = 0;

    // Length check
    if (password.length >= 8) strength++;

    // Mixed case check
    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;

    // Number check
    if (/\d/.test(password)) strength++;

    // Special character check
    if (/[^a-zA-Z\d]/.test(password)) strength++;

    // Remove all strength classes
    strengthMeterFill.classList.remove("weak", "fair", "strong");
    strengthText.classList.remove("weak", "fair", "strong");

    // Apply appropriate strength level
    if (password.length === 0) {
        strengthMeterFill.style.width = "0%";
        strengthText.textContent = "-";
    } else if (strength <= 1) {
        strengthMeterFill.classList.add("weak");
        strengthMeterFill.style.width = "33%";
        strengthText.classList.add("weak");
        strengthText.textContent = "Lemah";
    } else if (strength <= 2) {
        strengthMeterFill.classList.add("fair");
        strengthMeterFill.style.width = "66%";
        strengthText.classList.add("fair");
        strengthText.textContent = "Cukup";
    } else {
        strengthMeterFill.classList.add("strong");
        strengthMeterFill.style.width = "100%";
        strengthText.classList.add("strong");
        strengthText.textContent = "Kuat";
    }
}

// =====================================
// FORM VALIDATION
// =====================================

function setupFormValidation() {
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");

    if (loginForm) {
        setupLoginValidation(loginForm);
    }

    if (registerForm) {
        setupRegisterValidation(registerForm);
    }
}

function setupLoginValidation(form) {
    const usernameInput = form.querySelector('input[name="username"]');
    const passwordInput = form.querySelector('input[name="password"]');

    usernameInput?.addEventListener("blur", function () {
        validateField(this);
    });

    passwordInput?.addEventListener("blur", function () {
        validateField(this);
    });
}

function setupRegisterValidation(form) {
    const inputs = form.querySelectorAll("input, select");

    inputs.forEach((input) => {
        input.addEventListener("blur", function () {
            validateField(this);
        });

        input.addEventListener("input", function () {
            if (this.classList.contains("is-invalid")) {
                validateField(this);
            }
        });
    });

    // Password confirmation match
    const passwordInput = form.querySelector('input[name="password"]');
    const confirmInput = form.querySelector(
        'input[name="password_confirmation"]',
    );

    confirmInput?.addEventListener("input", function () {
        if (passwordInput.value !== this.value) {
            this.classList.add("is-invalid");
        } else {
            this.classList.remove("is-invalid");
        }
    });
}

function validateField(field) {
    const value = field.value.trim();
    const fieldName = field.name;
    let isValid = true;
    let errorMessage = "";

    // Empty check
    if (!value) {
        isValid = false;
        errorMessage = "Field ini tidak boleh kosong";
    }

    // Type-specific validation
    else if (fieldName === "username") {
        if (value.length < 4) {
            isValid = false;
            errorMessage = "Username minimal 4 karakter";
        }
    } else if (fieldName === "email") {
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            isValid = false;
            errorMessage = "Format email tidak valid";
        }
    } else if (fieldName === "password") {
        if (value.length < 8) {
            isValid = false;
            errorMessage = "Password minimal 8 karakter";
        }
    } else if (fieldName === "nama") {
        if (value.length < 3) {
            isValid = false;
            errorMessage = "Nama minimal 3 karakter";
        }
    } else if (fieldName === "nis") {
        if (!/^\d+$/.test(value)) {
            isValid = false;
            errorMessage = "NIS hanya boleh berisi angka";
        }
    } else if (fieldName === "kelas") {
        if (!value) {
            isValid = false;
            errorMessage = "Pilih kelas";
        }
    }

    // Update field appearance
    if (isValid) {
        field.classList.remove("is-invalid");
        field.classList.add("is-valid");

        // Remove error message if exists
        const errorDiv = field.parentElement.querySelector(".invalid-feedback");
        if (errorDiv) {
            errorDiv.style.display = "none";
        }
    } else {
        field.classList.add("is-invalid");
        field.classList.remove("is-valid");

        // Show or update error message
        let errorDiv = field.parentElement.querySelector(".invalid-feedback");
        if (!errorDiv) {
            errorDiv = document.createElement("div");
            errorDiv.className = "invalid-feedback";
            field.parentElement.appendChild(errorDiv);
        }
        errorDiv.textContent = errorMessage;
        errorDiv.style.display = "block";
    }

    return isValid;
}

// =====================================
// FORM SUBMISSION
// =====================================

function setupFormSubmission() {
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");

    if (loginForm) {
        loginForm.addEventListener("submit", handleLoginSubmit);
    }

    if (registerForm) {
        registerForm.addEventListener("submit", handleRegisterSubmit);
    }
}

function handleLoginSubmit(e) {
    const form = this;
    const usernameInput = form.querySelector('input[name="username"]');
    const passwordInput = form.querySelector('input[name="password"]');

    // Validate required fields
    const isUsernameValid = validateField(usernameInput);
    const isPasswordValid = validateField(passwordInput);

    if (!isUsernameValid || !isPasswordValid) {
        e.preventDefault();
        return false;
    }

    // Show loading state
    const submitBtn = form.querySelector(".btn-login");
    const btnText = submitBtn.querySelector(".btn-text");
    const btnLoader = submitBtn.querySelector(".btn-loader");

    if (btnText && btnLoader) {
        btnText.style.display = "none";
        btnLoader.style.display = "inline";
    }

    submitBtn.disabled = true;
}

function handleRegisterSubmit(e) {
    const form = this;

    // Validate all fields
    const inputs = form.querySelectorAll(
        'input[type="text"], input[type="email"], input[type="password"], select',
    );
    let isFormValid = true;

    inputs.forEach((input) => {
        if (!validateField(input)) {
            isFormValid = false;
        }
    });

    // Check password match
    const passwordInput = form.querySelector('input[name="password"]');
    const confirmInput = form.querySelector(
        'input[name="password_confirmation"]',
    );

    if (passwordInput.value !== confirmInput.value) {
        confirmInput.classList.add("is-invalid");
        const errorDiv =
            confirmInput.parentElement.querySelector(".invalid-feedback");
        if (errorDiv) {
            errorDiv.textContent = "Password tidak cocok";
            errorDiv.style.display = "block";
        }
        isFormValid = false;
    }

    // Check terms checkbox
    const agreeCheckbox = form.querySelector('input[name="agree"]');
    if (agreeCheckbox && !agreeCheckbox.checked) {
        const formCheck = agreeCheckbox.parentElement;
        formCheck.classList.add("is-invalid");
        isFormValid = false;
    }

    if (!isFormValid) {
        e.preventDefault();
        showErrorMessage("Silakan lengkapi semua field dengan benar");
        return false;
    }

    // Show loading state
    const submitBtn = form.querySelector(".register-btn");
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mendaftar...';
}

// =====================================
// ANIMATIONS
// =====================================

function setupAnimations() {
    // Animate form inputs on focus
    const inputs = document.querySelectorAll(".input-modern");

    inputs.forEach((input) => {
        input.addEventListener("focus", function () {
            this.parentElement.classList.add("focused");
        });

        input.addEventListener("blur", function () {
            if (!this.value) {
                this.parentElement.classList.remove("focused");
            }
        });
    });

    // Animate on page load
    setTimeout(() => {
        const forms = document.querySelectorAll(".login-form, .register-card");
        forms.forEach((form, index) => {
            form.style.opacity = "1";
            form.style.transform = "translateY(0)";
        });
    }, 100);
}

// =====================================
// HELPER FUNCTIONS
// =====================================

function showErrorMessage(message) {
    const alert = document.createElement("div");
    alert.className = "alert alert-danger alert-dismissible fade show";
    alert.role = "alert";
    alert.innerHTML = `
        <strong>Error!</strong> ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    const form = document.querySelector(".login-form, .register-card");
    if (form) {
        form.insertBefore(alert, form.firstChild);

        // Auto remove after 5 seconds
        setTimeout(() => {
            alert.remove();
        }, 5000);
    }
}

function showSuccessMessage(message) {
    const alert = document.createElement("div");
    alert.className = "alert alert-success alert-dismissible fade show";
    alert.role = "alert";
    alert.innerHTML = `
        <strong>Success!</strong> ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    const form = document.querySelector(".login-form, .register-card");
    if (form) {
        form.insertBefore(alert, form.firstChild);

        // Auto remove after 3 seconds
        setTimeout(() => {
            alert.remove();
        }, 3000);
    }
}

// =====================================
// PREVENT DOUBLE SUBMISSION
// =====================================

function preventDoubleSubmit() {
    const forms = document.querySelectorAll("form");
    forms.forEach((form) => {
        let isSubmitting = false;

        form.addEventListener("submit", function (e) {
            if (isSubmitting) {
                e.preventDefault();
                return false;
            }
            isSubmitting = true;

            // Re-enable after 2 seconds (in case of error)
            setTimeout(() => {
                isSubmitting = false;
            }, 2000);
        });
    });
}

document.addEventListener("DOMContentLoaded", preventDoubleSubmit);

// =====================================
// KEYBOARD SHORTCUTS
// =====================================

document.addEventListener("keydown", function (e) {
    // Enter to submit form
    if (e.key === "Enter" && (e.ctrlKey || e.metaKey)) {
        const activeForm = document.querySelector("form:focus-within");
        if (activeForm) {
            activeForm.submit();
        }
    }
});

// =====================================
// PERSIST FORM DATA
// =====================================

function setupFormPersistence() {
    const forms = document.querySelectorAll("form");

    forms.forEach((form) => {
        // Save form data on input
        form.addEventListener("input", function (e) {
            if (e.target.name) {
                sessionStorage.setItem(e.target.name, e.target.value);
            }
        });

        // Restore form data on load
        const inputs = form.querySelectorAll("input, select, textarea");
        inputs.forEach((input) => {
            const savedValue = sessionStorage.getItem(input.name);
            if (savedValue) {
                input.value = savedValue;
            }
        });
    });

    // Clear saved data on successful submission
    const forms2 = document.querySelectorAll("form");
    forms2.forEach((form) => {
        form.addEventListener("submit", function () {
            if (!form.classList.contains("was-validated")) {
                const inputs = form.querySelectorAll("input, select, textarea");
                inputs.forEach((input) => {
                    sessionStorage.removeItem(input.name);
                });
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", setupFormPersistence);
