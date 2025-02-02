<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    die ("You are not logged in ");
}
// Database connection
include '../../config.php';

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $admin_id=$_SESSION['admin_id'];
    // Prepare the SQL statement to prevent SQL injection
    $sql="select * from admin where id='$admin_id' ";
    $check=$conn->query($sql);
    if($check->num_rows>0){
        $resut= $conn->query("DELETE FROM food WHERE id = '$id'");
    }else{
        echo "You're not logged in yet";
    }
}

$conn->close();

// Redirect back to the main page
header("Location: ./menu.php");
exit();
?>