<?php

include("bootstrap.php");
include("../bootstrap.php");

include("utils/idgen.php");
include("../utils/idgen.php");

include("types/AuthTypes.php");
include("../types/AuthTypes.php");

include("types/ReservationType.php");
include("../types/ReservationType.php");
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

    if ($res->ERR_CODE->value != AuthenticationErrors::None->value) {
        $errorCode = $res->ERR_CODE;

        if ($errorCode instanceof AuthenticationErrors) {
            $errorCode = $errorCode->value;
        }

        header("Location: ../register.php?err={$errorCode}");
        return;
    }

    header("Location: ../index.php?id={$res->user_id}");
}
