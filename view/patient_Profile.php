<?php
require_once '../model/Patient_Model.php';

$patient_username = $_SESSION['user']['username'] ?? '';
if (!$patient_username) die("Patient not logged in!");

$model = new Patient_Profile_Model($conn);
$patient = $model->getPatientByUsername($patient_username);

if (!$patient) die("Patient record not found.");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Patient Profile</title>
</head>
<body>

<div id="profileSection" class="section" style="display:none;">
<h3>Patient Profile </h3>
<div class="profile-container">

        <!-- Patient Info -->
        <div id="editPatientInfoContainer" class="patient-box">
            <h4>Patient Information</h4><br>
<form id="editPatientForm" action="../controller/update_patient.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" id="editPatientId" name="patientId" value="<?= htmlspecialchars($patient['username']) ?>">
            <div class="profile-field">
                <label>Username:</label>
                <input type="text" id="editPatientUsername" name="patientUsername" 
                       value="<?= htmlspecialchars($patient['username']) ?>" readonly>
            </div>

            <div class="profile-field">
                <label>Email:</label>
                <input type="email" id="editPatientEmail" name="patientEmail" 
                       value="<?= htmlspecialchars($patient['email']) ?>" readonly>
            </div>

            <div class="profile-field">
                <label>Full Name:</label>
                <input type="text" id="editPatientName" name="patientName" 
                       value="<?= htmlspecialchars($patient['full_name']) ?>">
            </div>

            <div class="profile-field">
                <label>Contact Number:</label>
                <input type="text" id="editPatientPhone" name="patientPhone" 
                       value="<?= htmlspecialchars($patient['contact']) ?>">
            </div>

            <div class="profile-field">
                <label>Gender:</label>
                <select id="editPatientGender" name="patientGender">
                    <option value="">Select Gender</option>
                    <option value="Male" <?= $patient['gender']=='Male'?'selected':'' ?>>Male</option>
                    <option value="Female" <?= $patient['gender']=='Female'?'selected':'' ?>>Female</option>
                    <option value="Other" <?= $patient['gender']=='Other'?'selected':'' ?>>Other</option>
                </select>
            </div>

            <div class="profile-field">
                <label>Date of Birth:</label>
                <input type="date" id="editPatientDOB" name="patientDOB" 
                       value="<?= htmlspecialchars($patient['dob']) ?>">
            </div>

            <div class="profile-field">
    <label>Blood Group:</label>
    <select id="editPatientBloodGroup" name="patientBloodGroup">
        <option value="">Select Blood Group</option>
        <option value="A+" <?= $patient['blood_group']=='A+'?'selected':'' ?>>A+</option>
        <option value="A-" <?= $patient['blood_group']=='A-'?'selected':'' ?>>A-</option>
        <option value="B+" <?= $patient['blood_group']=='B+'?'selected':'' ?>>B+</option>
        <option value="B-" <?= $patient['blood_group']=='B-'?'selected':'' ?>>B-</option>
        <option value="O+" <?= $patient['blood_group']=='O+'?'selected':'' ?>>O+</option>
        <option value="O-" <?= $patient['blood_group']=='O-'?'selected':'' ?>>O-</option>
        <option value="AB+" <?= $patient['blood_group']=='AB+'?'selected':'' ?>>AB+</option>
        <option value="AB-" <?= $patient['blood_group']=='AB-'?'selected':'' ?>>AB-</option>
    </select>
</div>


            <div class="profile-field">
    <label>Address:</label>
    <input type="text" id="editPatientAddress" name="patientAddress" 
           value="<?= htmlspecialchars($patient['address']) ?>">
</div>

        </div>

   <!-- Documents -->
<div id="editPatientDocsContainer" class="patient-box">
    <h4>Documents</h4>

    <!-- Profile Photo -->
    <div class="doc-item">
        <img id="profileImagePreview" 
             src="<?= !empty($patient['profile_image']) ? "../assets/uploads/patient_documents/".htmlspecialchars($patient['profile_image']) : "default-profile.png" ?>" 
             alt="Profile Image" 
             class="doc-preview"><br>
        <label>Profile Photo:</label>
        <div class="file-input-container">
            <input type="text" 
                   id="profilePlaceholder" 
                   placeholder="<?= !empty($patient['profile_image']) ? htmlspecialchars($patient['profile_image']) : 'No file chosen' ?>" 
                   readonly 
                   onclick="document.getElementById('profileImageInput').click();">
            <input type="file" 
                   id="profileImageInput" 
                   name="editPatientPhoto" 
                   accept="image/*" 
                   style="display:none;" 
                   onchange="document.getElementById('profilePlaceholder').value = this.files[0].name; 
                             document.getElementById('profileImagePreview').src = URL.createObjectURL(this.files[0]);">
            <button type="button" onclick="document.getElementById('profileImageInput').click()">Upload</button>
        </div>
    </div>

    <!-- ID Proof -->
    <div class="doc-item">
        <label>ID Proof:</label>
        <div class="file-input-container">
            <input type="text" 
                   id="idProofPlaceholder" 
                   placeholder="<?= !empty($patient['id_proof']) ? htmlspecialchars($patient['id_proof']) : 'No file chosen' ?>" 
                   readonly 
                   onclick="document.getElementById('editPatientID').click();">
            <input type="file" id="editPatientID" name="editPatientID" accept=".pdf,.jpg,.png" style="display:none;" 
                   onchange="document.getElementById('idProofPlaceholder').value = this.files[0].name;">
            <button type="button" onclick="document.getElementById('editPatientID').click()">Upload</button>
        </div>
    </div>

    <!-- Medical Records -->
    <div class="doc-item">
        <label>Medical Records (Optional):</label>
        <div class="file-input-container">
            <input type="text" 
                   id="medicalPlaceholder" 
                   placeholder="<?= !empty($patient['medical_record']) ? htmlspecialchars($patient['medical_record']) : 'No file chosen' ?>" 
                   readonly 
                   onclick="document.getElementById('editPatientMedical').click();">
            <input type="file" id="editPatientMedical" name="editPatientMedical" accept=".pdf,.jpg,.png" style="display:none;" 
                   onchange="document.getElementById('medicalPlaceholder').value = this.files[0].name;">
            <button type="button" onclick="document.getElementById('editPatientMedical').click()">Upload</button>
        </div>
    </div>

</div>

    </div>

    <!-- Buttons -->
    <div style="margin-top: 15px;">
        <button type="button" class="editbtn" onclick="enableAllFields()">Edit</button>
        <button type="submit" class="rightbtn">Update Profile</button>
    </div>

</form>
</div>

</body>
</html>
