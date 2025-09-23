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
      <div id="inventoryDoctorList">
        <!-- Doctors dynamically loaded here via JS -->
      </div>
    </div>

    <!-- Add Doctor Section -->
    <div id="addDoctorSection" class="section" style="display:none;">
      <h3>Add Doctor</h3>
      <div class="doctor-container">
        <!-- Doctor Info -->
        <div id="addDoctorInfoContainer" class="doctor-box">
          <h4>Doctor Information</h4>
          <form id="addDoctorForm">
            <div class="doctor-field">
              <label>Full Name:</label>
              <input type="text" id="doctorName" placeholder="Enter Doctor Name" required>
            </div>
            <div class="doctor-field">
              <label>Specialization:</label>
              <input type="text" id="doctorSpecialization" placeholder="Enter Specialization" required>
            </div>
            <div class="doctor-field">
              <label>Contact Number:</label>
              <input type="text" id="doctorPhone" placeholder="017XXXXXXXX" required>
            </div>
            <div class="doctor-field">
              <label>Email:</label>
              <input type="email" id="doctorEmail" placeholder="doctor@example.com" required>
            </div>
            <div class="doctor-field">
              <label>Experience (Years):</label>
              <input type="number" id="doctorExperience" placeholder="0" required>
            </div>
            <div class="doctor-field">
              <label>Availability:</label>
              <input type="text" id="doctorAvailability" placeholder="Mon-Fri, 9:00AM - 5:00PM" required>
            </div>
            <button type="submit" class="rightbtn">Save Doctor</button>
          </form>
        </div>

        <!-- Documents -->
        <div id="doctorDocsContainer" class="doctor-box">
          <h4>Required Documents</h4>
          <div class="doc-item">
            <label>Profile Photo:</label>
            <input type="file" id="doctorPhoto" accept=".jpg,.png" required>
          </div>
          <div class="doc-item">
            <label>Medical License:</label>
            <input type="file" id="doctorLicense" accept=".pdf,.jpg,.png" required>
          </div>
          <div class="doc-item">
            <label>Degree Certificate:</label>
            <input type="file" id="doctorDegree" accept=".pdf,.jpg,.png" required>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Doctor Section -->
    <div id="editDoctorSection" class="section" style="display:none;">
      <h3>Edit Doctor</h3>
      <div class="doctor-container">
        <div id="editDoctorInfoContainer" class="doctor-box">
          <h4>Doctor Information</h4>
          <form id="editDoctorForm">
            <div class="doctor-field">
              <label>Full Name:</label>
              <input type="text" id="editDoctorName" disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editDoctorName')">Edit</button>
            </div>
            <div class="doctor-field">
              <label>Specialization:</label>
              <input type="text" id="editDoctorSpecialization" disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editDoctorSpecialization')">Edit</button>
            </div>
            <div class="doctor-field">
              <label>Contact Number:</label>
              <input type="text" id="editDoctorPhone" disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editDoctorPhone')">Edit</button>
            </div>
            <div class="doctor-field">
              <label>Email:</label>
              <input type="email" id="editDoctorEmail" disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editDoctorEmail')">Edit</button>
            </div>
            <div class="doctor-field">
              <label>Experience (Years):</label>
              <input type="number" id="editDoctorExperience" disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editDoctorExperience')">Edit</button>
            </div>
            <div class="doctor-field">
              <label>Availability:</label>
              <input type="text" id="editDoctorAvailability" disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editDoctorAvailability')">Edit</button>
            </div>
            <button type="submit" class="rightbtn">Update Doctor</button>
          </form>
        </div>

        <div id="editDoctorDocsContainer" class="doctor-box">
          <h4>Required Documents</h4>
          <div class="doc-item">
            <label>Profile Photo:</label>
            <input type="file" id="editDoctorPhoto" disabled>
            <button type="button" class="rightbtn" onclick="enableFile('editDoctorPhoto')">Upload</button>
          </div>
          <div class="doc-item">
            <label>Medical License:</label>
            <input type="file" id="editDoctorLicense" disabled>
            <button type="button" class="rightbtn" onclick="enableFile('editDoctorLicense')">Upload</button>
          </div>
          <div class="doc-item">
            <label>Degree Certificate:</label>
            <input type="file" id="editDoctorDegree" disabled>
            <button type="button" class="rightbtn" onclick="enableFile('editDoctorDegree')">Upload</button>
          </div>
        </div>
      </div>
    </div>

</body>
</html>