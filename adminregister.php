<!DOCTYPE html>
<html lang="en">
<?php require("config.php") ?>

<body>
    
    <?php require("adminlognavbar.php") ?>
    <?php require("adminbg.php") ?>
    <?php require("adminregcard.php") ?>

    <script type="module">
        import { setNavbarSticky, setNavbarInvisible } from "./js/navbar.js";

        setNavbarInvisible();
        setNavbarSticky();
    </script>
</body>

</html>