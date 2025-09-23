<?php
class signin_Model {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch user by username
    public function signin($username) {
        $stmt = $this->conn->prepare(
            "SELECT user_id, username, usertype, password_hash, clearance_status 
             FROM users 
             WHERE username=?"
        );
        if (!$stmt) {
            error_log("DB Error (signin fetch): " . $this->conn->error);
            return false;
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user ?: false;
    }
}
?>

