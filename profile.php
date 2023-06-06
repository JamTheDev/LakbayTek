<!DOCTYPE html>
<html lang="en">
<?php require("config.php"); ?>
<?php

$user = getUserBySession();
?>

<body>
    <?php require("components/navbar.php"); ?>

    <style>
        div.__body {
            padding: 2% 10%;
        }

        div.__body>table {
            width: 100%;
        }

        div.__body>table>tr {
            margin: 100px 0;
        }
    </style>

    <div class="__body">
        <h1>Profile Description</h1>

        <table>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>

            <tr>
                <td><strong>Email</strong></td>
                <td><?= $user->email ?></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td><strong>Name</strong></td>
                <td><?= $user->username ?></td>
                <td><strong>Birthdate</strong></td>
                <td><?= $user->date ?></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td><strong>Gender</strong></td>
                <td><?= $user->gender ?></td>
                <td><strong>Address</strong></td>
                <td><?= $user->address ?></td>
            </tr>


        </table>
    </div>
</body>

</html>