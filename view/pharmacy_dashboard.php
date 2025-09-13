<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HNMS Pharmacy Dashboard</title>
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
    <a href="#" onclick="showSection('inventory')">Medicine Inventory</a>
    <a href="#" onclick="showSection('orders')">Orders</a>
    <a href="#" onclick="showSection('orderHistory')">Order History</a>
    <a href="#" onclick="showSection('pharmacyProfile')">My Profile</a>
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
        <img src="../assets/image/HNMS.png" alt="HNMS Logo">
        <span>Pharmacy Dashboard</span>
      </div>
      <div class="navbar-links">
        <a href="#" onclick="showSection('addMedicineSection')">Add Medicine</a>
        <a href="#" onclick="showSection('orders')">Orders</a>
      </div>
      <div class="navbar-right">
        <div class="profile">
          <img src="Profile.jpg" alt="Profile Picture" class="profile-pic" onclick="showPharmacyProfile()">
          <p>Welcome,</p>
          <span class="profile-name" id="navbarPharmacyName" onclick="showPharmacyProfile()">City Pharmacy</span>
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

    <!-- Dashboard Section -->
    <div id="dashboard" class="section" style="display:block;">
      <h2>Hello! <span id="pharmacyName">City Pharmacy</span></h2>
      <!-- Verification Notice -->
      <div id="verificationNotice" class="verification-box" style="display:none;"></div>
      <div class="dashboard-cards">
        <div class="card">
          <h3>Today's Sales</h3>
          <p> <span id="todaysSales"></span></p>
        </div>
        <div class="card">
          <h3>Pending Orders</h3>
          <p><span id="pendingOrders">0</span> Orders</p>
        </div>
        <div class="card">
          <h3>Low Stock Alerts</h3>
          <ul id="lowStockList">
            <li>No low stock items</li>
          </ul>
        </div>
      </div>
    </div>

<!-- Pharmacy Profile Section -->
 <?php include "../view/pharmacy_medicineInventory.php";?>

   <!-- Pharmacy Order Section -->
 <?php include "../view/pharma_Order.php";?>

<!-- Pharmacy Order History Section -->
 <?php include "../view/pharma_OrderHistory.php";?>

<!-- Pharmacy Profile Section -->
 <?php include "../view/pharma_Profile.php";?>


  <!--Notification Panel -->
      <?php include "../view/notification_panel.php";?>

    <!-- Change Password -->
      <?php include "../view/change_Password.php";?>

   <!-- Footer -->
  <?php include "../view/dashboard_footer.php";?>
  </div>

  <script src="../assets/js/pharmacy_dashboard.js"></script>
</body>

</html>