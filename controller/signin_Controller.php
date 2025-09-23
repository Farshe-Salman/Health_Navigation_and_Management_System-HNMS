<?php
session_start();
include '../config/db_connection.php';
include '../model/signin_Model.php';

$signin_Model = new signin_Model($conn);

if (isset($_POST['signin'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $user = $signin_Model->signin($username);

    if ($user) {
        // Verify hashed password
        if (!password_verify($password, $user['password_hash'])) {
            $_SESSION['signin_message'] = "Incorrect password!";
            header("Location: ../view/signin_signup.php");
            exit();
        }

        // Check clearance status
        switch ($user['clearance_status']) {
            case 'approved':
                $_SESSION['user'] = [
                    'username' => $user['username'],
                    'usertype' => $user['usertype']
                ];

                // Redirect based on role
                switch ($user['usertype']) {
                    case 'admin':    header("Location: ../view/admin_dashboard.php"); break;
                    case 'hospital': header("Location: ../view/hospital_dashboard.php"); break;
                    case 'patient':  header("Location: ../view/patient_dashboard.php"); break;
                    default:
                        $_SESSION['signin_message'] = "Invalid user role!";
                        header("Location: ../view/signin_signup.php");
                }
                exit();

            case 'pending':
                $_SESSION['signin_message'] = "Your account is pending admin approval.";
                header("Location: ../view/signin_signup.php");
                exit();

            case 'rejected':
                $_SESSION['signin_message'] = "Your account has been rejected by the admin.";
                header("Location: ../view/signin_signup.php");
                exit();

            default:
                $_SESSION['signin_message'] = "Unknown account status. Contact admin.";
                header("Location: ../view/signin_signup.php");
                exit();
        }
    } else {
        $_SESSION['signin_message'] = "Username not found.";
        header("Location: ../view/signin_signup.php");
        exit();
    }
}

// Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: ../view/signin_signup.php");
    exit();
}
?>
