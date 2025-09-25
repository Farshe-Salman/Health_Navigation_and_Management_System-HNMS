<?php
require_once '../controller/adminHospitalsController.php';
$controller = new AdminHospitalsController();
$hospitals = $controller->index();
?>

<div class="hospitals-container">
    <div class="hospitals-table-container">
        <h2>Hospitals List</h2>
        <div class="search-container">
            <input type="text" id="hospitalSearchInput" placeholder="Search by username, name, or address...">
        </div>
        <table class="hospitals-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Hospital Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Profile Image</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hospitals as $hospital): ?>
                    <tr>
                        <td><?php echo $hospital['username']; ?></td>
                        <td><?php echo $hospital['hospital_name']; ?></td>
                        <td><?php echo $hospital['email']; ?></td>
                        <td><?php echo $hospital['phone']; ?></td>
                        <td><?php echo $hospital['address']; ?></td>
                        <td><img src="../assets/uploads/doctors_document/<?php echo $hospital['profile_image']; ?>" alt="Profile Image" width="50"></td>
                        <td><a href="../controller/adminHospitalsController.php?action=delete&username=<?php echo $hospital['username']; ?>" class="delete-btn">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="add-hospital-form-container">
        <h2>Add Hospital</h2>
        <form action="../controller/adminHospitalsController.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="hospital_name" placeholder="Hospital Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Phone" required>
            <textarea name="address" placeholder="Address" required></textarea>
            Profile Picture:
            <input type="file" name="profile_image" required>
            <button type="submit" name="add_hospital" class="add-btn">Add Hospital</button>
        </form>
    </div>
</div>
