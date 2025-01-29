<?php
include "../config.php";

if(isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

    try {
        // Prepare and execute the search query using prepared statements
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?"); 
        $stmt->bind_param("s", $username); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) { 
            // Prepare and execute the insert query using prepared statements
            $stmt = $conn->prepare("INSERT INTO user (username, password, contact_no, address) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $hashedPassword, $contact, $address); 
            $stmt->execute();
            echo "User created successfully";
            
        } else {
            echo "User already exists."; 
        }

    } catch(mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage(); 
    }

    $stmt->close(); 
    $conn->close(); 
}
?>