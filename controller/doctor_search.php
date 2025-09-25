<?php
include "../config/db_connection.php";
include "../model/DoctorModel.php";

$keyword = $_GET['keyword'] ?? '';
$specialization = $_GET['specialization'] ?? '';

$doctorModel = new DoctorModel($conn);
$doctors = $doctorModel->searchDoctors($keyword, $specialization);

foreach($doctors as $doctor){
    $doctor['profile_image'] = $doctor['profile_image'] ?? 'doc1.png';
    $doctor['doctor_name'] = $doctor['doctor_name'] ?? 'Unknown';
    $doctor['qualification'] = $doctor['qualification'] ?? 'N/A';
    $doctor['specialization'] = $doctor['specialization'] ?? 'N/A';
    $doctor['experience_years'] = $doctor['experience_years'] ?? '0';
    $doctor['consultation_fee'] = $doctor['consultation_fee'] ?? '0';
    $doctor['email'] = $doctor['email'] ?? 'N/A';
    $doctor['contact'] = $doctor['contact'] ?? 'N/A';

    echo '<div class="doctor-card">
        <img src="../assets/uploads/'.htmlspecialchars($doctor['profile_image']).'" alt="'.htmlspecialchars($doctor['doctor_name']).'">
        <div class="doctor-info">
            <h4>'.htmlspecialchars($doctor['doctor_name']).'</h4>
            <p><strong>'.htmlspecialchars($doctor['qualification']).'</strong></p>
            <p class="designation">'.htmlspecialchars($doctor['specialization']).'<br>Experience: '.htmlspecialchars($doctor['experience_years']).' yrs</p>
            <p>Consultation Fee: ৳'.htmlspecialchars($doctor['consultation_fee']).'</p>
        </div>
        <div class="button-group">
            <button class="btn-primary" onclick="bookAppointmentFromDoctor(\''.addslashes($doctor['doctor_name']).'\')">Request Appointment</button>
            <button class="btn-secondary" 
                onclick="viewDoctorDetails(this)"
                data-name="'.htmlspecialchars($doctor['doctor_name']).'"
                data-email="'.htmlspecialchars($doctor['email']).'"
                data-contact="'.htmlspecialchars($doctor['contact']).'"
                data-specialization="'.htmlspecialchars($doctor['specialization']).'"
                data-qualification="'.htmlspecialchars($doctor['qualification']).'"
                data-fee="'.htmlspecialchars($doctor['consultation_fee']).'"
                data-experience="'.htmlspecialchars($doctor['experience_years']).'"
                data-image="'.htmlspecialchars($doctor['profile_image']).'"
            >View Details</button>
        </div>
    </div>';
}
?>
