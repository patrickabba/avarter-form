 <?php 
    include 'config.php';


     if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/'.$image;

        $select = mysqli_query($conn, "SELECT * FROM user_form WHERE email = '$email' AND password = '$password'")
         or die ('query failed');

      if(mysqli_num_rows($select) > 0){
          $message[] = 'user already exist';
      }else{
          if($password != $cpassword){
              $message[] = 'confirm password not match!';
          }elseif($image_size > 2000000){
              $message[] = 'image size is too large';
          }else{
              $insert = mysqli_query($conn, "INSERT INTO user_form(name, email, password, image) VALUES
               ('$name', '$email', '$password', '$image')") or die('error connecting to db');
              if($insert){
                  move_uploaded_file($image_tmp_name, $image_folder);
                  $message[] = 'registered successfully!';
                  header('location:login.php');
              }else{
                  $message[] = 'registration failed!';
              }
          }
      }
  }

?> 




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="animation.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
             <h3>Register now</h3>

             <?php
              if(isset($message)){
                  foreach($message as $message){
                      echo '<div class="message">'.$message.'</div>';
                  }
              }
             ?>

            <input type="text" name="name" placeholder="enter username" class="box" required>
            <input type="email" name="email" placeholder="enter email" class="box" required>
            <input type="password" name="password" placeholder="enter password" class="box" required>
            <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
            <div class="floatleft arrow-right animate-right-to-left"></div>
            <button id="breathing-button" input type="submit" name="submit" value="Register" class="floatleft">Register now </button>
            <div class="floatleft arrow arrow-left animate-left-to-right"></div>
            <p>already have an account?<a href="login.php">Login now</a></p>
        </form>

    </div>
</body>
</html>