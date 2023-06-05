<?php
require_once("../controller/AuthController.php");

if (isset($_POST["__user-email"]) && isset($_POST["__user-password"])) {
    $email = $_POST["__user-email"];
    $username = $_POST["__user-name"];
    $confirm_password = $_POST["__user-confirm-password"];
    $password = $_POST["__user-password"];
    $address = $_POST["__user-address"];
    $gender = $_POST["__user-gender"];
    $bday = $_POST["__user-bday"];

    $res = register($username, $email, $password, $confirm_password, $gender, $bday, $address);

    if (!empty($res->$ERR_CODE)) {
        header("Location: ../login.php?err={$res->$ERR_CODE}");
    }

    header("Location: ../index.php");

}
