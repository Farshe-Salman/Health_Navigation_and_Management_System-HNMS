<?php
class signup_Model {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function signup($username, $email, $usertype, $password) {
        // 1. Basic input validation
        if (empty($username) || empty($email) || empty($usertype) || empty($password)) {
            return ["success" => false, "signup_message" => "All fields are required."];
        }

        // 2. Check if username exists
        $stmt = $this->conn->prepare("SELECT user_id FROM users WHERE username = ?");
        if (!$stmt) {
            return ["success" => false, "signup_message" => "Prepare failed (username check): " . $this->conn->error];
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return ["success" => false, "signup_message" => "Username already exists!"];
        }
        $stmt->close();

        // 3. Check if email exists
        $stmt = $this->conn->prepare("SELECT user_id FROM users WHERE email = ?");
        if (!$stmt) {
            return ["success" => false, "signup_message" => "Prepare failed (email check): " . $this->conn->error];
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return ["success" => false, "signup_message" => "Email already exists!"];
        }
        $stmt->close();

        // 4. Insert new user (store password as-is)
        $stmt = $this->conn->prepare(
            "INSERT INTO users (username, email, usertype, password_hash, clearance_status, created_at, updated_at)
             VALUES (?, ?, ?, ?, 'pending', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)"
        );
        if (!$stmt) {
            return ["success" => false, "signup_message" => "Prepare failed (insert): " . $this->conn->error];
        }

        $stmt->bind_param("ssss", $username, $email, $usertype, $password); // <-- store plain password

        if ($stmt->execute()) {
            $stmt->close();
            return ["success" => true, "signup_message" => "Sign-up successful! Please wait for admin approval."];
        } else {
            $error = $stmt->error;
            $stmt->close();
            return ["success" => false, "signup_message" => "DB Insert Error: " . $error];
        }
    }
}
?>
