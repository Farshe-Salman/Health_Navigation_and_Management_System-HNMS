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
    $pageType = 'surgery'; 
    include '../controller/landingPageController.php'; 
?>
<link rel="stylesheet" href="../assets/css/landingExtension.css">

<section class="diagnostic">
    <h2>Surgery Packages</h2>

    <div class="search-container">
        <input type="text" id="surgerySearchInput" placeholder="Search by surgery or hospital...">
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Hospital Name</th>
                    <th>Surgery Name</th>
                    <th>Price In Word</th>
                    <th>Price In Standard</th>
                    <th>Price In Deluxe</th>
                    <th>Price In Suite</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody id="surgeryTableBody">
                <?php if (!empty($surgeryPackages)): ?>
                    <?php foreach ($surgeryPackages as $package): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($package['hospitalName']); ?></td>
                            <td><?php echo htmlspecialchars($package['surgeryName']); ?></td>
                            <td><?php echo htmlspecialchars($package['priceInWord']); ?></td>
                            <td><?php echo htmlspecialchars($package['priceInStandard']); ?></td>
                            <td><?php echo htmlspecialchars($package['PriceInDeluxe']); ?></td>
                            <td><?php echo htmlspecialchars($package['priceInSuite']); ?></td>
                            <td><?php echo htmlspecialchars($package['duration']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No surgery packages available at the moment.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'footer.php'; ?>
<script src="../assets/js/landingExtension.js"></script>
<script src="../assets/js/landingpage.js"></script>

</body>
</html>