<?php
require_once(dirname(__FILE__) . '/../config/db_connection.php');

class AdminDoctorsModel {

    public function getAllDoctors() {
        global $conn;
        $sql = "SELECT * FROM doctors";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function addDoctor($data) {
        global $conn;
        
        $doctor_name = mysqli_real_escape_string($conn, $data['doctor_name']);
        $hospital_username = mysqli_real_escape_string($conn, $data['hospital_username']);
        $email = mysqli_real_escape_string($conn, $data['email']);
        $contact = mysqli_real_escape_string($conn, $data['contact']);
        $specialization = mysqli_real_escape_string($conn, $data['specialization']);
        $qualification = mysqli_real_escape_string($conn, $data['qualification']);
        $experience_years = mysqli_real_escape_string($conn, $data['experience_years']);
        $consultation_fee = mysqli_real_escape_string($conn, $data['consultation_fee']);
        $start_time = mysqli_real_escape_string($conn, $data['start_time']);
        $end_time = mysqli_real_escape_string($conn, $data['end_time']);
        $profile_image = mysqli_real_escape_string($conn, $data['profile_image']);

        $sql = "INSERT INTO doctors (doctor_name, hospital_username, email, contact, specialization, qualification, experience_years, consultation_fee, start_time, end_time, profile_image) 
                VALUES ('$doctor_name', '$hospital_username', '$email', '$contact', '$specialization', '$qualification', '$experience_years', '$consultation_fee', '$start_time', '$end_time', '$profile_image')";
        
        return mysqli_query($conn, $sql);
    }

    public function deleteDoctor($doctorId) {
        global $conn;
        $doctorId = (int)$doctorId;
        $sql = "DELETE FROM doctors WHERE doctor_id = $doctorId";
        return mysqli_query($conn, $sql);
    }

    public function searchDoctors($term) {
        global $conn;
        $term = mysqli_real_escape_string($conn, $term);
        $sql = "SELECT * FROM doctors WHERE doctor_name LIKE '%$term%' OR hospital_username LIKE '%$term%' OR specialization LIKE '%$term%'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>