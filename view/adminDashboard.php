<?php
session_start();

// check login
if (!isset($_SESSION['user']) || $_SESSION['user']['usertype'] !== 'admin') {
    header("Location: ../view/signin_signup.php");
    exit();

}
$AdminUsername = $_SESSION['user']['username']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/adminDashboard.css">
    <link rel="icon" href="../assets/image/HNMS.png?v=2" type="image/png" sizes="32x32">
</head>
<body>
    <div class="dashboard-layout">
    <header class="header">
        <div class="header-left">
            <img src="../assets/image/HNMS.png" alt="HNMS Logo">
            <h1>HNMS</h1>
        </div>
        <div class="header-right">
    <span>Welcome, <?php echo $AdminUsername; ?></span>
</div>

    </header>

    <!-- New wrapper -->
    <div class="main-section">
        <aside class="sidebar">
            <div class="sidebar-nav">
                <a href="#" data-page="adminOverview">Overview</a>
                <a href="#" data-page="adminDoctors">Doctors</a>
                <a href="#" data-page="adminHospitals">Hospitals</a>
                <a href="#" data-page="adminUserApproval">User Approval</a>
            </div>
            <div class="sidebar-footer">
                <a href="../controller/logout.php" class="log-out" onclick="return confirm('Are you sure you want to logout?');">Logout</a>
            </div>
        </aside>

        <main class="content" id="content">
            <!-- dynamic content loads here -->
        </main>
    </div>
</div>


    <script src="../assets/js/adminDashboard.js"></script>
</body>
</html>
