<?php
require_once '../model/adminDoctorsModel.php';

class AdminDoctorsController {
    private $model;

    public function __construct() {
        $this->model = new AdminDoctorsModel();
    }

    public function index() {
        return $this->model->getAllDoctors();
    }

    public function addDoctor($data) {
        // Handle file upload
        $target_dir = "../assets/uploads/doctor_documents/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
        $data['profile_image'] = basename($_FILES["profile_image"]["name"]);

        if ($this->model->addDoctor($data)) {
            header("Location: ../view/adminDashboard.php?page=adminDoctors");
        } else {
            echo "Error adding doctor: " . mysqli_error($GLOBALS['conn']);
        }
    }

    public function deleteDoctor($email) {
        return $this->model->deleteDoctor($email);
    }

    public function searchDoctors($term) {
        $doctors = $this->model->searchDoctors($term);
        if (!empty($doctors)) {
            foreach ($doctors as $doctor) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($doctor['doctor_name']) . '</td>';
                echo '<td>' . htmlspecialchars($doctor['hospital_username']) . '</td>';
                echo '<td>' . htmlspecialchars($doctor['specialization']) . '</td>';
                echo '<td>' . htmlspecialchars($doctor['qualification']) . '</td>';
                echo '<td>' . htmlspecialchars($doctor['consultation_fee']) . '</td>';
                echo '<td><img src="../assets/uploads/doctors_document/' . htmlspecialchars($doctor['profile_image']) . '" alt="Profile" width="50"></td>';
                echo '<td>
                          <a href="#" class="view-btn-doctor" data-doctor=' . htmlspecialchars(json_encode($doctor)) . '>View</a>
                          <a href="#" class="delete-btn-doctor" data-id="' . htmlspecialchars($doctor['doctor_id']) . '">Delete</a>
                      </td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="7">No results found.</td></tr>';
        }
    }
}

// Handle POST for adding a doctor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_doctor'])) {
    $controller = new AdminDoctorsController();
    $controller->addDoctor($_POST);
}

// Handle GET for AJAX delete
if (isset($_GET['action']) && $_GET['action'] === 'delete_doctor' && isset($_GET['doctor_id'])) {
    $controller = new AdminDoctorsController();
    if ($controller->deleteDoctor($_GET['doctor_id'])) {
        http_response_code(200);
    } else {
        http_response_code(500);
    }
    exit();
}

// Handle GET for AJAX search
if (isset($_GET['action']) && $_GET['action'] === 'search_doctors' && isset($_GET['term'])) {
    $controller = new AdminDoctorsController();
    $controller->searchDoctors($_GET['term']);
    exit();
}
?>