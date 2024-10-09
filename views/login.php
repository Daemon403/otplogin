<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="form-container">
    <h2>Login</h2>
    <!-- Simple Login Form -->
    <form method="POST" action = "../actions/login.php" autocomplete="off" >
        <input type="text" name="email" placeholder="Email" required autocomplete="off">
        <input type="password" name="password" placeholder="Password" required autocomplete="off">
        <button type="submit">Login</button>
    </form>
    <div class="buttons">
        <a href="register.php">Register</a>
    </div>
</div>

</body>
</html>

