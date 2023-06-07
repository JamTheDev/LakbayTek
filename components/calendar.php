<!DOCTYPE html>
<html>

<head>
  <title>Availability Booking Calendar</title>
  <style>
    section.__main-calendar {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      font-family: Metropolis, sans-serif;
    }

    .calendar-section {
      margin: auto;
      width: 100%;
      height: fit-content;
      background-color: #f2f2f2;
    }

    .calendar {
      padding: 70px;
      font-family: Arial, sans-serif;
      height: 100%;
    }

    @media only screen and (max-width: 700px) {
      .calendar {
        padding: 30px;
        font-family: Arial, sans-serif;
        height: 100%;
      }
    }

    table {
      width: 100%;
      height: 100%;
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
      padding: 1vw 5px;
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
      justify-content: space-evenly;
      align-items: center;
      margin-bottom: 10px;
    }

    .month-navigation button {
      background-color: #7EBB74;
      border: none;
      color: #333;
      padding: 8px 12px;
      cursor: pointer;
      width: 100px;
    }

    .month-navigation button:hover {
      background-color: #EEC945;
    }

    .calendar-container {
      order: 1;
    }
  </style>
</head>

<section class="__main-calendar">

  <div class="content">
    <div class="calendar-container">
      <div class="calendar-section">
        <div class="calendar">
          <div class="month-navigation">
            <button type="button" id="prevMonthBtn">&lt; Previous</button>
            <h1 id="currentMonth"></h1>
            <button type="button" id="nextMonthBtn">Next &gt;</button>
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

  </div>

  <script>
    // Availability data (dummy data for demonstration)

    let activeTdEl;
    let selectedDate;
    let dateHolderEl, dateInputHolderEl;

    const customEvent = new CustomEvent('ondateselect', {
      detail: {
        selectedDate: "hello",
        time: null
      }
    });

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
    })()
    var currentDate = new Date();

    // Event listeners for previous and next month buttons
    document.getElementById('prevMonthBtn').addEventListener('click', showPreviousMonth);
    document.getElementById('nextMonthBtn').addEventListener('click', showNextMonth);

    // Function to initialize the calendar
    function initCalendar() {
      showMonth(currentDate);
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
          const currdate = currentDate.getDate();
          const className = currentDate.toISOString();
          cell.classList.add(className);
          // Check availability status for the current date
          var availabilityStatus = getAvailabilityStatus(currentDate);

          if (availabilityStatus === 'available') {
            cell.classList.add('available');
          } else if (availabilityStatus === 'booked') {
            cell.classList.add('booked');
          }

          if (activeTdEl) {
            if (cell.classList.contains(activeTdEl.classList.item(0))) {
              cell.style.backgroundColor = "orange";
            }
          }

          // when cell is clicked...
          (function(cell) {
            cell.onclick = function() {
              if (cell.classList.contains("booked")) return;
              selectedDate = currdate;
              let isoDate = currentDate.toISOString();

              if (cell == activeTdEl) {
                activeTdEl.style.backgroundColor = "transparent";
                activeTdEl = null;
                dateHolderEl.textContent = "PICK DATE";
                document.dispatchEvent(createCustomEvent(null)); // Dispatch event with null detail
                return;
              }

              if (!activeTdEl) {
                activeTdEl = cell;
                cell.style.backgroundColor = "orange";
                document.dispatchEvent(createCustomEvent(isoDate)); // Dispatch event with selectedDate
                return;
              }

              activeTdEl.style.backgroundColor = "transparent";
              cell.style.backgroundColor = "orange";
              activeTdEl = cell;
              document.dispatchEvent(createCustomEvent(isoDate)); // Dispatch event with selectedDate
            };

            // Function to create the custom event with the given selectedDate
            function createCustomEvent(selectedDate = null, time = null) {
              return new CustomEvent('ondateselect', {
                detail: {
                  selectedDate: selectedDate,
                  time: time
                }
              });
            }
          })(cell);

          row.appendChild(cell);
          currentDate.setDate(currentDate.getDate() + 1);
        }

        calendarDaysElement.appendChild(row);
      }
    }

    // Function to get the availability status for a given date
    function getAvailabilityStatus(date) {
      var formattedDate = date.toISOString().split('T')[0];

      console.log(reservations)
      var availabilityEntry = reservations.find(function(entry) {
        return entry.check_in_date.split(" ")[0] == formattedDate;
      });

      return availabilityEntry ? 'booked' : '';
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

    function toDateString(isoStr) {
      var date = new Date(isoStr);

      var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

      var month = monthNames[date.getMonth()];
      var day = date.getDate();
      var year = date.getFullYear();

      return formattedDate = month + " " + day + ", " + year;
    }

    // Initialize the calendar
  </script>
</section>

</html>