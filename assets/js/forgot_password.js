// Elements
const forgotCard = document.getElementById("forgotCard");
const otpCard = document.getElementById("otpCard");
const resetCard = document.getElementById("resetCard");

const userInput = document.getElementById("userInput");
const userContact = document.getElementById("userContact");

const sendOtpBtn = document.getElementById("sendOtpBtn");
const verifyOtpBtn = document.getElementById("verifyOtpBtn");
const resetBtn = document.getElementById("resetBtn");

const backLinks = [
    document.getElementById("backToLogin1"),
    document.getElementById("backToEnterMail"),
    document.getElementById("backToOtp")
];

const otpInputs = document.querySelectorAll(".otp");

let generatedOtp = "";

// Step 1: Send OTP
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

// Step 2: Verify OTP
verifyOtpBtn.onclick = () => {
    const otpCode = Array.from(otpInputs).map(inp => inp.value).join("");
    if (otpCode.length < 4) return alert("Please enter the full OTP!");
    if (otpCode !== generatedOtp) return alert("Incorrect OTP. Please try again.");

    otpCard.style.display = "none";
    resetCard.style.display = "flex";
};

// Resend OTP
document.getElementById("resendOtp").onclick = (e) => {
    e.preventDefault();
    if (!userInput.value.trim()) return alert("No email to resend OTP!");
    generatedOtp = Math.floor(1000 + Math.random() * 9000).toString();
    console.log("Resent OTP:", generatedOtp);
    alert("A new OTP has been sent to " + userInput.value);
    otpInputs.forEach(input => input.value = '');
    otpInputs[0].focus();
};

// // Back to login links
// backLinks.forEach(link => link.onclick = (e) => {
//     e.preventDefault();
//     window.location.href = "index.html"; 
// });

// OTP auto move
otpInputs.forEach((input, i) => {
    input.addEventListener("input", () => {
        input.value = input.value.replace(/[^0-9]/g, "");
        if (input.value && i < otpInputs.length - 1) otpInputs[i + 1].focus();
    });
    input.addEventListener("keydown", e => {
        if (e.key === "Backspace" && !input.value && i > 0) otpInputs[i - 1].focus();
    });
});

// Reset Password
resetBtn.onclick = () => {
    const newPass = document.getElementById("newPass").value.trim();
    const confirmPass = document.getElementById("confirmPass").value.trim();

    if (newPass.length < 8) return alert("Password must be at least 8 characters.");
    if (newPass !== confirmPass) return alert("Passwords do not match.");

    alert("Password reset successful!");
    // window.location.href = "index.html"; // Redirect to login page
};
