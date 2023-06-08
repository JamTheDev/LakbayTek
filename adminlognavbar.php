<?php
?>
<style>
    @import url("styles/navbar.css");
</style>

<nav class="_navbar">
    <div class="left">
        <div class="logos" onclick="window.location.href = 'adminindex.php'">
            <img src="assets/logos/cq_logo.png" alt="QC Logo" class="logo">
            <span>Casa Querencia</span>
        </div>
    </div>

    <div class="right">
        <div class="buttons">
        <span class="text"> ADMIN </span>
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