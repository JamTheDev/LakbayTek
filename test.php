<?php
require_once("backend/auth.php");
try {

    // $dateToday = new DateTime();
    // $format = $dateToday->format("y-m-d");
    // register("Jam", "email@email.com", "1234567890", "1234567890", "Male", $format, "doon lng sa kanto");

    echo exec('whoami');
    
} catch (Exception $e) {
    echo $e->getMessage();
}
