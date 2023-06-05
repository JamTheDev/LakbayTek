<?php
$package_name = filter_input(INPUT_GET, 'package_name');
$package_desc = filter_input(INPUT_GET, 'package_desc');
$weekday_price = filter_input(INPUT_GET, 'weekday_price');
$weekend_price = filter_input(INPUT_GET, 'weekend_price');
?>

<style>
    .__card {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .__card>.card-title {
        font-size: 2vw;
        font-family: "Metropolis Black";
        width: 100%;
        text-align: center;
    }

    .__card>.card-subtitle {
        text-align: justify;
        max-width: 100%;
    }

    .__prices {
        display: flex;
        flex-direction: row;
        height: 20vh;
    }

    .__prices>div {
        flex: 1;
        height: 100%;

        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .__prices>div>span:nth-child(1) {
        font-size: 1.5vw;
        font-family: "Metropolis";
    }

    .__prices>div>span:nth-child(2) {
        font-size: 2.2vw;
        font-family: "Metropolis Black";
    }
</style>

<div class="__card">
    <span class="card-title"><?= $package_name ?></span>
    <p class="card-subtitle"><?= $package_desc ?></p>

    <div class="__prices">
        <div>
            <span>Weekday</span>
            <span>PHP <?= $weekday_price ?></span>
        </div>
        <div>
            <span>Weekend</span>
            <span>PHP <?= $weekend_price ?></span>
        </div>
    </div>
</div>