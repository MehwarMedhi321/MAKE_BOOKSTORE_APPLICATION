<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_Page.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="Main.css">

</head>
<body>
   

<div class="main">
          <nav>
            <div class="logo">
                <h6> <a href="http://127.0.0.1:5501/System-Desine/Book.html"><i class="fa-solid fa-arrow-left"></i></a> Book <span style="color: crimson"> Library</span></h6></a>
            </div>
            <div class="new">
                <a href="#" style="color:crimson;">Home</a>
                <a href="#">Info</a>
                <a href="#">About</a>
                <a href="#">Content</a>

            </div>
        </nav>
        
        <div class="container">
            
            <div class="row">
               <a href="./addBook.php"><button id="CreateBook">Create Book</button></a> 
                <button id="DelectBook"> Delete Book</button>
                <button id="EditBook">Edit Book</button>
                <h1 style="color: white;">Welcome To Library ....</h1>
                <div class="container">
               

   <div class="content">
      <h3>Hello, <span>user</span></h3>
      <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p style="color: white;">this is an user page</p>
      <a href="login_Page.php" class="btn primary">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>
            </div>
        </div>

        </div>
</body>
</html>