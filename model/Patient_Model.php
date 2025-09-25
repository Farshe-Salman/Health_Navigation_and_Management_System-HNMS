<?php
require_once '../config/db_connection.php';

class Patient_Profile_Model {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch patient info by username
    public function getPatientByUsername($username) {
        $stmt = $this->conn->prepare("
            SELECT patient_id, username, email, full_name, contact, gender, dob, blood_group, address,
                   profile_image, id_proof, medical_record
            FROM patients
            WHERE username = ?
        ");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $patient = $result->fetch_assoc();
        $stmt->close();
        return $patient ?: null;
    }

    // Update patient profile
    public function updatePatient($patient_id, $username, $data) {
        if (empty($data)) return false;

        $this->conn->begin_transaction();
        try {
            $fields = [];
            $types = '';
            $values = [];

            foreach ($data as $col => $val) {
                $fields[] = "$col = ?";
                if (is_int($val)) {
                    $types .= 'i';
                } elseif (is_float($val)) {
                    $types .= 'd';
                } else {
                    $types .= 's';
                }
                $values[] = $val;
            }

            // Add WHERE clause parameters
            $types .= 'is';
            $values[] = $patient_id;
            $values[] = $username;

            $sql = "UPDATE patients SET " . implode(', ', $fields) . " WHERE patient_id = ? AND username = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param($types, ...$values);
            $stmt->execute();
            $stmt->close();

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Update patient failed: " . $e->getMessage());
            return false;
        }
    }
}
?>
