<?php
include "../model/AppointmentModel.php";

// Handle request
if(isset($_GET['action']) && $_GET['action'] === 'save'){
    include "../config/db_connection.php";
    $controller = new AppointmentController($conn);
    $controller->saveAppointment();
    exit;
}
class AppointmentController {
    private $model;

    public function __construct($db) {
        $this->model = new AppointmentModel($db);
    }

    // Handle save request (normal POST or JSON)
    public function saveAppointment() {
        // Check JSON first (optional)
        $data = json_decode(file_get_contents('php://input'), true);

        // If no JSON, use POST
        if(!$data){
            $data = $_POST;
        }

        if(!$data){
            echo "No data received";
            return;
        }

        // Validate required fields
        $required = ['hospital_name','patient_name','dob','gender','contact','doctor_name','appointment_date'];
        foreach($required as $field){
            if(empty($data[$field])){
                echo "Please fill ".$field;
                return;
            }
        }

        if($this->model->createAppointment($data)){
            // If normal POST, redirect with success message
            if(!empty($_POST)){
                echo "<script>alert('Appointment requested successfully!'); window.location='".$_SERVER['HTTP_REFERER']."';</script>";
                exit;
            } else {
                echo "Appointment requested successfully!";
            }
        } else {
            echo "Failed to save appointment!";
        }
    }

    // Get hospitals (for dropdown)
    public function getHospitals() {
        return $this->model->getHospitals();
    }
}


?>
