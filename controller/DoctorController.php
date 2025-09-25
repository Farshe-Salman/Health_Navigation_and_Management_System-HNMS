<?php
include_once "../model/DoctorModel.php";

class DoctorController {
    private $model;

    public function __construct($conn) {
        $this->model = new DoctorModel($conn);
    }

    public function getDoctors() {
        return $this->model->getAllDoctors();
    }

    public function getSpecializations() {
        return $this->model->getSpecializations();
    }

    public function searchDoctors($keyword, $specialization = '') {
        return $this->model->searchDoctors($keyword, $specialization);
    }
}
?>
