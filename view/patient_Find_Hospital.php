<?php
include "../config/db_connection.php";
include "../controller/HospitalController.php";

$hospitalController = new HospitalController($conn);
$hospitals = $hospitalController->getHospitals();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="hospitals" class="section">
    <h3>Registered Hospitals</h3>
    <input type="text" placeholder="Search hospital or facility..." id="searchHospitals" onkeyup="searchHospitalAjax()">

    <div class="hospital-list" id="hospitalList">
        <?php if(!empty($hospitals)): ?>
            <?php foreach($hospitals as $hospital): ?>
    <div class="hospital-card">
         <img src="../assets/uploads/hospital_documents/<?= $doctor['profile_image'] ?: '' ?>" alt="<?= $hospital['hospital_name'] ?>">
        <div class="hospital-info">
            <h4><?= $hospital['hospital_name'] ?></h4>
            <p>Category: <?= $hospital['category'] ?></p>
            <p id="add">Address: <?= $hospital['address'] ?></p>
        </div>
        <div class="button-group">
            <button class="btn-primary" 
                onclick="viewHospitalDetails(this)"
                data-email="<?= $hospital['email'] ?>"
                data-phone="<?= $hospital['phone'] ?>"
                data-address="<?= $hospital['address'] ?>"
            >View Details</button>
        </div>
    </div>
<?php endforeach; ?>
        <?php else: ?>
            <p>No hospitals found.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Modal -->
<div id="hospitalModal" class="modal">
  <div class="modal-content">
    <img src="../assets/uploads/hospital_documents/<?= $hospital['profile_image'] ?: '' ?>" alt="<?= $hospital['hospital_name'] ?>">
    <h3 id="modalHospitalName">Hospital Name</h3>
    <div class="modal-info">
      <p><strong>Email:</strong> <span id="modalEmail"></span></p>
      <p><strong>Phone:</strong> <span id="modalPhone"></span></p>
      <p><strong>Address:</strong> <span id="modalAddress"></span></p>
      <p><strong>Category:</strong> <span id="modalCategory"></span></p>
      <p><strong>Facilities:</strong> <span id="modalFacilities">General Checkup, Emergency, Pharmacy</span></p>
    </div>
    <div class="modal-buttons">
      <button class="btn-secondary" onclick="closeModal()">Close</button>
    </div>
  </div>
</div>

</body>
</html>