<?php
require_once '../model/adminPatientsModel.php';

class AdminPatientsController {
    private $model;

    public function __construct() {
        $this->model = new AdminPatientsModel();
    }

    public function index() {
        return $this->model->getAllPatients();
    }

    public function addPatient($data) {
        $target_dir = "../assets/uploads/patient_documents/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
        $data['profile_image'] = basename($_FILES["profile_image"]["name"]);

        $result = $this->model->addPatient($data);
        if ($result['success']) {
            header("Location: ../view/adminDashboard.php?page=adminPatients");
        } else {
            echo "Error adding patient: " . htmlspecialchars($result['message']);
        }
    }

    public function deletePatient($username) {
        return $this->model->deletePatient($username);
    }

    public function searchPatients($term) {
        $patients = $this->model->searchPatients($term);
        if (!empty($patients)) {
            foreach ($patients as $patient) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($patient['username']) . '</td>';
                echo '<td>' . htmlspecialchars($patient['full_name']) . '</td>';
                echo '<td>' . htmlspecialchars($patient['email']) . '</td>';
                echo '<td>' . htmlspecialchars($patient['gender']) . '</td>';
                echo '<td>' . htmlspecialchars($patient['dob']) . '</td>';
                echo '<td><img src="../assets/uploads/patient_documents/' . htmlspecialchars($patient['profile_image']) . '" alt="Profile Image" width="50"></td>';
                echo '<td><a href="../controller/adminPatientsController.php?action=delete&username=' . urlencode($patient['username']) . '" class="delete-btn-patient">Delete</a></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="7" style="text-align:center;">No results found.</td></tr>';
        }
    }
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AdminPatientsController();
    if (isset($_POST['add_patient'])) {
        $controller->addPatient($_POST);
    } 
}

// Handle AJAX delete request
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['username'])) {
    $controller = new AdminPatientsController();
    if ($controller->deletePatient($_GET['username'])) {
        http_response_code(200); // Success
    } else {
        http_response_code(500); 
    }
    exit(); 
}

// Handle AJAX search request
if (isset($_GET['action']) && $_GET['action'] === 'search' && isset($_GET['term'])) {
    $controller = new AdminPatientsController();
    $controller->searchPatients($_GET['term']);
    exit();
}

?>