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
    $password = $_POST["__user-password"];
    $rememberme = boolval(isset($_POST["__user-remember-me"]));

    $response = login($email, $password, true);

    if ($response->ERR_CODE->value !== AuthenticationErrors::None->value) {
        $err = $response->ERR_CODE->value;
        header("Location: ../login.php?err=$err");
        exit();
        return;
    }

    header("Location: ../index.php");
}
