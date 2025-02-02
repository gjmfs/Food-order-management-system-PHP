<?php
$server="sql111.infinityfree.com";
$db_username="if0_38228699";
$db_password="CpbwwOR0XpjlgwY";
$db_name="if0_38228699_foms";

$conn=mysqli_connect($server,$db_username,$db_password,$db_name);

if($conn->connect_error){
    die("database connection error");
}

?>