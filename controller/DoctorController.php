<?php
include_once "../model/DoctorModel.php";

class DoctorController {
    private $doctorModel;

    public function __construct($conn) {
        $this->doctorModel = new DoctorModel($conn);
    }

    public function getDoctors() {
        return $this->doctorModel->getAllDoctors();
    }

    public function getSpecializations() {
        return $this->doctorModel->getSpecializations();
    }

    public function searchDoctors($keyword, $specialization = '') {
        return $this->doctorModel->searchDoctors($keyword, $specialization);
    }
}
?>
