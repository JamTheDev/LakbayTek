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
    height: 50vh;
    padding: 50px 30px;
  }

  .container {
    width: 100%;
    margin: 50px auto;
  }

  .container label {
    display: block;
    margin-bottom: 10px;
  }

  .container input[type="time"] {
    width: 50%;
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
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
    padding: 10px 0px;
  }

  @media only screen and (max-width: 900px) {
    .date-card {
      display: flex;
      flex-direction: column-reverse;
      width: 80%;
      height: 100%;
    }
  }

  @media only screen and (max-width: 700px) {
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

      <div class="container">
        <div class="__inp">
          Check-in: <input type="time" id="time" name="time">
          <input type="text" name="date" class="inp-date" value="" hidden>
        </div>

        <div class="__date-summary">
          <span>Date: </span>
          <span class="__date-span">PICK DATE</span>
        </div>
        <div class="__checkout-summary">
          <span>Check-out: </span>
          <span class="__checkout-span">NO TIME SELECTED</span>
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
    const timeEl = document.querySelector(".__checkout-span");
    const dateEl = document.querySelector(".__date-span");
    const dateInputEl = document.querySelector(".inp-date");
    const timeInputEl = document.getElementById("time");
    let timeInputValue = "";
    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    function calculateCheckOut() {
      let timeParts = timeInputValue.split(/:|\s/);
      let hours = parseInt(timeParts[0], 10);
      let minutes = parseInt(timeParts[1], 10);

      let date = !dateInputEl.value ? new Date() : new Date(dateInputEl.value);
      date.setHours(hours);
      date.setMinutes(minutes);

      date.setHours(date.getHours() + 22);

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

      dateInputEl.value = formattedDate + " " + String(rawUpdatedHours).padStart(2, "0") + ":" + String(rawUpdatedMinutes).padStart(2, "0");

      timeEl.textContent = formattedDate + " - " + String(updatedHours).padStart(2, "0") + ":" + String(updatedMinutes).padStart(2, "0") + " " + updatedAmPm;
    }

    timeInputEl.oninput = function(e) {
      timeInputValue = e.target.value;
      calculateCheckOut();
    }
  </script>


</section>
