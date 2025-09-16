<?php
class signin_Model {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function signin($username,$password) {
        $stmt = $this->conn->prepare(
            "SELECT user_id, username, usertype, password_hash, clearance_status 
             FROM users 
             WHERE username=?"
        );
        if (!$stmt) return false;

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $stmt->close();
            return $user;
        }

        $stmt->close();
        return false;
    }
}
?>
