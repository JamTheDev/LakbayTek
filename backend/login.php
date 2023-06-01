<?php

require_once("./auth.php");

if (isset($_POST["__user-email"]) && isset($_POST["__user-password"])) {
    $email = $_POST["__user-email"];
    $password = $_POST["__user-password"];
    $rememberme = boolval(isset($_POST["__user-remember-me"]));

    $response = login($email, $password, true);
    if ($response == 1) {
        header("Location: ../index.php");
    } else if ($response == 0) {
        header("Location: ../login.php?err=0");
    } else if ($response == 2) {
        header("Location: ../login.php?err=2");
    }
}


