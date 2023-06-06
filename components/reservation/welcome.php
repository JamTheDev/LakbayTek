<style>
    main {
        height: 100%;
        width: 100%;
        background-color: #FDF8E5;
        position: relative;
        display: grid;
        place-items: center;
        text-align: center;
    }

    section.welcome_title {
        height: 100%;
        width: 60%;
    }

    section.welcome_title {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    div.__card-points {
        display: flex;
        flex-direction: row;
        max-width: 100%;
        height: 40%;
    }

    div.__card-container {
        flex: 1;
        margin: 10px;
    }

    div.__card {
        background-color: #e5e5e5;
        border-radius: 5px;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    div.__card>.__header-text {
        font-family: "Metropolis Black";
    }

    div.__card>i {
        font-size: 5rem;
    }

    div.__card>* {
        padding: 10px 0;
    }

</style>


<main>
    <section class="welcome_title">
        <div class="__title">
            <span>WELCOME!</span>
        </div>
        <div class="__subtitle">
            <span>This step-by-step process should help you reserve a facility at Casa Querencia!</span>
        </div>

        <div class="__card-points">
            <div class="__card-container">
                <div class="__card">
                    <span class="__header-text">
                        STEP 1
                    </span>

                    <i class="fa-solid fa-user-group"></i>

                    <span>PACKAGE SELECTION</span>
                </div>
            </div>
            <div class="__card-container">
                <div class="__card">
                    <span class="__header-text">
                        STEP 2
                    </span>

                    <i class="fa-solid fa-calendar"></i>

                    <span>DATE OF RESERVATION</span>
                </div>
            </div>
            <div class="__card-container">
                <div class="__card">
                    <span class="__header-text">
                        STEP 3
                    </span>

                    <i class="fa-solid fa-circle-check"></i>

                    <span>CONFIRMATION OF DETAILS</span>
                </div>
            </div>
        </div>

        <div class="__subtitle">
            <span>The following process should help you reserve much faster without hassle!</span>
        </div>

        <div class="navigation-buttons">
            <button type="button" onclick="changePage('home')" class="option-button">BACK</button>
            <button type="button" onclick="changePage('capacity')" class="option-button">PROCEED</button>
        </div>
    </section>
</main>