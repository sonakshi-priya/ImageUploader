<?php
	require ("db_conn.php");
	if(isset($_POST['uploadImage'])){
		$target = "images/".basename($_FILES['image']['name']);
        echo $target;
        //connect to the db
        // $db = mysqli_connect('localhost', "sonam", "sonam", "erp_db", 3306);
        
        //get all the submitted data from the form
        $image = $_FILES['image']['name'];
        $text = $_POST['text'];
        $username = $_SESSION['username'];
        $sql = "INSERT INTO images(image, text, username) values('$image', '$text', '$username')";
        mysqli_query($conn, $sql);
        
        //move the uploaded image into the folder
        if(move_uploaded_file($_FILES ['image']['tmp_name'],$target)){
			// $msg = "image uploaded successfully";
			$obj -> status = 1;
			$obj -> url = $target;
        }else{
			// $msg = "There was a problem uploading image";
			$obj -> status = 0;
		}
		echo json_encode($obj);
	}
?>

