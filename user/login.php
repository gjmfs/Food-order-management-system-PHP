<?php
include "../config.php";

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Successful login
            session_start();
            $_SESSION['user_id'] = $row['id']; // Store user ID in session
            header("Location: home.php"); // Redirect to dashboard
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "User not found.";
    }
}

if(isset($error)) {
    // Display error message (e.g., using Bootstrap's alert class)
    echo "<div class='alert alert-danger'>{$error}</div>";
}

$stmt->close();
$conn->close();
?>