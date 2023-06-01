<!DOCTYPE html>
<html>
<head>
  <title>Account List</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }
    
    .container {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin: 20px;
      padding: 20px;
      background-color: #f2f2f2;
    }
    
    .column {
      flex: 1;
      margin-right: 20px;
    }
    
    .box {
      margin-bottom: 20px;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }
    
    .box-title {
      margin-top: 0;
    }
    
    .account-list {
      list-style-type: none;
      padding: 0;
    }
    
    .account-item {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="column">
      <div class="box">
        <h2 class="box-title">Total Registered Users</h2>
        <p>Total: 100</p>
      </div>
      <div class="box">
        <h2 class="box-title">Notifications</h2>
        <p>No new notifications</p>
      </div>
    </div>
    <div class="column">
      <div class="box">
        <h2 class="box-title">Account List</h2>
        <ul class="account-list">
          <li class="account-item">Arrabella Jane</li>
          <li class="account-item">Jam Emmanuel</li>
          <li class="account-item">Reiner Buenas</li>
          <li class="account-item">Mary Antoinette</li>
          <li class="account-item">Gwyneth Beatrice</li>
          <!-- Add more account items here -->
        </ul>
      </div>
    </div>
  </div>
</body>
</html>
