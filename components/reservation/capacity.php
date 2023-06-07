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

  .content {
    width: 35%;
  }

  div.__hr {
    width: 100%;

    display: grid;
    place-items: center;
  }

  div.__hr>div {
    width: 20%;
    height: 5px;

    background-color: black;
    margin: 20px 0;
  }

  .__custom-input {
    width: 100%;
  }

  .__custom-input>input {
    text-align: center;
  }
</style>

<section class="cap-bg">
  <div class="content">
    <div class="__title">
      <span>PACKAGE</span>
    </div>

    <div class="__subtitle">
      <span>Select the right package for you by entering the amount of people entering the resort!</span>
    </div>

    <div class="__hr">
      <div></div>
    </div>

    <div class="__package-body">
      <div class="__insert-content">
        <h1>Enter capacity down the input box below!</h1>
      </div>
      <div class="__custom-input">
        <input type="number" class="capacity" name="capacity" value="HERE!">
      </div>
    </div>

    <div class="navigation-buttons">
      <button type="button" onclick="changePage('welcome')" class="option-button">BACK</button>
      <button type="button" onclick="changePage('date')" class="option-button">PROCEED</button>
    </div>
  </div>
  <input type="text" name="package_id" class="__package-id" value="" hidden>
  <script>
    let data;
    let insertContentEl, packageIdInput;
    let xhttp = new XMLHttpRequest();

    // man tinatamad nako ioptimize to fuck this
    setTimeout(() => {
      insertContentEl = document.querySelector(".__insert-content");
      packageIdInput = document.querySelector(".__package-id");
      load();
    }, 1000);

    async function load() {
      let response = await fetch("api/packages.php", {
        method: "GET"
      });

      if (response.ok) {
        data = await response.json();
      } else {
        console.error(response.statusText);
      }
    }

    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var htmlContent = this.responseText;
        insertContentEl.innerHTML = htmlContent;
      }
    };

    document.querySelector(".capacity").oninput = (e) => {
      const inp = parseInt(e.target.value);
      const x = (data.filter((v, i) => parseInt(v["max_capacity"]) >= inp && parseInt(v["min_capacity"]) <= inp))[0];
      packageIdInput.value = x["package_id"];
      console.log(x["package_id"]);
      saveToCookie({
        "package_id": x["package_id"]
      })
      xhttp.open("GET", `components/reservation/package_card.php?package_name=${x["package_name"]}&package_desc=${encodeURIComponent(x["description"])}&weekday_price=${x["price_weekday"]}&&weekend_price=${x["price_weekend"]}`, true)
      xhttp.send();
    }
  </script>
</section>

<?php
