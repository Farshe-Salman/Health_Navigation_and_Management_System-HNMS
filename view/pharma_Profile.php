<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <!-- Pharmacy Profile Section -->
    <div id="pharmacyProfile" class="section" style="display:none;">
      <h3>Pharmacy Profile & Verification</h3>
      <div class="profile-container">
        <!-- Left: Profile Info -->
        <div id="profileInfoContainer">
          <h4>Profile Information</h4><br>
          <form id="pharmacyProfileForm">
            <div class="profile-field">
              <label for="profileName">Username:</label>
              <div class="field-row">
                <input type="text" id="profileName" value="City Pharmacy" disabled>
                <button type="button" class="edit-btn" onclick="enableEdit('profileName')">Edit</button>
              </div>
            </div>
            <div class="profile-field">
              <label for="profileEmail">Email:</label>
              <div class="field-row">
                <input type="email" id="profileEmail" value="citypharmacy@example.com" disabled>
                <button type="button" class="edit-btn" onclick="enableEdit('profileEmail')">Edit</button>
              </div>
            </div>
            <div class="profile-field">
              <label for="profilePhone">Contact Number:</label>
              <div class="field-row">
                <input type="text" id="profilePhone" value="01712345678" disabled>
                <button class="edit-btn" onclick="enableEdit('profilePhone')">Edit</button>
              </div>
            </div>
            <div class="profile-field">
              <label for="profileAddress">Address:</label>
              <div class="field-row">
                <input type="text" id="profileAddress" value="Dhaka, Bangladesh" disabled>
                <button class="edit-btn" onclick="enableEdit('profileAddress')">Edit</button>
              </div>
            </div>
            <div class="profile-field">
              <label for="profileHours">Operating Hours:</label>
              <div class="field-row">
                <input type="text" id="profileHours" value="9:00 AM - 10:00 PM" disabled>
                <button class="edit-btn" onclick="enableEdit('profileHours')">Edit</button>
              </div>
            </div>
            <button type="submit" class="rightbtn">Save Changes</button>
          </form>
        </div>
        <!-- Right: Verification Documents -->
        <div id="verificationDocsContainer">
          <h4>Verification Documents</h4>
          <br>
          <div class="verification-item">
            <label>TIN: </label>
            <span id="docTINStatus">❌ Not Uploaded</span>
            <input type="file" id="tinFile">
            <button type="button" class="rightbtn" onclick="uploadProfileDoc('tin')">Upload</button>
          </div>
          <div class="verification-item">
            <label>Trade License: </label>
            <span id="docDrugStatus">❌ Not Uploaded</span>
            <input type="file" id="tradeFile">
            <button type="button" class="rightbtn" onclick="uploadProfileDoc('trade')">Upload</button>
          </div>
          <div class="verification-item">
            <label>GST/VAT:</label>
            <span id="docGSTStatus">❌ Not Uploaded</span>
            <input type="file" id="gstFile">
            <button type="button" class="rightbtn" onclick="uploadProfileDoc('gst')">Upload</button>
          </div>
        </div>
      </div>
    </div>
</body>
</html>