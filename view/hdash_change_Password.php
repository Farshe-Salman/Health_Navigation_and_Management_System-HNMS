<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <!-- Change Password -->
  <div id="changePassword" class="section" >
    <h3>Change Password</h3>
    <div class="card">
      <form id="changePasswordForm">
        <div class="form-row">
          <div class="form-group">
            <label>Current Password*</label>
            <input type="password" id="currentPassword" placeholder="Enter current password">
            <span class="toggle-password" onclick="togglePassword('currentPassword')">Show</span>
            <div id="currentError" class="error-text"></div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>New Password*</label>
            <input type="password" id="newPassword" placeholder="Enter new password">
            <span class="toggle-password" onclick="togglePassword('newPassword')">Show</span>
            <div id="newError" class="error-text"></div>
          </div>
          <div class="form-group">
            <label>Confirm Password*</label>
            <input type="password" id="confirmPassword" placeholder="Confirm new password">
            <span class="toggle-password" onclick="togglePassword('confirmPassword')">Show</span>
            <div id="confirmError" class="error-text"></div>
          </div>
        </div>
        <button type="submit">UPDATE PASSWORD</button>
      </form>
      <p id="passwordMessage"></p>
    </div>
  </div>

</body>
</html>