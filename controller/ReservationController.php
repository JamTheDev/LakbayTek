<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    die("This file cannot be accessed directly.");
}


/**
 * Stars / Restarts the current reservation process.
 */
function start_reservation_process()
{
    if (!isset($_COOKIE["ReservationProcess"])) {
        $expirationTime = time() + (24 * 60 * 60); // One day from the current time
        $defaultValue = "default_value"; // Provide a default value for the cookie

        $_SESSION['ReservationProcess'] = $defaultValue;
    }
}


function update_local_reservation(Reservation $_r): Reservation
{
    if (!($_r instanceof Reservation)) {
        return Reservation::raise_error("Invalid reservation data provided!");
    }

    $old_reservation = fetch_local_reservation();
    $assoc_new_reservation = $old_reservation->update_reservation($_r);

    try {
        $str_assoc = json_encode($assoc_new_reservation);
        if ($str_assoc === false) {
            return Reservation::raise_error("Failed to encode reservation data!");
        }
    } catch (Exception $e) {
        return Reservation::raise_error("Failed to encode reservation data: " . $e->getMessage());
    }

    // Specify the same domain and path for the cookie
    $domain = "localhost";
    $path = "/";

    // Set the expiration time for the cookie (e.g., 1 day from the current time)
    $expirationTime = time() + (24 * 60 * 60);

    $_SESSION['ReservationProcess'] = $str_assoc;
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
