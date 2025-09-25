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
    $pageType = 'diagnostics'; 
    include '../controller/landingPageController.php'; 
?>
<link rel="stylesheet" href="../assets/css/landingExtension.css">

<section class="diagnostic">
    <h2>Diagnostic Services</h2>

    <div class="search-container">
        <input type="text" id="serviceSearchInput" placeholder="Search by service or hospital...">
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Hospital Name</th>
                    <th>Service Name</th>
                    <th>Regular Price</th>
                    <th>Discount Rate</th>
                    <th>Discount Price</th>
                </tr>
            </thead>
            <tbody id="servicesTableBody">
                <?php if (!empty($diagnosticServices)): ?>
                    <?php foreach ($diagnosticServices as $service): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($service['hospitalName']); ?></td>
                            <td><?php echo htmlspecialchars($service['serviceName']); ?></td>
                            <td><?php echo htmlspecialchars($service['regularPrice']); ?></td>
                            <td><?php echo htmlspecialchars($service['discountRate']); ?></td>
                            <td><?php echo htmlspecialchars($service['discountPrice']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No services available at the moment.</td>
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