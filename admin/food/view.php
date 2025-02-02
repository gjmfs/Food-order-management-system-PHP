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
    <title>View Foods</title>
    <link rel="stylesheet" href="../../css/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../css/form.css">
    <script src="../../css/bootstrap/dist/js/bootstrap.js"></script>
</head>
<body>
    <?php
        include "./nav.php"; 
        include '../../config.php'; 
    ?>
    <div class="container">
        <h2>View Resources</h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM food";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <?php 
                                $imagePath = "../../assets/foods/" . $row['image']; 
                                if (file_exists($imagePath)) { 
                                    ?>
                                    <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="Food Image" style="height: 250px; object-fit: cover;"> 
                                    <?php 
                                } else {
                                    ?>
                                    <img src="no_image.jpg" class="card-img-top" alt="No Image" style="height: 180px; object-fit: cover;"> 
                                    <?php 
                                } 
                            ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text">Price: <?php echo $row['price']; ?>LKR</p>
                                <p class="card-text">Quantity: <?php echo $row['quantity']; ?></p>
                                <div class="row row-cols-2 ">
                                    <div class="col">
                                    <?php
                                        echo"  <form action='./update.php' method='get' style='display:inline;'>
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                <button type='submit' name='update' class='btn btn-secondary'>
                                                Update
                                                </button>
                                            </form>
                                        </td>";
                                        ?>
                                    </div>
                                    <div class="col">
                                        <?php
                                            echo"  <form action='./delete.php' method='post' style='display:inline;'>
                                                    <input type='hidden' name='id' value='{$row['id']}'>
                                                    <button type='submit' name='delete' class='btn btn-danger'>
                                                    Delete
                                                    </button>
                                                </form>
                                            </td>";
                                        ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No resources found.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>