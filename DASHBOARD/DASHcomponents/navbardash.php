<style>
    @import url("styles/navbar.css");

	.text {
		font-family: metropolis black;
	}
	*{
		position: fixed;
		
	}
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
            <a href="DashSummaryPage.php">ADMIN</a>
            <a href="#" class="dropdown-toggle">
                <i class="fa-solid fa-circle-user"></i>
            </a>
            <div class="dropdown-content">
                <a href="#" class="">
                        <?php if (verifyRememberMeToken()) : ?>
                            <a href="profile.php">Sign Out</a>
                        <?php else : ?>
                            <a href="adminlogin.php">Log In</a>
                        <?php endif; ?>
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

        // Add hover effect to each dropdown item
        const dropdownItems = dropdownContent.getElementsByTagName('a');
        for (let i = 0; i < dropdownItems.length; i++) {
            dropdownItems[i].addEventListener('mouseover', function() {
                this.style.backgroundColor = 'rgba(0, 0, 0, 0.1)';
            });

            dropdownItems[i].addEventListener('mouseout', function() {
                this.style.backgroundColor = 'transparent';
            });
        }
    </script>
	
	
</nav>
