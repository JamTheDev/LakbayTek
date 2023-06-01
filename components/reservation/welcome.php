<style>
    section.welcome_title {
        height: 100%;
        background-color: #FDF8E5;
        position: relative;
        text-align: center;
        flex: 1;
        line-height: 30px;
    }

    section.welcome_title {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    section.welcome_title>.divwelcome>span:nth-child(1) {
        font-family: "Metropolis Black";
        font-size: 80px;
    }

    section.welcome_title>.divstart>span:nth-child(1) {

        font-family: "Metropolis";
        font-size: 25px;
        letter-spacing: 3px;


    }

    .butt {
        border: none;
        color: #000;
        background-color: #EEC945;
        padding: 10px 30px;
        text-align: center;
        font-family: "Metropolis";
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 20px auto;
        cursor: pointer;
        box-shadow: 0px 2px 5px #888888;
    }

    .butt:hover {
        border: none;
        color: #000;
        background-color: #7EBB74;
        padding: 10px 30px;
        text-align: center;
        font-family: "Metropolis";
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 20px auto;
        cursor: pointer;
        box-shadow: 0px 5px 10px #888888;
    }
</style>


<section class="welcome_title">
    <div class="divwelcome">
        <span>WELCOME!</span>
    </div>
    <div class="divstart">
        <span>LET US HELP YOU GET STARTED!</span>
    </div>

    <input class="butt" type="submit" value="GET STARTED">
    <input type="text" name="current_page" value="capacity" hidden>
</section>


