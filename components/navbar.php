<?php
?>
<style>
    @import url("styles/navbar.css");
</style>

<nav class="_navbar">
    <div class="left">
        <div class="logos">
            <img src="assets/logos/cq_logo.png" alt="QC Logo" class="logo">
            <span>Casa Querencia</span>
        </div>
    </div>

    <div class="right">
        <div class="buttons">
            <a href="index.php">HOME</a>
            <a href="">PACKAGES</a>
            <a href="gallery.php">GALLERY</a>
            <a href="about-us.php">ABOUT</a>
            <a href="#" class="dropdown-toggle">
                <i class="fa-solid fa-circle-user"></i>
            </a>
            <div class="dropdown-content">
                <a href="#" class="">
                    <a href="#" class="">
                        <?php if (autologin()) : ?>
                            <a href="profile.php">View Profile</a>
                            <a href="reservation.php">Reservations</a>
                            <a href="logout.php">Sign out</a>
                        <?php else : ?>
                            <a href="#" class="" />
                            <a href="#" class="" />

                            <a href="login.php">Log In</a>
                        <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        const dropdownToggle = document.querySelector('.dropdown-toggle');
        const dropdownContent = document.querySelector('.dropdown-content');

        dropdownToggle.addEventListener('mouseover', function() {
            dropdownContent.style.display = 'block';
        });

        dropdownContent.addEventListener('mouseover', function() {
            dropdownContent.style.display = 'block';
        });

        dropdownContent.addEventListener('mouseout', function() {
            dropdownContent.style.display = 'none';
        });

        dropdownToggle.addEventListener('mouseout', function() {
            dropdownContent.style.display = 'none';
        });
    </script>
</nav>