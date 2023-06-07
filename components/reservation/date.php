<style>
  .date-bg {
    margin: 0;
    padding: 0;
    height: 100%;
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .date-card {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    width: 60%;
    height: 100%;
  }

  .__details {
    width: 50%;
    height: 80vh;
    padding: 50px 30px;

    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .container {
    width: 100%;
    margin: 20px auto;
  }

  .container label {
    display: block;
    margin-bottom: 10px;
  }

  .container input[type="time"] {
    width: 50%;
    height: 100%;
    padding: 2px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .__curr-sel {
    background-color: lightcoral;
    padding: 5px;
    text-align: center;
    color: white;
    font-family: "Metropolis Black";
  }

  .navigation-buttons {
    width: 50%;
    padding: 0 auto;
    margin: 0 auto;
  }

  .navigation-buttons button:hover {
    border: none;
    color: #000;
    background-color: #7EBB74;
    font-family: "Metropolis";
    cursor: pointer;
    box-shadow: 0px 5px 10px #888888;
  }


  .navigation-buttons>button:hover {
    width: fit-content;

  }

  .navigation-buttons>button {
    margin: 0 0;
  }

  .__date-summary,
  .__checkout-summary,
  .__inp {
    padding: 5px 0px;
  }

  .__buttons>button {
    width: 100%;
    margin: 5px 0;
    border: none;
    color: #000;
    background-color: #EEC945;
    padding: 10px 40px;
    text-align: center;
    font-family: "Metropolis";
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    cursor: pointer;
    box-shadow: 0px 2px 5px #888888;
    transition-duration: 0.3s;
  }

  .__buttons>button:hover {
    color: #fff;
    background-color: #7EBB74;
    padding: 10px 40px;
    transition-duration: 0.3s;
  }

  @media only screen and (max-width: 900px) {
    .date-bg {
      height: fit-content;
    }

    .date-card {
      display: flex;
      flex-direction: column-reverse;
      width: 80%;
      height: 100%;
    }
  }

  @media only screen and (max-width: 700px) {
    .date-bg {
      height: 1000px;
    }

    .date-card {
      display: flex;
      flex-direction: column-reverse;
      width: 90%;
      height: 100%;
    }

    .date-card>* {
      flex: 1;
    }

    .container input[type="time"] {
      width: 80%;
      padding: 8px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .__details {
      width: 100%;
      height: fit-content;
      padding: 50px 0;

      display: flex;
      flex-direction: column;
      justify-content: center;
    }
  }
</style>
<section class="date-bg">
  <div class="date-card">
    <?php require("components/calendar.php") ?>
    <div class="__details">
      <div class="__title">
        <span>DATE</span>
      </div>

      <div class="__subtitle">
        <span>Select a date for the reservation!</span>
      </div>

      <div class="__curr-sel">
        <span>SELECTING CHECK-IN DATE</span>
      </div>

      <div class="container">
        <h3>Check-in</h3>
        <div class="__date-summary">
          <span>Date: </span>
          <span class="__ci-date-span">PICK DATE</span>
        </div>

        <div class="__inp">
          Time: <input type="time" id="time" name="time">
          <input type="text" name="date" class="__ci-inp-date" value="" hidden>
        </div>

        <h3>Check-out</h3>

        <div class="__date-summary">
          <span>Date: </span>
          <span class="__co-date-span">PICK DATE</span>
        </div>

        <div class="__inp">
          Time: <input type="time" id="time" name="time" disabled>
          <input type="text" name="date" class="__co-inp-date" value="" hidden>
        </div>


        <div class="__buttons">
          <button type="button">SET CHECK IN</button>
          <button type="button">SET CHECK OUT</button>
        </div>
      </div>
    </div>



    <script>
      setTimeout(() => {
        let calendarEl = document.querySelector(".calendar-section");
        let detailsEl = document.querySelector(".__details");

        detailsEl.setAttribute("height", getComputedStyle(calendarEl).height)
      }, 500);
    </script>

  </div>

  <div class="navigation-buttons">
    <button type="button" onclick="changePage('home')" class="option-button">BACK</button>
    <button type="button" onclick="changePage('summary')" class="option-button">PROCEED</button>
  </div>

  <script>
    // find elements for check-in & check-out dates/time
    let dateSelectionMode = "ci";
    let _selectedDate, timeInputValue;
    const checkInDateSpan = document.querySelector(".__ci-date-span");
    const checkOutDateSpan = document.querySelector(".__co-date-span");

    document.addEventListener('ondateselect', (date, time) => {
      _selectedDate = date ?? _selectedDate;
      console.log(_selectedDate)
      let [onlyTime, dateAndTime] = calculateCheckOut(new Date(_selectedDate));
      // check-in
      if (dateSelectionMode == "ci") {
        checkInDateSpan.textContent = dateAndTime;
      }

      // check-out
      if (dateSelectionMode == "co") {

      }

    });

    const dateInputEl = document.querySelector(".inp-date");
    const timeInputEl = document.getElementById("time");
    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    function calculateCheckOut(date) {
      let timeParts, hours, minutes;
      if (timeInputValue == null) {
        timeParts = timeInputValue.split(/:|\s/);
        hours = parseInt(timeParts[0], 10);
        minutes = parseInt(timeParts[1], 10);

        date.setHours(hours);
        date.setMinutes(minutes);

        date.setHours(date.getHours() + 22);
      }

      let updatedHours = date.getHours();
      let updatedMinutes = date.getMinutes();

      let rawUpdatedHours = updatedHours;
      let rawUpdatedMinutes = updatedMinutes;

      let updatedAmPm = updatedHours >= 12 ? "PM" : "AM";

      var month = monthNames[date.getMonth()];
      var day = date.getDate();
      var year = date.getFullYear();

      var formattedDate = month + " " + day + ", " + year;

      updatedHours = updatedHours % 12;
      if (updatedHours === 0) {
        updatedHours = 12;
      }

      console.log(formattedDate + " " + String(rawUpdatedHours).padStart(2, "0") + ":" + String(rawUpdatedMinutes).padStart(2, "0"))

      return [String(updatedHours).padStart(2, "0") + ":" + String(updatedMinutes).padStart(2, "0") + " " + updatedAmPm, formattedDate + " " + String(rawUpdatedHours).padStart(2, "0") + ":" + String(rawUpdatedMinutes).padStart(2, "0")];
    }

    timeInputEl.oninput = function(e) {
      timeInputValue = e.target.value;
      calculateCheckOut();
    }
  </script>


</section>