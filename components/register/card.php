<style>
    main {
        height: 100svh;
        display: grid;
        place-items: center;
    }

    div.__background-card {
        height: fit-content;
        width: 35%;
        background-color: white;
        z-index: 1;
        border-radius: 10px;
        padding: 1.5%;


        display: flex;
        flex-direction: column;
        align-items: center;
    }

    div.__background-card>.__card-header {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 10px;
    }

    div.__background-card>.__card-header>* {
        display: flex;
        flex-direction: row;
        flex: 1;
    }

    div.__background-card>.__card-header>.right {
        align-items: center;
        justify-content: center;
    }

    div.__background-card>.__card-header>.left>img.__logo {
        width: 50%;
        height: 100%;
    }

    div.__background-card>.__card-header>.right>.__title-text {
        font-family: "Metropolis Black";
        font-size: 200%;
        width: 100%;
        text-align: end;
    }

    div.__background-card>form {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 90%;
    }

    .__custom-input {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        border: solid 2px black;
        border-radius: 5px;
        margin: 10px 0 10px 0;
    }

    .__custom-input>* {
        padding: 10px;
    }

    .__custom-input>input,
    .__custom-input>select {
        width: 100%;
        border: 0px;
        outline: none;
        background-color: transparent;
    }

    div.__background-card>form>.__login-btn {
        background-color: var(--theme-yellow);
        border: 0;
        width: 70%;
        border-radius: 5px;
        font-family: "Metropolis Black";
        font-size: 1.3rem;
        padding: 2% 5% 2% 5%;
        cursor: pointer;
        margin: 1%;
    }

    div.__background-card>form>.__row {
        display: flex;
        flex-direction: row;
        width: 100%;
    }


    div.__background-card>form>.__row>div {
        flex: 1;
        padding: 0 10px 0 10px;
    }

    div.__background-card>form>.__tos-checkbox {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 10px;
    }

    div.__background-card>form>.__tos-checkbox>* {
        padding: 5px;
    }

    div.__background-card>form>.__tos-checkbox>span {
        font-size: 12px;
    }

    span.__error-msg {
        text-align: center;
        font-size: 0.7vw;
        color: red;
    }

    span.__error-msg>i {
        font-size: 1vw;
    }

    @media only screen and (max-width: 900px) {
        div.__background-card {
            width: 50%;
        }
    }

    @media only screen and (max-width: 700px) {
        div.__background-card {
            width: 65%;
        }
    }
</style>

<main>
    <div class="__background-card">

        <div class="__card-header">
            <div class="left">
                <img src="assets/logos/cq_logo.png" alt="" class="__logo">
            </div>
            <div class="right">
                <span class="__title-text">REGISTER</span>
            </div>
        </div>

        <form action="backend/register.php" method="post">
            <div class="__custom-input">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="__user-email" placeholder="USER EMAIL" value="<?php echo $_GET['email']; ?>" required>
            </div>

            <div class="__custom-input">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="__user-name" placeholder="FULL NAME" value="<?php echo $_GET['username']; ?>" required>
            </div>

            <div class="__row">
                <div class="__custom-input" style="margin-right: 10px;">
                    <select name="__user-gender" id="">
                        <option value="x" selected disabled>GENDER</option>
                        <option value="Male">MALE</option>
                        <option value="Female">FEMALE</option>
                        <option value="Others">OTHERS</option>
                    </select>
                </div>

                <div class="__custom-input">
                    <input type="date" name="__user-bday" placeholder="BIRTHDATE" value="<?php echo $_GET['birthdate']; ?>" required>
                </div>
            </div>

            <div class="__custom-input">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" name="__user-address" placeholder="ADDRESS" value="<?php echo $_GET['address']; ?>" required>
            </div>


            <div class="__custom-input">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="__user-password" placeholder="PASSWORD" minlength="8" required>
            </div>

            <div class="__custom-input">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="__user-confirm-password" placeholder="CONFIRM PASSWORD" required>
            </div>

            <div class="__tos-checkbox">
                <input type="checkbox" name="__user-agree-tos" required>
                <span>I HAVE READ & AGREED TO THE <a href="terms-of-service.php?prevpage=register.php" style="color: lightblue;">TERMS AND SERVICES</a> </span>
            </div>

            <?php if (isset($_GET["err"])) : ?>
                <span class="__error-msg">
                    <i class="fa-solid fa-warning"></i>
                    <br>
                    <br>
                    <?php 
                        if ($_GET["err"] == 0) {
                            echo "Account already exists! Try <a style='color: red;' href='login.php'>logging in</a> to your account instead.";
                        }

                        if ($_GET["err"] == 1) {
                            echo "Passwords don't match. Try again!";
                        }
                    ?>
                </span>
            <?php endif; ?>

            <input type="submit" value="REGISTER" class="__login-btn">
            <span style="padding: 10px; font-size: 12px;">ALREADY HAVE AN ACCOUNT? <a href="login.php">LOGIN!</a></span>
        </form>
    </div>
</main>