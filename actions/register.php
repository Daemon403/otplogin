<?php
include '../connection.php';

// Registration form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // Hashing the password
    $email = $_POST['email'];  // For OTP delivery

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");

    // Check if the prepare() failed
    if ($stmt === false) {
        
        die('Prepare failed: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sss", $username, $password, $email);

    if ($stmt->execute()) {
        echo "User registered successfully!";
        header("Location: ../views/login.php");
        exit();
    } else {

        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>