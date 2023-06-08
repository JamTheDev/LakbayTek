<?php $e = fetch_all_accepted_reservations(); ?>
<!DOCTYPE html>
<html>

<head>
  <title>Availability Booking Calendar</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      font-family: Metropolis, sans-serif;
    }

    .content {
      flex: 1;
      display: flex;
      flex-direction: row;
    }

    .calendar-section {
      margin: 10px 40px;
      padding: 30px 50px;
      width: 100%;
      background-color: #f2f2f2;
      box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
    }

    .calendar {
      font-family: Arial, sans-serif;
      width: 100%;
      background-color: #FDF8E5;
      padding: 10px;
    }

    .reservation-summary-container {
      margin: 10px 40px 10px 0px;
      padding: 70px 50px;
      width: 400px;
      background-color: #f2f2f2;
      box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th {
      background-color: #f2f2f2;
      color: #333;
      padding: 10px;
      text-align: center;
    }

    td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
      cursor: pointer;
    }

    td.available {
      background-color: #b7f4b7;
    }

    td.booked {
      background-color: #EEC945;
      color: #fff;
    }

    .month-navigation {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .month-navigation button {
      background-color: #7EBB74;
      border: none;
      color: #333;
      padding: 8px 12px;
      cursor: pointer;
    }

    .month-navigation button:hover {
      background-color: #EEC945;
    }

    .summary-section {
      margin: 40px auto;
      padding: 20px;
      width: 1200px;
      background-color: #f2f2f2;
      box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
    }

    .summary-section h2 {
      margin-top: 0;
    }

    .summary-section table {
      width: 100%;
      border-collapse: collapse;
      font-family: "Metropolis";
    }

    .summary-section th,
    .summary-section td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
    }

    .summary-section th {
      background-color: #f2f2f2;
      color: #000000;
      text-align: center;
    }

    .summary-section td {
      background-color: #f2f2f2;
      color: #000000;
      font-family: "Metropolis";
      text-align: left;
    }


    .summary-section .booked {
      color: #0000000;
    }

    .calendar-container {
      order: 1;
    }

    .summary-container {
      order: 2;
    }
  </style>
</head>

<body>

  <div class="content">
    <div class="calendar-section">
      <h2>Availability Calendar</h2><br>
      <div class="calendar">
        <div class="month-navigation">
          <button id="prevMonthBtn">&lt; Previous Month</button>
          <h1 id="currentMonth"></h1>
          <button id="nextMonthBtn">Next Month &gt;</button>
        </div>
        <table>
          <thead>
            <tr>
              <th>Sun</th>
              <th>Mon</th>
              <th>Tue</th>
              <th>Wed</th>
              <th>Thu</th>
              <th>Fri</th>
              <th>Sat</th>
            </tr>
          </thead>
          <tbody id="calendarDays"></tbody>
        </table>
      </div>
    </div>

    <div class="reservation-summary-container">
      <h2>Total Number of Approved Reservations</h2>
      <span id="totalReservations">
        <?php

        echo count($e) . " approved reservations for this year.";
        ?>
      </span>
    </div>
  </div>

  <div class="summary-container">
    <div class="summary-section">
      <h2>List of Approved Reservations</h2><br>
      <table>
        <thead>
          <tr class="columns">
            <th>User Name</th>
            <th>Package</th>
            <th>Date of Check-In</th>
            <th>Date of Check-Out</th>
            <th>Reservation Status</th>
            <th>Payment Status</th>
            <th>Feedback</th>
          </tr>
        </thead>
        <tbody id="reservationSummary">
          <?php foreach ($e as $r) : ?>
            <tr>
              <td><?= get_user($r['username']) ?></td>
              <td> <?= $r["package_id"] ?> </td>
              <td> <?= $r["check_in_date"] ?> </td>
              <td> <?= $r["check_out_date"] ?> </td>
              <td> <?= $r["reservation_status"] ?> </td>
              <td> <?= $r["payment_status"] ?> </td>
              <td> NONE </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    // Availability data (dummy data for demonstration)


    async function fetchAllReservations() {
      const response = await fetch("./api/fetch_reservations.php", {
        method: "GET"
      });

      if (response.ok) {
        let x = await response.json();
        return x;
      }
    }
    let reservations;
    (async () => {
      reservations = await fetchAllReservations();
      dateHolderEl = document.querySelector(".__date-span");
      dateInputHolderEl = document.querySelector(".inp-date");
      initCalendar();
    })();

    var currentDate = new Date();

    // Event listeners for previous and next month buttons
    document.getElementById('prevMonthBtn').addEventListener('click', showPreviousMonth);
    document.getElementById('nextMonthBtn').addEventListener('click', showNextMonth);

    // Function to initialize the calendar
    function initCalendar() {
      showMonth(currentDate);
      displayReservationSummary();
    }

    // Function to display the current month
    function showMonth(date) {
      var monthElement = document.getElementById('currentMonth');
      monthElement.textContent = date.toLocaleDateString('en-US', {
        month: 'long',
        year: 'numeric'
      });

      var calendarDaysElement = document.getElementById('calendarDays');
      calendarDaysElement.innerHTML = '';

      var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
      var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
      var currentDate = new Date(firstDay);

      while (currentDate.getMonth() === date.getMonth() || currentDate < lastDay) {
        var row = document.createElement('tr');

        for (var i = 0; i < 7; i++) {
          var cell = document.createElement('td');
          cell.textContent = currentDate.getDate();

          // Check availability status for the current date
          var availabilityStatus = getAvailabilityStatus(currentDate);

          if (availabilityStatus === 'available') {
            cell.classList.add('available');
          } else if (availabilityStatus === 'booked') {
            cell.classList.add('booked');
          }

          row.appendChild(cell);
          currentDate.setDate(currentDate.getDate() + 1);
        }

        calendarDaysElement.appendChild(row);
      }
    }

    // Function to get the availability status for a given date
    function getAvailabilityStatus(date) {
      var availabilityEntry = reservations.find(function(entry) {
        var entryCheckInDate = new Date(entry.check_in_date.split(" ")[0]);
        var entryCheckOutDate = new Date(entry.check_out_date.split(" ")[0]);

        return entryCheckInDate <= date && date <= entryCheckOutDate;
      });

      return availabilityEntry ? 'booked' : '';
    }

    // Function to display the reservation summary
    function displayReservationSummary() {
      var reservationSummaryElement = document.getElementById('reservationSummary');
      reservationSummaryElement.innerHTML = '';

      availability.forEach(function(entry) {
        if (entry.status === 'booked') {
          var row = document.createElement('tr');
          var userCell = document.createElement('td');
          var dateCell = document.createElement('td');
          var timeCell = document.createElement('td');
          var paymentCell = document.createElement('td');
          var actionCell = document.createElement('td');
          var paymentStatus = entry.payment === 'full' ? 'Fully Paid' : 'Partial Payment';

          userCell.textContent = entry.user;
          dateCell.textContent = entry.date;
          timeCell.textContent = entry.time;
          paymentCell.textContent = paymentStatus;

          if (entry.payment !== 'full') {
            var markAsPaidButton = document.createElement('button');
            markAsPaidButton.textContent = 'Mark as Fully Paid';
            markAsPaidButton.addEventListener('click', function() {
              markReservationAsPaid(entry);
            });

            actionCell.appendChild(markAsPaidButton);
          }

          row.appendChild(userCell);
          row.appendChild(dateCell);
          row.appendChild(timeCell);
          row.appendChild(paymentCell);
          row.appendChild(actionCell);

          if (entry.status === 'booked') {
            row.classList.add('booked');
          }

          reservationSummaryElement.appendChild(row);
        }
      });
    }


    // Function to mark a reservation as fully paid
    function markReservationAsPaid(reservation) {
      reservation.payment = 'full';
      displayReservationSummary();
    }

    // Function to show the previous month
    function showPreviousMonth() {
      currentDate.setMonth(currentDate.getMonth() - 1);
      showMonth(currentDate);
      displayReservationSummary();
    }

    // Function to show the next month
    function showNextMonth() {
      currentDate.setMonth(currentDate.getMonth() + 1);
      showMonth(currentDate);
      displayReservationSummary();
    }

    // Initialize the calendar
    initCalendar();
  </script>
</body>

</html>
</body>

</html>