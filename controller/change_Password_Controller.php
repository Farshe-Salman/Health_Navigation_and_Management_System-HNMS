<?php
class change_Password_Controller {
    public function index() {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: ../view/signin_signup.php");
            exit();
        }
        include "../view/change_Password.php";
    }
}
