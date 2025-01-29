<?php
// Include your database connection file
include '../config.php';

// Get data from the form
$name = $_POST['food_name'];
$quantity = $_POST['food_quantity'];
$price = $_POST['food_price'];
$food_order_quantity = $_POST['food_order_quantity'];

if ($food_order_quantity <= $quantity) {
    session_start();
    $user_id = $_SESSION['user_id']; 

    // Get user address using prepared statement
    $stmt = mysqli_prepare($conn, "SELECT address FROM user WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id); 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt); 
    if ($result) {
        $row = mysqli_fetch_assoc($result); 
        $address = $row['address']; 
    } else {
        echo "Error: " . mysqli_stmt_error($stmt); 
        exit(); 
    }
    mysqli_stmt_close($stmt); 

    // Insert pre-order data into the database
    $sql = "INSERT INTO `order` (food_name, food_quantity, food_price, user_id) 
            VALUES ('$name', '$food_order_quantity', '$price', '$user_id')";

    if ($conn->query($sql) === TRUE) {

        // Update the remaining quantity of the food
        $new_quantity = $quantity - $food_order_quantity;

        // Prepare and execute the update statement
        $update_stmt = mysqli_prepare($conn, "UPDATE food SET quantity = ? WHERE name = ?"); 
        mysqli_stmt_bind_param($update_stmt, "is", $new_quantity, $name);
        mysqli_stmt_execute($update_stmt);

        echo "<script>alert('order successfull');</script>";
        header("Location: ./food.php"); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    mysqli_stmt_close($update_stmt); 

} else {

    echo '<script>alert("Order quantity exceeds available stock.");</script>';
}

$conn->close();
?>