<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HNMS Patient Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/dashboard.css">
  <link rel="icon" type="image/png" href="../assets/image/HNMS.png">
</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="logo">
      <img src="../assets/image/HNMS.png" alt="HNMS Logo">
      <span class="logo-text">HEALTH NAVIGATION MANAGEMENT SYSTEM</span>
    </div>
    <a href="#" class="active" onclick="showSection('dashboard')">Dashboard</a>
    <a href="#" onclick="showSection('hospitals')">Hospitals</a>
    <a href="#" onclick="showSection('doctors')">Find Doctors</a>
    <a href="#" onclick="showSection('pharmacy')">Pharmacy</a>
    <a href="#" onclick="showBloodBank('bloodBankSection')">Blood Bank</a>
    <a href="#" onclick="showAppointmentSection()">Book Appointment</a>
    <a href="#" onclick="">History</a>
    <a href="#" onclick="showSection('profileSection')">My Profile</a>
    <a href="#" class="log-out">Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main">
    <!-- Navbar -->
    <div class="navbar">
      <div class="menubar" onclick="toggleSidebar()">
        <i class="fa fa-bars"></i>
      </div>
      <div class="navbar-logo">
        <img src="HNMS.png" alt="HNMS Logo">
        <span>HNMS</span>
      </div>
      <div class="navbar-links">
        <a href="#" onclick="showSection('doctors')">Find Doctor</a>
        <a href="#" onclick="showAppointmentSection()">Book Appointment</a>
        <a href="#" onclick="showBloodBank('bloodBankSection')">Blood Bank</a>
      </div>
      <div class="navbar-right">
        <div class="profile">
          <img src="Profile.jpg" alt="Profile Picture" onclick="showProfile()">
          <p>Welcome,</p>
          <span class="profile-name" id="navbarProfileName" onclick="showProfile()">Shizan Sarkar</span>
        </div>

        <div class="notification" onclick="showNotifications()">
          <i class="fa fa-bell"></i>
          <span class="notification-count" id="notificationCount">0</span>
        </div>
        <div class="settings">
          <a href="#" onclick="showSection('changePassword')">
            <i class="fa fa-cog"></i>
          </a>
        </div>
      </div>
    </div>
    <!-- End Navbar -->

    <!-- Content Sections -->
    <div class="content">
      <!-- Dashboard -->
      <div id="dashboard" class="section" style="display:block;">
        <div class="welcome-banner">
          <h2>Quick overview of your health activities</h2>
        </div>
        <div class="dashboard-cards">
          <div class="card">
            <h3>Upcoming Appointments</h3>
            <ul id="appointmentsList">
              <li>No appointments scheduled.</li>
            </ul>
          </div>
          <div class="card">
            <h3>Nearest Hospital / Pharmacy</h3>
            <iframe src="https://www.google.com/maps/embed/v1/search?q=hospitals+near+me&key=YOUR_GOOGLE_MAPS_API_KEY"
              width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
          <div class="card">
            <h3>Health Tips</h3>
            <ul>
              <li>Stay hydrated by drinking at least 8 glasses of water daily.</li>
              <li>Incorporate at least 30 minutes of exercise into your daily routine.</li>
              <li>Eat a balanced diet rich in fruits, vegetables, and whole grains.</li>
              <li>Ensure you get 7-8 hours of quality sleep each night.</li>
              <li>Practice stress-relief techniques such as meditation or deep breathing.</li>
            </ul>
          </div>
        </div>
      </div>

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
      
       <!-- Find Doctor -->
  <?php include "../view/find_Doctor.php";?>


      <!-- Pharmacy Section -->
      <div id="pharmacy" class="section">
        <h3>Pharmacy & Medicines</h3>
        <input type="text" placeholder="Search pharmacy or medicine..." id="searchPharmacy">

        <div class="pharmacy-list">
          <!-- Example Pharmacy Card -->
          <div class="pharmacy-card">
            <img src="pharmacy1.jpg" alt="City Pharmacy">
            <div class="pharmacy-info">
              <h4>City Pharmacy</h4>
              <p class="status">Status: Open (9:00 AM - 10:00 PM)</p>
              <p class="location">Location: Dhaka, Bangladesh</p>
            </div>
            <div class="button-group">
              <button class="btn-primary" onclick="openMedicineCatalog('City Pharmacy')">View All Products</button>
              <button class="btn-secondary">View Details</button>
            </div>
          </div>

          <!-- phar2 -->
          <div class="pharmacy-card">
            <img src="pharmacy1.jpg" alt="Lazz Pharmacy">
            <div class="pharmacy-info">
              <h4>Lazz Pharmacy</h4>
              <p class="status">Status: Open (9:00 AM - 10:00 PM)</p>
              <p class="location">Location: Dhaka, Bangladesh</p>
            </div>
            <div class="button-group">
              <button class="btn-primary" onclick="openMedicineCatalog('City Pharmacy')">View Medicines</button>
              <button class="btn-secondary">View Details</button>
            </div>
          </div>

          <!-- phar3 -->
          <div class="pharmacy-card">
            <img src="pharmacy1.jpg" alt="Tamanna Pharmacy">
            <div class="pharmacy-info">
              <h4>Tamanna Pharmacy</h4>
              <p class="status">Status: Open (9:00 AM - 10:00 PM)</p>
              <p class="location">Location: Dhaka, Bangladesh</p>
            </div>
            <div class="button-group">
              <button class="btn-primary" onclick="openMedicineCatalog('City Pharmacy')">View Medicines</button>
              <button class="btn-secondary">View Details</button>
            </div>
          </div>


          <!-- Add other pharmacy cards here -->
        </div>
      </div>

      <!-- Pharmacy Medicines Section -->
      <div id="pharmacyMedicinesSection" class="section" style="display:none;">
        <div class="med-header">
          <h3 id="medSectionTitle">Pharmacy Medicines</h3>
          <div class="med-header-buttons">
            <button class="btn-secondary" onclick="showCart()">View Cart</button>
            <button class="btn-secondary" onclick="backToPharmacy()">Back to Pharmacies</button>
          </div>
        </div>

        <div id="pharmacyMedicineList" class="medicine-list">
          <!-- Medicines will be dynamically loaded here via JS -->
        </div>
      </div>

      <!-- Pharmacy Cart Section -->
      <div id="pharmacyCartSection" class="section" style="display:none;">
        <div class="med-header">
          <h3>My Cart</h3>
          <div class="med-header-buttons">
            <button class="btn-secondary" onclick="backToMedicines()">Back to Medicines</button>
          </div>
        </div>

        <div id="cartItemsList" class="medicine-list">
          <!-- Cart items dynamically loaded -->
        </div>

        <h4>Total: <span id="cartTotal">৳0</span></h4>
        <div class="cart-actions">
          <button class="btn-primary" onclick="checkoutCart()">Checkout</button>
          <button class="btn-secondary" onclick="clearCart()">Clear Cart</button>
        </div>
      </div>



      <!-- Delivery / Order Section -->
      <div id="deliverySection" class="section" style="display:none;">
        <h3>Delivery Details & Order Summary</h3>
        <div class="delivery-container">

          <!-- LEFT: Order Summary -->
          <div class="order-box">
            <h4>Order Summary</h4>
            <div id="orderSummary" style="margin-bottom: 20px;"></div>
            <h4>Total Payable: <span id="orderTotal">৳0</span></h4>
          </div>

          <!-- RIGHT: Delivery Form -->
          <div class="form-box">
            <form id="deliveryForm">
              <div class="form-row">
                <div class="form-group">
                  <label>Receiver Name (Optional)</label>
                  <input type="text" id="custName">
                </div>
                <div class="form-group">
                  <label>Receiver Phone*</label>
                  <input type="tel" id="custPhone" placeholder="+8801XXXXXXXXX" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label>Region*</label>
                  <select id="custRegion" required>
                    <option value="">Select Region</option>
                    <option>Dhaka</option>
                    <option>Chattogram</option>
                    <option>Rajshahi</option>
                    <option>Khulna</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>City*</label>
                  <input type="text" id="custCity" required>
                </div>
                <div class="form-group">
                  <label>Area (Optional)</label>
                  <input type="text" id="custArea">
                </div>
              </div>

              <div class="form-group">
                <label>Address*</label>
                <textarea id="custAddress" required></textarea>
              </div>

              <!-- Prescription Upload -->
              <div class="form-group prescription-upload">
                <label for="custPrescription" class="btn-prescription">
                  Select Prescription (optional)
                </label>
                <input type="file" id="custPrescription" accept="image/*,.pdf" style="display:none;">
                <span id="prescriptionFileName" class="file-name">No file selected</span>
              </div>


              <!-- Payment Options -->
              <div class="form-group">
                <label>Payment Method*</label>
                <select id="paymentMethod" required>
                  <option value="">Select Payment Method</option>
                  <option value="cod">Cash on Delivery</option>
                  <option value="digital">Digital Payment</option>

                </select>
              </div>

              <button type="button" class="btn-primary" onclick="placeOrder()">Place Order</button>
            </form>
          </div>
        </div>
      </div>


      <!-- Blood Bank Section -->
      <div class="section" id="bloodBankSection" style="display:none;">
        <h2>Blood Bank</h2>

        <!-- Search -->
        <div class="blood-search">
          <select id="hospitalSelectBB">
            <option value="">All Hospitals</option>
            <option value="City General Hospital">City General Hospital</option>
            <option value="Sunrise Diagnostics">Sunrise Diagnostics</option>
          </select>

          <select id="bloodSearch">
            <option value="">Select Blood Type</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
          </select>

          <button onclick="searchBlood()">Search</button>
        </div>

        <!-- Blood List -->
        <div id="bloodList" class="blood-list">
          <!-- dynamically generated blood cards will appear here -->
        </div>
      </div>
      <!-- Blood Request Modal -->
      <div id="bloodRequestModal" class="modal" style="display:none;">
        <div class="modal-content">
          <h3>Request Blood</h3>
          <form id="bloodRequestForm">
            <input type="text" id="reqName" placeholder="Your Name" required>
            <input type="text" id="reqPhone" placeholder="Phone Number" required>
            <input type="text" id="reqNote" placeholder="Optional Note">
            <input type="hidden" id="reqHospital">
            <input type="hidden" id="reqBloodGroup">
            <button type="submit">Submit Request</button>
            <button type="button" onclick="closeBloodRequestModal()">Cancel</button>
          </form>
        </div>
      </div>
      <!-- Donor Details Modal -->
      <div id="donorModal" class="modal" style="display:none;">
        <div class="modal-content">
          <h3>Donor Details</h3>
          <p><strong>Name:</strong> <span id="donorName"></span></p>
          <p><strong>Contact:</strong> <span id="donorContact"></span></p>
          <p><strong>Hospital:</strong> <span id="donorHospital"></span></p>
          <p><strong>Blood Group:</strong> <span id="donorBloodGroup"></span></p>
          <button type="button" onclick="closeDonorModal()">Close</button>
        </div>
      </div>


      <!-- Appointment Form -->
      <div id="appointments" class="section">
        <h3>Appointment Request Form</h3>
        <div class="card appointment-card">
          <form id="appointmentForm">
            <div class="form-row">
              <div class="form-group">
                <label>Hospital*</label>
                <select id="hospitalSelect" required>
                  <option value="">Select Hospital</option>
                  <option value="City General Hospital">City General Hospital</option>
                  <option value="Sunrise Diagnostics">Sunrise Diagnostics</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label>Patient Name*</label>
                <input type="text" id="patientName" placeholder="Full name" required>
              </div>
              <div class="form-group">
                <label>Date of Birth*</label>
                <input type="date" id="dob" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label>Gender*</label>
                <select id="gender" required>
                  <option value="">Select Gender</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
              </div>
              <div class="form-group">
                <label>Email*</label>
                <input type="email" id="email" placeholder="example@gmail.com" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label>Contact Number*</label>
                <input type="tel" id="contact" placeholder="+8801XXXXXXXXX" required>
              </div>
              <div class="form-group">
                <label>Speciality For Consultation*</label>
                <select id="speciality" required>
                  <option value="">Select Speciality</option>
                  <option>Cardiology</option>
                  <option>Neurology</option>
                  <option>Orthopedics</option>
                  <option>Dermatology</option>
                  <option>ENT & Head Neck Surgery</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group" style="flex:1; margin-right:15px;">
                <label>Doctor*</label>
                <select id="doctorSelect" required style="width:100%;">
                  <option value="">Select Doctor</option>
                </select>
              </div>
              <div class="form-group" style="flex:1;">
                <label>Appointment Date*</label>
                <input type="date" id="appointmentDate" required style="width:100%;">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label>Appointment Time (9:00AM -5:00PM)*</label>
                <input type="time" id="appointmentTime" required>
              </div>
            </div>

            <button type="submit">SUBMIT</button>
          </form>
        </div>
      </div>

      <!-- Change Password -->
      <div id="changePassword" class="section" style="display:none;">
        <h3>Change Password</h3>
        <div class="card">
          <form id="changePasswordForm">
            <div class="form-row">
              <div class="form-group">
                <label>Current Password*</label>
                <input type="password" id="currentPassword" placeholder="Enter current password">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>New Password*</label>
                <input type="password" id="newPassword" placeholder="Enter new password">
              </div>
              <div class="form-group">
                <label>Confirm Password*</label>
                <input type="password" id="confirmPassword" placeholder="Confirm new password">
              </div>
            </div>
            <button type="submit">UPDATE PASSWORD</button>
          </form>
          <p id="passwordMessage"></p>
        </div>
      </div>

      <!-- Notifications Panel -->
      <div id="notificationsPanel" class="notification-popup" style="display:none;">
        <div class="notification-header">
          <span>Notifications</span>
          <button id="closeNotifications">Close</button>
        </div>
        <div class="notification-body" id="notificationsList">
          <!-- Notification items will be injected here -->
        </div>
        <div class="notification-footer">
          <a href="#">See All</a>
        </div>
      </div>

      <!-- Patient Profile Section -->
      <div class="section" id="profileSection" style="display:none;">
        <h2>My Profile</h2>
        <form id="profileForm">

          <div class="profile-field">
            <label for="profileName">Username:</label>
            <div class="field-row">
              <input type="text" id="profileName" placeholder="Full Name" value="Shizan Sarkar" disabled required>
              <button type="button" class="edit-btn" onclick="enableEdit('profileName')">Edit</button>
            </div>
          </div>

          <div class="profile-field">
            <label for="profileEmail">Email:</label>
            <div class="field-row">
              <input type="email" id="profileEmail" placeholder="Email" value="shizan@example.com" disabled required>
              <button type="button" class="edit-btn" onclick="enableEdit('profileEmail')">Edit</button>
            </div>
          </div>

          <div class="profile-field">
            <label for="profilePhone">Phone:</label>
            <div class="field-row">
              <input type="text" id="profilePhone" placeholder="Phone Number" value="01712345678" disabled required>
              <button type="button" class="edit-btn" onclick="enableEdit('profilePhone')">Edit</button>
            </div>
          </div>

          <button type="submit" class="petient-btn-primary">Save Changes</button>
        </form>
      </div>




    </div>
   <!-- Footer -->
  <?php include "../view/dashboard_footer.php";?>
  </div>

  <script src="../assets/js/patient_dashboard.js"></script>
</body>

</html>