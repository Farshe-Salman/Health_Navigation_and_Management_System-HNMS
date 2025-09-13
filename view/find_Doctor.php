<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>
    <!-- Doctors -->
      <div id="doctors" class="section">
        <h3>Search Doctor</h3>
        <div class="doctor-search">
          <select id="doctorDepartment">
            <option>Select department</option>
            <option>Accident & Emergency</option>
            <option>Anesthesia and Pain Medicine</option>
            <option>Cancer Care Centre</option>
            <option>Cardiology Care Centre</option>
            <option>Cardiothoracic & Vascular Surgery</option>
            <option>Child Development Centre</option>
            <option>Critical Care Units</option>
            <option>Neurology</option>
          </select>
          </div>
          <div class="doctor-search">
            <input type="text" id="searchDoctor" placeholder="Search by doctor name">
          </div>
          
        

        <div class="doctor-list">
          <!-- Doctor Cards -->
          <div class="doctor-card">
            <img src="Profile.jpg" alt="Dr. Sarkar Md. Shizan">
            <div class="doctor-info">
              <h4>Dr. Sarkar Md. Shizan</h4>
              <p><strong>MBBS, FCPS (ENT), MS (Otolaryngology)</strong></p>
              <p class="designation">Coordinator & Senior Consultant<br>ENT & Head Neck Surgery<br>Child Specialist</p>
            </div>
            <div class="button-group">
              <button class="btn-primary">Request an Appointment</button>
              <button class="btn-secondary">View Doctor Profile</button>
            </div>
          </div>

          <div class="doctor-card">
            <img src="doc2.jpg" alt="Dr. Michael Brown">
            <div class="doctor-info">
              <h4>Dr. Michael Brown</h4>
              <p><strong>MBBS, MS (Orthopedics)</strong></p>
              <p class="designation">Senior Consultant<br>Orthopedics Department</p>
            </div>
            <div class="button-group">
              <button class="btn-primary">Request an Appointment</button>
              <button class="btn-secondary">View Doctor Profile</button>
            </div>
          </div>

          <div class="doctor-card">
            <img src="doctor3.jpg" alt="Dr. John Smith">
            <div class="doctor-info">
              <h4>Dr. John Smith</h4>
              <p><strong>MBBS, MS (Neurology)</strong></p>
              <p class="designation">Specialist<br>Neurology Department</p>
            </div>
            <div class="button-group">
              <button class="btn-primary">Request an Appointment</button>
              <button class="btn-secondary">View Doctor Profile</button>
            </div>
          </div>

          <div class="doctor-card">
            <img src="doctor4.jpg" alt="Dr. Emily Davis">
            <div class="doctor-info">
              <h4>Dr. Emily Davis</h4>
              <p><strong>MBBS, FCPS (Dermatology)</strong></p>
              <p class="designation">Consultant<br>Dermatology Department</p>
            </div>
            <div class="button-group">
              <button class="btn-primary">Request an Appointment</button>
              <button class="btn-secondary">View Doctor Profile</button>
            </div>
          </div>

          <div class="doctor-card">
            <img src="doctor5.jpg" alt="Dr. Sarah Khan">
            <div class="doctor-info">
              <h4>Dr. Sarah Khan</h4>
              <p><strong>MBBS, MD (Cardiology), Diabetes Specialist</strong></p>
              <p class="designation">Senior Consultant<br>Cardiology Care Centre<br>Orthopedics Department</p>
            </div>
            <div class="button-group">
              <button class="btn-primary">Request an Appointment</button>
              <button class="btn-secondary">View Doctor Profile</button>
            </div>
          </div>
        </div>
      </div>
 <script src="../assets/js/patient_dashboard.js"></script>
</body>
</html>