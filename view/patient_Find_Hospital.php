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
                    <img src="<?= $hospital['image'] ?>" alt="<?= $hospital['name'] ?>">
                    <div class="hospital-info">
                        <h4><?= $hospital['name'] ?></h4>
                        <p>Category: <?= $hospital['category'] ?> | Facilities: <?= $hospital['facilities'] ?></p>
                    </div>
                    <div class="button-group">
                        <button class="btn-primary" onclick="bookAppointmentFromHospital('<?= $hospital['name'] ?>')">Book Appointment</button>
                        <button class="btn-secondary">View Details</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hospitals found.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>