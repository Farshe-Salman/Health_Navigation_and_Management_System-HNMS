<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HNMS Patient Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/dashboard.css">
  <link rel="icon" href="../assets/image/HNMS.png?v=2" type="image/png" sizes="32x32">
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
    <a href="#" onclick="showBloodBank('bloodBankSection')" style="color:red">Blood Bank</a>
    <a href="#" onclick="showAppointmentSection()">Book Appointment</a>
    <a href="#" onclick="" style="color:red">History</a>
    <a href="#" onclick="showSection('profileSection')">My Profile</a>
    <a href="../controller/logout.php" class="log-out" onclick="return confirm('Are you sure you want to logout?');">Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main">
    <!-- Navbar -->
    <div class="navbar">
      <div class="menubar" onclick="toggleSidebar()">
        <i class="fa fa-bars"></i>
      </div>
      <div class="navbar-logo">
        <img src="../assets/image/HNMS.png" alt="HNMS Logo">
        <span>HNMS</span>
      </div>
      <div class="navbar-links">
        <a href="#" onclick="showSection('doctors')">Find Doctor</a>
        <a href="#" onclick="showAppointmentSection()">Book Appointment</a>
        <a href="#" onclick="">My Appointments</a>
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


      <!-- Patient Find Hospital -->
  <?php include "../view/patient_Find_Hospital.php";?>
     
      
       <!-- Find Doctor -->
  <?php include "../view/find_Doctor.php";?>


 <!-- Pharmacy and Order Medicine SEction -->
  <?php include "../view/patientdash_pharmacy.php";?>



      <!-- Blood Bank -->
      <?php include "../view/patientdash_bloodBank.php";?>

     <!-- Book AppointMent -->
      <?php include "../view/book_Appointment.php";?>

     <!-- Patient Profile Section -->
      <?php include "../view/patient_Profile.php";?>


      <!-- Change Password -->
      <?php include "../view/change_Password.php";?>

          <!--Notification Panel -->
      <?php include "../view/notification_panel.php";?>
      



    </div>
   <!-- Footer -->
  <?php include "../view/dashboard_footer.php";?>
  </div>

  <script src="../assets/js/patient_dashboard.js"></script>
</body>

</html>