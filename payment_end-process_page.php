<?php require("config.php") ?>
<!DOCTYPE html>
<html>
<head>
    <title>Lakbaytek - Reservation Confirmation</title>
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: 'Metropolis', Arial, sans-serif;
            margin: 0;
            background-color: #FDF8E5;
        }
        
        .background {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            width: 80%;
            max-width: 600px;
            padding: 40px;
            background-color: #ffffff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }
        
        h1 {
            font-size: 28px;
            margin: 0 0 20px;
            color: #333333;
            text-align: center;
        }
        
        p {
            margin: 10px 0;
            color: #666666;
            text-align: center;
			line-height: 30px;
        }
        
        .contact-info {
            margin-top: 40px;
            text-align: center;
        }
        
        .contact-info p {
            margin: 5px 0;
        }
        
        .contact-info p:last-child {
            margin-bottom: 20px;
        }
        
        .contact-info a {
            color: #eec945;
            text-decoration: none;
        }
		
		
        
        .home-button {
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
        
        .home-button {
            background-color: #eec945;
            color: #ffffff;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
			text-decoration: none;

        }
		
		 .home-button:hover {
            background-color: #7EBB74;
        }
        
        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            .container {
                width: 90%;
            }
            
            h1 {
                font-size: 24px;
            }
        }
		
		.l {
			color: blue;
		}
    </style>
</head>
<body>
<?php require("components/navbar.php") ?><br><br>
    <div class="background">
        <div class="container">
            <h1>Reservation Confirmation</h1>
            <p>Thank you for choosing Casa Querencia Resort! We look forward to welcoming you on your travel date.
            Your reservation approval is now on process. Please check your <a class="l" href="reservation.php">reservation details</a> for updates.
            For any inquiries or changes, please contact our customer support.</p>
            <div class="contact-info">
                <p>Contact Us:</p>
                <p>Phone: <a href="tel:09485063644">09485063644</a></p>
                <p>Email: <a href="mailto:r.nuevas.k12042427@umak.edu.ph">r.nuevas.k12042427@umak.edu.ph</a></p>
            </div><br><br><Br>
            <a class="home-button" href="/">Go to Home</a>
        </div>
    </div>
</body>
</html>
