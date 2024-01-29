<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){


   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
   $pass = md5($_POST['password']);
   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['password'];
         header('location:admin_Page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['email'];
         header('location:user_Page.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="Main.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <p style="color: black;">E-mail</p><input type="email" name="email" required placeholder="enter your email">
      <p style="color: black;">Password</p> <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" style="margin-top: 8%" name="submit" value="login now" class="form-btn">
      <p style="color: black; ">don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

</body>
</html>