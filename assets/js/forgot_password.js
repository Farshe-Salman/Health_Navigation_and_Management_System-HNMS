// Elements
const forgotCard = document.getElementById("forgotCard");
const otpCard = document.getElementById("otpCard");
const resetCard = document.getElementById("resetCard");

const userInput = document.getElementById("userInput");
const userContact = document.getElementById("userContact");

const sendOtpBtn = document.getElementById("sendOtpBtn");
const verifyOtpBtn = document.getElementById("verifyOtpBtn");
const resetBtn = document.getElementById("resetBtn");

const otpInputs = document.querySelectorAll(".otp");

const newPassInput = document.getElementById("newPass");
const confirmPassInput = document.getElementById("confirmPass");
const resetPasswordError = document.getElementById("newPasswordError");
const confirmPasswordError = document.getElementById("conPasswordError");

let generatedOtp = "";

// ===== STEP 1: SEND OTP =====
sendOtpBtn.onclick = () => {
    const contact = userInput.value.trim();
    if (!contact) return alert("Please enter your email!");

    generatedOtp = Math.floor(1000 + Math.random() * 9000).toString();
    console.log("Generated OTP:", generatedOtp);
    alert("OTP sent to " + contact);

    userContact.textContent = contact;
    forgotCard.style.display = "none";
    otpCard.style.display = "flex";

    otpInputs.forEach(input => input.value = '');
    otpInputs[0].focus();
};

// ===== STEP 2: VERIFY OTP =====
verifyOtpBtn.onclick = () => {
    const otpCode = Array.from(otpInputs).map(inp => inp.value).join("");
    if (otpCode.length < 4) return alert("Please enter the full OTP!");
    if (otpCode !== generatedOtp) return alert("Incorrect OTP. Please try again.");

    otpCard.style.display = "none";
    resetCard.style.display = "flex";
};

// ===== RESEND OTP =====
document.getElementById("resendOtp").onclick = (e) => {
    e.preventDefault();
    if (!userInput.value.trim()) return alert("No email to resend OTP!");
    generatedOtp = Math.floor(1000 + Math.random() * 9000).toString();
    console.log("Resent OTP:", generatedOtp);
    alert("A new OTP has been sent to " + userInput.value);
    otpInputs.forEach(input => input.value = '');
    otpInputs[0].focus();
};

// ===== BACK BUTTONS =====
// Forgot → Login
document.getElementById("backToLogin").onclick = (e) => {
    e.preventDefault();
    window.location.href = "../view/signin_signup.php";
};

// OTP → Forgot
document.getElementById("backToEnterMail").onclick = (e) => {
    e.preventDefault();
    otpCard.style.display = "none";
    forgotCard.style.display = "flex";
};


// OTP auto move
otpInputs.forEach((input, i) => {
    input.addEventListener("input", () => {
        input.value = input.value.replace(/[^0-9]/g, "");
        if (input.value && i < otpInputs.length - 1) {
            otpInputs[i + 1].focus();
        }
    });
    input.addEventListener("keydown", e => {
        if (e.key === "Backspace" && !input.value && i > 0) {
            otpInputs[i - 1].focus();
        }
    });
});

// ===== PASSWORD VALIDATION =====
function validatePassword(pass) {
    // 8+ chars, uppercase, lowercase, number, special char
    const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;
    return pattern.test(pass);
}

// Live validation for New Password
newPassInput.addEventListener("input", () => {
    if (!validatePassword(newPassInput.value)) {
        resetPasswordError.textContent = "Password must be 8+ chars with 1 uppercase, 1 lowercase, 1 number & 1 special char.";
    } else {
        resetPasswordError.textContent = "";
    }

    // Confirm password live check
    if (confirmPassInput.value && confirmPassInput.value !== newPassInput.value) {
        confirmPasswordError.textContent = "Passwords do not match.";
    } else {
        confirmPasswordError.textContent = "";
    }
});

// Live validation for Confirm Password
confirmPassInput.addEventListener("input", () => {
    if (confirmPassInput.value !== newPassInput.value) {
        confirmPasswordError.textContent = "Passwords do not match.";
    } else {
        confirmPasswordError.textContent = "";
    }
});
// ===== Password Show/Hide =====
function setupPasswordToggle(inputId, toggleId) {
    const input = document.getElementById(inputId);
    const toggle = document.getElementById(toggleId);

    toggle.addEventListener("click", () => {
        if (input.type === "password") {
            input.type = "text";
            toggle.textContent = "Hide";
        } else {
            input.type = "password";
            toggle.textContent = "Show";
        }
    });
}

// Correct usage with your HTML IDs
setupPasswordToggle("newPass", "newPassword");      
setupPasswordToggle("confirmPass", "confirmPassword");

// ===== RESET PASSWORD BUTTON =====
resetBtn.onclick = () => {
    const newPass = newPassInput.value.trim();
    const confirmPass = confirmPassInput.value.trim();

    if (!validatePassword(newPass)) {
        resetPasswordError.textContent = "Password must be 8+ chars with 1 uppercase, 1 lowercase, 1 number & 1 special char.";
        newPassInput.focus();
        return;
    }

    if (newPass !== confirmPass) {
        confirmPasswordError.textContent = "Passwords do not match.";
        confirmPassInput.focus();
        return;
    }

    resetPasswordError.textContent = "";
    confirmPasswordError.textContent = "";
    alert("Password reset successful!");
    window.location.href = "../view/signin_signup.php";
};
