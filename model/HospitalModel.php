<?php
class HospitalModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllHospitals() {
        $sql = "SELECT hospital_id, name, location, contact, category, facilities, image FROM hospitals";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchHospitals($keyword) {
        $keyword = "%".$keyword."%";
        $stmt = $this->conn->prepare("
            SELECT hospital_id, name, location, contact, category, facilities, image 
            FROM hospitals 
            WHERE name LIKE ? OR facilities LIKE ?
        ");
        $stmt->bind_param("ss", $keyword, $keyword);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
