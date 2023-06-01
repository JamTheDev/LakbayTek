<style>
    @import url("styles/navbar.css");
	
	.admin-text {
		
		font-family: metropolis black;
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
        <span class="admin-text">Admin | DASHBOARD</span>
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