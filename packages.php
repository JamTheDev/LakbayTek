<!DOCTYPE html>
<html lang="en">
<?php require("config.php") ?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <style>
    body {
      background: #FDF8E5;
    }

    main {
      padding: 30px 50px;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      margin-bottom: 10px;
    }

    .card {
      width: calc(23% - 10px);
      height: 50vh;
      background-color: #EEC945;
      margin-right: 10px;
      margin-bottom: 5px; /* Decreased margin-bottom */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.3s, transform 0.3s;
      display: flex;
      padding: 10px;
      flex-direction: column;
      border-radius: 6px;
      overflow: hidden;
    }

    .card:hover {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transform: translateY(-5px);
	  background-color: #B2BEB5;
    }

    .card .__top {
      display: flex;
      align-items: center;
      flex-direction: column;
      flex: 1;
      margin: 30px;
    }

    .card .__bottom {
      display: flex;
      align-items: center;
      flex-direction: column;
      flex: 1;
      text-align: center;
    }

    @media screen and (max-width: 700px) {
      .card {
        width: calc(50% - 10px);
        height: 40vh;
      }
    }

    .cardContainer {
      width: 100%;
    }

    .card .package-title {
      font-size: 30px;
      font-weight: bold;
      font-family: "Metropolis Black", sans-serif;
    }

    .card span {
      font-size: 20px;
      font-family: "Metropolis", sans-serif;
    }

    /* See Details Button Styling */
    .button {
      background-color: #45a049;
      margin: 30px;
      color: white; /* White text color */
      border: none; /* No border */
      padding: 10px 20px; /* Add some padding */
      text-align: center; /* Center the text */
      text-decoration: none; /* Remove underline */
      display: inline-block; /* Make it inline */
      font-size: 16px; /* Set font size */
      border-radius: 4px; /* Add border radius */
      transition: background-color 0.3s; /* Add transition effect */
    }

    .button:hover {
      background-color: #7EBB74; /* Darker green background on hover */
    }

    /* Modal Styling */
    .modal {
      display: none; /* Hide the modal by default */
      position: fixed; /* Fixed position */
      z-index: 1; /* Set a high z-index */
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto; /* Enable scrolling */
      background-color: rgba(0, 0, 0, 0.4); /* Black overlay */
    }

    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 60%;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <?php require("components/navbar.php") ?>

  <main>
    <div id="cardContainer"></div>
  </main>

  <!-- Modal -->
  <div id="modalContainer" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2 id="modalTitle"></h2>
      <p id="modalDescription"></p>
    </div>
  </div>

  <script>
    var container = document.getElementById("cardContainer");
    var currentRow;
    var cardsCreated = false;
    var insertContentEl = document.querySelector(".__insert-content");

    (async () => {
      let data = await load();

      createCardElements(data);

      // Re-calculate and update card layout on window resize
      window.addEventListener("resize", function() {
        var screenWidth = window.innerWidth || document.documentElement.clientWidth;
        var cardsPerRow = calculateCardsPerRow();

        if ((screenWidth >= 700 && cardsPerRow === 4) || (screenWidth < 700 && cardsPerRow === 2)) {
          return; // No change in card layout, no need to recreate
        }

        container.innerHTML = "";
        currentRow = null;
        cardsCreated = false;
        createCardElements();
      });
    })();

    async function load() {
      let response = await fetch("api/packages.php", {
        method: "GET"
      });

      if (response.ok) {
        return (await response.json());
      } else {
        console.error(response.statusText);
      }
    }

    function calculateCardsPerRow() {
      var screenWidth = window.innerWidth || document.documentElement.clientWidth;
      return screenWidth >= 700 ? 4 : 2;
    }

    function createCardElements(cardData) {
      if (cardsCreated) {
        return; // Cards already created, no need to recreate
      }

      var cardsPerRow = calculateCardsPerRow();
      var packagesTop = cardData.slice(0, 3);
      var packagesBottom = cardData.slice(3, 5);

      var createCards = function(packages, rowClass) {
        var row = document.createElement("div");
        row.classList.add("row");
        if (rowClass) {
          row.classList.add(rowClass);
        }

        packages.forEach(function(card) {
          var cardElement = document.createElement("div");
          var topElement = document.createElement("div");
          var bottomElement = document.createElement("div");

          var s1 = document.createElement("span");
          var s2 = document.createElement("span");
          var button = document.createElement("button");

          topElement.classList.add("__top");
          bottomElement.classList.add("__bottom");

          cardElement.appendChild(topElement);
          cardElement.appendChild(bottomElement);

          cardElement.classList.add("card");

          s1.textContent = card["package_name"];
          s1.classList.add("package-title");
          s2.textContent = card["description"];

          // Add "See Details" button
          button.textContent = "See Details";
          button.classList.add("button"); // Add button class
          button.addEventListener("click", function() {
            openModal(card["package_name"], card["description"]);
          });

          topElement.appendChild(s1);
          topElement.appendChild(button);
          bottomElement.appendChild(s2);

          row.appendChild(cardElement);
        });

        container.appendChild(row);
      };

      createCards(packagesTop, "__top-row");
      createCards(packagesBottom, "__bottom-row");

      cardsCreated = true;
    }

    // Open the modal with package details
    function openModal(title, description) {
      var modal = document.getElementById("modalContainer");
      var modalTitle = document.getElementById("modalTitle");
      var modalDescription = document.getElementById("modalDescription");

      modalTitle.textContent = title;
      modalDescription.textContent = description;

      modal.style.display = "block";
    }

    // Close the modal when the user clicks the close button
    document.getElementsByClassName("close")[0].addEventListener("click", function() {
      var modal = document.getElementById("modalContainer");
      modal.style.display = "none";
    });
  </script>
</body>

</html>
