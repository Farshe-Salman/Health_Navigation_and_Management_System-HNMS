<?php
include "../config/db_connection.php";
include "../model/DoctorModel.php";

$keyword = $_GET['keyword'] ?? '';
$specialization = $_GET['specialization'] ?? '';

$doctorModel = new DoctorModel($conn);
$doctors = $doctorModel->searchDoctors($keyword, $specialization);

foreach($doctors as $doctor){
    // Use 'Profile.jpg' if 'profile_image' is not set or empty
    $photo = !empty($doctor['profile_image']) ? $doctor['profile_image'] : '';

    echo '<div class="doctor-card">
        <img src="../assets/uploads/'.htmlspecialchars($photo).'" alt="'.htmlspecialchars($doctor['name']).'">
        <div class="doctor-info">
            <h4>'.htmlspecialchars($doctor['name']).'</h4>
            <p><strong>'.htmlspecialchars($doctor['qualification']).'</strong></p>
            <p class="designation">'.htmlspecialchars($doctor['specialization']).'<br>Experience: '.htmlspecialchars($doctor['experience_years']).' yrs</p>
            <p>Consultation Fee: ৳'.htmlspecialchars($doctor['consultation_fee']).'</p>
        </div>
        <div class="button-group">
            <button class="btn-primary" onclick="bookAppointmentFromDoctor(\''.addslashes($doctor['name']).'\')">Request an Appointment</button>
            <button class="btn-secondary">View Doctor Profile</button>
        </div>
    </div>';
}
?>
