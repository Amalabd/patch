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

$id=$_GET["patch_id"];
$sh = "SELECT * FROM patchfelder_tbl WHERE patch_id= $id";
$show=mysqli_query($conn, $sh);

if(isset($_GET['patch_id']) && $show && mysqli_num_rows($show) > 0){
    
    
    $row= mysqli_fetch_assoc($show);
    $raum= $row["raum_nutzer"];
    $vlan= $row["vlan"];
    $port= $row["port"];
    $gerat= $row["geraete_ip"];
    $belegt= $row["belegt"] ? "1" : "0";
    $gepatcht= $row["gepatcht"] ? "1" : "0"; 
    //$checked = $gepatcht == 1 ? 'checked' : ''; 
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
  <title>-- Edit --</title>
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
    <div class="d-flex text-white">
      <a class="nav-link active text-white fw-bold " > <?php echo $user; ?>  </a>
    <a class="nav-link active text-white fw-bold "  aria-current="page" href= 'log.php?session_unset()' role='button' aria-pressed='true'>Log-out</a>

</div>
  </div>
</nav>

<!------To Edit ---->

<div class="container m-5">
          
          <div class="m-3">
          <form action=" " method="post">
          <table class="table  " >
  <thead>
    <tr style= 'background-color:#7A003F; color:white;'>
      <th scope="col">#</th>
      <th scope="col">Section</th>
      <th scope="col">Edit</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><label><h5 class="m-3">Raum-Nutzer :</h5> </label></td>
      <td><input type="text" name ="raum" value= "<?php echo htmlspecialchars($raum); ?>" ></td>

    </tr>
    <tr>
      <th scope="row">2</th>
      <td><label><h5 class="m-3">VLAN :</h5> </label></td>
      <td><input type="text" name ="vlan" value= "<?php echo htmlspecialchars($vlan); ?>"></td>

    </tr>
    <tr>
      <th scope="row">3</th>
      <td ><label><h5 class="m-3">PORT :</h5> </label></td>
      <td><input type="text" name ="port" value= "<?php echo htmlspecialchars($port); ?>" ></td>

    </tr>
    <tr>
      <th scope="row">4</th>
      <td ><label><h5 class="m-3">Gerät-IP :</h5> </label></td>
      <td><input type="text" name ="gerat" value= "<?php echo htmlspecialchars($gerat); ?>"></td>

    </tr>
    <tr>
      <th scope="row">5</th>
      <td ><label><h5 class="m-3">Belegt:</h5> </label></td>
      <td><input class="form-check-input" type="checkbox" name="belegt" value= "<?php echo htmlspecialchars($belegt); ?>" id="defaultCheck1" <?php echo $belegt == "1" ? 'checked' : '' ; ?>></td>

    </tr>
    <tr>
      <th scope="row">6</th>
      <td ><label><h5 class="m-3">Gepatcht :</h5> </label></td>
      <td><input class="form-check-input" type="checkbox" name="gepatcht" value= "<?php echo htmlspecialchars($gepatcht); ?>" id="defaultCheck1" <?php echo $gepatcht == "1" ? 'checked' : '' ; ?>></td>

    </tr>
  </tbody>
</table>
 <input type= "submit" value= "Submit" name= "up" class='btn btn-outline-success'>

 </div> </form>
  </div>

<?php

if(isset($_POST["up"])){
    $id=$_GET["patch_id"];
    $raum= $_POST["raum"];
    $vlan= $_POST["vlan"];
    $port= $_POST["port"];
    $gerat= $_POST["gerat"];
    $belegt= isset($_POST["belegt"]) ? 1 : 0; 
    $gepatcht= isset($_POST["gepatcht"]) ? 1 : 0; 
    
  
      $update= "UPDATE patchfelder_tbl SET raum_nutzer='$raum', vlan='$vlan',geraete_ip='$gerat',port='$port', belegt=' $belegt', gepatcht='$gepatcht' WHERE patch_id=$id";
      if (mysqli_query($conn, $update)) {
        echo "<h5 class='text-success m-5'>The record has been updated successfully! :)</h5>";
        echo "<input type= 'submit' name='back' value= 'Back'  onclick= 'location.href=\"patchplan.php\";' class='btn btn-outline-success m-5'>";
        if(!isset($_POST['back'])){
            header("refresh:5; url=patchplan.php");
        }
     }else{ echo "<h5 class='text-danger m-5'>Didn't update! :)</h5>";}
    }

  ?>
          </main>
        </body>
        </html>