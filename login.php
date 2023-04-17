<?php 
    include 'config.php';
    session_start();



     if(isset($_POST['login'])){
        
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        
        $select = mysqli_query($conn, "SELECT * FROM user_form WHERE email = '$email' AND password = '$password'") 
        or die ('query failed');
        if(mysqli_num_rows($select) > 0){
            $row = mysqli_fetch_assoc($select);
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
        }else{
            $message[] = 'incorrect email or password!';
        }
      
  }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="animation.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
             <h3>login now</h3>

             <?php
              if(isset($message)){
                  foreach($message as $message){
                      echo '<div class="message">'.$message.'</div>';
                  }
              }
             ?>

            <input type="email" name="email" placeholder="enter email" class="box" required>
            <input type="password" name="password" placeholder="enter password" class="box" required>
            
            <div class="floatleft arrow-right animate-right-to-left"></div>
            <button id="breathing-button" input type="submit" name="login" value="login" class="floatleft">Login now </button>
            <div class="floatleft arrow arrow-left animate-left-to-right"></div>
            <p>don't have an account?<a href="register.php">register now</a></p>
        </form>

    </div>
</body>
</html>