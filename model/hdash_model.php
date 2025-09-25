<?php
require_once '../config/db_connection.php';

/**
 * Add a doctor and also create a user account with clearance_status = 'pending'
 */
function addDoctor(
    $hospital_username,
    $name,
    $email,
    $contact,
    $specialization,
    $qualification,
    $experience_years,
    $consult_fee,
    $start_time,
    $end_time,
    $schedule_days,
    $profile_image,
    $medical_license,
    $degree_certificate,
    $username,
    $password_hash
) {
    global $conn;

    $hospital_username = trim($hospital_username);
    $conn->begin_transaction();

    try {
        // Insert into doctors
        $stmt = $conn->prepare("INSERT INTO doctors 
            (hospital_username, doctor_name, email, contact, specialization, qualification, 
             experience_years, consultation_fee, start_time, end_time, schedule_days, 
             profile_image, medical_license, degree_certificate, username, password_hash) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        // Corrected: 16 parameters
        $stmt->bind_param(
            "ssssssis" . "ssssssss",   // 16 types
            $hospital_username,
            $name,
            $email,
            $contact,
            $specialization,
            $qualification,
            $experience_years,
            $consult_fee,
            $start_time,
            $end_time,
            $schedule_days,
            $profile_image,
            $medical_license,
            $degree_certificate,
            $username,
            $password_hash
        );

        if (!$stmt->execute()) {
            throw new Exception("Execute failed (doctors): " . $stmt->error);
        }
        $stmt->close();

        // Insert into users
        $stmt2 = $conn->prepare("INSERT INTO users 
            (username, email, usertype, password_hash, clearance_status, created_at, updated_at) 
            VALUES (?, ?, 'doctor', ?, 'pending', NOW(), NOW())");
        if (!$stmt2) {
            throw new Exception("Prepare failed (users): " . $conn->error);
        }

        $stmt2->bind_param("sss", $username, $email, $password_hash);

        if (!$stmt2->execute()) {
            throw new Exception("Execute failed (users): " . $stmt2->error);
        }
        $stmt2->close();

        $conn->commit();
        return true;

    } catch (Exception $e) {
        $conn->rollback();
        error_log("Add doctor failed: " . $e->getMessage());
        return false;
    }
}

/**
 * Fetch doctors list by hospital username
 */
function getDoctors($hospital_username) {
    global $conn;

    $hospital_username = trim($hospital_username);

    $stmt = $conn->prepare("SELECT * FROM doctors WHERE hospital_username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $hospital_username);
    $stmt->execute();
    $result = $stmt->get_result();
    $doctors = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $doctors;
}
//================update doctor===================
function updateDoctor($doctor_id, $hospital_username, $data) {
    global $conn;

    if (empty($data)) return false; // nothing to update

    $conn->begin_transaction();

    try {
        $fields = [];
        $params = [];
        $types = '';

        foreach ($data as $column => $value) {
            $fields[] = "$column = ?";
            // Use 'i' for integers, 'd' for floats, 's' for strings
            if (is_int($value)) $types .= 'i';
            elseif (is_float($value)) $types .= 'd';
            else $types .= 's';
            $params[] = $value;
        }

        // Add WHERE clause parameters
        $types .= 'is'; // doctor_id = i, hospital_username = s
        $params[] = $doctor_id;
        $params[] = $hospital_username;

        $sql = "UPDATE doctors SET " . implode(', ', $fields) . " WHERE doctor_id = ? AND hospital_username = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);

        // Bind parameters dynamically
        $stmt->bind_param($types, ...$params);

        if (!$stmt->execute()) throw new Exception("Execute failed: " . $stmt->error);

        $stmt->close();
        $conn->commit();

        return true;
    } catch (Exception $e) {
        $conn->rollback();
        error_log("Update doctor failed: " . $e->getMessage());
        return false;
    }
}
// =============delete doctor===================
function deleteDoctor($doctor_id, $hospital_username) {
    global $conn;

    $uploadDir = '../assets/uploads/doctors_document/';

    $conn->begin_transaction();

    try {
        // Get the username and uploaded files of this doctor
        $stmt = $conn->prepare("SELECT username, profile_image, medical_license, degree_certificate FROM doctors WHERE doctor_id = ? AND hospital_username = ?");
        $stmt->bind_param("is", $doctor_id, $hospital_username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) throw new Exception("Doctor not found");
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $profile_image = $row['profile_image'];
        $medical_license = $row['medical_license'];
        $degree_certificate = $row['degree_certificate'];
        $stmt->close();

        //  Delete files if they exist
        foreach ([$profile_image, $medical_license, $degree_certificate] as $file) {
            if (!empty($file) && file_exists($uploadDir . $file)) {
                @unlink($uploadDir . $file); // suppress errors
            }
        }

        // Delete from doctors table
        $stmt = $conn->prepare("DELETE FROM doctors WHERE doctor_id = ? AND hospital_username = ?");
        $stmt->bind_param("is", $doctor_id, $hospital_username);
        $stmt->execute();
        $stmt->close();

        // Delete from users table
        $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->close();

        $conn->commit();
        return true;

    } catch (Exception $e) {
        $conn->rollback();
        error_log("Delete doctor failed: " . $e->getMessage());
        return false;
    }
}

?>
