<?php
$conn = new mysqli('localhost', 'root', '', 'login_system');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>