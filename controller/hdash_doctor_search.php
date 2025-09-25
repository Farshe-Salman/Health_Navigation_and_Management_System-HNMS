<?php
require_once '../model/hdash_model.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$hospital_username = $_SESSION['user']['username'] ?? '';
$keyword = strtolower(trim($_GET['keyword'] ?? ''));

$doctors = getDoctors($hospital_username);

if ($keyword !== '') {
    $doctors = array_filter($doctors, function($doc) use ($keyword) {
        return strpos(strtolower($doc['doctor_name']), $keyword) !== false ||
               strpos(strtolower($doc['specialization']), $keyword) !== false ||
               strpos(strtolower($doc['contact']), $keyword) !== false;
    });
}

if(!$doctors) {
    echo "<p>No doctors found.</p>";
} else {
    foreach($doctors as $doc) {
        ?>
        <div class="doctor-item">
          <div class="doctor-card">
            <img src="../assets/uploads/doctors_document/<?= htmlspecialchars($doc["profile_image"]) ?>" 
                 alt="<?= htmlspecialchars($doc["doctor_name"]) ?>" 
                 style="width:100px; height:100px; object-fit:cover; border-radius:50%;">
            
            <h4><?= htmlspecialchars($doc["doctor_name"]) ?></h4>
            <p><strong>Specialization:</strong> <?= htmlspecialchars($doc["specialization"]) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($doc["contact"]) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($doc["email"]) ?></p>
            <p><strong>Experience:</strong> <?= htmlspecialchars($doc["experience_years"]) ?> years</p>
            <p><strong>Availability:</strong> <?= htmlspecialchars($doc["schedule_days"]) ?></p>

            <a href="edit_doctor.php?id=<?= $doc["doctor_id"] ?>" class="edit-btn">Edit</a>
            <a href="../controller/delete_doctor.php?id=<?= $doc["doctor_id"] ?>" 
               class="delete-btn" 
               onclick="return confirm('Are you sure you want to delete this doctor?');">
               Delete
            </a>
          </div>
        </div>
        <?php
    }
}
?>