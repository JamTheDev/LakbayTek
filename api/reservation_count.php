<?php

include("bootstrap.php");
include("../bootstrap.php");

include("utils/idgen.php");
include("../utils/idgen.php");
global $conn; // Assuming you have a database connection

$query = "
    SELECT
        MONTH(r.check_in_date) AS month,
        COUNT(*) AS reservation_count
    FROM
        Reservations r
    INNER JOIN
        Users u ON r.user_id = u.user_id
    GROUP BY
        MONTH(r.check_in_date)
    ORDER BY
        MONTH(r.check_in_date)";

$result = $conn->query($query);

$reservation_counts = array();
for ($i = 1; $i <= 12; $i++) {
    $reservation_counts[$i] = 0;
}

if ($result) {
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $row) {
        $month = intval($row['month']);
        $count = intval($row['reservation_count']);
        $reservation_counts[$month] = $count;
    }
}

$reservation_data = array();
for ($i = 1; $i <= 12; $i++) {
    $reservation_data[] = $reservation_counts[$i];
}

header('Content-Type: application/json');
echo json_encode($reservation_data);
?>