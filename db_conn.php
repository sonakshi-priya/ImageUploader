<?php
    require 'db_info.php';
    $conn = mysqli_connect($server_name, $user_name, $passwd, $db_name, $db_port);
    if(!$conn){
        die("database connection not established");
    }
    //echo "i love you hemu"
?>