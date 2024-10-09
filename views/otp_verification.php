<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification Form</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="form-container">
    <h2>OTP Verification</h2>
    <!-- OTP Verification Form -->
    <form method="POST" action = "../actions/otp_verification.php">
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <button type="submit">Verify OTP</button>
    </form>
    <div class="back-link">
        <a href="login.php">Back to Login</a>
    </div>
</div>

</body>
</html>

