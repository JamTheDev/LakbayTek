<!DOCTYPE html>
<html lang="en">
<?php
$title = "Home";
require("config.php"); ?>

<body>

    <?php require("components/navbar.php") ?>
    <?php require("components/landing/carousel.php") ?>
    <?php require("components/landing/services.php") ?>
    <?php require("components/landing/about.php") ?>
    <?php require("components/landing/testimonials.php") ?>

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