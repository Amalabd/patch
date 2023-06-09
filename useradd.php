<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('session.cookie_httponly', true);
include_once("pf.php");
session_start();
//if(empty($_SESSION['mail'])){ header("Location: log.php");exit;}


$user= $_SESSION['mail'];
$clas =mysqli_query($conn, "SELECT * FROM users WHERE email= '$user' ") ;
$clas_data = mysqli_fetch_assoc($clas);
$classs= $clas_data['class'];
$idd= $clas_data['id'];

$_SESSION['timestamp']= time();
if(time() - $_SESSION['timestamp'] > 40) { 
  echo"<script>alert('Will log out!');</script>";
  session_unset();session_destroy();
  header("Location: log.php"); 
  exit;
}

if(empty($_SESSION['mail'])){
  header("Location: log.php");
}


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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>-- Adding-Users --</title>
</head>
<body>
  

<nav class="navbar navbar-expand-lg " style= "background-color:#EBEBEB ;">
  <div class="container-fluid">
    
    <h4 class='fw-bold'>  <img src="logo.png" alt="" > URZ UNIVERSITÄTSRECHENZENTRUM</h4>
    <div class="d-flex text-white">
      <a class="nav-link active text-dark fw-bold " > <?php echo $user; ?>  </a>
</div>

  </div>
</nav>
<nav class="navbar navbar-expand-lg" style= "background-color:black; ">
  <div class="container-fluid">
    <a class="navbar-brand text-white fw-bold" href= 'patchplan.php'>Patch-Plan</a>
    <span class=" collapse navbar-collapse text-white fw-bold"> Welcome to our offecial website</span>

    <!----------Button ---->
   

    

<div class="btn-group dropstart ">
  <button type="button" class="btn  dropdown-toggle" style="background-color:white;" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fa fa-bars" aria-hidden="true"></i>

  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
  <?php 
    if($classs === 'a'){ 
   echo '<li>' . '<a class="dropdown-item" aria-current="page" href= "useredit.php" role="button" aria-pressed="true">Editing-Users</a>'.'</li>'.
    '<li>' .'<a class="dropdown-item" aria-current="page" href= "useradd.php" role="button" aria-pressed="true">Adding-Users</a>'.'</li>';
    }
    ?>
    <li><a href= <?php echo'password.php?id= " '.$idd.' " ' ?> role='button' aria-pressed='true' class="dropdown-item" aria-current="page">Password-Change</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class=" dropdown-item nav-link  text-white fw-bold "  aria-current="page" href= 'log.php?session_unset()' role='button' aria-pressed='true'>Log-out</a></li>
  </ul>
</div>

          
    

      
</div>
  </div>
</nav>


<!-----------------------------Adding Form---------------------->
<h3 class=" m-5 fw-bold" style= "color:#7A003F">Adding new users</h3>

<div class="container m-2">
          
          <div class="m-4">
          <form action=" " method="post">
          <table class="table  " >
  <thead>
    <tr style= 'background-color:#7A003F; color:white;'>
      <th scope="col">#</th>
      <th scope="col">Section</th>
      <th scope="col">ADD</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><label><h5 class="m-3">ID :</h5> </label></td>
      <td><input type="number" class=" form-control " name="id" ></td>

    </tr>
    <tr>
      <th scope="row">2</th>
      <td><label><h5 class="m-3">Email :</h5> </label></td>
      <td><input type="text" class="form-control " name="email" ></td>

    </tr>
    <tr>
      <th scope="row">3</th>
      <td ><label><h5 class="m-3">Password :</h5> </label></td>
      <td><input type="text" class="form-control " name="pass" ></td>

    </tr>
    <tr>
      <th scope="row">4</th>
      <td ><label><h5 class="m-3">Class :</h5> </label></td>
      <td><input type="text" class="form-control " name="class" ></td>

    </tr>

  </tbody>
</table>
 <input type= "submit" value= "Submit" name= "add" class='btn btn-outline-success'>









 

<?php
//=================================================================================
//=================(((((((((((((ADDING))))))))))))=================================
//=================================================================================
function secure($data){
  $data= htmlspecialchars($data);
  $data = trim($data);
  $data = stripcslashes($data);
  return $data;
}
if(isset($_POST['add']))
{    
  $id = secure($_POST['id']);
  $email = secure($_POST['email'], FILTER_VALIDATE_EMAIL);
  $pass = secure($_POST['pass']);
  $class = filter_var(secure($_POST['class']));
  
  $stmt3=mysqli_prepare($conn, "INSERT INTO users (id, email , password ,class)  VALUES(?,?,?,?)");
  mysqli_stmt_bind_param($stmt3, "isss",$id,$email,$pass,$class);

  if (mysqli_stmt_execute($stmt3)) {
     echo "<h5 class='m-5 text-success'>New record has been added successfully !</h5>";
  } else {
     echo "Error ";
  }
  mysqli_stmt_close($stmt3);
}



mysqli_close($conn);



?>
 </div> </form>
  </div>


</main>
<script>
if ( window.history.replaceState ) {
window.history.replaceState( null, null, window.location.href );
}
</script>


</body>
</html>