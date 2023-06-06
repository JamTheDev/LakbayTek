<?php
$title = "About Us";
$bg_url = "assets/media/cq_about.jpg";
?>

<!DOCTYPE html>
<html lang="en">
<?php require("config.php") ?>
<body>
    <?php require("components/navbar.php") ?>
    <?php require("components/about-us/carousel.php") ?>
    <?php require("components/about-us/description.php") ?>
    <?php require("components/about-us/banner.php") ?>
    <?php require("components/about-us/cards.php") ?>


    <script type="module">
        import { setNavbarSticky, setNavbarInvisible } from "./js/navbar.js";

        setNavbarInvisible();
        setNavbarSticky();
    </script>
</body>
</html>