<?php
session_start();
require_once '../model/hdash_model.php';

// Check hospital login
$hospital_username = trim($_SESSION['user']['username'] ?? '');
if (empty($hospital_username)) {
    die("Hospital user not logged in!");
}

// ================== Doctor Add Handle ==================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form inputs
    $name            = trim($_POST['doctorName'] ?? '');
    $email           = trim($_POST['doctorEmail'] ?? '');
    $contact         = trim($_POST['doctorPhone'] ?? '');
    $specialization  = trim($_POST['doctorSpecialization'] ?? '');
    $qualification   = trim($_POST['doctorQualification'] ?? '');
    $experience_years = intval($_POST['doctorExperience'] ?? 0);
    $consult_fee     = intval($_POST['consultFee'] ?? 0);
    $start_time      = $_POST['doctorStartTime'] ?? null;
    $end_time        = $_POST['doctorEndTime'] ?? null;

    // Days availability
    $schedule_days = '';
    if (!empty($_POST['doctorDays'])) {
        $schedule_days = implode(',', $_POST['doctorDays']);
    }

    // Upload directory
    $uploadDir = '../assets/uploads/doctor_documents/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // File uploads
    $profile_image     = $_FILES['doctorPhoto']['name'] ?? '';
    $medical_license   = $_FILES['doctorLicense']['name'] ?? '';
    $degree_certificate = $_FILES['doctorDegree']['name'] ?? '';

    if ($profile_image) {
        move_uploaded_file($_FILES['doctorPhoto']['tmp_name'], $uploadDir . $profile_image);
    }
    if ($medical_license) {
        move_uploaded_file($_FILES['doctorLicense']['tmp_name'], $uploadDir . $medical_license);
    }
    if ($degree_certificate) {
        move_uploaded_file($_FILES['doctorDegree']['tmp_name'], $uploadDir . $degree_certificate);
    }

    // Login credentials
    $username      = trim($_POST['doctorUsername'] ?? '');
    $password      = $_POST['doctorPassword'] ?? '';
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Call model function (this will insert into doctors + users)
    $result = addDoctor(
        $hospital_username,
        $name,
        $email,
        $contact,
        $specialization,
        $qualification,
        $experience_years,
        $consult_fee,
        $start_time,
        $end_time,
        $schedule_days,
        $profile_image,
        $medical_license,
        $degree_certificate,
        $username,
        $password_hash
    );

    // Redirect with status
    if ($result) {
        echo "<script>alert('Doctor added successfully!'); window.location.href='../view/hospital_dashboard.php#doctor';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to add doctor.'); window.location.href='../view/hospital_dashboard.php#doctor';</script>";
        exit();
    }
}

// ================== Doctor Fetch (if needed in AJAX) ==================
// If you want to fetch doctors list dynamically, you can call getDoctors here
// Example:
// $doctors = getDoctors($hospital_username);

?>
