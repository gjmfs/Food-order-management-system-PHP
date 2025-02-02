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
    <title>Edit Food</title>
    <link rel="stylesheet" href="../../css/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../css/form.css">
    <script src="../../css/bootstrap/dist/js/bootstrap.js"></script>
</head>
<body>
    <?php
        include "./nav.php"; 
        include '../../config.php'; 

        $food_id = $_GET['id']; // Get the food ID from the URL

        $sql = "SELECT * FROM food WHERE id = '$food_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); 
            $name = $row['name'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $old_image = $row['image']; 
        } else {
            echo "Food not found.";
            exit();
        }

        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];

            // Image handling
            $file_name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];

            if(!empty($file_name)){ // If a new image is uploaded
                $target_dir = "../../assets/foods/"; 
                $target_file = $target_dir . basename($_FILES["image"]["name"]);

                if(move_uploaded_file($tmp_name,$target_file)){
                    // Delete the old image if a new one is uploaded
                    if (file_exists("../../assets/foods/" . $old_image)) {
                        unlink("../../assets/foods/" . $old_image); 
                    }

                    $update_sql = "UPDATE food SET name='$name', quantity='$quantity', price='$price', image='$file_name' WHERE id='$food_id'";
                } else {
                    echo "<p>File not uploaded</p>";
                    exit();
                }
            } else { // If no new image is uploaded
                $update_sql = "UPDATE food SET name='$name', quantity='$quantity', price='$price' WHERE id='$food_id'";
            }

            if ($conn->query($update_sql) === TRUE) {
                echo "<p>Food updated successfully!</p>";
                header("Location: view.php"); 
                exit();
            } else {
                echo "Error updating food: " . $conn->error;
            }
        }
    ?>

    <div class="container">
        <h2>Edit Resource</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label  class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" required value="<?php echo $name; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Price:</label>
                <input type="number" name="price" class="form-control" required value="<?php echo $price; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Quantity:</label>
                <input type="number" name="quantity" class="form-control" required value="<?php echo $quantity; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Add Image:</label>
                <input type="file" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>
</html>