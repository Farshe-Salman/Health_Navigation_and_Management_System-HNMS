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
    $pageType = 'ambulance'; 
    include '../controller/landingPageController.php'; 
?>
<link rel="stylesheet" href="../assets/css/landingExtension.css">

<section class="diagnostic">
    <h2>Ambulance Services</h2>

    <div class="search-container">
        <input type="text" id="ambulanceSearchInput" placeholder="Search by hospital or ambulance code...">
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Hospital Name</th>
                    <th>Ambulance Code</th>
                    <th>Hospital Number</th>
                    <th>Driver Number</th>
                    <th>License No</th>
                </tr>
            </thead>
            <tbody id="ambulanceTableBody">
                <?php if (!empty($ambulanceData)): ?>
                    <?php foreach ($ambulanceData as $ambulance): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ambulance['hospitalName']); ?></td>
                            <td><?php echo htmlspecialchars($ambulance['ambulanceCode']); ?></td>
                            <td><?php echo htmlspecialchars($ambulance['hospitalNumber']); ?></td>
                            <td><?php echo htmlspecialchars($ambulance['driverNumber']); ?></td>
                            <td><?php echo htmlspecialchars($ambulance['licenseNo']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No ambulance data available at the moment.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>


<section>
    <?php include '../view/footer.php'; ?>
</section>
<script src="../assets/js/landingExtension.js"></script>
<script src="../assets/js/landingpage.js"></script>

</body>
</html>

