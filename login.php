<?php
    include "server.php";
    if (isset ($_SESSION['username'])) {
        header ('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <div class = "container">
        <div class="header">Login</div>
        <?php require ("errors.php") ?>
        <form action="login.php" method = "POST">
            <div>
                <label for="username">username: </label>
                <input type="text" name = "username" required>
            </div>

            <div>
                <label for="password">Password: </label>
                <input type="password" name = "password" required>
            </div>
            <div>
                <input type="submit" name ="loginuser" value = "LogIn">
            </div>

        </form>
        <br />
        <div class="info">
            <span>Not registered ? </span> <a href="register.php">Register here</a>
        </div>
    </div>
</body>
</html>