<?php
session_start();
require_once '../model/hdash_model.php';

// Hospital login check
$hospital_username = trim($_SESSION['user']['username'] ?? '');
if (empty($hospital_username)) die("Hospital user not logged in!");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctor_id = intval($_POST['doctorId'] ?? 0);

    // Prepare data array for only the fields that are being updated
    $data = [];

    if (!empty($_POST['doctorName'])) $data['doctor_name'] = trim($_POST['doctorName']);
    if (!empty($_POST['doctorEmail'])) $data['email'] = trim($_POST['doctorEmail']);
    if (!empty($_POST['doctorPhone'])) $data['contact'] = trim($_POST['doctorPhone']);
    if (!empty($_POST['doctorSpecialization'])) $data['specialization'] = trim($_POST['doctorSpecialization']);
    if (!empty($_POST['doctorQualification'])) $data['qualification'] = trim($_POST['doctorQualification']);
    if (!empty($_POST['doctorExperience'])) $data['experience_years'] = intval($_POST['doctorExperience']);
    if (!empty($_POST['consultFee'])) $data['consultation_fee'] = intval($_POST['consultFee']);
    if (!empty($_POST['doctorStartTime'])) $data['start_time'] = $_POST['doctorStartTime'];
    if (!empty($_POST['doctorEndTime'])) $data['end_time'] = $_POST['doctorEndTime'];
    if (!empty($_POST['editDoctorDays'])) $data['schedule_days'] = implode(',', $_POST['editDoctorDays']);

    // Handle file uploads
    $uploadDir = '../assets/uploads/doctor_documents/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    if (!empty($_FILES['editDoctorPhoto']['name'])) {
        $profile_image = $_FILES['editDoctorPhoto']['name'];
        move_uploaded_file($_FILES['editDoctorPhoto']['tmp_name'], $uploadDir . $profile_image);
        $data['profile_image'] = $profile_image;
    }
    if (!empty($_FILES['editDoctorLicense']['name'])) {
        $medical_license = $_FILES['editDoctorLicense']['name'];
        move_uploaded_file($_FILES['editDoctorLicense']['tmp_name'], $uploadDir . $medical_license);
        $data['medical_license'] = $medical_license;
    }
    if (!empty($_FILES['editDoctorDegree']['name'])) {
        $degree_certificate = $_FILES['editDoctorDegree']['name'];
        move_uploaded_file($_FILES['editDoctorDegree']['tmp_name'], $uploadDir . $degree_certificate);
        $data['degree_certificate'] = $degree_certificate;
    }

    // Update doctor
    $result = updateDoctor($doctor_id, $hospital_username, $data);

    if ($result) {
        echo "<script>
            alert('Doctor updated successfully!');
            window.location.href='../view/hospital_dashboard.php#doctor';
        </script>";
    } else {
        echo "<script>
            alert('Failed to update doctor.');
            window.location.href='../view/hospital_dashboard.php#doctor';
        </script>";
    }
}
?>
