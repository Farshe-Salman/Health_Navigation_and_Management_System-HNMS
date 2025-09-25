<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Health Navigation Management System</title>
  <link rel="stylesheet" href="../assets/css/landingpage.css">
</head>
<body>
<?php include 'header.php'; ?>
<?php 
    $pageType = 'blood_donor'; 
    include '../controller/landingPageController.php'; 
?>
<link rel="stylesheet" href="../assets/css/landingExtension.css">

<section class="diagnostic">
    <h2>Blood Donors</h2>

    <div class="page-container">
        <div class="table-section">
            <div class="search-container">
                <input type="text" id="donorSearchInput" placeholder="Search by name or blood group...">
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Blood Group</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Last Donated</th>
                            <th>Available</th>
                        </tr>
                    </thead>
                    <tbody id="donorTableBody">
                        <?php if (!empty($bloodDonors)): ?>
                            <?php foreach ($bloodDonors as $donor): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($donor['donorName']); ?></td>
                                    <td><?php echo htmlspecialchars($donor['age']); ?></td>
                                    <td><?php echo htmlspecialchars($donor['gender']); ?></td>
                                    <td><?php echo htmlspecialchars($donor['bloodGroup']); ?></td>
                                    <td><?php echo htmlspecialchars($donor['contactNumber']); ?></td>
                                    <td><?php echo htmlspecialchars($donor['email']); ?></td>
                                    <td><?php echo htmlspecialchars($donor['address']); ?></td>
                                    <td><?php echo htmlspecialchars($donor['lastDonationDate']); ?></td>
                                    <td><?php echo htmlspecialchars($donor['available']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9">No donors found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-section">
            <h3>Register as a Donor</h3>
            <?php if(isset($_GET['success'])): ?>
                <p class="success-message">Registration successful!</p>
            <?php endif; ?>
            <form action="landingPageBloodDonor.php" method="POST">
                <input type="text" name="donorName" placeholder="Donor Name" required>
                <input type="number" name="age" placeholder="Age" required>
                <div class="radio-group">
                    <label>Gender:</label>
                    <input type="radio" name="gender" value="Male" required> Male
                    <input type="radio" name="gender" value="Female"> Female
                    <input type="radio" name="gender" value="Other"> Other
                </div>
                <input type="text" name="bloodGroup" placeholder="Blood Group (e.g., A+)" required>
                <input type="text" name="contactNumber" placeholder="Contact Number" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="address" placeholder="Address" required>
                <div class="input-group">
                    <label>Last Donation Date:</label>
                    <input type="date" name="lastDonationDate" required>
                </div>
                <div class="radio-group">
                    <label>Available:</label>
                    <input type="radio" name="available" value="Yes" required> Yes
                    <input type="radio" name="available" value="No"> No
                </div>
                <button type="submit" name="register_blood_donor">Register</button>
            </form>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
<script src="../assets/js/landingExtension.js"></script>
<script src="../assets/js/landingpage.js"></script>

</body>
</html>