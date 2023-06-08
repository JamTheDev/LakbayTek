<!DOCTYPE html>
<html lang="en">
<?php require("config.php") ?>

<body>
    <?php require("components/navbar.php") ?>
    <?php require("components/pendingres.php") ?>
    
    

    <script type="module">
        import { setNavbarSticky, setNavbarInvisible } from "./js/navbar.js";

        setNavbarInvisible();
        setNavbarSticky();
    </script>
</body>

</html>