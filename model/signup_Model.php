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
    $stmt->bind_param("ssss", $username, $email, $usertype, $hashedPassword);

    if ($stmt->execute()) {
        $stmt->close();

        if ($usertype === 'patient') {
    $stmtPatient = $this->conn->prepare(
        "INSERT INTO patients 
        (username, full_name, email, contact, gender, dob, blood_group, address, profile_image, id_proof, medical_record, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)"
    );

    // Default / empty values
    $full_name = ''; // empty by default
    $contact = '';
    $gender = '';
    $dob = null;
    $blood_group = '';
    $address = '';
    $profile_image = '';
    $id_proof = '';
    $medical_record = '';

    $stmtPatient->bind_param(
        "sssssssssss",
        $username,   // same as users.username
        $full_name,
        $email,
        $contact,
        $gender,
        $dob,
        $blood_group,
        $address,
        $profile_image,
        $id_proof,
        $medical_record
    );
    $stmtPatient->execute();
    $stmtPatient->close();
}
        // Hospital-specific insertion
            if ($usertype === 'hospital') {
                $stmtHospital = $this->conn->prepare(
                    "INSERT INTO hospitals 
                    (username, hospital_name, email, phone, address, category, profile_image, license_file, accreditation_file, vat_file) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
                );

                // Default values
                $hospital_name = null;
                $phone = null;
                $address = null;
                $category = null;
                $profile_image = null;
                $license_file = null;
                $accreditation_file = null;
                $vat_file = null;

                $stmtHospital->bind_param(
                    "ssssssssss",
                    $username, $hospital_name, $email, $phone, $address, $category, $profile_image, $license_file, $accreditation_file, $vat_file
                );
                $stmtHospital->execute();
                $stmtHospital->close();
            }


        return ["success" => true, "signup_message" => "Sign-up successful! Please wait for admin approval."];
    } else {
        error_log("DB Insert Error: " . $stmt->error);
        $stmt->close();
        return ["success" => false, "signup_message" => "Internal server error."];
    }
}
}
?>
