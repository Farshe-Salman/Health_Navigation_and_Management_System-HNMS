<?php
class signup_Model {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function signup($username, $email, $usertype, $password) {
        // 1. Trim inputs
        $username = trim($username);
        $email = trim($email);
        $usertype = trim($usertype);
        $password = trim($password);

        // 2. Basic input validation
        if (empty($username) || empty($email) || empty($usertype) || empty($password)) {
            return ["success" => false, "signup_message" => "All fields are required."];
        }

        // 3. Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ["success" => false, "signup_message" => "Invalid email format."];
        }

        // 4. Check username length
        if (strlen($username) > 50) {
            return ["success" => false, "signup_message" => "Username is too long (max 50 characters)."];
        }

        // 5. Check password length
        if (strlen($password) < 6) {
            return ["success" => false, "signup_message" => "Password must be at least 6 characters."];
        }

        // 6. Check if username exists
        $stmt = $this->conn->prepare("SELECT user_id FROM users WHERE username = ?");
        if (!$stmt) {
            error_log("DB Error (username check): " . $this->conn->error);
            return ["success" => false, "signup_message" => "Internal server error."];
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return ["success" => false, "signup_message" => "Username already exists."];
        }
        $stmt->close();

        // 7. Check if email exists
        $stmt = $this->conn->prepare("SELECT user_id FROM users WHERE email = ?");
        if (!$stmt) {
            error_log("DB Error (email check): " . $this->conn->error);
            return ["success" => false, "signup_message" => "Internal server error."];
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return ["success" => false, "signup_message" => "Email already exists."];
        }
        $stmt->close();

        // 8. Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // 9. Insert new user
        $stmt = $this->conn->prepare(
            "INSERT INTO users (username, email, usertype, password_hash, clearance_status, created_at, updated_at)
             VALUES (?, ?, ?, ?, 'pending', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)"
        );
        if (!$stmt) {
            error_log("DB Error (insert user): " . $this->conn->error);
            return ["success" => false, "signup_message" => "Internal server error."];
        }

        $stmt->bind_param("ssss", $username, $email, $usertype, $hashedPassword);

        if ($stmt->execute()) {
            $stmt->close();
            return ["success" => true, "signup_message" => "Sign-up successful! Please wait for admin approval."];
            header("Location:signin_signup.php");
        } else {
            error_log("DB Insert Error: " . $stmt->error);
            $stmt->close();
            return ["success" => false, "signup_message" => "Internal server error."];
        }
    }
}
?>
