<!DOCTYPE html>
<html lang="en">
<?php
$title = "Home";
require("config.php"); ?>

<body>

    <?php require("adminlogin.php") ?>

    <!-- CONTROL THE NAVBAR -->
    <script type="module">
        import {
            setNavbarInvisible,
            setNavbarSticky,
            watchElement
        } from "./js/navbar.js";

        
        watchElement(".header");
        setNavbarInvisible();
        setNavbarSticky();
    </script>
</body>

</html>