<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('session.cookie_httponly', true);

session_start();
include_once("pf.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>-- LOG_IN --</title>
</head>
<body>
    
  
<nav class="navbar navbar-expand-lg " style= "background-color:#EBEBEB";>
  <div class="container-fluid">
    
    <h4 class='fw-bold'>  <img src="logo.png" alt="" > URZ UNIVERSITÄTSRECHENZENTRUM</h4>
    </a>
  </div>
</nav>
<nav class="navbar navbar-expand-lg" style= "background-color:black; ">
  <div class="container-fluid">
    <a class="navbar-brand text-white fw-bold">Patch-Plan</a>
    <span class=" collapse navbar-collapse text-white fw-bold"> Welcome to our offecial website</span>
  </div>
</nav>

<main class=" container  text-center mt-5 " style="margin: auto; ">

<header class="page-header m-5  ">
  <h1 class="" style= "color:#7A003F">LOG - IN</h1>
</header>
      
<section class="row-sm m-5 col-4 mx-auto border border-secondary rounded-3 shadow" style=" background-color:#7A003F ; color: white;">
  <form action="" method="POST" class=" m-5">
    <label class= "fs-4">Email</label><br>
    <input type="text"  name="mail" placeholder= "Schreib hier"><br><br>
    <label class= "fs-4" for="pass">Password</label><br>
    <input type="password"  name="pass" placeholder= "****************"><br><br>
    <input type="hidden"  name="clas" ><br><br>
    <input type="submit" value="Submit" name= "btn" class= "fs-5 p-1 m-3">
  </form> 
  <a href="mailto: amal.abdalla@ovgu.de" style="text-decoration:none; color:white;">
  No account!! Please contact us <i class="fa fa-envelope-o" aria-hidden="true"></i>
</a>
</section>
</main>

<?php

$mail = $pass = "";
$message = '<div class="alert alert-danger alert-dismissible fade show  col-2 mx-auto" role="alert">
    <strong>  You dont have Permission !!!</strong>
     </div>';
 
 function secure($data){
    $data= htmlspecialchars($data);
    $data= htmlentities($data);
    $data= stripcslashes($data);
    $data= trim ($data);
    return $data;
 }

 if(isset($_POST['btn']))
  {
    $mail = secure($_POST['mail']);
    $pass = secure($_POST['pass']);
    $clas = secure($_POST['clas']);
    $stmt= mysqli_prepare($conn, "SELECT * FROM users WHERE email= ? AND password= ? ");
    mysqli_stmt_bind_param($stmt, "ss", $mail, $pass);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0)
    {
    session_start();
    $_SESSION ['mail']= $mail;
    $_SESSION ['pass']= $pass;
    $_SESSION ['clas']= $clas;
    header("Location: patchplan.php");
    exit();
    }else {
      
      echo $message;
    }

  }

?>

</body>
  </html>