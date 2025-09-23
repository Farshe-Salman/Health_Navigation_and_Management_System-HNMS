<?php
include "../config/db_connection.php";
include "../model/HospitalModel.php";

$keyword = $_GET['keyword'] ?? '';

$hospitalModel = new HospitalModel($conn);
$hospitals = $hospitalModel->searchHospitals($keyword);

foreach($hospitals as $hospital){
    $image = !empty($hospital['image']) ? $hospital['image'] : '';

    echo '<div class="hospital-card">
        <img src="../assets/uploads/'.htmlspecialchars($image).'" alt="'.htmlspecialchars($hospital['name']).'">
        <div class="hospital-info">
            <h4>'.htmlspecialchars($hospital['name']).'</h4>
            <p>Category: '.htmlspecialchars($hospital['category']).' | Facilities: '.htmlspecialchars($hospital['facilities']).'</p>
        </div>
        <div class="button-group">
            <button class="btn-primary" onclick="bookAppointmentFromHospital(\''.addslashes($hospital['name']).'\')">Book Appointment</button>
            <button class="btn-secondary">View Details</button>
        </div>
    </div>';
}
?>
