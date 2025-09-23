<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- Hospital Profile Section -->
<div id="hospitalProfile" class="section" style="display:none;">
  <h3>Hospital Profile & Verification</h3>
  <div class="profile-container">

    <!-- Left: Profile Info -->
    <div id="hospitalInfoContainer">
      <h4>Profile Information</h4><br>
      
      <!-- Start Form -->
      <form id="hospitalProfileForm">

        <!-- Profile Image -->
        <div class="profile-field">
          <label>Profile Image:</label>
          <div class="field-row">
            <img id="profileImagePreview" src="default-profile.png" alt="Profile Image">
            <input type="file" id="profileImageInput" accept="image/*" style="margin-left:10px;" disabled>
            <button type="button" class="rightbtn" onclick="uploadProfileDoc('profileImage')">Upload Image</button>
          </div>
        </div>

        <!-- Username -->
        <div class="profile-field">
          <label for="username">Username:</label>
          <div class="field-row">
            <input type="text" id="username" placeholder="User Name" value="user123" disabled>
          </div>
        </div>

        <!-- Hospital Name -->
        <div class="profile-field">
          <label for="hospitalName">Hospital Name:</label>
          <div class="field-row">
            <input type="text" id="hospitalName" value="City Hospital" disabled>
          </div>
        </div>

        <!-- Email -->
        <div class="profile-field">
          <label for="hospitalEmail">Email:</label>
          <div class="field-row">
            <input type="email" id="hospitalEmail" value="cityhospital@example.com" disabled>
          </div>
        </div>

        <!-- Contact Number -->
        <div class="profile-field">
          <label for="hospitalPhone">Contact Number:</label>
          <div class="field-row">
            <input type="text" id="hospitalPhone" value="01712345678" disabled>
          </div>
        </div>

        <!-- Address -->
        <div class="profile-field">
          <label for="hospitalAddress">Address:</label>
          <div class="field-row">
            <input type="text" id="hospitalAddress" value="Dhaka, Bangladesh" disabled>
          </div>
        </div>

        <!-- Category -->
        <div class="profile-field">
          <label for="hospitalCategory">Category:</label>
          <div class="field-row">
            <select id="hospitalCategory" disabled>
              <option value="general">General</option>
              <option value="specialized">Specialized</option>
              <option value="teaching">Teaching</option>
            </select>
          </div>
        </div>

        <!-- Facilities -->
        <div class="profile-field">
          <label>Facilities:</label>
          <div class="field-row" id="hospitalFacilities">
            <label><input type="checkbox" value="ICU" disabled> ICU</label>
            <label><input type="checkbox" value="Emergency" disabled> Emergency</label>
            <label><input type="checkbox" value="Pharmacy" disabled> Pharmacy</label>
            <label><input type="checkbox" value="Lab" disabled> Lab</label>
            <label><input type="checkbox" value="Radiology" disabled> Radiology</label>
            <label><input type="checkbox" value="Maternity" disabled> Maternity</label>
            <label><input type="checkbox" value="Cardiology" disabled> Cardiology</label>
            <label><input type="checkbox" value="Neurology" disabled> Neurology</label>
          </div>
        </div>

        <!-- Single Edit Button -->
        <div class="profile-btn" style="margin-top:15px;">
          <button type="button" class="edit-btn" onclick="enableAllHospitalFields()">Edit Profile</button>
          <button type="submit" class="rightbtn">Save Changes</button>
        </div>
    </div>

    <!-- Verification Documents -->
    <div id="verificationDocsContainer">
      <h4>Verification Documents</h4><br>

      <div class="verification-item">
        <label>License Certificate:</label>
        <span id="docLicenseStatus">❌ Not Uploaded</span>
        <input type="file" id="licenseFile" accept=".pdf,image/*" disabled>
        <button type="button" class="rightbtn" onclick="uploadProfileDoc('license')">Upload</button>
      </div>

      <div class="verification-item">
        <label>Accreditation Certificate:</label>
        <span id="docAccreditationStatus">❌ Not Uploaded</span>
        <input type="file" id="accreditationFile" accept=".pdf,image/*" disabled>
        <button type="button" class="rightbtn" onclick="uploadProfileDoc('accreditation')">Upload</button>
      </div>

      <div class="verification-item">
        <label>VAT/Tax Certificate:</label>
        <span id="docVATStatus">❌ Not Uploaded</span>
        <input type="file" id="vatFile" accept=".pdf,image/*" disabled>
        <button type="button" class="rightbtn" onclick="uploadProfileDoc('vat')">Upload</button>
      </div>
    </div>

    <!-- Close the Form here -->
    </form>

  </div>
</div>



</body>
</html>