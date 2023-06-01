<?php
require_once("./auth.php");

if (isset($_POST["__user-email"]) && isset($_POST["__user-password"])) {
    $email = $_POST["__user-email"];
    $username = $_POST["__user-name"];
    $confirm_password = $_POST["__user-confirm-password"];
    $password = $_POST["__user-password"];
    $address = $_POST["__user-address"];
    $gender = $_POST["__user-gender"];
    $bday = $_POST["__user-bday"];

    $res = register($username, $email, $password, $confirm_password, $gender, $bday, $address);

    if ($res == 0 || $res == 1) {
        header("Location: ../index.php");
    }

    if ($res == 2) {
        header("Location: ../register.php?err=0&email=$email&username=$username&address=$address&birthdate=$bday");
    }

    if ($res == 3) {
        header("Location: ../register.php?err=1&email=$email&username=$username&address=$address&birthdate=$bday");
    }
}
