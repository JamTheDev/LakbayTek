<!DOCTYPE html>
<html>
<head>
  <title>Pending Reservations</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .container {
      margin: 20px;
    }

    h1 {
      text-align: center;
    }

    .pending-reservations-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .pending-reservations-table th,
    .pending-reservations-table td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
    }

    .pending-reservations-table th {
      background-color: #f2f2f2;
      color: #000000;
    }

    .pending-reservations-table td {
      background-color: #ffffff;
      color: #000000;
      font-family: metropolis;
    }

    .partial-payment {
      background-color: #FFD700;
    }

    .approve-btn {
      background-color: #7EBB74;
      color: #000000;
      font-family: metropolis;
      padding: 2px;
      margin: 2px;
    }

    .cancel-btn {
      background-color: #FF6565;
      color: #000000;
      font-family: metropolis;
      padding: 2px;
      margin: 2px;
    }

    .reschedule-btn {
      background-color: #EEC945;
      color: #000000;
      font-family: metropolis;
      padding: 2px;
      margin: 2px;
    }

  </style>
</head>
<body>
  <div class="container">
    <h1>Pending Reservations</h1>
    <table class="pending-reservations-table">
      <thead>
        <tr>
          <th>Reservation ID</th>
          <th>Date and Time of Check-In</th>
          <th>Pax</th>
          <th>Payment Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php

        // Database connection and retrieving account data
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'lakbaytek';

        $conn = mysqli_connect($host, $username, $password, $database);
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM reservations WHERE reservation_status = 'pending'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['reservation_id'] . "</td>";
            echo "<td>" . $row['check_in_date'] . "</td>";
            echo "<td>" . $row['package_id'] . "</td>";
            echo "<td>" . $row['payment_status'] . "</td>";
            echo "<td>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='reservation_id' value='" . $row['reservation_id'] . "'>";
            echo "<button type='submit' name='approve_btn' class='approve-btn'>Approve</button>";
            echo "<button type='submit' name='cancel_btn' class='cancel-btn'>Cancel</button>";
            echo "<button type='submit' name='reschedule_btn' class='reschedule-btn'>Reschedule</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='5'>No pending reservations found.</td></tr>";
        }

        // Handle button actions
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          if (isset($_POST['approve_btn'])) {
            $reservationId = $_POST['reservation_id'];
            $query = "UPDATE reservations SET reservation_status = 'approved' WHERE reservation_id = '$reservationId'";
            mysqli_query($conn, $query);
          } elseif (isset($_POST['cancel_btn'])) {
            $reservationId = $_POST['reservation_id'];
            $query = "UPDATE reservations SET reservation_status = 'cancelled' WHERE reservation_id = '$reservationId'";
            mysqli_query($conn, $query);
          } elseif (isset($_POST['reschedule_btn'])) {
            // Handle reschedule logic
            // You can redirect to a reschedule page or show a form to select a new date and time
          }

          // Refresh the page after performing the action
          header("Location: ".$_SERVER['PHP_SELF']);
          exit();
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
