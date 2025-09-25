<?php
session_start();
require_once '../model/hdash_model.php';

// Hospital login check
$hospital_username = trim($_SESSION['user']['username'] ?? '');
if (empty($hospital_username)) die("Hospital user not logged in!");

// Get doctor ID from query parameter
$doctor_id = intval($_GET['id'] ?? 0);
if ($doctor_id <= 0) die("Invalid doctor ID");

// Delete doctor
$result = deleteDoctor($doctor_id, $hospital_username);

if ($result) {
    echo "<script>
        alert('Doctor deleted successfully!');
        window.location.href='../view/hospital_dashboard.php#doctor';
    </script>";
} else {
    echo "<script>
        alert('Failed to delete doctor.');
        window.location.href='../view/hospital_dashboard.php#doctor';
    </script>";
}
?>
