<?php
session_start();
if(!isset($_SESSION['user_id'])){
  die ("You are not logged in ");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Books</title>
    <link rel="stylesheet" href="../css/bootstrap/dist/css/bootstrap.css">
    <script src="../css/bootstrap/dist/js/bootstrap.js"></script>
    
</head>
<body>
<?php include "./nav.php";?> 
    <div class="container">
        <form action="./food.php" method="POST"> 
            <h2 class="text-center mt-3 mb-3"> Search Books</h2>
            <div class="mb-3">
                <label class="form-label">Search Term:</label>
                <input type="text" class="form-control" name="search_term" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" name="submit">Search</button>
            </div>
        </form>

        <?php
        // Include your database connection file
        include '../config.php';

        // Check if the form is submitted
        if(isset($_POST['submit'])) {
            $search_term = $_POST['search_term'];

            // Construct the SQL query to search across multiple columns
            $sql = "SELECT * FROM food 
                    WHERE (name LIKE '%$search_term%' 
                    OR price LIKE '%$search_term%')
                    AND quantity > 0"
                    ;

            // Execute the query
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                echo '
                    <div class="container mt-4">
                        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-6">';
                while($row = $result->fetch_assoc()) {
                    ?>
                            <div class="col mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Name: </b><?php echo $row["name"]; ?></h5>
                                        <p class="card-text"><b>Quantity:</b> <?php echo $row["quantity"]; ?></p>
                                        <p class="card-text"><b>Price:</b> <?php echo $row["price"]; ?></p>
                                        <form action="./order-process.php" method="POST">
                                            <input type="hidden" name="food_name" value="<?php echo $row["name"]; ?>"> 
                                            <input type="hidden" name="food_quantity" value="<?php echo $row["quantity"]?>">
                                            <input type="hidden" name="food_price" value="<?php echo $row["price"]?>">
                                            <input type="hidden" name="id" value="<?php echo $row["id"]?>">
                                            <input type="number" name="food_order_quantity" class="form-control mt-2 mb-2">
                                            <button type="submit" class="btn btn-success">order</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                      
                    <?php
                }
            } else {
                echo "0 results";
            }
        }
        ?>
    </div>
</body>
</html>