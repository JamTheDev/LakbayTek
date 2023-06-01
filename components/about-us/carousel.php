<style>
    div.__carousel {
        width: 100%;
        height: 100vh;
        z-index: -1;
        background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)), url(<?php echo $bg_url; ?>);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        object-fit: contain;
        color: white;
    }

    div.__carousel>.__center-text {
        position: absolute;
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
    }

    div.__carousel>.__center-text>span:nth-child(1) {
        font-size: 3vw;
        font-family: "Metropolis Black";
    }

    div.__carousel>.__center-text>span:nth-child(2) {
        font-size: 4vw;
        font-family: "Metropolis Black";
        letter-spacing: 2vw;
    }

    div.__carousel>.__center-text>span:nth-child(3) {
        font-size: 1.5vw;
        font-family: "Metropolis";
        letter-spacing: .40vw;
    }

    div.__carousel>.bottom-sheet {
        position: absolute;
        top: 90%;
        right: 50%;
        transform: translate(50%, -50%);
    }
    div.__carousel>.bottom-sheet>.scroll-down>*{
        padding: 10px;
    }

    div.__carousel>.bottom-sheet>.scroll-down {
        display: flex;
        flex-direction:column;
        align-items: center;
    }

    /* div.__carousel>.bottom-sheet>.scroll-down>i.fa-chevron-down {
        animation-name: _bounce;
        animation-duration: 0.5s;
        animation-direction: alternate;
        animation-iteration-count: infinite;
    }

    @keyframes _bounce {
        from {
            margin-top: -10px;
        }

        to {
            margin-top: 10px;
        }
    }  */
</style>

<div class="__carousel">
    <div class="__center-text">
        <span>ABOUT</span>
        <span>CASA QUERENCIA</span>
        <span>Learn about the history and backstory of CASA QUERENCIA</span>
    </div>

    <!-- <div class="bottom-sheet">
        <div class="scroll-down">
            <i class="fa-solid fa-chevron-down"></i>
            <span>SCROLL DOWN</span>
        </div>
    </div> -->
</div>