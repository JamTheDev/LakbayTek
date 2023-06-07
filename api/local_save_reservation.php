<?php

session_start();
// Include the Reservation class file
include '../types/ReservationType.php';

// Read input from php://input
$inputData = file_get_contents('php://input');
if ($inputData) {
    // Decode the input data (assuming it's in JSON format)
    $requestData = json_decode($inputData, true);

    // Check if the decoding was successful
    if ($requestData !== null) {
        // Create a Reservation object from the input data
        $reservation = Reservation::from_assoc($requestData);

        // Save reservation data in cookies
        $_SESSION['package_id'] = $reservation->package_id ?? $_SESSION['package_id'];
        $_SESSION['check_in_date'] = $reservation->check_in_date ??  $_SESSION['check_in_date'];
        $_SESSION['check_out_date'] = $reservation->check_out_date ?? $_SESSION['check_out_date'];
        // ...

        // Output a success message
        echo "Reservation data saved in cookies.";
    } else {
        // Output an error message if the decoding failed
        echo "Failed to decode input data.";
    }
} else {
    // Output an error message if no input data is available
    echo "No input data found.";
}
?>
