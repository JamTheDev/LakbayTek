<?php
error_reporting(E_ALL);
define('BASE_PATH', dirname(__FILE__));
session_set_cookie_params(0);
session_start();

include("bootstrap.php");
include("utils/idgen.php");
include("types/AuthTypes.php");
include("types/ReservationType.php");

require_once("controller/AuthController.php");
require_once("controller/ReservationController.php");
require_once("enums/ErrorEnums.php");
require_once("enums/Statuses.php");
require_once("types/AuthTypes.php");

$user = getUserBySession();

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" href="assets/logos/cq_logo.png">
    <title><?php echo $title ?? "Welcome"; ?> | Casa Querencia </title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <style>
        :root {
            --primary: #8FEA93;
            --secondary: #FFE921;
            --theme-yellow: #EEC945;
        }

        html,
        body {
            padding: 0 auto;
            margin: 0 auto;
            font-family: "Metropolis";
        }

        @font-face {
            font-family: Metropolis;
            src: url("assets/fonts/Metropolis-Regular.otf");
        }

        @font-face {
            font-family: "Metropolis Black";
            src: url("assets/fonts/Metropolis-Black.otf");
        }
    </style>
</head>

<?php require("components/notif_banner.php") ?>