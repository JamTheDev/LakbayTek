<!DOCTYPE html>
<html lang="en">
<?php require("config.php"); ?>
<?php

$user = getUserBySession();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 100%;
            margin: 10px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }

        .left-section {
            flex-basis: 33%;
			
        }

        .right-section {
            flex-basis: 65%;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			
        }

        table th,
        table td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .form-container {
            background-color: #fff;
            border-radius: 4px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            margin-top: 0;
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 97%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 12px;
        }

        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
 <?php require("components/navbar.php"); ?>
    <div class="container">
        <div class="left-section">
            <h1>Profile</h1>

            <div class="form-container">
                <table>
                    <tr>
                        <th>Email</th>
                        <td><?= $user->email ?></td>
                    </tr>

                    <tr>
                        <th>Name</th>
                        <td><?= $user->username ?></td>
                    </tr>

                    <tr>
                        <th>Birthdate</th>
                        <td><?= $user->date ?></td>
                    </tr>

                    <tr>
                        <th>Gender</th>
                        <td><?= $user->gender ?></td>
                    </tr>

                    <tr>
                        <th>Address</th>
                        <td><?= $user->address ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="right-section">
            <div class="form-container">
                <h2>Edit Profile</h2>
                <form action="update_profile.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?= $user->username ?>">

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= $user->email ?>">

                    <label for="birthdate">Birthdate:</label>
                    <input type="text" id="birthdate" name="birthdate" value="<?= $user->date ?>">

                    <label for="gender">Gender:</label>
                    <input type="text" id="gender" name="gender" value="<?= $user->gender ?>">

                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?= $user->address ?>">

                    <input type="submit" value="Update Profile">
                </form>
            </div>

            <div class="form-container">
                <h2>Change Password</h2>
                <form action="change_password.php" method="post">
                    <label for="current-password">Current Password:</label>
                    <input type="password" id="current-password" name="current-password">

                    <label for="new-password">New Password:</label>
                    <input type="password" id="new-password" name="new-password">

                    <label for="confirm-password">Confirm New Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password">

                    <input type="submit" value="Change Password">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
