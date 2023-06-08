<?php
$adminPage = true;
$title = "Dashboard Summary";
?>

<!DOCTYPE html>
<html lang="en">
<?php 
$adminPage = true;
require("config.php");
?>
<body>
<?php require("DASHBOARD/DASHcomponents/navbardash.php") ?> 
    <?php require("DASHBOARD/DASHcomponents/summary.php") ?>
	 

</body>
</html>