<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    die("This file cannot be accessed directly.");
}
include("bootstrap.php");
include("../bootstrap.php");

include("utils/idgen.php");
include("../utils/idgen.php");

include("types/AuthTypes.php");
include("../types/AuthTypes.php");

include("types/ReservationType.php");
include("../types/ReservationType.php");

/**
 * Stars / Restarts the current reservation process.
 */
function start_reservation_process()
{
    if ($_COOKIE["ReservationProcess"]) {
        setcookie("ReservationProcess", NULL);
    }
}

function update_local_reservation(Reservation $_r): Reservation
{
    $old_reservation = fetch_local_reservation();
    if (Reservation::is_empty($old_reservation)) return Reservation::raise_error("No reservation currently in place!");

    $assoc_new_reservation = $old_reservation->update_reservation($_r);

    $str_assoc = json_encode($assoc_new_reservation);
    setcookie("ReservationProcess", $str_assoc);

    return Reservation::from_assoc($assoc_new_reservation);
}

function fetch_local_reservation(): Reservation
{
    if (!$_COOKIE["ReservationProcess"]) {
        setcookie("ReservationProcess", NULL);
        return Reservation::create_empty();
    }

    $jsonified = json_decode($_COOKIE["ReservationProcess"]);
    return Reservation::from_assoc($jsonified);
}

function fetch_db_reservations(): array
{
    global $conn;
    $reservation_arr = array();

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare(
            "SELECT * FROM Reservations"
        );
        $stmt->execute();

        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->free_result();
        $conn->commit();

        return $result;
    } catch (Exception $e) {
        $conn->rollback();
        return [Reservation::raise_error("Error: {$e->getMessage()}")];
    }
}
