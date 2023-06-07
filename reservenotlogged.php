<!DOCTYPE html>
<html lang="en">
<?php require("config.php"); ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservation Page</title>
  <style>
    /* Add your custom CSS styles here */

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      background-color: #eec945;
    }

    .navbar {
      background-color: #333333;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .navbar-brand {
      color: #ffffff;
      font-size: 24px;
      text-decoration: none;
    }

    .container {
      max-width: 500px;
      margin: 40px auto;
      padding: 40px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #333333;
      font-size: 28px;
      font-weight: bold;
      letter-spacing: 2px;
      text-transform: uppercase;
      animation: fadeIn 1s;
    }

    p {
      margin-top: 0;
      text-align: center;
      font-size: 16px;
      color: #666666;
      animation: slideIn 1s;
    }

    .button-container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 30px;
      animation: fadeIn 1s;
    }

    .button {
      display: inline-block;
      padding: 12px 24px;
      background-color: #4CAF50;
      color: #ffffff;
      text-decoration: none;
      border-radius: 4px;
      transition: background-color 0.3s;
      font-size: 16px;
      margin: 0 10px;
      border: none;
      cursor: pointer;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      outline: none;
      animation: fadeIn 1s;
    }

    .button:hover {
      background-color: #45a049;
      transform: scale(1.05);
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }

    @keyframes slideIn {
      0% {
        transform: translateY(-20px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    /* Responsive Styles */
    @media (max-width: 600px) {
      .container {
        padding: 20px;
      }

      h1 {
        font-size: 24px;
        margin-bottom: 20px;
      }

      p {
        font-size: 14px;
      }

      .button {
        font-size: 14px;
        padding: 10px 20px;
        margin: 0 5px;
      }
    }
  </style>
</head>
<body>
 
      <?php require("components/navbar.php") ?><br><br>
 
  <div class="container">
    <h1>Reservation</h1>
    <p>To proceed with the reservation, please log in or create an account:</p>
    <div class="button-container">
      <a href="login.php" class="button">Log In</a>
      <a href="register.php" class="button">Register</a>
    </div>
  </div>

  <script>
    const buttons = document.querySelectorAll('.button');

    buttons.forEach(button => {
      button.addEventListener('mouseover', () => {
        button.style.backgroundColor = '#45a049';
      });

      button.addEventListener('mouseout', () => {
        button.style.backgroundColor = '#4CAF50';
      });
    });
  </script>
</body>
</html>
	