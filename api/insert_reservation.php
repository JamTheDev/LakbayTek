<?php
header("Content-Type: application/json");

include("bootstrap.php");
include("../bootstrap.php");
include("utils/idgen.php");
include("../utils/idgen.php");
include("../types/ReservationType.php");

$entityBody = json_decode(file_get_contents('php://input'), true);
$reservation_details = Reservation::from_assoc($entityBody);

// Begin transaction
$conn->begin_transaction();

try {
    // Insert reservation details
    $stmt = $conn->prepare("INSERT INTO Reservations (reservation_id, package_id, user_id, check_in_date, check_out_date) 
        VALUES (?, ?, ?, ?, ?);");

    $stmt->bind_param(
        "sssss",
        $reservation_details->reservation_id,
        $reservation_details->package_id,
        $reservation_details->user_id,
        (new DateTime($reservation_details->check_in_date))->format("Y-m-d H:i:s"),
        (new DateTime($reservation_details->check_out_date))->format("Y-m-d H:i:s")
    );

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Commit the transaction
        $conn->commit();
        echo "Success!";
        session_unset();
        exit;
    }

    throw new Exception("Failed to insert reservation details");
} catch (Exception $e) {
    // Rollback the transaction
    $conn->rollback();
    echo "Fail!";
}
