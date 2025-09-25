<?php
include_once "../model/HospitalModel.php";
include_once "../config/db_connection.php";

class HospitalController {
    private $hospitalModel;

    public function __construct($conn) {
        if (!$conn) {
            die("Database connection failed");
        }
        $this->hospitalModel = new HospitalModel($conn);
    }

    // Get all hospitals
    public function getHospitals() {
        $hospitals = $this->hospitalModel->getAllHospitals();
        return $hospitals ?: []; 
    }

    // Search hospitals by keyword
    public function searchHospitals($keyword) {
        $hospitals = $this->hospitalModel->searchHospitals($keyword);
        return $hospitals ?: []; 
    }
}
?>
