<?php
require_once '../model/landingPageData.php';

$dataModel = new LandingPageData();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register_blood_donor'])) {
        $dataModel->addBloodDonor($_POST);
        // Redirect to prevent form re-submission on refresh
        header("Location: ../view/landingPageBloodDonor.php?success=1");
        exit();
    }
}

// Handle data display for views
if (isset($pageType)) {
    switch ($pageType) {
        case 'diagnostics':
            $diagnosticServices = $dataModel->getDiagnosticServices();
            break;
        case 'surgery':
            $surgeryPackages = $dataModel->getSurgeryPackages();
            break;
        case 'ambulance':
            $ambulanceData = $dataModel->getAmbulanceData();
            break;
        case 'blood_donor':
            $bloodDonors = $dataModel->getBloodDonors();
            break;
    }
}

// The connection should be closed after all potential queries are done.
global $conn;
if ($conn) {
    $conn->close();
}
?>