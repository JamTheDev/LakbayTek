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
    color: #000;
  }
</style>

<div class="summary-container">
  <div class="summary-section">
    <h2>History of Reservations</h2><br>
    <table>
      <thead>
        <tr class="columns">
          <th>User Name</th>
          <th>Package</th>
          <th>Date of Check-In</th>
          <th>Date of Check-Out</th>
          <th>Reservation Status</th>
          <th>Payment Status</th>
          <th>Feedback</th>
        </tr>
      </thead>
      <tbody id="reservationSummary">
        <?php foreach (fetch_all_accepted_reservations($user->user_id) as $r) : ?>
          <tr>
            <td> <?= $user->username ?> </td>
            <td> <?= $r["package_id"] ?> </td>
            <td> <?= $r["check_in_date"] ?> </td>
            <td> <?= $r["check_out_date"] ?> </td>
            <td> <?= $r["reservation_status"] ?> </td>
            <td> <?= $r["payment_status"] ?> </td>
            <td> NONE </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<section class="home-section">
  <br><br><br><br><br><br>
  <?php require("reservationlist.php") ?>
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