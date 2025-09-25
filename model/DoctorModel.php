<?php
class DoctorModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Get all doctors with hospital_username
    public function getAllDoctors() {
        $sql = "SELECT doctor_id, hospital_username, doctor_name, email, contact, specialization, 
                       qualification, experience_years, consultation_fee, profile_image
                FROM doctors";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get unique specializations for dropdown
    public function getSpecializations() {
        $sql = "SELECT DISTINCT specialization FROM doctors WHERE specialization IS NOT NULL AND specialization != ''";
        $result = $this->conn->query($sql);
        $specializations = [];
        while($row = $result->fetch_assoc()) {
            $specializations[] = $row['specialization'];
        }
        return $specializations;
    }

    // Search doctors by keyword and optional specialization
    public function searchDoctors($keyword, $specialization = '') {
        $keyword = "%".$keyword."%";
        if($specialization) {
            $stmt = $this->conn->prepare(
                "SELECT doctor_id, hospital_username, doctor_name, email, contact, specialization, 
                        qualification, experience_years, consultation_fee, profile_image
                 FROM doctors
                 WHERE (doctor_name LIKE ? OR specialization LIKE ?) AND specialization=?"
            );
            $stmt->bind_param("sss", $keyword, $keyword, $specialization);
        } else {
            $stmt = $this->conn->prepare(
                "SELECT doctor_id, hospital_username, doctor_name, email, contact, specialization, 
                        qualification, experience_years, consultation_fee, profile_image
                 FROM doctors
                 WHERE doctor_name LIKE ? OR specialization LIKE ?"
            );
            $stmt->bind_param("ss", $keyword, $keyword);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        $doctors = $res->fetch_all(MYSQLI_ASSOC);


        return $doctors;
    }
}
?>
