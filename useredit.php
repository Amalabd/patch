<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('session.cookie_httponly', true);

session_start();
include_once("pf.php");
$user= $_SESSION['mail'];
$clas =mysqli_query($conn, "SELECT * FROM users WHERE email= '$user' ") ;
$clas_data = mysqli_fetch_assoc($clas);
$classs= $clas_data['class'];
$idd= $clas_data['id'];
$pass= $clas_data['password'];

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
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>-- Editing-Users --</title>
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
<header class="container">
<h3 class=" mt-5 row justify-content-center fw-bold" style= "color:#7A003F; ">Editing users</h3>
</header>
<!------To Edit ---->

<?php
function secure($data){
    //$data= htmlspecialchars($data);
    $data = trim($data);
    $data = stripcslashes($data);
    return $data;
  }

  if(isset($_POST["up"])){

    for($i=0; $i < count($_POST['id']) ; $i++){
    $idd=secure($_POST["id"][$i]);
    $email= secure($_POST["email"][$i]);
    $pass= secure($_POST["pass"][$i]);
    $class= secure($_POST["class"][$i]);

        $stmtt=mysqli_prepare($conn, "UPDATE users SET email =?, password=?, class=? WHERE id=?");
        mysqli_stmt_bind_param($stmtt,"sssi", $email, $pass,$class, $idd);
        mysqli_stmt_execute($stmtt);

        if (mysqli_stmt_affected_rows($stmtt)) {
          $refresh_url= "useredit.php";
         }

         
        }

     
    }
    if(isset($_POST['del'])){
      $ids= $_POST['ck'];
      foreach($ids as $id){

      $stmtd=mysqli_prepare($conn,"DELETE FROM users WHERE id=?");
           mysqli_stmt_bind_param($stmtd, "i", $id);
           mysqli_stmt_execute($stmtd); 
           if(mysqli_stmt_affected_rows($stmtd)){
            header("Location:useredit.php");
    }}}
   
   
$stmt=mysqli_prepare($conn, "SELECT id,email, password, class FROM users ");
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$idd,$email,$pass,$class);
          //$rows=  mysqli_stmt_fetch($stmt);
         echo '<div class="container mt-5">';
          echo'<div class="m-3">';
          echo'<form action=" " method="post">';
          echo "<table class='table table-bordered'>";
     
            // Adding the first row for the horizontal headings
            echo "<thead>";
            echo "<tr style= 'background-color:#7A003F; color:white;'>";
            echo "<th scope='col'>ID</th>";
            echo "<th scope='col'>EMAIL</th>";
            echo "<th scope='col'>PASSWORD</th>";
            echo "<th scope='col'>CLASS</th>";
            echo "<th scope='col'>Sel</th>";
            echo "</tr>";
            echo"</thead>";
            echo'<tbody>';

          while(mysqli_stmt_fetch($stmt)){

            echo "<tr>";
            echo "<td>" . "<input type='text' name ='id[]' value= ' " .secure($idd). " ' readonly>" . "</td>".
             "<td>"  ."<input type='text' name ='email[]' value= ' " .secure($email). " '>" . "</td>".
              "<td>". "<input type='password' name ='pass[]'  value= ' " .secure($pass). " '>" . "</td>".
               "<td>". "<input type='text' name ='class[]'  value= ' " .secure($class). " '>" . "</td>" .
               "<td>". '<input class="form-check-input" type="checkbox" name="ck[]" value= " '.secure($idd).' " id="defaultCheck1">' .
              
             
              "</td>";

               
            echo "</tr>";

          }


        echo'</tbody>';
        echo '</table>';
        echo '<input type= "submit" value= "Editing" name= "up" class="btn btn-outline-success">' . " " . 
       '<input type= "submit" value= "Delete" name= "del" class="btn btn-outline-danger" onclick="return confirm(\'Are you sure?\');" >' ;
          
        echo'</form>';
        echo' </div>';
        echo'</div>';




          mysqli_close($conn);

  ?>
          </main>
        </body>
        </html>
