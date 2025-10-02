<?php
require_once '../controller/adminDoctorsController.php';
$controller = new AdminDoctorsController();
$doctors = $controller->index();
?>

<div class="doctors-container">
    <div class="doctors-table-container">
        <h2>Doctors List</h2>
        <div class="search-container">
            <input type="text" id="doctorSearchInput" placeholder="Search by name, hospital, or specialization...">
        </div>
        <table class="doctors-table">
            <thead>
                <tr>
                    <th>Doctor Name</th>
                    <th>Hospital</th>
                    <th>Specialization</th>
                    <th>Qualification</th>
                    <th>Fee</th>
                    <th>Profile</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($doctors as $doctor): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($doctor['doctor_name']); ?></td>
                        <td><?php echo htmlspecialchars($doctor['hospital_username']); ?></td>
                        <td><?php echo htmlspecialchars($doctor['specialization']); ?></td>
                        <td><?php echo htmlspecialchars($doctor['qualification']); ?></td>
                        <td><?php echo htmlspecialchars($doctor['consultation_fee']); ?></td>
                        <td><img src="../assets/uploads/doctor_documents/<?php echo htmlspecialchars($doctor['profile_image']); ?>" alt="Profile" width="50"></td>
                        <td>
                            <a href="#" class="view-btn-doctor" data-doctor='<?php echo htmlspecialchars(json_encode($doctor)); ?>'>View</a>
                            <a href="#" class="delete-btn-doctor" data-id="<?php echo htmlspecialchars($doctor['doctor_id']); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="add-doctor-form-container">
        <h2>Add Doctor</h2>
        <form action="../controller/adminDoctorsController.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="doctor_name" placeholder="Doctor Name" required>
            <input type="text" name="hospital_username" placeholder="Hospital Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="contact" placeholder="Contact" required>
            <input type="text" name="specialization" placeholder="Specialization" required>
            <input type="text" name="qualification" placeholder="Qualification" required>
            <input type="number" name="experience_years" placeholder="Experience (Years)" required>
            <input type="number" name="consultation_fee" placeholder="Consultation Fee" required>
            Start Time:
            <input type="time" name="start_time" required>
            End Time:
            <input type="time" name="end_time" required>
            Profile Image:
            <input type="file" name="profile_image" required>
            <button type="submit" name="add_doctor" class="add-btn">Add Doctor</button>
        </form>
    </div>
</div>

<!-- The Modal -->
<div id="doctorModal" class="modal">
  <div class="modal-content">
    <span class="close-btn">&times;</span>
    <h2>Doctor Details</h2>
    <div id="doctorDetailsContent"></div>
  </div>
</div>
