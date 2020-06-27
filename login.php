<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>
            Log In
        </h2>
    </div>

    <form method="post" action="login.php">
    <!-- !-- display validation errors here  -->
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Your Name">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Type a Password">
        </div>

        <div class="input-group">
            <button type="submit" name="login" class="btn">Log In</button>
        </div>

        <p>
            Not yet a member? <a href="register.php">Sign Up</a>
        </p>
    </form>
</body>
</html>