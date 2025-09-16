<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Verification | HNMS</title>
<link rel="stylesheet" href="../assets/css/signup_verification.css">
<link rel="icon" href="../assets/image/HNMS.png?v=2" type="image/png" sizes="32x32">
</head>
<body>
    <div class="verify-container">

        <!-- USER DETAILS / INIT VERIFICATION -->
        <div class="verify-card" id="userCard">
           <div class="logo">
               <img src="../assets/image/HNMS.png" alt="HNMS Logo">
               <span>HNMS</span>
           </div> 
            <h2>User Verification</h2>
            <p>Enter your E-mail to receive OTP.</p>
            <input type="email" id="userInput" placeholder="Enter your email or phone">
            <button id="sendOtpBtn">Send OTP</button>
        </div>

        <!-- OTP VERIFICATION FORM -->
        <div class="verify-card" id="otpCard" style="display:none;">
            <div class="logo">
                <img src="../assets/image/HNMS.png" alt="HNMS Logo">
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

        </div>

        <!-- SUCCESS CONFIRMATION FORM -->
        <div class="verify-card" id="successCard" style="display:none;">
             <div class="logo">
                <img src="../assets/image/HNMS.png" alt="HNMS Logo">
                <span>HNMS</span>
             </div> 
            <h2>Verification Successful!</h2>
            <p>Your account has been created successfully.</p>
            <button id="goToLogin">Go to Login</button>
        </div>

    </div>

<script src="../assets/js/signup_verification.js"></script>
</body>
</html>
