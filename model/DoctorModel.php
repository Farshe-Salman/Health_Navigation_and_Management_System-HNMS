<?php
class DoctorModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Get all doctors
    public function getAllDoctors() {
        $sql = "SELECT * FROM doctors";
        $result = $this->conn->query($sql);
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

   public function searchDoctors($keyword, $specialization = '') {
    $keyword = "%".$keyword."%";
    if($specialization) {
        $stmt = $this->conn->prepare(
            "SELECT doctor_id, name, qualification, specialization, experience_years, consultation_fee, profile_image
             FROM doctors
             WHERE (name LIKE ? OR specialization LIKE ?) AND specialization=?"
        );
        $stmt->bind_param("sss", $keyword, $keyword, $specialization);
    } else {
        $stmt = $this->conn->prepare(
            "SELECT doctor_id, name, qualification, specialization, experience_years, consultation_fee, profile_image
             FROM doctors
             WHERE name LIKE ? OR specialization LIKE ?"
        );
        $stmt->bind_param("ss", $keyword, $keyword);
    }
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

}
?>
