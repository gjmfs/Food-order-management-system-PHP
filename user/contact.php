<?php
session_start();
include "../config.php";
if(!isset($_SESSION['user_id'])){
  die ("You are not logged in ");
}
 if(isset($_POST['msg_btn'])){
    $subject=$_POST['subject'];
    $msg=$_POST['msg'];
    $user_id=$_SESSION['user_id'];

    $stmt = mysqli_prepare($conn, "INSERT INTO contact (subject, msg, user_id) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssi", $subject, $msg, $user_id); 
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "
        <script>alert('message submitted successfully');</script>
        ";
        
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="../css/bootstrap/dist/css/bootstrap.css">
    <script src="../css/bootstrap/dist/js/bootstrap.js"></script>
</head>
<body style="background-color: rgb(102, 102, 102);">
<?php include "./nav.php";?> 
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Contact Us</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="./contact.php">
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" placeholder="Enter subject" name="subject">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Enter your message" name="msg"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" name="msg_btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>