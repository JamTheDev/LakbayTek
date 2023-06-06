<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: metropolis;
    }

    .dashboard-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin: 20px;
    }

    .dashboard-box {
      padding: 20px;
      background-color: #f2f2f2;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    .dashboard-title {
      margin-top: 0;
    }

    .account-list {
      border-collapse: collapse;
      width: 100%;
    }
	
	.scroll {
	 max-height: 320px; /* Set a maximum height for the account list */
     overflow-y: auto; /* Enable vertical scroll bar */
	}

    .account-list th,
    .account-list td {
      border: 1px solid #ccc;
      padding: 10px;
    }

    .account-list th {
      background-color: #f2f2f2;
    }


    .account-list-item:hover {
      background-color: #D3D3D3;
    }

    .account-list-item .details-link {
      text-decoration: underline;
      color: blue;
      cursor: pointer;
      float: right;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
      font-family: metropolis;
    }

    .modal-content {
      background-color: #fefefe;
      margin: 20% auto;
      padding: 20px;
      width: 50%;
      height: 30%;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    span, .details-link, reservation-chart {
      font-family: metropolis;
    }
	
  </style>
</head>
<body>
  <div class="dashboard-container">
    <div class="dashboard-box">
      <h2 class="dashboard-title">Total Registered Users</h2><br>
      <span>Total: <!-- Add the total number of registered users dynamically --></span>
    </div>

    <div class="dashboard-box">
      <h2 class="dashboard-title">Total Earnings</h2><br>
      <span>Php: <!-- Add the total number of registered users dynamically --></span>
    </div>
  </div>
  <div class="dashboard-container">
    <div class="dashboard-box">
      <h2 class="dashboard-title">Notifications</h2><br>
      <span>No new notifications</span>
    </div>
  
    <div class="dashboard-box">
      <h2 class="dashboard-title">Account List</h2><br>
	  <div class="scroll">
      <table class="account-list">
        <tbody>
          <tr class="account-list-item">
            <td><span>Arrabella Jane</span> <a class="details-link" href="#">See Details</a></td>
          </tr>
          <tr class="account-list-item">
            <td><span>Jam Emmanuel</span> <a class="details-link" href="#">See Details</a></td>
          </tr>
          <tr class="account-list-item">
            <td><span>Reiner Buenas</span> <a class="details-link" href="#">See Details</a></td>
          </tr>
          <tr class="account-list-item">
            <td><span>Mary Antoinette</span> <a class="details-link" href="#">See Details</a></td>
          </tr>
          <tr class="account-list-item">
            <td><span>Gwyneth Landero</span> <a class="details-link" href="#">See Details</a></td>
          </tr>
          <tr class="account-list-item">
            <td><span>Alexander Pahayahay</span> <a class="details-link" href="#">See Details</a></td>
          </tr>
          <tr class="account-list-item">
            <td><span>Arrabella Jane</span> <a class="details-link" href="#">See Details</a></td>
          </tr>
          <tr class="account-list-item">
            <td><span>Jam Emmanuel</span> <a class="details-link" href="#">See Details</a></td>
          </tr>
          <tr class="account-list-item">
            <td><span>Reiner Buenas</span> <a class="details-link" href="#">See Details</a></td>
          </tr>
          <tr class="account-list-item">
            <td><span>Mary Antoinette</span> <a class="details-link" href="#">See Details</a></td>
          </tr>
          <tr class="account-list-item">
            <td><span>Gwyneth Landero</span> <a class="details-link" href="#">See Details</a></td>
          </tr>
          <tr class="account-list-item">
            <td><span>Alexander Pahayahay</span> <a class="details-link" href="#">See Details</a></td>
          </tr>
          <!-- Add more account list items here -->
        </tbody>
      </table>
    </div>
	</div>
  </div>

  <div class="dashboard-box" style="margin: 20px;">
    <h2 class="dashboard-title">Monthly Reservation Statistics</h2>
    <canvas id="reservation-chart"></canvas>
  </div>

  <!-- Account Details Modal -->
  <div id="accountModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2 class="dashboard-title">Account Details</h2><br>
      <div class="account-details"></div>
    </div>
  </div>

  <script>
    const accountListItems = document.querySelectorAll('.account-list-item');
    const accountModal = document.getElementById('accountModal');
    const accountDetailsContainer = document.querySelector('.account-details');

    accountListItems.forEach(item => {
      const detailsLink = item.querySelector('.details-link');
      detailsLink.addEventListener('click', (event) => {
        event.preventDefault();
        const accountName = detailsLink.previousElementSibling.textContent;
        showAccountModal(accountName);
      });
    });

    // Show account details modal
    function showAccountModal(accountName) {
      // Populate account details in the modal
      accountDetailsContainer.innerHTML = `<span>Name: ${accountName}</span>`;

      // Show the modal
      accountModal.style.display = 'block';
    }

    // Close the modal when the close button is clicked
    const closeButton = document.querySelector('.close');
    closeButton.addEventListener('click', () => {
      accountModal.style.display = 'none';
    });

    const ctx = document.getElementById('reservation-chart').getContext('2d');
    const reservationsData = {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [
        {
          label: 'Reservations per Month',
          data: [5, 10, 15, 20, 25 ,30, 4, 1, 6, 12, 10, 10],
          backgroundColor: 'rgba(0, 123, 255, 0.5)',
          borderColor: 'rgba(0, 123, 255, 1)',
          borderWidth: 1
        }
      ]
    };
    const reservationsConfig = {
      type: 'line',
      data: reservationsData,
      options: {}
    };
    new Chart(ctx, reservationsConfig);
  </script>
</body>
</html>
