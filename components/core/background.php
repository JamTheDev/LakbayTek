<style>
    div.__background {
        position: absolute;
        width: 100%;
        height: 100vh;
        z-index: -1;
        background-image: url(<?php echo $bg_url; ?>);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        object-fit: contain;
        filter: brightness(40%);
    }
</style>

<div class="__background"></div>