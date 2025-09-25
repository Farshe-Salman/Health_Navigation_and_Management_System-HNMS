<?php
require_once '../model/adminUserApprovalModel.php';

class AdminUserApprovalController {
    private $model;

    public function __construct() {
        $this->model = new AdminUserApprovalModel();
    }

    public function index() {
        return $this->model->getPendingUsers();
    }

    public function updateUserStatus($username, $status) {
        return $this->model->updateUserStatus($username, $status);
    }
}

// Handle AJAX requests to update status
if (isset($_GET['action']) && $_GET['action'] === 'update_status' && isset($_GET['username']) && isset($_GET['status'])) {
    $controller = new AdminUserApprovalController();
    if ($controller->updateUserStatus($_GET['username'], $_GET['status'])) {
        http_response_code(200); // OK
    } else {
        http_response_code(500); // Internal Server Error
    }
    exit();
}
?>