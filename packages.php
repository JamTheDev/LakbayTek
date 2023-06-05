<?php
$title = "Packages";
?>
<!DOCTYPE html>
<html lang="en">
<?php require("config.php") ?>

<body>

    <?php require("components/navbar.php") ?>

    <style>
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
            /* Adjust the width as per your design */
            height: 50vh;
            background-color: lightgray;
            margin-right: 10px;
            margin-bottom: 10px;

            display: flex;
            padding: 10px;
            flex-direction: column;
        }

        .card>* {
            width: 100%;
            flex: 1;

            display: flex;
        }

        .card>.__top {
            justify-content: center;
            align-items: end;
        }

        .card>.__bottom {

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
    </style>

    <main>
        <div id="cardContainer"></div>

    </main>

    <script>
        var container = document.getElementById("cardContainer");
        var currentRow;
        var cardsCreated = false;
        var insertContentEl = document.querySelector(".__insert-content");

        (async () => {
            let data = await load();

            createCardElements(data)

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

            cardData.forEach(function(card) {
                if (!currentRow || currentRow.childElementCount === cardsPerRow) {
                    currentRow = document.createElement("div");
                    currentRow.classList.add("row");
                    container.appendChild(currentRow);
                }

                var cardElement = document.createElement("div");
                var topElement = document.createElement("div");
                var bottomElement = document.createElement("div");

                var s1 = document.createElement("span");
                var s2 = document.createElement("span");

                s2.style.textAlign = "center";

                topElement.classList.add("__top");
                bottomElement.classList.add("__bottom");

                cardElement.appendChild(topElement);
                cardElement.appendChild(bottomElement);

                cardElement.classList.add("card");

                s1.textContent = card["package_name"];
                s2.textContent = card["description"];

                topElement.appendChild(s1)
                bottomElement.appendChild(s2)

                currentRow.appendChild(cardElement);
            });

            cardsCreated = true;
        }

        createCardElements();
    </script>
</body>

</html>