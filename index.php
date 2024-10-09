<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="container">
    <h1>Welcome to Our Website</h1>

    <?php if (isset($_SESSION['loggedin'])): ?>
        <div class="user-info">
            <p>Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
            <p>Your email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        </div>
        <div class="buttons">
            <a href="actions/logout.php">Logout</a>
        </div>
    <?php else: ?>
        <p>Please log in or register to access more features.</p>
        <div class="buttons">
            <a href="views/login.php">Login</a>
            <a href="views/register.php">Register</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
