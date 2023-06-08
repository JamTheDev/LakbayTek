<?php

include("bootstrap.php");
include("../bootstrap.php");

include("utils/idgen.php");
include("../utils/idgen.php");

function calculateTotalReservationPrice()
{
    global $conn; // Assuming you have a database connection

    $query = "
        SELECT r.reservation_id, r.check_in_date, r.check_out_date, p.package_id, p.price_weekday, p.price_weekend
        FROM Reservations r
        INNER JOIN Packages p ON r.package_id = p.package_id";

    $result = $conn->query($query);

    $totalPrice = 0;

    if ($result) {
        $reservations = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($reservations as $reservation) {
            $checkInDate = new DateTime($reservation['check_in_date']);
            $checkOutDate = new DateTime($reservation['check_out_date']);
            $packageId = $reservation['package_id'];

            $priceWeekday = $reservation['price_weekday'];
            $priceWeekend = $reservation['price_weekend'];

            $totalDays = $checkInDate->diff($checkOutDate)->days;

            $totalPrice += calculateReservationPrice($totalDays, $packageId, $priceWeekday, $priceWeekend);
        }
    }

    return $totalPrice;
}

function calculateReservationPrice($totalDays, $packageId, $priceWeekday, $priceWeekend)
{
    $totalPrice = 0;

    for ($day = 1; $day <= $totalDays; $day++) {
        $currentDate = date('Y-m-d', strtotime("+{$day} days"));

        $isWeekend = (date('N', strtotime($currentDate)) >= 6);

        $price = $isWeekend ? $priceWeekend : $priceWeekday;
        $totalPrice += $price;
    }

    return $totalPrice;
}

$totalReservationPrice = calculateTotalReservationPrice();

$response = [
    'total_price' => $totalReservationPrice
];

header('Content-Type: application/json');
echo json_encode($response);
?>
