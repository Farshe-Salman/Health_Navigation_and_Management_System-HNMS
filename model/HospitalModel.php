<?php
class HospitalModel {
	private $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	// Get all hospitals
	public function getAllHospitals() {
		$sql = "SELECT hospital_id, username, hospital_name, email, phone, address, category, profile_image, license_file, accreditation_file, vat_file FROM hospitals";
		$result = $this->conn->query($sql);
		if (!$result) {
			// Log error and return empty array
			error_log("Database Error in getAllHospitals: " . $this->conn->error);
			return [];
		}
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	// Search hospitals by name or address/facilities
	public function searchHospitals($keyword) {
		$keyword = "%".$keyword."%";
		$stmt = $this->conn->prepare("
			SELECT hospital_id, username, hospital_name, email, phone, address, category, profile_image, license_file, accreditation_file, vat_file
			FROM hospitals
			WHERE hospital_name LIKE ? OR address LIKE ? OR category LIKE ?
		");
		if (!$stmt) {
			error_log("Prepare failed in searchHospitals: " . $this->conn->error);
			return [];
		}
		$stmt->bind_param("sss", $keyword, $keyword, $keyword);
		$stmt->execute();
		$result = $stmt->get_result();
		if (!$result) {
			error_log("Execute failed in searchHospitals: " . $stmt->error);
			return [];
		}
		return $result->fetch_all(MYSQLI_ASSOC);
	}
}
?>