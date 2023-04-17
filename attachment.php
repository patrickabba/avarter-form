<?php 
   session_start();
   $user_id = $_SESSION['user_id'];

  include 'config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attachment Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>
<div class="container">
    <div class="col-md-6">
     <p>Our dear esteemed parents/guardian, the school has exercised patience due to the hard time the country the country is in but it has now gone beyond our endurance. Therefore, your child/ward will not be allowed into the school premises as from Monday 31st October 2022 because of school fees default. Please endeavor to pay 
        to avoid your child/ward being driven. 
    </p>
</div>
<div class="col-md-4">
<div class="profile">
   <?php
      $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      
      if(mysqli_num_rows($select) > 0){
      $fetch = mysqli_fetch_assoc($select);
      }
      if($fetch['image'] == ''){
         echo '<img src="images/default-avatar.png">';
      }else{
         echo '<img src="uploaded_img/'.$fetch['image'].'">';
      }
   ?>
   <h3><?php echo $fetch['name']; ?></h3>
   <h3><?php echo $fetch['email']; ?></h3>
   <h3><?php echo $fetch['name']; ?></h3>
   <h3><?php echo $fetch['name']; ?></h3>
   <h3><?php echo $fetch['name']; ?></h3>
   
 </div>
</div>
</div>

</body>
</html>