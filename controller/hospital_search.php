<?php
include "../config/db_connection.php";
include "../model/HospitalModel.php";

$keyword = $_GET['keyword'] ?? '';

$hospitalModel = new HospitalModel($conn);
$hospitals = $hospitalModel->searchHospitals($keyword);

if (!empty($hospitals)) {
    foreach($hospitals as $hospital){
        $image = !empty($hospital['profile_image']) ? $hospital['profile_image'] : '';

        echo '<div class="hospital-card">
            <img src="'.htmlspecialchars($image).'" alt="'.htmlspecialchars($hospital['hospital_name']).'">
            <div class="hospital-info">
                <h4>'.htmlspecialchars($hospital['hospital_name']).'</h4>
                <p>Category: '.htmlspecialchars($hospital['category']).'</p>
                <p id="add">Address: '.htmlspecialchars($hospital['address']).'</p> 
            </div>
            <div class="button-group">
                <button class="btn-primary" onclick="bookAppointmentFromHospital(\''.addslashes($hospital['hospital_name']).'\')">Book Appointment</button>
                <button class="btn-secondary" 
                    onclick="viewHospitalDetails(this)"
                    data-email="'.htmlspecialchars($hospital['email']).'"
                    data-phone="'.htmlspecialchars($hospital['phone']).'"
                    data-address="'.htmlspecialchars($hospital['address']).'"
                >View Details</button>
            </div>
        </div>';
    }
} else {
    echo '<p>No hospitals found.</p>';
}
?>
