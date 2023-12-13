<!doctype html>
<head>
   <link rel="stylesheet" href="./css/style.css">
   <link rel="stylesheet" href="./css/style1.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://kit.fontawesome.com/1b2b1806df.js" crossorigin="anonymous"></script>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <!-- <script  type="text/javascript" src="assets/js/ajax.js"></script> -->

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
</head>

<?php include "db.php"; ?>

<?php include "init.php"; ?>





<?php


if (!empty($maintaince)){

  header('Location: maintenance.php');

  die('Maintenance'. $maintaince);

}




// if (!$user -> LoggedIn() ){

//  header('location: login.php');

// }



 ?>




    <body >



    <nav id="navbar">
  <!-- <div class="nav-wrapper "> -->
   
    <div class="logo">
      <a href="#home"><img width="100px" height="auto" src="./css/logo1.png"></a>
    </div>

    <div class="toggle burger-menu"><a  class="burgermenu"> <i class="fa fa-bars "></i></a></div>
          

    <ul class="navbar   hide-on-small-screen" id="menu" >
    
      <li><a  class="navbutton" href="dashboard.php">Home</a></li>
      <li><a class="navbutton" href="viewallpolls.php">Public Polls</a></li>
      <?php 
    
        if (!($user -> LoggedIn() )){
          echo '<li><a class="navbutton" href="./login.php">Sign In</a></li>
           <li><a class="navbutton" href="./register.php">Register</a></li>';
 
          }else {
            echo '
            <li><a class="navbutton" href="./mangepolls.php">manage polls</a></li>
            <span class"logout">  <li><a class="navbutton" href="./logout.php"><i class="fa-solid  fa-lg fa-arrow-right-from-bracket"  style="--fa-inverse: rgb(95, 16, 29);--fa-li-margin:0px"></i> Logout</a></li> </span>';
          }

      
      ?>
      
    </ul>
    
  

<!-- </div> -->


</nav>





