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
    <title>Document</title>
</head>
<body>
    <!-- Doctors -->
      <div id="doctors" class="section">
        <h3>Search Doctor</h3>
        <div class="doctor-search">
          <select id="doctorDepartment">
    <option value="">Select department</option>
    <?php foreach($departments as $dept): ?>
        <option value="<?= htmlspecialchars($dept) ?>"><?= htmlspecialchars($dept) ?></option>
    <?php endforeach; ?>
</select>
        </div>
          <div class="doctor-search">
            <input type="text" id="searchDoctor" placeholder="Search by doctor name" onkeyup="searchDoctorAjax()">
          </div>
          
        

        <div class="doctor-list" id="doctorList">
           <?php foreach($doctors as $doctor): ?>
          <!-- Doctor Cards -->
          <div class="doctor-card">
             <img src="../assets/uploads/<?= $doctor['photo'] ?: 'doc1.png' ?>" alt="<?= $doctor['name'] ?>">
            <div class="doctor-info">
              <h4><?= $doctor['name'] ?></h4>
                <p><strong><?= $doctor['qualification'] ?></strong></p>
                <p><?= $doctor['specialization'] ?> | <?= $doctor['experience_years'] ?> yrs</p>
                <p>Fee: ৳<?= $doctor['consultation_fee'] ?></p>
            </div>
            <div class="button-group">
              <button class="btn-primary"onclick="alert('Book appointment with <?= $doctor['name'] ?>')">Request an Appointment</button>
              <button class="btn-secondary">View Doctor Profile</button>
            </div>
          </div>

             <?php endforeach; ?>
        </div>
      </div>
</body>
</html>




