<?php
session_start();
include '../config/db_connection.php';
include '../model/signup_Model.php';

if (isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $usertype = trim($_POST['usertype']);
    $password = $_POST['password'];

    $signup_Model = new signup_Model($conn);
    $result = $signup_Model->signup($username, $email, $usertype, $password);

    $_SESSION['signup_message'] = $result['signup_message'];

    // Redirect back to signup page
    header("Location: ../view/signin_signup.php");
    exit();
}
?>
