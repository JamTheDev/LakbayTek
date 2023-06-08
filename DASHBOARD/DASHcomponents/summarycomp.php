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
            max-height: 320px;
            overflow-y: auto;
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

        span,
        .details-link,
        reservation-chart {
            font-family: metropolis;
        }
    </style>
</head>

<body>
    <?php

    $query = "SELECT * FROM Users";
    $result = mysqli_query($conn, $query);

    $totalRegisteredUsers = mysqli_num_rows($result);

    // Retrieve account details for the modal
    $accountDetails = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $accountDetails[] = $row;
    }

    mysqli_close($conn);
    ?>

    <div class="dashboard-container">
        <div class="dashboard-box">
            <h2 class="dashboard-title">Total Registered Users</h2><br>
            <span>Total: <?php echo $totalRegisteredUsers; ?></span>
        </div>

        <div class="dashboard-box">
            <h2 class="dashboard-title">Total Earnings</h2><br>
            <span class="total-earnings">Php: <!-- Add the total earnings dynamically --></span>
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
                <?php
                if (count($accountDetails) > 0) {
                    echo "<table class='account-list'>";
                    echo "<tbody>";

                    foreach ($accountDetails as $account) {
                        echo "<tr class='account-list-item'>";
                        echo "<td><span>" . $account['username'] . "</span> <a class='details-link' href='#'>See Details</a></td>";
                        echo "</tr>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "No accounts found.";
                }
                ?>
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
            <div class="account-details">
                <span>Username: <span id="accountUsername"></span></span><br>
                <span>Email: <span id="accountEmail"></span></span><br>
                <span>Birthdate: <span id="accountBirthdate"></span></span><br>
                <span>User ID: <span id="accountUserID"></span></span><br>
            </div>
        </div>
    </div>

    <script>
        const accountListItems = document.querySelectorAll('.account-list-item');
        const accountModal = document.getElementById('accountModal');

        accountListItems.forEach(item => {
            const detailsLink = item.querySelector('.details-link');
            detailsLink.addEventListener('click', (event) => {
                event.preventDefault();
                const accountName = item.querySelector('span').textContent;
                showAccountModal(accountName);
            });
        });

        // Show account details modal
        function showAccountModal(accountName) {
            const accountDetails = <?php echo json_encode($accountDetails); ?>;

            // Find the account with the matching username
            const account = accountDetails.find(acc => acc.username === accountName);

            // Populate account details in the modal
            const accountUsername = document.getElementById('accountUsername');
            const accountEmail = document.getElementById('accountEmail');
            const accountBirthdate = document.getElementById('accountBirthdate');
            const accountUserID = document.getElementById('accountUserID');

            if (account) {
                accountUsername.textContent = account.username;
                accountEmail.textContent = account.email;
                accountBirthdate.textContent = account.birthdate;
                accountUserID.textContent = account.user_id;
            } else {
                accountUsername.textContent = "N/A";
                accountEmail.textContent = "N/A";
                accountBirthdate.textContent = "N/A";
                accountUserID.textContent = "N/A";
            }

            // Show the modal
            accountModal.style.display = 'block';
        }

        // Close the modal when the close button is clicked
        const closeButton = document.querySelector('.close');
        closeButton.addEventListener('click', () => {
            accountModal.style.display = 'none';
        });

        fetch("./api/total_reservation_sum.php").then((result) => result.json()).then((resultTalaga) => document.querySelector(".total-earnings").textContent = `PHP ${resultTalaga["total_price"]}`)

        const ctx = document.getElementById('reservation-chart').getContext('2d');

        // Make a fetch request to fetch the reservation count data from reservation_count.php
        fetch('./api/reservation_count.php')
            .then(response => response.json())
            .then(reservationCounts => {
                const reservationsData = {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Reservations per Month',
                        data: [...reservationCounts],
                        backgroundColor: 'rgba(0, 123, 255, 0.5)',
                        borderColor: 'rgba(0, 123, 255, 1)',
                        borderWidth: 1
                    }]
                };
                const reservationsConfig = {
                    type: 'line',
                    data: reservationsData,
                    options: {}
                };
                new Chart(ctx, reservationsConfig);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    </script>
</body>

</html>