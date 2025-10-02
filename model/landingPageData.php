<?php
require_once '../config/db_connection.php';

class LandingPageData {

    public function getDiagnosticServices() {
        global $conn;
        $sql = "SELECT hospitalName, serviceName, regularPrice, discountRate, discountPrice FROM diagnostic_services";
        $result = $conn->query($sql);
        $services = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $services[] = $row;
            }
        }
        // Not closing connection here, as the script might need it.
        return $services;
    }

    public function getSurgeryPackages() {
        global $conn;
        $sql = "SELECT hospitalName, surgeryName, priceInWord, priceInStandard, PriceInDeluxe, priceInSuite, duration FROM surgery_packages";
        $result = $conn->query($sql);
        $packages = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $packages[] = $row;
            }
        }
        // Not closing connection here.
        return $packages;
    }

    public function getAmbulanceData() {
        global $conn;
        $sql = "SELECT hospitalName, ambulanceCode, hospitalNumber, driverNumber, licenseNo FROM ambulance";
        $result = $conn->query($sql);
        $ambulances = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $ambulances[] = $row;
            }
        }
        // Not closing connection here.
        return $ambulances;
    }

    public function getBloodDonors() {
        global $conn;
        $sql = "SELECT donorName, age, gender, bloodGroup, contactNumber, email, address, lastDonationDate, available FROM blood_donor";
        $result = $conn->query($sql);
        $donors = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $donors[] = $row;
            }
        }
        return $donors;
    }

    public function addBloodDonor($data) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO blood_donor (donorName, age, gender, bloodGroup, contactNumber, email, address, lastDonationDate, available) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssssss", 
            $data['donorName'], 
            $data['age'], 
            $data['gender'], 
            $data['bloodGroup'], 
            $data['contactNumber'], 
            $data['email'], 
            $data['address'], 
            $data['lastDonationDate'], 
            $data['available']
        );
        $stmt->execute();
        $stmt->close();
    }
}
?>