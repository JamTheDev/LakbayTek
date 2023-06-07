<?php
include("bootstrap.php");
include("../bootstrap.php");

include("utils/idgen.php");
include("../utils/idgen.php");

include("types/AuthTypes.php");
include("../types/AuthTypes.php");

include("types/ReservationType.php");
include("../types/ReservationType.php");

header("Content-Type: application/json");

include("../controller/ReservationController.php");

$entityBody = json_decode(file_get_contents('php://input'), true);

if (!empty($entityBody)) {
    echo 123;
    exit;
}

echo json_encode(fetch_db_reservations());
