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

    <!-- Medicine Inventory -->
    <div id="inventory" class="section" style="display:none;">
      <h3>Medicine Inventory</h3>
      <button class="btn-primary" onclick="openAddMedicineSection()">Add New Medicine</button>
      <div id="inventoryMedicineList" class="medicine-list">
        <!-- Medicines will be dynamically loaded here via JS -->
      </div>
    </div>

    <!-- Add Medicine Section -->
    <div id="addMedicineSection" class="section" style="display:none;">
      <h3>Add Medicines</h3>
      <div class="medicine-container">
        <!-- Left: Medicine Info -->
        <div id="addmedicineInfoContainer" class="medicine-box">
          <h4>Medicine Information</h4>
          <form id="addMedicineFormSection">
            <div class="medicine-field">
              <label>Medicine Name:</label>
              <input type="text" id="medNameSection" placeholder="Enter Medicine Name" required>
            </div>
            <div class="medicine-field">
              <label>Category:</label>
              <select id="medCategorySection" required>
                <option value="">Select category</option>
                <option value="medicine">Medicine</option>
                <option value="firstAid">First Aid</option>
                <option value="equipment">Medical Equipment</option>
                <option value="skincare">Skincare</option>
              </select>
            </div>
            <div class="medicine-field">
              <label>Stock:</label>
              <input type="number" id="medStockSection" placeholder="0" required>
            </div>
            <div class="medicine-field">
              <label>Price (৳):</label>
              <input type="number" id="medPriceSection" placeholder="0" required>
            </div>
            <div class="medicine-field">
              <label>Expiry Date:</label>
              <input type="date" id="medExpirySection" required>
            </div>
            <div class="medicine-field">
              <label>Prescription Required:</label>
              <select id="prescriptionRequiredSection" required>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
            <button type="submit" class="rightbtn">Save Medicine</button>
          </form>
        </div>
        <!-- Right: Document Uploads -->
        <div id="medicineDocsContainer" class="medicine-box">
          <h4>Required Documents</h4>
          <div class="doc-item">
            <label>Drug Image:</label>
            <input type="file" id="drugImageFileSection" accept=".jpg,.png" required>
          </div>
          <div class="doc-item">
            <label>Drug License (PDF/JPG):</label>
            <input type="file" id="drugLicenseFileSection" accept=".pdf,.jpg,.png" required>
          </div>
          <div class="doc-item">
            <label>Import Certificate (if applicable):</label>
            <input type="file" id="importCertFileSection" accept=".pdf,.jpg,.png">
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Medicine Section -->
    <div id="editMedicineSection" class="section" style="display:none;">
      <h3>Edit Medicine</h3>
      <div class="medicine-container">
        <!-- Left: Medicine Info -->
        <div id="editMedicineInfoContainer" class="medicine-box">
          <h4>Medicine Information</h4>
          <form id="editMedicineFormSection">
            <div class="medicine-field">
              <label>Medicine Name:</label>
              <input type="text" id="editmedNameSection" required disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editmedNameSection')">Edit</button>
            </div>
            <div class="medicine-field">
              <label>Category:</label>
              <select id="editmedCategorySection" required disabled>
                <option value="">Select category</option>
                <option value="medicine">Medicine</option>
                <option value="firstAid">First Aid</option>
                <option value="equipment">Medical Equipment</option>
                <option value="skincare">Skincare</option>
              </select>
              <button type="button" class="edit-btn" onclick="enableEdit('editmedCategorySection')">Edit</button>
            </div>
            <div class="medicine-field">
              <label>Stock:</label>
              <input type="number" id="editmedStockSection" required disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editmedStockSection')">Edit</button>
            </div>
            <div class="medicine-field">
              <label>Price (৳):</label>
              <input type="number" id="editmedPriceSection" required disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editmedPriceSection')">Edit</button>
            </div>
            <div class="medicine-field">
              <label>Expiry Date:</label>
              <input type="date" id="editmedExpirySection" required disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editmedExpirySection')">Edit</button>
            </div>
            <div class="medicine-field">
              <label>Prescription Required:</label>
              <select id="editprescriptionRequiredSection" required disabled>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              <button type="button" class="edit-btn"
                onclick="enableEdit('editprescriptionRequiredSection')">Edit</button>
            </div>
            <button type="submit" class="rightbtn">Update Medicine</button>
          </form>
        </div>
        <!-- Right: Document Uploads -->
        <div id="editMedicineDocsContainer" class="medicine-box">
          <h4>Required Documents</h4>
          <div class="doc-item">
            <label>Drug Image:</label>
            <input type="file" id="editdrugImageFileSection" accept=".jpg,.png" disabled>
            <button type="button" class="rightbtn" onclick="enableFile('editdrugImageFileSection')">Upload</button>
          </div>
          <div class="doc-item">
            <label>Drug License (PDF/JPG):</label>
            <input type="file" id="editdrugLicenseFileSection" accept=".pdf,.jpg,.png" disabled>
            <button type="button" class="rightbtn" onclick="enableFile('editdrugLicenseFileSection')">Upload</button>
          </div>
          <div class="doc-item">
            <label>Import Certificate (if applicable):</label>
            <input type="file" id="editimportCertFileSection" accept=".pdf,.jpg,.png" disabled>
            <button type="button" class="rightbtn" onclick="enableFile('editimportCertFileSection')">Upload</button>
          </div>
        </div>
      </div>
    </div>

   <!-- ORDER IN PHARMA -->
<div id="orders" class="section" style="display:none;">
  <h3>Customer Orders</h3>
  <div class="table-container">
    <table class="orders-table">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer / Phone</th>
          <th>Region / City / Area</th>
          <th>Address</th>
          <th>Medicines</th>
          <th>Total (৳)</th>
          <th>Prescription</th>
          <th>Payment</th>
          <th>Status</th>
          <th>Update</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="ordersList">
        <!-- Orders will be dynamically loaded here -->
      </tbody>
    </table>
  </div>
</div>

    <!-- ORDER HISTORY -->
<div id="orderHistory" class="section" style="display:none;">
  <h3>Order History</h3>
  <div class="table-container">
    <table class="orders-table">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Date</th>
          <th>Customer / Phone</th>
          <th>Region / City / Area</th>
          <th>Address</th>
          <th>Medicines</th>
          <th>Total (৳)</th>
          <th>Prescription</th>
          <th>Payment</th>
          <th>Status</th>
        
        </tr>
      </thead>
      <tbody id="orderHistoryList">
        <!-- Past orders will be dynamically loaded here -->
      </tbody>
    </table>
  </div>
</div>

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