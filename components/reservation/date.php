<style>
  body {
    background-color: #FDF8E5;
  }

  .date-bg {
    height: 100%;
    width: 100%;
    display: grid;
    place-items: center;
  }

  div.date-card {
    border: 1px solid black;
    height: fit-content;
    position: relative;
    text-align: center;
    flex: 1;
    line-height: 30px;
    width: 490px;
    margin: 60px auto;
    padding: 50px 40px 20px 40px;
    border-radius: 10px;
    background-color: #ffffffff;
  }

  .cap>span:nth-child(1) {
    font-family: "Metropolis Black";
    font-size: 40px;
  }

  .cap {
    font-family: "Metropolis";
    font-size: 19px;
    text-align: left;
  }

  .option-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #ffffff;
    border: 1px solid grey;
    border-radius: 3px;
    margin: 10px 20px;
    cursor: pointer;
    font-family: "Metropolis Black";
  }

  .selected {
    background-color: #7EBB74;
  }

  .navigation-buttons {
    margin-top: 50px;
  }

  .navigation-buttons button {
    border: none;
    color: #000;
    background-color: #EEC945;
    padding: 10px 40px;
    text-align: center;
    font-family: "Metropolis";
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 20px 50px;
    cursor: pointer;
    box-shadow: 0px 2px 5px #888888;
  }

  .navigation-buttons button:hover {
    border: none;
    color: #000;
    background-color: #7EBB74;
    padding: 10px 40px;
    text-align: center;
    font-family: "Metropolis";
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 20px 50px;
    cursor: pointer;
    box-shadow: 0px 5px 10px #888888;
  }

  .container {
    width: 450px;
    margin: 50px auto;
  }

  .container label {
    display: block;
    margin-bottom: 10px;
  }

  .container input[type="date"],
  .container input[type="time"] {
    width: 30%;
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .container input[type="submit"] {
    margin-top: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    cursor: pointer;
  }
</style>
<section class="date-bg">
  <div class="date-card">
    <div class="cap">
      <span>DATE OF RESERVATION</span> <br>
      <p>When do you plan to stay in our resort? </p>
    </div>

    <div class="container">
      Date: <input type="date" id="date" name="date">
      <br><br>
      Time: <input type="time" id="time" name="time">
      <input type="text" name="current_page" value="summary" hidden>

      <?php
        $_SESSION["capacity"] = $_POST["capacity"];
      ?>
    </div>

    <div class="navigation-buttons">
      <button onclick="goBack()" class="option-button">BACK</button>
      <button onclick="proceed()" class="option-button">PROCEED</button>
    </div>

    <script>
      let selectedOption = null;

      function selectOption(button) {
        if (selectedOption) {
          selectedOption.classList.remove("selected");
        }

        selectedOption = button;
        selectedOption.classList.add("selected");
      }

      function goBack() {
        // Logic for going back
        console.log("Go back");
        // Redirect to the previous page
        window.location.href = "capacity.php";
      }

      function proceed() {
        // Check if date and time fields are filled
        const date = document.getElementById("date").value;
        const time = document.getElementById("time").value;

        if (date === "" || time === "") {
          alert("Please fill in both the date and time fields.");
          return;
        }

        // Store the selected date and time in sessionStorage
        sessionStorage.setItem("selectedDate", date);
        sessionStorage.setItem("selectedTime", time);

        // Logic for proceeding
        console.log("Proceed");
        // Redirect to the next page
      }

      function validateForm() {
        // Prevent form submission
        return false;
      }
    </script>
  </div>
</section>