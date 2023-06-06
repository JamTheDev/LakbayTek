<?php
require_once("controller/AuthController.php");
try {

    // $dateToday = new DateTime();
    // $format = $dateToday->format("y-m-d");
    // $l = register("Jam", "2004jamvillarosa@gmail.com", "1234567890", "1234567890", "Male", $format, "doon lng sa kanto");


    ob_start(); ?>

    <span>HELLO</span>


<?php ob_get_flush();
} catch (Exception $e) {
    echo $e->getMessage();
}
