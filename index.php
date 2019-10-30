<?php 
    require ('db_conn.php');
    session_start();
    // print_r ($_SESSION);
    if(!isset($_SESSION['username'])){
        $_SESSION['msg'] = "you must log in first to view this page ";
        header("location: login.php"); 
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }

    $msg = "";
    //if upload button is pressed
    if(isset($_POST ['uploadImage'])){
        
        //path to store the uploaded image
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
            $msg = "image uploaded successfully";
        }else{
            $msg = "There was a problem uploading image";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
</head>
<body>
    <h1>This is the home page.</h1>

    <?php
        if(isset($_SESSION['success'])):?>

        <div>
            <h3>
                <?php
                    echo $_SESSION['success'];
                    unset ($_SESSION['success']);
                ?>
            </h3>
        
        </div>
        <?php endif ?>

        

        <?php /* if the users log in print information about him */ if(isset($_SESSION['username'])): ?>

        <h3>welcome <strong><?php echo $_SESSION['username']; ?></strong></h3>

        <button><a href="index.php?logout='1'">Logout</a></button>
        <?php endif ?>
        <?php
            $username = $_SESSION['username'];
            $sql = "SELECT * FROM `images` WHERE `username` = '$username'";
            $result = mysqli_query($conn, $sql);
            
            while($row=mysqli_fetch_array($result)){
                // link of image
                $link_image = 'images/' . $row['image'];
                echo "<div id ='img_div'>";
                //displaying img

                echo "<img height='200px' width='200px' src ='images/".$row['image']."'>";
                //displaying img as link
                // echo <a href=''></a>
                echo "<p>".$row['text']."</p>";
                echo "</div>";
            }
        ?>
        <form id="image_upload_form" method = "post" action = "index.php" enctype = "multipart/form-data">
            <input type = "hidden" name = "size" value = 1000000>
            <div>
            <input type = "file" name = "image">
            </div>
            <div>
            <textarea name = "text" cols = "40" rows="4" placeholder = "say something about this image......"></textarea>
            </div>
            <div>
                <input type="submit" name="uploadImage" value = "Upload">
            </div>
        </form>
    <div id="images">
            
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(e){
        //     // Submit form data via Ajax
        //     $('form#image_upload_form').submit(function (e) {
        //         e.preventDefault();
        //         var formData = new FormData (this);
        //         console.log (formData);
                // formData.append ('username', "<?php // echo $username ?>");
        //         console.log(formData);
                
        //         $.ajax ({
        //             // url : "img_upload.php",
        //             url: $(this).attr('action'),
        //             type: 'POST',
        //             enctype: 'multipart/form-data',
        //             data : formData,
        //             dataType: 'json',
        //             success : function (data) {
        //                 alert (data);
        //             },
        //             cache : false,
        //             contentType : false,
        //             processsData : false
        //         });
        //     });
        //     $("#fupForm").on('submit', function(e){
        //         e.preventDefault();
        //         $.ajax({
        //             type: 'POST',
        //             url: 'submit.php',
        //             data: new FormData(this),
        //             dataType: 'json',
        //             contentType: false,
        //             cache: false,
        //             processData:false,
        //             beforeSend: function(){
        //                 $('.submitBtn').attr("disabled","disabled");
        //                 $('#fupForm').css("opacity",".5");
        //             },
        //             success: function(response){ //console.log(response);
        //                 $('.statusMsg').html('');
        //                 if(response.status == 1){
        //                     $('#fupForm')[0].reset();
        //                     $('.statusMsg').html('<p class="alert alert-success">'+response.message+'</p>');
        //                 }else{
        //                     $('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
        //                 }
        //                 $('#fupForm').css("opacity","");
        //                 $(".submitBtn").removeAttr("disabled");
        //             }
        //         });
        //     });
        });
        
    </script>
    <script src = "./js/main.js"></script>
</body>
</html>
