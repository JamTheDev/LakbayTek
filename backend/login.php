<?php

require_once("../controller/AuthController.php");

if (isset($_POST["__user-email"]) && isset($_POST["__user-password"])) {
    $email = $_POST["__user-email"];
    $password = $_POST["__user-password"];
    $rememberme = boolval(isset($_POST["__user-remember-me"]));

    $response = login($email, $password, true);

    if (!empty($response->$ERR_MSG)) {
        
    }
}
