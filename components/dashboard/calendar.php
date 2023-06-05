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
    
    .navbar {
      background-color: #333;
      color: #fff;
      padding: 10px;
    }

    .content {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .calendar-section {
      margin: auto;
      padding: 70px;
      width: 1000px;
      height: 400px;
      background-color: #f2f2f2;
    }

    .calendar {
      font-family: Arial, sans-serif;
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
      width: 1000px;
      background-color: #f2f2f2;
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
    <div class="calendar-container">
      <div class="calendar-section">
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
    </div>

    <div class="summary-container">
      <div class="summary-section">
        <h2>List of Approved Reservations</h2><br>
        <table>
          <thead>
            <tr class="columns">
              <th>User Name</th>
              <th>Reserved Date</th>
              <th>Time of Check-In</th>
            </tr>
          </thead>
          <tbody id="reservationSummary"></tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    // Availability data (dummy data for demonstration)
    var availability = [
      { date: '2023-06-01', status: 'booked', user: 'Arrabella Jane', time: '10:00 AM' },
      { date: '2023-06-05', status: 'booked', user: 'Jam Emmanuel', time: '2:30 PM' },
      { date: '2023-07-10', status: 'booked', user: 'Reiner Buenas', time: '11:00 AM' },
      { date: '2023-06-15', status: 'booked', user: 'Mary Antoinette', time: '3:00 PM' },
      { date: '2023-07-20', status: 'booked', user: 'Gwyneth Beatrice', time: '9:30 AM' },
    ];

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
      monthElement.textContent = date.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });

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
      var formattedDate = date.toISOString().split('T')[0];

      var availabilityEntry = availability.find(function(entry) {
        return entry.date === formattedDate;
      });

      return availabilityEntry ? availabilityEntry.status : '';
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

          userCell.textContent = entry.user;
          dateCell.textContent = entry.date;
          timeCell.textContent = entry.time;

          row.appendChild(userCell);
          row.appendChild(dateCell);
          row.appendChild(timeCell);

          if (entry.status === 'booked') {
            row.classList.add('booked');
          }

          reservationSummaryElement.appendChild(row);
        }
      });
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
