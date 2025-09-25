<?php
require_once(dirname(__FILE__) . '/../config/db_connection.php');

class AdminUserApprovalModel {

    public function getPendingUsers() {
        global $conn;
        $sql = "SELECT username, email, usertype, clearance_status FROM users WHERE clearance_status = 'pending'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function updateUserStatus($username, $status) {
        global $conn;
        $username = mysqli_real_escape_string($conn, $username);
        $status = mysqli_real_escape_string($conn, $status);

        $sql = "UPDATE users SET clearance_status = '$status' WHERE username = '$username'";
        return mysqli_query($conn, $sql);
    }
}
?>