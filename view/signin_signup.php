<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/signin_signup.css">
  <title>Signin_Signup Page | HNMS</title>
  <link rel="icon" href="../assets/image/HNMS.png?v=2" type="image/png" sizes="32x32">
</head>
<body>
  <div class="container" id="container">
 
    <!-- Sign Up -->
    <div class="form-container sign-up">
      <form id="signupForm" method="POST" action="../controller/signup_Controller.php">
        <img id="img1" src="../assets/image/HNMS.png" alt="Logo">
        <h1>SIGN UP</h1>
        <span>- use your username & email to sign up</span>

        <input type="text" id="signupUsername" name="username" placeholder="Username">
        <div class="error" id="signupUsernameError"></div>

        <input type="text" id="signupEmail"  name="email" placeholder="E-mail">
        <div class="error" id="signupEmailError"></div>

        <select id="signupRole" name="usertype" >
          <option value="" disabled selected>Select User Role</option>
          <option value="patient">Patient</option>
          <option value="hospital">Hospital</option>
          <!-- <option value="pharmacy">Pharmacy</option> -->
          <option value="doctor">Doctor</option>
        </select>
        <div class="error" id="signupRoleError"></div>

        <div class="password-container">
          <input type="password" id="signupPassword" name="password" placeholder="Password">
          <span class="toggle-pass" id="toggleSignupPass">Show</span>
        </div>
        <div class="error" id="signupPasswordError"></div>
      
        <div class="form-message" id="signupFormMessage">
          <?php
          if(isset($_SESSION['signup_message'])) {
              echo $_SESSION['signup_message'];
              unset($_SESSION['signup_message']);
          }
          ?>
        </div>
        <button type="submit" name="signup">Sign Up</button>
        <a href="../view/landingPage.php" id="backToHome">← Back to Home</a>
      </form>
      
    </div>

    <!-- Sign In -->
    <div class="form-container sign-in">
      <form id="signinForm" method="POST" action="../controller/signin_Controller.php">
        <img id="img1" src="../assets/image/HNMS.png" alt="Logo">
        <h1>SIGN IN</h1>
        <span>- use your username to sign in</span>

        <input type="text" id="signinUsername" name="username" placeholder="Username">
        <div class="error" id="signinUsernameError"></div>

        <div class="password-container">
          <input type="password" id="signinPassword" name="password" placeholder="Password">
          <span class="toggle-pass" id="toggleSigninPass">Show</span>
        </div>
        <div class="error" id="signinPasswordError"></div>

         <div class="form-message" id="signinFormMessage">
          <?php
          if(isset($_SESSION['signin_message'])) {
              echo $_SESSION['signin_message'];
              unset($_SESSION['signin_message']);
          }
          ?>
        </div>
        <a class="forgot-pass" href="../view/forgot_password.php">Forget Your Password??</a>
        <button type="submit" name="signin">Sign In</button>
        <a href="../view/landingPage.php" id="backToHome">← Back to Home</a>
      </form>
    </div>

    <!-- Toggle Panel -->
    <div class="toggle-container">
      <div class="toggle">
        <div class="toggle-panel toggle-left">
          <img id="img2" src="../assets/image/HNMS.png" alt="Logo">
          <h1>HEALTH NAVIGATION MANAGEMENT SYSTEM</h1>
          <p id="p1">Your Health . Your Path . Simplified</p>
          <p id="p2">Already Have An Account?</p>
          <button class="hidden" id="login">Sign In</button>
        </div>
        <div class="toggle-panel toggle-right">
          <img id="img2" src="../assets/image/HNMS.png" alt="Logo">
          <h1>HEALTH NAVIGATION MANAGEMENT SYSTEM</h1>
          <p id="p1">Your Health . Your Path . Simplified</p>
          <p id="p2">Don't Have An Account?</p>
          <button class="hidden" id="register">Sign Up</button>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="../assets/js/signin_signup.js"></script>
</body>
</html>
