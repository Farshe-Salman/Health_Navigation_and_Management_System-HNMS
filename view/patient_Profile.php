<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Patient Profile Section -->
      <div class="section" id="profileSection" style="display:none;">
        <h2>My Profile</h2>
        <form id="profileForm">

          <div class="profile-field">
            <label for="profileName">Username:</label>
            <div class="field-row">
              <input type="text" id="profileName" placeholder="Full Name" value="Shizan Sarkar" disabled required>
              <button type="button" class="edit-btn" onclick="enableEdit('profileName')">Edit</button>
            </div>
          </div>

          <div class="profile-field">
            <label for="profileEmail">Email:</label>
            <div class="field-row">
              <input type="email" id="profileEmail" placeholder="Email" value="shizan@example.com" disabled required>
              <button type="button" class="edit-btn" onclick="enableEdit('profileEmail')">Edit</button>
            </div>
          </div>

          <div class="profile-field">
            <label for="profilePhone">Phone:</label>
            <div class="field-row">
              <input type="text" id="profilePhone" placeholder="Phone Number" value="01712345678" disabled required>
              <button type="button" class="edit-btn" onclick="enableEdit('profilePhone')">Edit</button>
            </div>
          </div>

          <button type="submit" class="petient-btn-primary">Save Changes</button>
        </form>
      </div>

</body>
</html>