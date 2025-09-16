<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Forgot / Reset Password</title>
<link rel="stylesheet" href="../assets/css/forgot_password.css">
<link rel="icon" type="png" href="../assets/image/HNMS.png">
</head>
<body>
    <div class="forgot-container">

        <!-- FORGOT PASSWORD FORM -->
        <div class="forgot-card" id="forgotCard">
            <div class="logo">
                <img id="img1" src="../assets/image/HNMS.png" alt="Logo">
                <span>HNMS</span>
            </div> 
            <h2>Forgot password?</h2>
            <p>Enter your E-mail to get OTP.</p>
            <input type="email" id="userInput" placeholder="Enter your email">
            <button id="sendOtpBtn">Send OTP</button>
            <a href="../view/signin_signup.php" id="backToLogin">← Back to log in</a>
        </div>

        <!-- OTP VERIFICATION FORM -->
        <div class="forgot-card" id="otpCard" style="display:none;">
            <div class="logo">
                <img src="HNMS.png" alt="HNMS Logo">
                <span>HNMS</span>
            </div> 
            <h2>OTP Verification</h2>
            <p>We have sent a code to <span id="userContact">your@email.com</span></p>
            <div class="otp-inputs">
                <input type="text" maxlength="1" class="otp">
                <input type="text" maxlength="1" class="otp">
                <input type="text" maxlength="1" class="otp">
                <input type="text" maxlength="1" class="otp">
            </div>
            <button id="verifyOtpBtn">Verify</button>
            <p><a href="#" id="resendOtp">Didn't receive the OTP? Click to resend</a></p>
            <a href="#" id="backToEnterMail">← Back</a>
        </div>

        <!-- RESET PASSWORD FORM -->
        <div class="forgot-card" id="resetCard" style="display:none;">
            <div class="logo">
                <img src="HNMS.png" alt="HNMS Logo">
                <span>HNMS</span>
            </div> 
            <h2>Set new password</h2>
            <p>Must be at least 8 characters.</p>
            <input type="password" id="newPass" placeholder="New Password">
            <input type="password" id="confirmPass" placeholder="Confirm Password">
            <button id="resetBtn">Reset password</button>
            <a href="signin_signup.html" id="backToLogin2">← Back to log in</a>
        </div>

    </div>

<script src="../assets/js/forgot_password.js"></script>
</body>
</html>
