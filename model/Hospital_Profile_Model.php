<?php
require_once '../config/db_connection.php';

class Hospital_Profile_Model {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch hospital info by username
    public function getHospitalByUsername($username) {
        $stmt = $this->conn->prepare("
            SELECT hospital_id, username, hospital_name, email, phone, address, category,
                   profile_image, license_file, accreditation_file, vat_file
            FROM hospitals
            WHERE username = ?
        ");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $hospital = $result->fetch_assoc();
        $stmt->close();
        return $hospital ?: null;
    }

    // Update hospital profile
    public function updateHospital($hospital_id, $username, $data) {
        if (empty($data)) return false;

        $fields = [];
        $types = '';
        $values = [];

        foreach ($data as $col => $val) {
            $fields[] = "$col = ?";
            $types .= 's';
            $values[] = $val;
        }

        $types .= 'is';
        $values[] = $hospital_id;
        $values[] = $username;

        $sql = "UPDATE hospitals SET " . implode(', ', $fields) . " WHERE hospital_id = ? AND username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}
?>
