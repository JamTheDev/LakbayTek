<!DOCTYPE html>
<html lang="en">
<?php
require_once("config.php");

?>

<body>
    <style>
        html,
        body {
            height: 100%;
        }

        form {
            height: 90%;
        }

        div.__title {
            font-family: "Metropolis Black";
            font-size: 4rem;
            padding: 10px 0;
        }

        div.__subtitle {
            font-size: 1rem;
            color: grey;
            padding: 10px 0;
        }

        .__custom-input>input {
            width: 100%;
            border: 0px;
            outline: none;
        }

        .__custom-input {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 90%;
            border: solid 2px black;
            border-radius: 5px;
            margin: 10px 0 10px 0;
        }

        .__custom-input>* {
            padding: 10px;
        }

        .navigation-buttons {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .navigation-buttons button {
            border: none;
            color: #000;
            background-color: #EEC945;
            padding: 10px 40px;
            text-align: center;
            font-family: "Metropolis";
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 20px 50px;
            cursor: pointer;
            box-shadow: 0px 2px 5px #888888;
        }

        .navigation-buttons button:hover {
            border: none;
            color: #000;
            background-color: #7EBB74;
            font-family: "Metropolis";
            cursor: pointer;
            box-shadow: 0px 5px 10px #888888;
        }
    </style>
    <?php require("components/navbar.php"); ?>

    <?php if (verifyRememberMeToken()) : ?>
        <form class="main-form" action="" method="post">
            <?php
            $redir_page = $_POST['current_page'] ?? "welcome";
            require("components/reservation/$redir_page.php"); ?>
            <input type="text" class="current_page" name="current_page" value="welcome" hidden>
        </form>
    <?php endif; ?>

    <script>
        let form;
        window.onload = () => {
            form = document.querySelector(".main-form");
        }

        function changePage(page) {
            if (!form) return;
            if (page == "home") {
                window.location.href = "index.php";
                return;
            }
            document.querySelector(".current_page").value = page;
            form.submit();
        }
    </script>
</body>

</html>

<?php ?>