<?php require("config.php") ?>

<!DOCTYPE html>
<html>

<head>
    <title>Reservation Confirmation</title>
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: 'Metropolis', Arial, sans-serif;
            margin: 0;
            background-color: #FDF8E5;
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin: 40px auto;
            padding: 40px;
            background-color: #ffffff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333333;
        }

        p {
            margin-bottom: 10px;
            color: #666666;
        }

        .form-container {
            text-align: left;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333333;
        }

        input[type="text"],
        input[type="file"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #dddddd;
            border-radius: 4px;
            margin-bottom: 10px;
            background-color: #f8f8f8;
            /* Add background color */
            font-size: 16px;
        }

        input[type="file"] {
            padding-top: 16px;
            padding-bottom: 16px;
        }

        .proceed-button {
            background-color: #eec945;
            color: #ffffff;
            border: none;
            padding: 16px 32px;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s;
            z-index: 1;
        }

        .proceed-button {
            background-color: #eec945;
            color: #ffffff;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .proceed-button:hover {
            background-color: #7EBB74;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            p {
                font-size: 14px;
            }

            .form-container {
                margin-bottom: 10px;
            }

            input[type="text"],
            input[type="file"] {
                padding: 10px;
                font-size: 14px;
            }

            .proceed-button {
                font-size: 16px;
                padding: 12px 24px;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <?php require("components/navbar.php") ?><br><br>
    <div class="container">
        <h1 style="text-align: center;">Reservation Confirmation</h1>
        <div class="form-container">
            <div style="text-align: center;">
                <h2>Payment Confirmation</h2>
            </div>
            <form action="payment_end-process_page.php?reservation=<?= $_GET['reservation'] ?>" method="post" enctype="multipart/form-data">
                <label for="reference-number">Reference Number:</label>
                <input type="text" id="reference-number" name="reference-number" required maxlength="13">

                <label for="gcash-account-name">GCash Account Name:</label>
                <input type="text" id="gcash-account-name" name="gcash-account-name" required>

                <label for="gcash-phone-number">Phone Number (GCash):</label>
                <input type="number" id="gcash-phone-number" name="gcash-phone-number" required>

                <label for="payment-screenshot">Upload GCash Payment Screenshot:</label>
                <input type="file" name="file" id="file" accept="multipart/form-data" required>

                <div style="text-align: center;"><button class="proceed-button" type="submit" name="submit" style="text-align: center;">Submit</button></div>
        </div>
        </form>
    </div>
    </div>
</body>

</html>