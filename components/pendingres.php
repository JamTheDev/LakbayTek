<html>
    <style>
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
</style>

<div class="summary-container">
    <div class="summary-section">
      <h2>Pending Reservations</h2><br>
      <table>
        <thead>
          <tr class="columns">
            <th>User Name</th>
            <th>Reserved Date</th>
            <th>Time of Check-In</th>
            <th>Time of Check-Out</th>
            <th>Reservation Status</th>
            <th>Feedback</th>
          </tr>
        </thead>
        <tbody id="reservationSummary"></tbody>
      </table>
    </div>
  </div>

  <section class="home-section">
    <br><br><br><br><br><br>
    <?php require("historyofres.php") ?>
  </section>
  <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");
    closeBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange();
    });
    searchBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange();
    });
    function menuBtnChange() {
      if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
    }
  </script>
</body>
</html>