<style>
    main {
        display: grid;
        place-items: center;
        height: 98svh;
    }

    div.__background-card {
        height: fit-content;
        background-color: white;
        z-index: 1;
        border-radius: 10px;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    div.__background-card>img.__logo {
        width: 40%;
        height: 35%;
    }

    div.__background-card>.__title-text {
        font-family: "Metropolis Black";
        font-size: 3em;
    }

    div.__background-card>form {
        width: 90%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .__custom-input {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 90%;
        border: solid 2px black;
        border-radius: 5px;
        margin: 10px 0 10px 0;
    }

    .__custom-input>* {
        padding: 10px;
    }

    .__custom-input>input {
        width: 100%;
        border: 0px;
        outline: none;
    }

    div.__background-card>form>.__login-btn {
        background-color: var(--theme-yellow);
        border: 0;
        width: 30%;
        border-radius: 5px;
        font-family: "Metropolis Black";
        font-size: 1.3rem;
        padding: 15px 30px 15px 30px;
        cursor: pointer;
        margin: 10px;
    }

    div.__background-card>form>.__tos-remember-me {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: start;
        width: 90%;
        padding: 10px;
    }

    div.__background-card>form>.__tos-remember-me>* {
        padding: 5px;
    }

    div.__background-card>form>.__tos-remember-me>span {
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
</style>

<main>
    <div class="__background-card">
        <img src="assets/logos/cq_logo.png" alt="" class="__logo">
        <span class="__title-text">LOGIN</span>

        <form action="api/login.php" method="post">
            <div class="__custom-input">
                <i class="fa-solid fa-user"></i>
                <input type="email" name="__user-email" placeholder="USER EMAIL">
            </div>
            <div class="__custom-input">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="__user-password" placeholder="USER PASSWORD">
            </div>
            <div class="__tos-remember-me">
                <input type="checkbox" name="__user-remember-me">
                <span> REMEMBER ME? </span>
            </div>

            <?php if (isset($_GET["err"])) : ?>
                <span class="__error-msg">
                    <i class="fa-solid fa-warning"></i>
                    <br>
                    <br>
                    <?php
                    switch (intval($_GET["err"])) {
                        case AuthenticationErrors::NoAccount->value:
                            echo "Account does not exist!";
                            break;
                        case AuthenticationErrors::WrongPassword->value:
                            echo "Wrong password! Please try again.";
                            break;
                        case AuthenticationErrors::NoSessionID->value:
                            echo "Please try logging in again.";
                            break;
                        case AuthenticationErrors::PasswordsNotMatching->value:
                            echo "Passwords do not match!";
                            break;
                        default:
                            echo "Unknown Error, please try again!";
                            break;
                    }
                    ?>
                </span>
            <?php endif; ?>

            <input type="submit" value="LOGIN" class="__login-btn">

            <span style="padding: 20px; font-size: 12px;">DON'T HAVE AN ACCOUNT? <a href="register.php">REGISTER!</a></span>
        </form>
    </div>
</main>