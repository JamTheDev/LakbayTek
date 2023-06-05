<?php
require_once("../controller/PackagesController.php");
header("Content-Type: application/json");

echo json_encode(get_all_packages());