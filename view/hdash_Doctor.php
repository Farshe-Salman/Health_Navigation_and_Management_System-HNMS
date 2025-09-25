<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Doctor Section -->
    <div id="doctor" class="section" style="display:none;">
      <h3>Doctors Inventory</h3>
      <button class="btn-primary" onclick="openDoctorSection()">Add New Doctor</button>
      <input type="text" placeholder="Search Doctor's..." id="searchDoctors" onkeyup="searchDoctorAjax()">
   <div id="inventoryDoctorList" class="doc-list">
<?php
require_once '../model/hdash_model.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$hospital_username = $_SESSION['user']['username'] ?? '';
$doctors = getDoctors($hospital_username);

if(!$doctors) {
    echo "<p>No doctors available. Add new doctors.</p>";
} else {
    foreach($doctors as $doc) {
    $docJson = htmlspecialchars(json_encode($doc), ENT_QUOTES, 'UTF-8');
    ?>
    <div class="doctor-item">
      <div class="doctor-card" data-doctor='<?= $docJson ?>'>
        <img src="../assets/uploads/doctors_document/<?= htmlspecialchars($doc["profile_image"]) ?>" 
             alt="<?= htmlspecialchars($doc["doctor_name"]) ?>" 
             style="width:100px; height:100px; object-fit:cover; border-radius:50%;">
        
        <h4><?= htmlspecialchars($doc["doctor_name"]) ?></h4>
        <p><strong>Specialization:</strong> <?= htmlspecialchars($doc["specialization"]) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($doc["contact"]) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($doc["email"]) ?></p>
        <p><strong>Experience:</strong> <?= htmlspecialchars($doc["experience_years"]) ?> years</p>
        <p><strong>Availability:</strong> <?= htmlspecialchars($doc["schedule_days"]) ?></p>
        
        <!-- Action buttons -->
        <button class="edit-btn" onclick="editDoctor(this)">Edit</button>
        <a href="../controller/hdash_delete_doctor_controller.php?id=<?= $doc["doctor_id"] ?>" 
           class="delete-btn" 
           onclick="return confirm('Are you sure you want to delete this doctor?');">
           Delete
        </a>
      </div>
    </div>
    <?php
}
}
?>
</div>
</div>

<!-- Add Doctor Section -->
<div id="addDoctorSection" class="section" style="display:none;">
  <h3>Add Doctor</h3>

  <!-- One Form Wrapping Everything -->
  <form id="addDoctorForm" action="../controller/hdash_controller.php" method="POST" enctype="multipart/form-data">
  <div class="doctor-container">
    <!-- Left: Doctor Info -->
    <div id="addDoctorInfoContainer" class="doctor-box">
      <h4>Doctor Information</h4>
      <div class="doctor-field">
        <label>Full Name:</label>
        <input type="text" id="doctorName" name="doctorName" placeholder="Enter Doctor Name" required>
      </div>
      <div class="doctor-field">
        <label>Email:</label>
        <input type="email" id="doctorEmail" name="doctorEmail" placeholder="doctor@example.com" required>
      </div>
      <div class="doctor-field">
        <label>Contact Number:</label>
        <input type="text" id="doctorPhone" name="doctorPhone" placeholder="017XXXXXXXX" required>
      </div>
      <div class="doctor-field">
        <label>Specialization's:</label>
        <input type="text" id="doctorSpecialization" name="doctorSpecialization" placeholder="Enter Specialization" required>
      </div>
      <div class="doctor-field">
        <label>Qualification's:</label>
        <input type="text" id="doctorQualification" name="doctorQualification" placeholder="Enter Qualification" required>
      </div>
      <div class="doctor-field">
        <label>Experience (Years):</label>
        <input type="number" id="doctorExperience" name="doctorExperience" placeholder="0" required>
      </div>
      <div class="doctor-field">
        <label>Counsultation_fee:</label>
        <input type="number" id="consultantfee" name="consultFee" placeholder="0" required>
      </div>
      

      <!-- Availability Fields -->
      <div class="doctor-field">
        <label>Start Time:</label>
        <input type="time" id="doctorStartTime" name="doctorStartTime" required>
      </div>
      <div class="doctor-field">
        <label>End Time:</label>
        <input type="time" id="doctorEndTime" name="doctorEndTime" required>
      </div>
      <div class="doctor-field">
        <label>Available Days:</label><br>
        <div id="doctorDays">
          <label><input type="checkbox" name="doctorDays[]" value="Sun"> Sun</label>
          <label><input type="checkbox" name="doctorDays[]" value="Mon"> Mon</label>
          <label><input type="checkbox" name="doctorDays[]" value="Tue"> Tue</label>
          <label><input type="checkbox" name="doctorDays[]" value="Wed"> Wed</label>
          <label><input type="checkbox" name="doctorDays[]" value="Thu"> Thu</label>
          <label><input type="checkbox" name="doctorDays[]" value="Fri"> Fri</label>
          <label><input type="checkbox" name="doctorDays[]" value="Sat"> Sat</label>
        </div>
      </div>
    </div>

    <!-- Right: Documents -->
    <div id="adddoctorDocsContainer" class="doctor-box">
      <h4>Required Documents</h4>
      <div class="doc-item">
        <label>Profile Photo:</label>
        <input type="file" id="doctorPhoto" name="doctorPhoto" accept=".jpg,.png" required>
      </div>
      <div class="doc-item">
        <label>Medical License:</label>
        <input type="file" id="doctorLicense" name="doctorLicense" accept=".pdf,.jpg,.png">
      </div>
      <div class="doc-item">
        <label>Degree Certificate:</label>
        <input type="file" id="doctorDegree" name="doctorDegree" accept=".pdf,.jpg,.png">
      </div><br><br>

      <h4>Profile Credentials</h4>
      <div class="doctor-field">
        <label>Username:</label>
        <input type="text" id="doctorUsername" name="doctorUsername" placeholder="Enter Username" required>
      </div>
      <div class="doctor-field">
        <label>Password:</label>
        <input type="password" id="doctorPassword" name="doctorPassword" placeholder="Enter Password" required>
        <span id="addDoc-toggle-password" onclick="togglePassword('doctorPassword')">Show</span>
      </div>
    </div>
  </div>

  <div>
    <button type="submit" class="rightbtn">Save Doctor</button>
  </div>
</form>

</div>

<!-- Edit Doctor Section -->
<div id="editDoctorSection" class="section" style="display:none;">
  <h3>Edit Doctor</h3>

  <form id="editDoctorForm" action="../controller/update_doctor.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" id="editDoctorId" name="doctorId">

    <div class="doctor-container">

      <!-- Left: Doctor Info -->
      <div id="editDoctorInfoContainer" class="doctor-box">
        <h4>Doctor Information</h4>

        <div class="doctor-field">
          <label>Full Name:</label>
          <input type="text" id="editDoctorName" name="doctorName" value="">
        </div>

        <div class="doctor-field">
          <label>Email:</label>
          <input type="email" id="editDoctorEmail" name="doctorEmail" value="">
        </div>

        <div class="doctor-field">
          <label>Contact Number:</label>
          <input type="text" id="editDoctorPhone" name="doctorPhone" value="">
        </div>

        <div class="doctor-field">
          <label>Specialization:</label>
          <input type="text" id="editDoctorSpecialization" name="doctorSpecialization" value="">
        </div>

        <div class="doctor-field">
          <label>Qualification:</label>
          <input type="text" id="editDoctorQualification" name="doctorQualification" value="">
        </div>

        <div class="doctor-field">
          <label>Experience (Years):</label>
          <input type="number" id="editDoctorExperience" name="doctorExperience" value="">
        </div>

        <div class="doctor-field">
          <label>Consultation Fee:</label>
          <input type="number" id="editconsultantfee" name="consultFee" value="">
        </div>

        <div class="doctor-field">
          <label>Start Time:</label>
          <input type="time" id="editDoctorStartTime" name="doctorStartTime" value="">
        </div>

        <div class="doctor-field">
          <label>End Time:</label>
          <input type="time" id="editDoctorEndTime" name="doctorEndTime" value="">
        </div>

        <div class="doctor-field">
          <label>Available Days:</label><br>
          <label><input type="checkbox" name="editDoctorDays[]" value="Sun"> Sun</label>
          <label><input type="checkbox" name="editDoctorDays[]" value="Mon"> Mon</label>
          <label><input type="checkbox" name="editDoctorDays[]" value="Tue"> Tue</label>
          <label><input type="checkbox" name="editDoctorDays[]" value="Wed"> Wed</label>
          <label><input type="checkbox" name="editDoctorDays[]" value="Thu"> Thu</label>
          <label><input type="checkbox" name="editDoctorDays[]" value="Fri"> Fri</label>
          <label><input type="checkbox" name="editDoctorDays[]" value="Sat"> Sat</label>
        </div>
      </div>

      <!-- Right: Documents -->
      <div id="editDoctorDocsContainer" class="doctor-box">
        <h4>Required Documents</h4>

        <div class="doc-item">
          <label>Profile Photo:</label>
          <input type="file" name="editDoctorPhoto" accept=".jpg,.png">
        </div>

        <div class="doc-item">
          <label>Medical License:</label>
          <input type="file" name="editDoctorLicense" accept=".pdf,.jpg,.png">
        </div>

        <div class="doc-item">
          <label>Degree Certificate:</label>
          <input type="file" name="editDoctorDegree" accept=".pdf,.jpg,.png">
        </div><br>
      </div>

    </div>

    <!-- Buttons -->
    <div>
      <button type="button" class="edit-btn" onclick="enableAllEditFields()">Edit</button>
      <button type="submit" class="rightbtn">Update Doctor</button>
    </div>

  </form>
</div>

</html>

