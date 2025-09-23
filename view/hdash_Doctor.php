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
<<<<<<< HEAD
      <input type="text" placeholder="Search Doctor's..." id="searchDoctors">
      <div id="inventoryDoctorList" class="doc-list">
=======
      <div id="inventoryDoctorList">
>>>>>>> dca59e9d8a046b13be8c5a77c7e592307e0a6f2a
        <!-- Doctors dynamically loaded here via JS -->
      </div>
    </div>

<<<<<<< HEAD
<!-- Add Doctor Section -->
<div id="addDoctorSection" class="section" style="display:none;">
  <h3>Add Doctor</h3>

  <!-- One Form Wrapping Everything -->
  <form id="addDoctorForm">
    <div class="doctor-container">

      <!-- Left: Doctor Info -->
      <div id="addDoctorInfoContainer" class="doctor-box">
        <h4>Doctor Information</h4>
        <div class="doctor-field">
          <label>Full Name:</label>
          <input type="text" id="doctorName" placeholder="Enter Doctor Name" required>
        </div>
        <div class="doctor-field">
          <label>Email:</label>
          <input type="email" id="doctorEmail" placeholder="doctor@example.com" required>
        </div>
        <div class="doctor-field">
          <label>Contact Number:</label>
          <input type="text" id="doctorPhone" placeholder="017XXXXXXXX" required>
        </div>
        <div class="doctor-field">
          <label>Specialization's:</label>
          <input type="text" id="doctorSpecialization" placeholder="Enter Specialization" required>
        </div>
        <div class="doctor-field">
          <label>Qualification's:</label>
          <input type="text" id="doctorQualification" placeholder="Enter Qualification" required>
        </div>

        <div class="doctor-field">
          <label>Experience (Years):</label>
          <input type="number" id="doctorExperience" placeholder="0" required>
        </div>

        <!-- New Availability Fields -->
        <div class="doctor-field">
          <label>Start Time:</label>
          <input type="time" id="doctorStartTime" required>
        </div>
        <div class="doctor-field">
          <label>End Time:</label>
          <input type="time" id="doctorEndTime" required>
        </div>
        <div class="doctor-field">
          <label>Available Days:</label><br>
          <div id="doctorDays">
          <label><input type="checkbox" name="doctorDays" value="Sun"> Sun</label>
          <label><input type="checkbox" name="doctorDays" value="Mon"> Mon</label>
          <label><input type="checkbox" name="doctorDays" value="Tue"> Tue</label>
          <label><input type="checkbox" name="doctorDays" value="Wed"> Wed</label>
          <label><input type="checkbox" name="doctorDays" value="Thu"> Thu</label>
          <label><input type="checkbox" name="doctorDays" value="Fri"> Fri</label>
          <label><input type="checkbox" name="doctorDays" value="Sat"> Sat</label>
          </div>
        </div>
      </div>

      <!-- Right: Documents -->
      <div id="adddoctorDocsContainer" class="doctor-box">
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
        </div><br><br>
        <h4>Profile Credentials</h4>
        <div class="doctor-field">
          <label>Username:</label>
          <input type="text" id="doctorUsername" placeholder="Enter Username" required>
        </div>
        <div class="doctor-field">
          <label>Password:</label>
          <input type="password" id="doctorPassword" placeholder="Enter Password" required>
          <span id="addDoc-toggle-password" onclick="togglePassword('doctorPassword')">Show</span>
        </div>
      </div>

    </div>

    <!-- Save Button Below Both Columns -->
    <div>
      <button type="submit" class="rightbtn">Save Doctor</button>
    </div>
  </form>
</div>
<!-- Edit Doctor Section -->
<div id="editDoctorSection" class="section" style="display:none;">
  <h3>Edit Doctor</h3>

  <!-- One Form Wrapping Everything -->
  <form id="editDoctorForm">
    <div class="doctor-container">

      <!-- Left: Doctor Info -->
      <div id="editDoctorInfoContainer" class="doctor-box">
        <h4>Doctor Information</h4>
        <div class="doctor-field">
          <label>Full Name:</label>
          <input type="text" id="editDoctorName" disabled>
        </div>
        <div class="doctor-field">
          <label>Email:</label>
          <input type="email" id="editDoctorEmail" disabled>
        </div>
        <div class="doctor-field">
          <label>Contact Number:</label>
          <input type="text" id="editDoctorPhone" disabled>
        </div>
        <div class="doctor-field">
          <label>Specialization's:</label>
          <input type="text" id="editDoctorSpecialization" disabled>
        </div>
        <div class="doctor-field">
          <label>Qualification's:</label>
          <input type="text" id="editDoctorQualification" disabled>
        </div>
        <div class="doctor-field">
          <label>Experience (Years):</label>
          <input type="number" id="editDoctorExperience" disabled>
        </div>

        <!-- Availability -->
        <div class="doctor-field">
          <label>Start Time:</label>
          <input type="time" id="editDoctorStartTime" disabled>
        </div>
        <div class="doctor-field">
          <label>End Time:</label>
          <input type="time" id="editDoctorEndTime" disabled>
        </div>
        <div class="doctor-field">
          <label>Available Days:</label><br>
          <div id="doctorDays">
          <label><input type="checkbox" name="editDoctorDays" value="Sun" disabled> Sun</label>
          <label><input type="checkbox" name="editDoctorDays" value="Mon" disabled> Mon</label>
          <label><input type="checkbox" name="editDoctorDays" value="Tue" disabled> Tue</label>
          <label><input type="checkbox" name="editDoctorDays" value="Wed" disabled> Wed</label>
          <label><input type="checkbox" name="editDoctorDays" value="Thu" disabled> Thu</label>
          <label><input type="checkbox" name="editDoctorDays" value="Fri" disabled> Fri</label>
          <label><input type="checkbox" name="editDoctorDays" value="Sat" disabled> Sat</label>
          </div>
        </div>
      </div>

      <!-- Right: Documents -->
      <div id="editDoctorDocsContainer" class="doctor-box">
        <h4>Required Documents</h4>
        <div class="doc-item">
          <label>Profile Photo:</label>
          <input type="file" id="editDoctorPhoto" accept=".jpg,.png" disabled>
        </div>
        <div class="doc-item">
          <label>Medical License:</label>
          <input type="file" id="editDoctorLicense" accept=".pdf,.jpg,.png" disabled>
        </div>
        <div class="doc-item">
          <label>Degree Certificate:</label>
          <input type="file" id="editDoctorDegree" accept=".pdf,.jpg,.png" disabled>
        </div><br><br>

        <h4>Profile Credentials</h4>
        <div class="doctor-field">
          <label>Username:</label>
          <input type="text" id="editDoctorUsername" disabled>
        </div>
        <div class="doctor-field">
          <label>Password:</label>
          <input type="password" id="editDoctorPassword" disabled>
          <span id="editDoc-toggle-password" onclick="togglePassword('editDoctorPassword')">Show</span>
        </div>
      </div>

    </div>

    <!-- Buttons -->
    <div>
      <button type="button"  class="editbtn" onclick="enableAllEditFields()">Edit</button>
      <button type="submit" class="rightbtn">Update Doctor</button>
    </div>
  </form>
</div>

=======
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

>>>>>>> dca59e9d8a046b13be8c5a77c7e592307e0a6f2a
</body>
</html>