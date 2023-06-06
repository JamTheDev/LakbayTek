<style>
    section.description {
        position: relative;
        height: 200%;
        display: flex;
        flex-direction: row;

    }

    section.description>div {
        position: relative;
        flex: 1;
    }

    section.description>.left {
        display: flex;
        overflow: scroll;
        flex-direction: column;
        justify-content: center;
        padding: 40px;
    }

    section.description>.left>span:nth-child(2) {
        padding: 35px;
        line-height: 180%;
        font-size: 120%;
    }

    section.description>.left>span:nth-child(1) {
        font-family: "Metropolis Black";
        font-size: 24px;
    }

    section.description>.right {
        position: relative;
        height: 100%;
        width: 100%;
        padding: 0px;
        flex-direction: column;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    section.description>.right>.__background-sheet {
        position: absolute;
        width: 80%;
        height: 95%;

        top: 50%;
        left: 50%;
    }

    section.description>.right>.__background-sheet:nth-child(1) {
        background-color: lightgreen;
        transform: translate(-50%, -50%) rotate(1deg);
    }

    section.description>.right>.__background-sheet:nth-child(2) {
        background-color: green;
        transform: translate(-50%, -50%) rotate(-1deg);
    }

    section.description>.right>.__images {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px;
        height: 100%;
    }

    section.description>.right>.__images>img {
        transition-duration: 0.3s;
        width: 50%;
        position: relative;
        aspect-ratio: 16/9;
    }

    section.description>.right>.__images>img:nth-child(1) {
        left: -8%;
        transform: rotate(-4deg);
        z-index: 1;
    }

    section.description>.right>.__images>img:nth-child(2) {
        right: -10%;
        transform: rotate(2deg) scale(1.2);
        z-index: 2;
    }

    section.description>.right>.__images>img:nth-child(3) {
        left: -8%;
        transform: rotate(-2deg) scale(1);
        z-index: 3;
    }

    section.description>.right>.__images>img:hover {
        transition-duration: 0.3s;
        transform: scale(1.5);
        z-index: 10;
    }

    @media only screen and (max-width: 700px) {
        section.description {
            position: relative;
            height: 200%;
            display: flex;
            flex-direction: column;

        }
    }
</style>

<section class="description">
    <div class="left">
        <span>ABOUT CASA QUERENCIA</span>
        <span>
            Welcome to Casa Querencia Hot Spring Resort in Pansol, Laguna, Philippines. Our hidden treasure combines luxury and serenity, offering a remarkable experience. Nestled amidst lush greenery and natural hot springs, our resort is an escape from the busy life.
            <br>
            <br>
            At Casa Querencia, we go beyond stunning surroundings. Our dedicated team ensures exceptional service from arrival to departure. Our accommodations, from cozy rooms to spacious suites, provide comfort and convenience.
            <br>
            <br>
            Relax in the healing waters of our natural hot springs and enjoy our amenities, including spa treatments, swimming pools, and diverse dining options. We aim to create a home away from home for our guests, be it a romantic getaway, family vacation, or gathering with friends.
        </span>
    </div>
    <div class="right">
        <div class="__background-sheet"></div>
        <div class="__background-sheet"></div>

        <div class="__images">
            <img src="assets/media/cq_pool1.jpg" alt="">
            <img src="assets/media/cq_pool2.jpg" alt="">
            <img src="assets/media/cq_pool3.jpg" alt="">
        </div>
    </div>
</section>