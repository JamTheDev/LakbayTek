<style>
    div.__card-points {
        display: flex;
        flex-direction: row;
        max-width: 100%;
        padding: 0 1vw 100px 1vw;
    }

    div.__card-container {
        flex: 1;
        margin: 10px;
    }

    div.__card {
        background-color: #e5e5e5;
        aspect-ratio: 13/16;
        border-radius: 5px;

        padding: 10px;

        display: flex;
        flex-direction: column;
    }


    div.__card>.__top {
        flex: 2;
        display: flex;
        flex-direction: column;
        justify-content: end;
        align-items: center;
    }

    div.__card>.__top>i {
        font-size: 10vw;
        padding: 50px;
    }

    div.__card>.__bottom {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 50px 0 50px;
    }

    div.__card>.__bottom>.__content {
        font-size: 1vw;
        text-align: center;
        line-height: 150%;
    }

    div.__card>.__top>.__title {
        font-family: "Metropolis Black";
        text-align: center;
        font-size: 1.5vw;
    }

    @media only screen and (max-width: 1000px) {
        div.__card-points {
            margin: 0 15% 100px 15%;
            flex-direction: column;
        }

        div.__card>.__bottom>.__content {
            font-size: 2vw;
            text-align: center;
        }

        div.__card>.__top>.__title {
            font-family: "Metropolis Black";
            font-size: 3.5vw;
        }
    }

    @media only screen and (max-width: 700px) {
        div.__card-points {
            margin: 0 15% 100px 15%;
            height: 1200px;
        }

        div.__card>.__bottom>.__content {
            font-size: 2vw;
            text-align: center;
        }

        div.__card>.__top>.__title {
            font-family: "Metropolis Black";
            font-size: 4vw;
        }

        div.__card>.__top>i {
            font-size: 20vw;
            padding: 50px;
        }
    }
</style>

<div class="__card-points">
    <div class="__card-container">
        <div class="__card">

            <div class="__top">
                <i class="fa-solid fa-bell-concierge"></i>
                <span class="__title">EXCEPTIONAL SERVICES</span>

            </div>
            <div class="__bottom">
                <span class="__content">
                    Casa Querencia aims to provide a relaxing haven, impeccable accommodations, and exceptional service, ensuring an extraordinary and unforgettable experience for our esteemed guests.
                </span>
            </div>
        </div>
    </div>
    <div class="__card-container">
        <div class="__card">
            <div class="__top">
                <i class="fa-solid fa-peso-sign"></i>
                <span class="__title">LONG-TERM INVESTMENT</span>

            </div>
            <div class="__bottom">
                <span class="__content">
                    Casa Querencia was established based on the owners' vision of a reliable source of passive income and a secure long-term investment, recognizing the potential of the land.
                </span>

            </div>
        </div>
    </div>
    <div class="__card-container">
        <div class="__card">
            <div class="__top">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
                <span class="__title">CAPTIVATING DESIGN</span>
            </div>
            <div class="__bottom">
                <span class="__content">
                    Casa Querencia's design features a spacious and inviting environment with an unenclosed layout, a large function hall for events, and a beautifully adorned resort that creates a harmonious blend of colors, captivating valued guests and adding to its overall appeal.
                </span>
            </div>
        </div>
    </div>
</div>