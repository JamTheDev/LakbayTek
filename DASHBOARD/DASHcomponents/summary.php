<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Metropolis black', sans-serif;
      position: relative;
    }

    body {
      background: #FDF8E5; /* Set the desired background color */
    }

    .sidebar {
      position: relative;
      left: 0;
      top: 0;
      height: 100%;
      width: 78px;
      padding: 6px 14px;
      z-index: 99;
      transition: all 0.5s ease;
    }

    .sidebar.open{
      width: 250px;
    }

    .sidebar .logo-details{
      height: 60px;
      display: flex;
      align-items: center;
      position: relative;
    }

    .sidebar .logo-details .icon{
      opacity: 0;
      transition: all 0.5s ease;
    }

    .sidebar .logo-details .logo_name{
      color: #000000;
      font-size: 20px;
      font-weight: 600;
      opacity: 0;
      transition: all 0.5s ease;
    }

    .sidebar.open .logo-details .icon,
    .sidebar.open .logo-details .logo_name{
      opacity: 1;
    }

    .sidebar .logo-details #btn{
      position: absolute;
      top: 50%;
      right: 0;
      transform: translateY(-50%);
      font-size: 22px;
      transition: all 0.4s ease;
      font-size: 23px;
      text-align: center;
      cursor: pointer;
      transition: all 0.5s ease;
    }

    .sidebar.open .logo-details #btn{
      text-align: right;
    }

    .sidebar i{
      color: #000000;
      height: 60px;
      min-width: 50px;
      font-size: 28px;
      text-align: center;
      line-height: 60px;
    }

    .sidebar .nav-list{
      margin-top: 20px;
      height: 100%;
    }

    .sidebar li{
      position: relative;
      margin: 8px 0;
      list-style: none;
    }

    .sidebar li .tooltip{
      position: absolute;
      top: -20px;
      left: calc(100% + 15px);
      z-index: 3;
      background: #7EBB74;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
      padding: 6px 12px;
      border-radius: 4px;
      font-size: 15px;
      font-weight: 400;
      opacity: 0;
      white-space: nowrap;
      pointer-events: none;
      transition: 0s;
    }

    .sidebar li:hover .tooltip{
      opacity: 1;
      pointer-events: auto;
      transition: all 0.4s ease;
      top: 50%;
      transform: translateY(-50%);
    }

    .sidebar.open li .tooltip{
      display: none;
    }

    .sidebar li a{
      display: flex;
      height: 100%;
      width: 100%;
      border-radius: 12px;
      align-items: center;
      text-decoration: none;
      transition: all 0.4s ease;
      background: #EEC945;
    }

    .sidebar li a:hover{
      display: flex;
      height: 100%;
      width: 100%;
      border-radius: 12px;
      align-items: center;
      text-decoration: none;
      transition: all 0.4s ease;
      background: #013220;
    }

    .sidebar li a .links_name{
      color: black;
      font-size: 15px;
      font-weight: 400;
      white-space: nowrap;
      opacity: 0;
      pointer-events: none;
      transition: 0.4s;
    }

    .sidebar.open li a .links_name{
      opacity: 1;
      pointer-events: auto;
    }

    .sidebar li a:hover .links_name,
    .sidebar li a:hover i{
      transition: all 0.5s ease;
      color: #EEC945;
    }

    .sidebar li i{
      height: 50px;
      line-height: 50px;
      font-size: 18px;
      border-radius: 12px;
    }

    .home-section{
      position: fixed;
      background: #E4E9F7;
      height: 100%;
      top: 0;
      left: 78px;
      width: calc(100% - 78px);
      transition: all 0.5s ease;
      z-index: 2;
      overflow-y: scroll; /* Enable vertical scrolling */
    }

    .sidebar.open ~ .home-section{
      left: 250px;
      width: calc(100% - 250px);
    }

    .home-section .text{
      display: inline-block;
      color: #0000000;
      font-size: 25px;
      font-weight: 500;
      margin: 18px;
    }
	
  .nav-list li a.active {
    background: #7EBB74;
	font-color: #EEC945;
  }
</style>
</head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <div class="logo_name">DASHBOARD</div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
  <li>
    <a href="dashsummarypage.php"class="active">
      <i class='bx bx-pie-chart-alt-2'></i>
      <span class="links_name">Summary</span>
    </a>
    <span class="tooltip">Summary</span>
  </li>
    <li>
    <a href="dashreservationspage.php">
      <i class='bx bx-grid-alt'></i>
      <span class="links_name">Reservations</span>
    </a>
    <span class="tooltip">Reservations</span>
  </li>
  <li>
    <a href="dashpendingpage.php">
      <i class='bx bx-time'></i>
      <span class="links_name">Pending</span>
    </a>
    <span class="tooltip">Pending</span>
  </li>


  </div>
  <section class="home-section">
    <br><br><br><br>
    <?php require("DASHBOARD/DASHcomponents/summarycomp.php") ?>
  </section>
  <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");
    closeBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange();
    });
    searchBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange();
    });
    function menuBtnChange() {
      if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
    }
  </script>
</body>
</html>
