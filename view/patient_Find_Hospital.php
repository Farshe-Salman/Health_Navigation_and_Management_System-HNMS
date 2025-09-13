<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <!-- Hospitals -->
      <div id="hospitals" class="section">
        <h3>Registered Hospitals</h3>
        <input type="text" placeholder="Search hospital or facility..." id="searchHospitals">

        <div class="hospital-list">
          <div class="hospital-card">
            <img src="hospital1.jpg" alt="City General Hospital">
            <div class="hospital-info">
              <h4>City General Hospital</h4>
              <p>Category: Government | Facilities: ICU, Emergency, Lab</p>
            </div>
            <div class="button-group">
              <button class="btn-primary" onclick="bookAppointmentFromHospital('City General Hospital')">Book
                Appointment</button>
              <button class="btn-secondary">View Details</button>
            </div>
          </div>

          <div class="hospital-card">
            <img src="hospital2.jpg" alt="Sunrise Diagnostics">
            <div class="hospital-info">
              <h4>Sunrise Diagnostics</h4>
              <p>Category: Diagnostic Center | Facilities: Lab Tests, Imaging</p>
            </div>
            <div class="button-group">
              <button class="btn-primary" onclick="bookAppointmentFromHospital('Sunrise Diagnostics')">Book
                Appointment</button>
              <button class="btn-secondary">View Details</button>
            </div>
          </div>
        </div>
      </div>
</body>
</html>