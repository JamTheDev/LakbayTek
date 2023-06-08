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

function fetch_all_reservations($user_id): array
{
    global $conn;
    $reservation_arr = array();

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare(
            "SELECT * FROM Reservations WHERE user_id = ?"
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

function fetch_all_pending_reservations($user_id): array
{
    global $conn;
    $reservation_arr = array();

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare(
            "SELECT * FROM Reservations WHERE user_id = ? AND (payment_status = 'PENDING' OR payment_id IS NULL OR reservation_status <> 'ACCEPTED')"
        );

        $stmt->bind_param("s", $user_id);
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

function fetch_all_accepted_reservations($user_id): array
{
    global $conn;
    $reservation_arr = array();

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare(
            "SELECT * FROM Reservations WHERE user_id = ? AND (payment_status = 'ACCEPTED' OR payment_id IS NOT NULL)"
        );

        $stmt->bind_param("s", $user_id);
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



function fetch_reservation($reservation_id): array
{
    global $conn;
    $reservation_arr = array();

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare(
            "SELECT * FROM Reservations where reservation_id = ?"
        );
        $stmt->bind_param("s", $reservation_id);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $conn->commit();
        return $result;
    } catch (Exception $e) {
        $conn->rollback();
        return [Reservation::raise_error("Error: {$e->getMessage()}")];
    }
}

function create_payment($user_id, $image_path, $reference_number): bool
{
    global $conn;

    try {
        $conn->begin_transaction();

        // Insert the payment into the payments table
        $stmt = $conn->prepare("
            INSERT INTO Payment (user_id, image_path, reference_number)
            VALUES (?, ?, ?)
        ");
        $stmt->bind_param("sss", $user_id, $image_path, $reference_number);
        $stmt->execute();

        $payment_id = $stmt->insert_id;

        // Update the reservation with the payment_id
        $stmt = $conn->prepare("
            UPDATE Reservations
            SET payment_id = ?
            WHERE reservation_id = ?
        ");
        $stmt->bind_param("is", $payment_id, $reservation_id);
        $stmt->execute();

        $conn->commit();
        return true;
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
        return false;
    }
}
