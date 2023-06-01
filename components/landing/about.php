<style>
    section.__about {
        height: 700px;
        width: 100%;
        background-color: #C0CEFF;

        display: flex;
        flex-direction: row;

    }

    section.__about>* {
        flex: 1;
    }

    section.__about>.left-img {
        background-image: url("assets/media/cq_about.jpg");
        background-position: center;
        background-repeat: no-repeat;
        object-fit: contain;
    }

    section.__about>.text-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 50px;
    }

    section.__about>.text-content>* {
        padding: 20px 0 20px 0;
    }

    section.__about>.text-content>.title {
        font-family: "Metropolis Black";
        font-size: 2rem;
    }

    section.__about>.text-content>.subtitle {
        font-family: "Metropolis";
        font-size: 1.8vw;
        line-height: 1.5;
    }

    section.__about>.text-content>button {
        font-family: "Metropolis Black";
        font-size: 100%;
        border: 0;
        border-radius: 5px;
        padding: 15px 30px 15px 30px;
        width: fit-content;
        align-self: end;
        background-color: #325FFF;
        color: white;
        box-shadow: 0 5px 7px black;

    }

    @media only screen and (max-width: 700px) {
        section.__about {
            height: 1000px;
            display: flex;
            flex-direction: column;
        }

        section.__about>.text-content>.subtitle {
            font-family: "Metropolis";
            font-size: 100%;
            line-height: 1.5;
        }

        section.__about>.left-img {
            background-image: linear-gradient(to bottom, #fff 10px, transparent, #C0CEFF 90%), url("assets/media/cq_about.jpg");
            background-position: center;
            background-repeat: no-repeat;
            object-fit: contain;
        }

        section.__about>.text-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px;
        }
    }
</style>

<section class="__about">
    <div class="left-img">
        &nbsp;
    </div>
    <div class="text-content">
        <span class="title">ABOUT CASA QUERENCIA</span>
        <div class="subtitle">Casa Querencia is a private hot spring resort in Pansol, Calamba, Laguna. Established in October 2020, Mr. and Mrs. Cruz decided on investing in a life-long income which is a private resort.
            <br><br>
            The business owners own many businesses such as beach resort, hotspring resort, and café. One of these businesses is the Casa Querencia private resort where they accommodate guests by providingcomfortable rooms and amenities as well as a pleasing destination spot.
        </div>

        <button>LEARN MORE</button>
    </div>
</section>