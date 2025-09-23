<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <!-- Appointment Form -->
  <div id="appointments" class="section">
    <h3>Appointment Request Form</h3>
    <div class="card appointment-card">
      <form id="appointmentForm">
        <div class="form-row">
          <div class="form-group">
            <label>Hospital*</label>
            <select id="hospitalSelect">
              <option value="">Select Hospital</option>
              <option value="City General Hospital">City General Hospital</option>
              <option value="Sunrise Diagnostics">Sunrise Diagnostics</option>
            </select>
            <div id="hospitalError" class="error-text"></div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Patient Name*</label>
            <input type="text" id="patientName" placeholder="Full name">
            <div id="nameError" class="error-text"></div>
          </div>
          <div class="form-group">
            <label>Date of Birth*</label>
            <input type="date" id="dob">
            <div id="dobError" class="error-text"></div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Gender*</label>
            <select id="gender">
              <option value="">Select Gender</option>
              <option>Male</option>
              <option>Female</option>
            </select>
            <div id="genderError" class="error-text"></div>
          </div>
          <div class="form-group">
            <label>Contact Number*</label>
            <input type="tel" id="contact" placeholder="+8801XXXXXXXXX">
            <div id="contactError" class="error-text"></div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group" style="flex:1; margin-right:15px;">
            <label>Doctor*</label>
            <select id="doctorSelect" style="width:100%;">
              <option value="">Select Doctor</option>
              <option>Dr. Rahman</option>
              <option>Dr. Sultana</option>
            </select>
            <div id="doctorError" class="error-text"></div>
          </div>
          <div class="form-group" style="flex:1;">
            <label>Appointment Date*</label>
            <input type="date" id="appointmentDate" style="width:100%;">
            <div id="appointmentDateError" class="error-text"></div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Appointment Time (9:00AM - 5:00PM)</label>
            <input type="time" id="appointmentTime">
          </div>
        </div>

        <button type="submit">SUBMIT</button>
      </form>
    </div>
  </div>
</body>
</html>