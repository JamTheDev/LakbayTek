<?php
header("Content-Type: application/json");

include("bootstrap.php");
include("../bootstrap.php");
include("utils/idgen.php");
include("../utils/idgen.php");

$entityBody = json_decode(file_get_contents('php://input'), true);

var_dump($entityBody);

$reservation_id = $entityBody["reservation_id"];
$package_id = $entityBody["package_id"];
$user_id = $entityBody["user_id"];
$date = $entityBody["date"];
$time = $entityBody["time"];
$dt = $date . " " . $time;
$payment_status = $entityBody["payment_status"];


$result = $conn->query("insert into Reservations (reservation_id, package_id, user_id, date, payment_status) 
VALUES ('$reservation_id', '$package_id', '$user_id', '$dt', '$payment_status');");
