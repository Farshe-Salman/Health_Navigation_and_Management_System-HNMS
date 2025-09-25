<?php
class AppointmentModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Insert appointment
    public function createAppointment($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO appointments 
            (hospital_name, patient_name, dob, gender, contact, doctor_name, appointment_date, appointment_time) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "ssssssss",
            $data['hospital_name'],
            $data['patient_name'],
            $data['dob'],
            $data['gender'],
            $data['contact'],
            $data['doctor_name'],
            $data['appointment_date'],
            $data['appointment_time']
        );

        return $stmt->execute();
    }

    // Get list of hospitals
    public function getHospitals() {
        $hospitals = [];
        $result = $this->conn->query("SELECT hospital_username FROM doctors");
        if($result){
            while($row = $result->fetch_assoc()){
                $hospitals[] = $row['hospital_username'];
            }
        }
        return $hospitals;
    }
}
?>
