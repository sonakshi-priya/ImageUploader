<?php
    session_start();

    $username = '';
    $email = '';
    $errors = array();
    require "db_conn.php";

    // register user
    if (isset($_POST['register_user'])) {
        $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
        $email = trim (mysqli_real_escape_string($conn, $_POST['email']));
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        // form validation
        if(empty($username)) {
            array_push($errors, "Username is required");
        }

        if(empty($email)) {
            array_push($errors, "email is required");
        }

        if(empty($password)) {
            array_push($errors, "Password is required");
        }
        if($confirm_password != $password){
            array_push($errors, "password does not match"); 
        }
        //check query for existing users
        $user_check_query = "SELECT * FROM `users` WHERE `username` = '$username' OR `email` = '$email' LIMIT 1;";
        
        $result = mysqli_query($conn, $user_check_query);
        $user =  mysqli_fetch_assoc($result);

        if($user){
            if($user['username']===$username){
                array_push($errors, "Username already exist");
            }
            if($user['email']===$email){
                array_push($errors, "email already exist");
            }
        }

        //insert the user into db when no error

        if(count($errors) == 0){
            $password_hash = md5($password);
            $query = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password_hash');";
            mysqli_query($conn, $query);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "you are now logged in";

            header("location: index.php");

        }
    }

    //login user
     if(isset($_POST['loginuser'])){
        $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if(empty($username)){
            array_push($errors, "username is required");
        }
        if(empty($password)){
            array_push($errors, "password is required");
        }

        if(count($errors) == 0){
            $password = md5($password);
            $query = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' LIMIT 1;";
            $results = mysqli_query($conn, $query);

            if(mysqli_num_rows($results) != 0){
                $_SESSION['username'] = $username;
                // $_SESSION['email'] = 
                $user = mysqli_fetch_assoc ($results);
                $_SESSION['email'] = $user['email'];
                $_SESSION['success'] = 'Logged in successfully';
                // echo "Logged in";
                header ('location: index.php');
            } else {
                array_push ($errors, "Username and/or password not found");
            }
        }
        


     }

    

?>