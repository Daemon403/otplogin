<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_otp = $_POST['otp'];

    // Check if OTP matches and is not expired
    if (isset($_SESSION['otp']) && time() < $_SESSION['otp_expiry']) {
        if ($_SESSION['otp'] == $input_otp) {
            echo "Login successful!";
            header("Location: ../index.php");
            // Clear OTP session data
            unset($_SESSION['otp']);
            unset($_SESSION['otp_expiry']);
            $_SESSION['loggedin'] = true;
        } else {
            echo "Incorrect OTP.";
        }
    } else {
        echo "OTP expired. Please try again.";
    }
}
?>
