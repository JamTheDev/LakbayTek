<!DOCTYPE html>
<html lang="en">
<?php
require_once("config.php");

$user = finduserbysession();
$exec = $conn->query("select * from Reservations where user_id = '{$user['user_id']}'");
$result = $exec->fetch_all();
?>


<body>
    <?php require_once("components/navbar.php") ?>


    <div class="__card-group">
        <?php foreach ($result as $reservation) : ?>
            <div class="__card">
                <?= $reservation[2] ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>