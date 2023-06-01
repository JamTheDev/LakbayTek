<?php

$res = $conn->query("select * from Packages");
$d = $res->fetch_all();
?>

<style>
  body {
    background-color: #FDF8E5;
  }

  .cap-bg {
    height: 100%;
    width: 100%;
    display: grid;
    place-items: center;
  }

  div.cap-card {
    border: 1px solid black;
    height: fit-content;
    position: relative;
    text-align: center;
    flex: 1;
    width: 80%;
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
    width: 200px;
    height: 150px;
    background-color: #ffffff;
    border: 1px solid grey;
    border-radius: 3px;
    margin: 5px 5px;
    cursor: pointer;
  }

  .option-button > .__title {
    font-family: "Metropolis Black";
  }

  .option-button > .__description {
    font-family: "Metropolis";
  }

  .selected {
    background-color: #7EBB74;
  }

  .navigation-buttons {
    margin-top: 50px;
  }

  .navigation-buttons>button {
    border: none;
    height: fit-content;
    color: #000;
    background-color: #EEC945;
    padding: 10px 10px;
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

  .capacity-options {
    display: flex;
    flex-direction: row;
    justify-content: start;
  }
</style>

<section class="cap-bg">
  <div class="cap-card">
    <div class="cap">
      <span>CAPACITY</span> <br>
      <p>What will be the estimated capacity/pax?</p>
    </div>

    <div id="capacity-options">
      <?php foreach ($d as $data) : ?>
        <button type="button" class="option-button" onclick="selectOption(this)">
          <span class="__id" hidden><?= $data[0] ?></span>
          <span class="__title"><?= $data[1] ?></span><br>
          <span class="__description"><?= $data[2] ?></span>
        </button>
      <?php endforeach; ?>
    </div>

    <input type="text" name="capacity" id="capacity" hidden>

    <div class="navigation-buttons">
      <button onclick="goBack()" class="option-button">BACK</button>
      <button onclick="proceed()" class="option-button">PROCEED</button>
    </div>
    <input type="text" name="current_page" value="date" hidden>

    <script>
      let selectedOption = null;

      function selectOption(button) {
        document.getElementById("capacity").value = button.querySelector(".__id").textContent;
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
        window.location.href = "reserve.php?current_page=welcome";
      }

      function proceed() {
        if (!selectedOption) {
          alert("Please select a capacity option.");
          return;
        }

        // Store the selected capacity in sessionStorage
        sessionStorage.setItem("selectedCapacity", document.getElementById("capacity").value);
        // Redirect to the next page
      }
    </script>
  </div>
</section>