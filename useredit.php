<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('session.cookie_httponly', true);

session_start();
include_once("pf.php");
$user= $_SESSION['mail'];
$clas =mysqli_query($conn, "SELECT class FROM users WHERE email= '$user' ") ;
$clas_data = mysqli_fetch_assoc($clas);
$classs= $clas_data['class'];



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
    <a class="navbar-brand text-white fw-bold">Patch-Plan</a>
    <span class=" collapse navbar-collapse text-white fw-bold"> Welcome to our offecial website</span>

    <!----------Button ---->
   

    

<div class="btn-group dropstart ">
  <button type="button" class="btn  dropdown-toggle" style="background-color:white;" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fa fa-bars" aria-hidden="true"></i>

  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" aria-current="page" href= 'useredit.php?session_unset()' role='button' aria-pressed='true'>Editing-Users</a></li>
    <li><a class="dropdown-item" aria-current="page" href= 'useradd.php?session_unset()' role='button' aria-pressed='true'>Adding-Users</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class=" dropdown-item nav-link  text-white fw-bold "  aria-current="page" href= 'log.php?session_unset()' role='button' aria-pressed='true'>Log-out</a></li>
  </ul>
</div>

          
    

      
</div>
  </div>
</nav>

<!------To Edit ---->

<?php
function secure($data){
    $data= htmlentities($data);
    $data= htmlspecialchars($data);
    $data = trim($data);
    $data = stripcslashes($data);
    return $data;
  }

$stmt=mysqli_prepare($conn, "SELECT id,email, password, class FROM users ");
          //mysqli_stmt_bind_param($stmt, "i", $idd);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$idd,$email,$password,$class);
          //$stmt=mysqli_stmt_fetch($stmt);
         echo '<div class="container m-5">';
          echo'<div class="m-3">';
          echo'<form action=" " method="post">';
          echo "<table class='table table-bordered table-striped'>";
     
            // Adding the first row for the horizontal headings
            echo "<thead>";
            echo "<tr style= 'background-color:#7A003F; color:white;'>";
            echo "<th scope='col'>ID</th>";
            echo "<th scope='col'>EMAIL</th>";
            echo "<th scope='col'>PASSWORD</th>";
            echo "<th scope='col'>CLASS</th>";
            echo "<th scope='col'>Action</th>";
            echo "</tr>";
            echo"</thead>";
            echo'<tbody>';

          while( mysqli_stmt_fetch($stmt)){
            


            echo "<tr>";
            echo "<td>" . "<input type='text' name ='id[]' value= ' " .htmlspecialchars($idd). " ' readonly>" . "</td>".
             "<td>"  ."<input type='text' name ='email[]' value= ' " .htmlspecialchars($email). " '>" . "</td>".
              "<td>". "<input type='text' name ='pass[]'  value= ' " .htmlspecialchars($password). " '>" . "</td>".
               "<td>". "<input type='text' name ='class[]'  value= ' " .htmlspecialchars($class). " '>" . "</td>" .
               "<td>". '<input type= "submit" value= "Submit" name= "up" class="btn btn-outline-success">'. "  " .
                '<input type= "submit" value= "Delete" name= "del" class="btn btn-outline-danger">' . "</td>";

                if(isset($_POST["up"])){
                    $idd=$_GET["id"];
                    $email= $_POST["email"];
                    $class= $_POST["class"];
                
                      $update= "UPDATE users SET email ='$email', class='$class' WHERE patch_id=$idd";
                      if (mysqli_query($conn, $update)) {
                        echo '<h5 class="text-success m-5"><i class="fa fa-check" aria-hidden="true"></i></h5>';
                     }
                    }
                




            echo "</tr>";

          }

        echo'</tbody>';
        echo '</table>';
        
        echo'</form>';
        echo' </div>';
        echo'</div>';




          mysqli_close($conn);

  ?>
          </main>
        </body>
        </html>