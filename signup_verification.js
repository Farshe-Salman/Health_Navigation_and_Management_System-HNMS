// Elements
const userCard = document.getElementById("userCard");
const otpCard = document.getElementById("otpCard");
const successCard = document.getElementById("successCard");

const userInput = document.getElementById("userInput");
const userContact = document.getElementById("userContact");

const sendOtpBtn = document.getElementById("sendOtpBtn");
const verifyOtpBtn = document.getElementById("verifyOtpBtn");
const goToLogin = document.getElementById("goToLogin");
const resendOtp = document.getElementById("resendOtp");

const otpInputs = document.querySelectorAll(".otp");

let generatedOtp = "";

// Step 1: Send OTP
sendOtpBtn.onclick = () => {
    if (!userInput.value.trim()) return alert("Please enter your email or phone!");
    
    // Generate 4-digit OTP
    generatedOtp = Math.floor(1000 + Math.random() * 9000).toString();
    console.log("Generated OTP:", generatedOtp); // For testing
    
    alert("OTP has been sent to " + userInput.value);
    
    // Show OTP card and update user contact display
    userContact.textContent = userInput.value;
    userCard.style.display = "none";
    otpCard.style.display = "flex";

    // Clear OTP inputs
    otpInputs.forEach(input => input.value = '');
    otpInputs[0].focus();
};

// Step 2: Verify OTP
verifyOtpBtn.onclick = () => {
    const enteredOtp = Array.from(otpInputs).map(input => input.value).join("");
    if (enteredOtp.length < 4) return alert("Please enter the full OTP!");
    if (enteredOtp !== generatedOtp) return alert("Incorrect OTP. Please try again.");
    
    otpCard.style.display = "none";
    successCard.style.display = "flex";
};

// Resend OTP
resendOtp.onclick = (e) => {
    e.preventDefault();
    generatedOtp = Math.floor(1000 + Math.random() * 9000).toString();
    console.log("Resent OTP:", generatedOtp); // For testing
    alert("A new OTP has been sent to " + userInput.value);
    otpInputs.forEach(input => input.value = '');
    otpInputs[0].focus();
};

// OTP auto move
otpInputs.forEach((input, i) => {
    input.addEventListener("input", () => {
        if (input.value && i < otpInputs.length - 1) otpInputs[i + 1].focus();
    });
    input.addEventListener("keydown", e => {
        if (e.key === "Backspace" && !input.value && i > 0) otpInputs[i - 1].focus();
    });
});

// Go to login after success
goToLogin.onclick = () => {
    alert("Redirecting to login page...");
    window.location.href = "index.html"; 
};
