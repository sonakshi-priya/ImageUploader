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
    <title>Registration</title>
</head>
<body>
    <div class = "container">
        <div class="header">Register here</div>
        <form action="register.php" method = "POST">
            <?php include('errors.php'); ?>

            <div>
                <label for="username">username: </label>
                <input type="text" name = "username" required>
            </div>

            <div>
                <label for="email">Email: </label>
                <input type="email" name = "email" required>
            </div>

            <div>
                <label for="password">Password: </label>
                <input type="password" name = "password" required>
            </div>

            <div>
                <label for="confirm_password">Confirm Password: </label>
                <input type="password" name = "confirm_password" required>
            </div>

            <!-- <div>
                <label for="first_name">First Name: </label>
                <input type="text" name = "first_name" required>
            </div>

            <div>
                <label for="last_name">Last Name: </label>
                <input type="text" name = "last_name" required>
            </div>

            <div>
                <label for="dob">Date Of Birth</label>
                <input type="date" name = "dob" required>
            </div> -->
            <div>
                <input type="submit" name = "register_user">
            </div>

        </form>
        <br />
        <div class="info">
            <span>Already registered ? </span> <a href="login.php">Login here</a>
        </div>
    </div>
</body>
</html>