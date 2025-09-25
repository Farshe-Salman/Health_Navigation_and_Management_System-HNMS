<?php
require_once '../model/adminHospitalsModel.php';

class AdminHospitalsController {
    private $model;

    public function __construct() {
        $this->model = new AdminHospitalsModel();
    }

    public function index() {
        return $this->model->getAllHospitals();
    }

    public function addHospital($data) {
        $target_dir = "../assets/uploads/doctors_document/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
        $data['profile_image'] = basename($_FILES["profile_image"]["name"]);

        $result = $this->model->addHospital($data);
        if ($result['success']) {
            header("Location: ../view/adminDashboard.php?page=adminHospitals");
        } else {
            echo "Error adding hospital: " . htmlspecialchars($result['message']);
        }
    }

    public function deleteHospital($username) {
        return $this->model->deleteHospital($username);
    }

    public function searchHospitals($term) {
        $hospitals = $this->model->searchHospitals($term);
        if (!empty($hospitals)) {
            foreach ($hospitals as $hospital) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($hospital['username']) . '</td>';
                echo '<td>' . htmlspecialchars($hospital['hospital_name']) . '</td>';
                echo '<td>' . htmlspecialchars($hospital['email']) . '</td>';
                echo '<td>' . htmlspecialchars($hospital['phone']) . '</td>';
                echo '<td>' . htmlspecialchars($hospital['address']) . '</td>';
                echo '<td><img src="../assets/uploads/doctors_document/' . htmlspecialchars($hospital['profile_image']) . '" alt="Profile Image" width="50"></td>';
                echo '<td><a href="../controllers/adminHospitalsController.php?action=delete&username=' . urlencode($hospital['username']) . '" class="delete-btn">Delete</a></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="7" style="text-align:center;">No results found.</td></tr>';
        }
    }
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AdminHospitalsController();
    if (isset($_POST['add_hospital'])) {
        $controller->addHospital($_POST);
    } 
}

// Handle AJAX delete request
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['username'])) {
    $controller = new AdminHospitalsController();
    if ($controller->deleteHospital($_GET['username'])) {
        http_response_code(200); // Success
    } else {
        http_response_code(500); 
    }
    exit(); 
}

// Handle AJAX search request
if (isset($_GET['action']) && $_GET['action'] === 'search' && isset($_GET['term'])) {
    $controller = new AdminHospitalsController();
    $controller->searchHospitals($_GET['term']);
    exit();
}

?>