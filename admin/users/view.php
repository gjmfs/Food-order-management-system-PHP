<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link rel="stylesheet" href="../../css/bootstrap/dist/css/bootstrap.css">
    
</head>
<body>
    <?php
    include "nav.php";
    ?>
    <div class="container mt-5">
        <h2>Messages</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Address</th>
                    <th>Contact No</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include your database connection file
                include '../../config.php'; 
                session_start();
                
                

                // Fetch requests made by the user
                $sql = "SELECT * FROM user ORDER BY id DESC"; 
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $count = 1;
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row["username"]; ?></td>
                            <td><?php echo $row["address"]; ?></td> 
                            <td><?php echo $row["contact_no"]; ?></td> 
                            <td><?php echo $row["create_at"]; ?></td> 
                            </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr><td colspan="6">No requests found.</td></tr>
                    <?php
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    
</body>
</html>