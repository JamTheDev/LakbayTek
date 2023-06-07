<?php require("config.php") ?>
<?php
$user = findUserBySession();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lakbaytek - Reservation Payment</title>
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: 'Metropolis', Arial, sans-serif;
			background:#FDF8E5;
            margin: 0;
        }
        
        .background {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
     
            max-width: 700px;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }
        
        .personal-details-container {
            background-color: #f6f6f6;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 40px;
        }
        
        .summary {
            margin-bottom: 40px;
        }
        
        .payment {
            text-align: center;
        }
        
        h1 {
            font-size: 28px;
            margin: 0 0 10px;
            color: #333333;
        }
        
        h2 {
            font-size: 20px;
            color: #333333;
        }
        
        p {
            margin: 10px 0;
            color: #666666;
        }
        
        .qr-code {
            max-width: 300px;
            max-height: 300px;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .highlight {
            background-color: #f6f6f6;
            padding: 8px 12px;
            border-radius: 4px;
            display: inline-block;
            color: #333333;
        }
        
        .personal-details p strong {
            font-weight: bold;
        }
        
        .personal-details p span {
            color: #777777;
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
            }
            
            .personal-details-container {
                margin-bottom: 20px;
            }
            
            .qr-code {
                max-width: 200px;
                max-height: 200px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            h2 {
                font-size: 18px;
            }
            
            p {
                font-size: 14px;
            }
            
            .proceed-button {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>
</head>

<body>
    <?php require("components/navbar.php") ?><br><br>
    <div class="background">
        <div class="container">
            <div class="personal-details-container">
                <h1>Personal Details</h1>
                <p><strong>Name:</strong> <?= $user->username ?></p>
                <p><strong>Email:</strong> <?= $user->email ?></p>
                <p><strong>Address:</strong> <?= $user->address ?></p>
            </div>
            <div class="summary">
                <h1>Summary of the Placed Reservation</h1>
                <?php
                $reservationID = "muLwJ-GFCC-";
                $paxCapacity = ""; // Add the pax capacity variable here
                $dateTimeOfUsage = "June 20, 2023 - 15:49";
                $paymentStatus = "UNPAID";
                $paymentAmount = "PHP 0 (50% OFF)"; // Update with the correct payment amount variable
                ?>
                <h2>Details</h2>
                <p><strong>Reservation ID:</strong> <span class="highlight"><?= $reservationID ?></span></p>
                <p><strong>Pax (Capacity):</strong> <?= $paxCapacity ?></p>
                <p><strong>Date and Time of Usage:</strong> <?= $dateTimeOfUsage ?></p>
                <h2>Pricing & Payment</h2>
                <p><strong>Payment Status:</strong> <span class="highlight"><?= $paymentStatus ?></span></p>
                <p><strong>Payment Amount:</strong> <?= $paymentAmount ?></p>
            </div>
            <div class="payment">
                <h2>Payment Method: GCash</h2>
                <img src="assets/media/payment_qr_code.png" alt="GCash QR Code" class="qr-code">
                <p>Scan the QR code using your GCash app to make the payment.</p>
            </div>
            <button class="proceed-button" onclick="window.location.href='proceed_button.php'">Proceed</button>
        </div>
    </div><br><br><br><br>
</body>

</html>
