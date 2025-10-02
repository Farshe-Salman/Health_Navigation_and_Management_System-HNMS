<?php
include "../config/db_connection.php";
include "../controller/DoctorController.php";

$doctorController = new DoctorController($conn);
$doctors = $doctorController->getDoctors();
$departments = $doctorController->getSpecializations();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors</title>
    <link rel="stylesheet" href="style.css">
    <script src="doctor.js" defer></script>
</head>
<body>
<div id="doctors" class="section">
    <h3>Search Doctor</h3>
    <div class="doctor-search">
        <select id="doctorDepartment">
            <option value="">Select department</option>
            <?php foreach($departments as $dept): ?>
                <option value="<?= htmlspecialchars($dept) ?>"><?= htmlspecialchars($dept) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" id="searchDoctor" placeholder="Search by doctor name" onkeyup="searchDoctorAjax()">
    </div>

    <div class="doctor-list" id="doctorList">
        <?php foreach($doctors as $doctor): ?>
            <div class="doctor-card">
                <img src="../assets/uploads/doctor_documents/<?= $doctor['profile_image'] ?: 'doc1.png' ?>" alt="<?= $doctor['doctor_name'] ?>">
                <div class="doctor-info">
                    <h4><?= $doctor['doctor_name'] ?></h4>
                    <p><strong><?= $doctor['qualification'] ?></strong></p>
                    <p><?= $doctor['specialization'] ?> | <?= $doctor['experience_years'] ?> yrs</p>
                    <p>Fee: ৳<?= $doctor['consultation_fee'] ?></p>
                    <p>Hospital:<?= $doctor['hospital_username']  ?></p>
                </div>
                <div class="button-group">
                    <button class="btn-primary" 
    onclick="bookAppointmentFromDoctor('<?= $doctorNameJS ?>', '<?= $hospitalJS ?>')">
    Request Appointment
</button>

                    <button class="btn-secondary"
                        onclick="viewDoctorDetails(this)"
                        data-name="<?= $doctor['doctor_name'] ?>"
                        data-email="<?= $doctor['email'] ?>"
                        data-contact="<?= $doctor['contact'] ?>"
                        data-specialization="<?= $doctor['specialization'] ?>"
                        data-qualification="<?= $doctor['qualification'] ?>"
                        data-fee="<?= $doctor['consultation_fee'] ?>"
                        data-experience="<?= $doctor['experience_years'] ?>"
                        data-image="<?= $doctor['profile_image'] ?: 'doc1.png' ?>"
                        data-hospital="<?= $doctor['hospital_username']  ?>"
                    >View Details</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Doctor Modal -->
<div id="doctorModal" class="modal">
    <div class="modal-content">
        <img id="modalDoctorImage" src="../assets/uploads/doctor_documents/doc1.png" alt="Doctor Image">
        <h3 id="modalDoctorName">Doctor Name</h3>
        <div class="modal-info">
            <p><strong>Email:</strong> <span id="modalEmail">N/A</span></p>
            <p><strong>Contact:</strong> <span id="modalContact">N/A</span></p>
            <p><strong>Specialization:</strong> <span id="modalSpecialization">N/A</span></p>
            <p><strong>Qualification:</strong> <span id="modalQualification">N/A</span></p>
            <p><strong>Experience:</strong> <span id="modalExperience">0</span> yrs</p>
            <p><strong>Consultation Fee:</strong> ৳<span id="modalFee">0</span></p>
            <p><strong>Hospital:</strong> <span id="modalHospital">N/A</span></p>
        </div>
        <div class="modal-buttons">
            <button class="btn-primary" onclick="bookAppointmentFromModal()">Book Appointment</button>
            <button class="btn-secondary" onclick="closeModal()">Close</button>
        </div>
    </div>
</div>
</body>
</html>
