<?php
session_start();
if(!isset($_SESSION['admin_id'])){
  die ("You are not logged in ");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Home</title>
    <link rel="stylesheet" href="../css/bootstrap/dist/css/bootstrap.css" />
    <script src="../css/bootstrap/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../css/card.css">
    
  </head>
  
  <body class="home">
  <?php include "./nav.php";?> 
    <div class=" container">
      <div class="row row-cols-1">
        <a href="./food.php" class="col">Foods</a>
        <a href="./orders.php" class="col">Orders</a>
        <a href="./contact.php" class="col">Messages</a>
      </div>
    </div>
  </body>
</html>
