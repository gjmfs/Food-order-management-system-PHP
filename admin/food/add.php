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
    <title>Add Food</title>
    <link rel="stylesheet" href="../../css/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../css/form.css">
    <script src="../../css/bootstrap/dist/js/bootstrap.js"></script>
    <?php
    include '../../config.php';
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $price=$_POST['price'];
        $quantity=$_POST['quantity'];

        //image
        $file_name=$_FILES['image']['name'];
        $tmp_name=$_FILES['image']['tmp_name'];
        $folder="../../assets/foods/".$file_name;

        if(move_uploaded_file($tmp_name,$folder)){
            echo "<p>File Uploaded Successfully</p>";
        }else{
            echo "<p>File not uploaded</p>";
        }


        $exist="select * from food where name='$name' and price='$price'";
        $result=$conn->query($exist);
        if($result->num_rows>0){
            echo "Resource already exist";
        }else{
            $createResource="insert into food(name,quantity,price,image) values('$name','$quantity','$price','$file_name')";
            $result=$conn->query($createResource);
            header("Location:./view.php");
        }
    }
    ?>
</head>
<body>
    <?php
        include "./nav.php";
    ?>
    <div class="container">
    <form action='./add.php' method="POST" enctype="multipart/form-data">
        <h2 class="text-center mt-3 mb-3"> Food</h2>
        <div class="mb-3">
            <label  class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price:</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Quantity:</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Add Image:</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>