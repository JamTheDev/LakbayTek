<!DOCTYPE html>
<html lang="en">
<?php
require("config.php");

$user = getUserBySession();
$exec = $conn->query("select * from Reservations where user_id = '{$user['user_id']}'");
$result = $exec->fetch_all();

?>


<body>
    <?php require_once("components/navbar.php") ?>

    <style>
        div.__card-points {
            display: flex;
            flex-direction: row;
            padding: 0 1vw 100px 1vw;
        }

        div.__card-container {
            flex: 1;
            margin: 10px;
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }

        div.__card {
            background-color: #e5e5e5;
            aspect-ratio: 13/16;

            border-radius: 5px;

            width: 20%;

            padding: 10px;

            display: flex;
            flex-direction: column;
        }
    </style>

    <div class="__card-points">
        <div class="__card-container">
            <?php foreach ($result as $reservation) : ?>
                <div class="__card">

                </div>
                <div class="__card">

                </div>
                <div class="__card">

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>