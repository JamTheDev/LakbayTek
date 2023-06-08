<?php

$res = $conn->query("select * from Packages where package_id = '{$_SESSION['package_id']}'");
$d = $res->fetch_assoc();
$reservation_id = genid(9);
?>
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
        flex: 1;
        line-height: 30px;
        margin: 30px 0;
        padding: 50px 40px 20px 40px;
        border-radius: 10px;
        background-color: #ffffffff;
    }

    .summary-body {
        width: 100%;
    }

    .summary-body>.__fields>.__field-name {
        font-family: "Metropolis Black";
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

    button {
        margin-top: 10px;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
    }

    .__back {
        background-color: red;
    }

    .__pay-later,
    .__pay-now {
        background-color: #7EBB74;
    }
</style>
<section class="date-bg">
    <div class="date-card">
        <div class="cap">
            <span>SUMMARY</span> <br>
            <p>Summary of the placed reservation </p>
        </div>

        <div class="summary-body">
            <h2>Details</h2>
            <div class="__fields">
                <span class="__field-name">Reservation ID:</span>
                <span class="__field-value"><?php echo $reservation_id; ?></span>
            </div>

            <div class="__fields">
                <span class="__field-name">Pax (Capacity):</span>
                <span class="__field-value"><?php echo $d["package_name"]; ?></span>
            </div>

            <div class="__fields">
                <span class="__field-name">Check in:</span>
                <span class="__field-value"><?php echo $_SESSION["check_in_date"] ?></span>
            </div>

            <div class="__fields">
                <span class="__field-name">Check out:</span>
                <span class="__field-value"><?php echo $_SESSION["check_out_date"] ?></span>
            </div>
            <h2>Pricing & Payment</h2>
            <div class="__fields">
                <span class="__field-name">Payment Status:</span>
                <span class="__field-value"> UNPAID </span>
                <!-- <br>
                <i class="fa-solid fa-warning"></i>
                &nbsp;
                <span style="font-size: 12px; font-style:italic;">In order for your application to be approved, you must pay the current fee first.</span> -->
            </div>

            <div class="__fields">
                <span class="__field-name">Payment Amount:</span>
                <span class="__field-value"> PHP <?php
                                                    $ts = strtotime($_SESSION["check_in_date"]);
                                                    $dayOfWeek = date('N', $ts);
                                                    $d1 = new DateTime($_SESSION["check_in_date"]);
                                                    $d2 = new DateTime($_SESSION["check_out_date"]);
                                                    $interval = $d1->diff($d2);
                                                    $isWeekend = ($dayOfWeek == 6 || $dayOfWeek == 7);


                                                    echo (($isWeekend ? $d["price_weekend"] : $d["price_weekend"]) * ($interval->days + 1))  / 2;
                                                    ?> (50% OFF, pay other 50% ON-SITE) </span>
            </div>
        </div>


        <div class="__button-row">
            <button type="button" class="__back" onclick="changePage('date')">Back</button>
            <button type="button" class="__pay-later" onclick="insertIntoDb()">Pay later</button>
            <button type="button" class="__pay-now" onclick="insertIntoDbThenPayment()">Pay Now</button>
        </div>

        <script>
            async function insertIntoDbThenPayment() {
                try {
                    const response = await fetch("./api/insert_reservation.php", {
                        method: "POST",
                        body: JSON.stringify({
                            "reservation_id": "<?php echo $reservation_id ?>",
                            "package_id": "<?php echo $_SESSION['package_id']; ?>",
                            "user_id": "<?php echo getUserBySession()->user_id; ?>",
                            "check_in_date": "<?php echo $_SESSION["check_in_date"]; ?>",
                            "check_out_date": "<?php echo $_SESSION["check_out_date"]; ?>",
                            "payment_status": "UNPAID",
                        })
                    })

                    if (response.status == 200) {
                        Swal.fire("Reservation placed!", "Proceeding to payment page", "success").then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "paying_page.php?reservation=<?php echo $reservation_id ?>";
                            }
                        })
                    }
                } catch (e) {
                    console.error(e);
                }
            }

            async function insertIntoDb() {
                try {
                    const response = await fetch("./api/insert_reservation.php", {
                        method: "POST",
                        body: JSON.stringify({
                            "reservation_id": "<?php echo $reservation_id ?>",
                            "package_id": "<?php echo $_SESSION['package_id']; ?>",
                            "user_id": "<?php echo getUserBySession()->user_id; ?>",
                            "check_in_date": "<?php echo $_SESSION["check_in_date"]; ?>",
                            "check_out_date": "<?php echo $_SESSION["check_out_date"]; ?>",
                            "payment_status": "UNPAID",
                        })
                    })

                    if (response.status == 200) {
                        Swal.fire("Reservation placed!", "Go back to main menu", "success").then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "index.php";
                            }
                        })
                    }
                } catch (e) {
                    console.error(e);
                }
            }
        </script>
    </div>


</section>