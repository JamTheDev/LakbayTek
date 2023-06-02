<!DOCTYPE html>
<html lang="en">
<?php
require_once("config.php");

?>

<body>
    <style>
        html, body {
            height: 100%;
        }

        form {
            height: 90%;
        }
    </style>
    <?php require("components/navbar.php"); ?>

    <?php if (verifyRememberMeToken()) : ?>
        <form action="" method="post">
            <?php 
            $redir_page = $_POST['current_page'] ?? "welcome";
            require("components/reservation/$redir_page.php"); ?>
        </form>
    <?php endif; ?>
</body>

</html>

<?php ?>