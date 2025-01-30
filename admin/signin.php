<?php
include "../config.php";

if(isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 

    // Validate input (important!)
    if (empty($username) || empty($password)) {
        echo "Username and password are required.";
        exit; // Stop further execution
    }

    // Hash the password for security.  Do this *before* checking if the user exists.
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

    try {
        // Check if the user already exists
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username =?"); 
        $stmt->bind_param("s", $username); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) { 
            // User doesn't exist, so create them.  Use the hashed password.
            $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?,?)"); // Corrected SQL: removed extra comma
            $stmt->bind_param("ss", $username, $hashedPassword); // Corrected bind_param: two strings
            $stmt->execute();
            echo "User created successfully";
        } else {
            echo "User already exists."; 
        }

    } catch(mysqli_sql_exception $e) {
        // Log the error for debugging (don't show detailed errors to users in production)
        error_log("Database Error: ". $e->getMessage());
        echo "An error occurred. Please try again later."; // Generic error message for users
    }

    $stmt->close(); 
    $conn->close(); 
}?>