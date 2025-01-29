<?php
$server="localhost";
$db_username="root";
$db_password="root";
$db_name="foms";

$conn=mysqli_connect($server,$db_username,$db_password,$db_name);

if($conn->connect_error){
    die("database connection error");
}

?>