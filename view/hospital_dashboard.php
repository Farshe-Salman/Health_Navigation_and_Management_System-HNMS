<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HNMS Hospital Dashboard</title>
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
        <a href="#" onclick="showSection('doctor')">Doctor's Inventory</a>
        <a href="#" onclick="showSection('appointments')">Appointments</a>
        <a href="#" onclick="showSection('historySection')">History</a>
        <a href="#" onclick="showSection('hospitalProfile')">My Profile</a>
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
                <a href="#" onclick="showSection('addDoctorSection')">Add Doctor</a>
                <a href="#" onclick="showSection('appointments')">Appointments</a>
            </div>
            <div class="navbar-right">
                <div class="profile">
                    <img src="Profile.jpg" alt="Profile Picture" onclick="showProfile()">
                    <p>Welcome,</p>
                    <span class="profile-name" id="navbarProfileName" onclick="showProfile()">Hospital</span>
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
            <!-- Patient default dashboard section -->
            <?php include "../view/hdash_section.php"; ?>
            <!-- Doctor -->
            <?php include "../view/hdash_Doctor.php"; ?>
            <!-- Patient Profile Section -->
            <?php include "../view/hospital_Profile.php"; ?>
        </div>

        <!-- Change Password -->
        <?php include "../view/hdash_change_Password.php"; ?>
        <!-- Notification Panel -->
        <?php include "../view/notification_panel.php"; ?>

    </div>

    <!-- Footer -->
    <?php include "../view/dashboard_footer.php"; ?>
    
    <script src="../assets/js/hospital_dashboard.js"></script>
</body>
</html>
