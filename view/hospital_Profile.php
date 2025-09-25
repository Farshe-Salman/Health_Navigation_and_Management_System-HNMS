<?php
require_once '../model/Hospital_Profile_Model.php';

$hospital_username = $_SESSION['user']['username'] ?? '';
if (!$hospital_username) die("Hospital not logged in!");

$model = new Hospital_Profile_Model($conn);
$hospital = $model->getHospitalByUsername($hospital_username);

if (!$hospital) die("Hospital record not found.");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Hospital Profile</title>
</head>
<body>

<div id="hospitalProfile" class="section" style="display:none;">
  <h3>Hospital Profile</h3>
  <div class="profile-container">

    <!-- Profile Info -->
    <div id="hospitalInfoContainer" class="profile-box">
      <h4>Profile Information</h4><br>
      <form id="hospitalProfileForm" action="../controller/update_hospital.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="hospitalId" name="hospitalId" value="<?= htmlspecialchars($hospital['username']) ?>">
        <div class="file-input-container">
          <img id="profileImagePreview"
             src="<?= !empty($hospital['profile_image']) ? "../assets/uploads/hospital_documents/" . htmlspecialchars($hospital['profile_image']) : "default-profile.png" ?>"
             alt="Profile Image" class="doc-preview">
        </div>
        <!-- Username -->
        <div class="profile-field">
          <label>Username:</label>
          <input type="text" id="hospitalUsername" value="<?= htmlspecialchars($hospital['username']) ?>" readonly>
        </div>

        <!-- Hospital Name -->
        <div class="profile-field">
          <label>Hospital Name:</label>
          <input type="text" id="hospitalName" name="hospitalName" value="<?= htmlspecialchars($hospital['hospital_name']) ?>">
        </div>

        <!-- Email -->
        <div class="profile-field">
          <label>Email:</label>
          <input type="email" id="hospitalEmail" name="hospitalEmail" value="<?= htmlspecialchars($hospital['email']) ?>" readonly>
        </div>

        <!-- Phone -->
        <div class="profile-field">
          <label>Phone:</label>
          <input type="text" id="hospitalPhone" name="hospitalPhone" value="<?= htmlspecialchars($hospital['phone']) ?>">
        </div>

        <!-- Address -->
        <div class="profile-field">
          <label>Address:</label>
          <input type="text" id="hospitalAddress" name="hospitalAddress" value="<?= htmlspecialchars($hospital['address']) ?>">
        </div>

        <!-- Category -->
        <div class="profile-field">
          <label>Category:</label>
          <select id="hospitalCategory" name="hospitalCategory">
            <option value="general" <?= $hospital['category'] == 'general' ? 'selected' : '' ?>>General</option>
            <option value="specialized" <?= $hospital['category'] == 'specialized' ? 'selected' : '' ?>>Specialized</option>
            <option value="teaching" <?= $hospital['category'] == 'teaching' ? 'selected' : '' ?>>Teaching</option>
          </select>
        </div>
    </div>

    <!-- Verification Documents -->
    <div id="verificationDocsContainer" class="profile-box">
      <h4>Verification Documents</h4><br>

      <!-- Profile Image -->
      <div class="profile-field">
        <label>Profile Image:</label>
        <input type="text" id="profilePlaceholder" readonly
             placeholder="<?= !empty($hospital['profile_image']) ? htmlspecialchars($hospital['profile_image']) : 'No file chosen' ?>"
             onclick="document.getElementById('profileImageInput').click();">
        <input type="file" id="profileImageInput" name="profileImage" accept="image/*" style="display:none;"
             onchange="document.getElementById('profilePlaceholder').value = this.files[0].name;
                 document.getElementById('profileImagePreview').src = URL.createObjectURL(this.files[0]);">
        <button type="button" onclick="document.getElementById('profileImageInput').click()">Upload</button>
      </div>

      <?php
      $docs = [
        'licenseFile' => 'License Certificate',
        'accreditationFile' => 'Accreditation Certificate',
        'vatFile' => 'Tax Certificate'
      ];

      foreach ($docs as $inputName => $label):
        $dbField = str_replace('File', '_file', $inputName);
        $fileValue = !empty($hospital[$dbField]) ? $hospital[$dbField] : '';
      ?>
      <div class="doc-item">
        <label><?= $label ?>:</label>
        <div class="file-input-container">
          <input type="text"
               id="<?= $inputName ?>Placeholder"
               readonly
               value="<?= htmlspecialchars($fileValue ?: 'No file chosen') ?>"
               onclick="document.getElementById('<?= $inputName ?>Input').click();">
          <input type="file"
               id="<?= $inputName ?>Input"
               name="<?= $inputName ?>"
               accept=".pdf,.jpg,.png,image/*"
               style="display:none;"
               onchange="document.getElementById('<?= $inputName ?>Placeholder').value = this.files[0].name;">
          <button type="button" onclick="document.getElementById('<?= $inputName ?>Input').click()">Upload</button>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
</div>
    <!-- Edit / Save Buttons -->
    <div style="margin-top:10px;">
      <button type="button" class="edit-btn" onclick="enableAllHospitalFields()">Edit</button>
      <button type="submit" class="rightbtn">Update Profile</button>
    </div>

    </form>
  
</div>

</body>
</html>
