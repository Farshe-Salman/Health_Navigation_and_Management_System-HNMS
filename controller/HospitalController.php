<?php
include_once "../model/HospitalModel.php";
include_once "../config/db_connection.php";

class HospitalController {
    private $hospitalModel;

    public function __construct($conn) {
        $this->hospitalModel = new HospitalModel($conn);
    }

    public function getHospitals() {
        return $this->hospitalModel->getAllHospitals();
    }

    public function searchHospitals($keyword) {
        return $this->hospitalModel->searchHospitals($keyword);
    }
}

// Usage
$hospitalController = new HospitalController($conn);
$hospitals = $hospitalController->getHospitals();
?>
