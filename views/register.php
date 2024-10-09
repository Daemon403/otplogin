<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Registration Form</title>
    
</head>
<body>

<div class="form-container">
    <h2>Register</h2>
    <form method="POST" action ="../actions/register.php" autocomplete="off">
        <input type="text" name="username" placeholder="Username" required autocomplete="off">
        <input type="password" name="password" placeholder="Password" required autocomplete="off">
        <input type="email" name="email" placeholder="Email" required autocomplete="off">
        <button type="submit">Register</button>
        <div class="buttons">
            <a href="login.php">Login</a>
        </div>
    </form>
</div>

</body>
</html>
