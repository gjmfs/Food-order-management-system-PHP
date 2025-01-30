<?php
session_start();
if(!isset($_SESSION['admin_id'])){
  die ("You are not logged in ");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="../css/bootstrap/dist/css/bootstrap.css">
</head>
<body>
    <?php
    include "./nav.php";
    ?>
<div class="container mt-4">
        <h2>Order History</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Food Name</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../config.php";


                $sql = "select * from order";
                
                $result=$conn->query($sql);

                if ($result->num_rows > 0) {
                    $i = 1; // Counter for order number
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i++; ?></th>
                            <td><?php echo $row['food_name']; ?></td>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['food_quantity']; ?></td>
                            <td><?php echo $row['food_price']; ?></td> 
                            <td><?php echo $row['order_date']; ?></td> 
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No orders found.</td></tr>"; 
                }

                
                $conn->close(); 
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>