<?php
include "../config/db_connection.php";
include "../controller/AppointmentController.php";

$controller = new AppointmentController($conn);
$hospitals = $controller->getHospitals();
?>

<div id="appointments" class="section" style="display:none;"> <!-- Hidden by default -->
  <h3>Appointment Request Form</h3>
  <div class="card appointment-card">
    <form id="appointmentForm" method="POST" action="../controller/AppointmentController.php?action=save">
      <!-- Hospital -->
      <div class="form-row">
        <div class="form-group">
          <label>Hospital*</label>
          <select id="hospitalSelect" name="hospital_name" required>
            <option value="">Select Hospital</option>
            <?php foreach($hospitals as $hospital): ?>
                <option value="<?= htmlspecialchars($hospital) ?>"><?= htmlspecialchars($hospital) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <!-- Patient Name & DOB -->
      <div class="form-row">
        <div class="form-group">
          <label>Patient Name*</label>
          <input type="text" id="patientName" name="patient_name" placeholder="Full name" required>
        </div>
        <div class="form-group">
          <label>Date of Birth*</label>
          <input type="date" id="dob" name="dob" required>
        </div>
      </div>

      <!-- Gender & Contact -->
      <div class="form-row">
        <div class="form-group">
          <label>Gender*</label>
          <select id="gender" name="gender" required>
            <option value="">Select Gender</option>
            <option>Male</option>
            <option>Female</option>
          </select>
        </div>
        <div class="form-group">
          <label>Contact Number*</label>
          <input type="tel" id="contact" name="contact" placeholder="+8801XXXXXXXXX" required>
        </div>
      </div>

      <!-- Doctor & Appointment Date -->
      <div class="form-row">
        <div class="form-group" style="flex:1; margin-right:15px;">
          <label>Doctor*</label>
          <select id="doctorSelect" name="doctor_name" style="width:100%;" required>
            <option value="">Select Doctor</option>
          </select>
        </div>
        <div class="form-group" style="flex:1;">
          <label>Appointment Date*</label>
          <input type="date" id="appointmentDate" name="appointment_date" style="width:100%;" required>
        </div>
      </div>

      <!-- Appointment Time -->
      <div class="form-row">
        <div class="form-group">
          <label>Appointment Time (9:00AM - 5:00PM)</label>
          <input type="time" id="appointmentTime" name="appointment_time">
        </div>
      </div>

      <button type="submit">SUBMIT</button>
    </form>
  </div>
</div>
