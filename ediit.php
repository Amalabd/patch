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
  <title>-- Edit --</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Patch-Plan</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Log-in</a>
        <a class="nav-link" href="#">Plan</a>
      </div>
    </div>
  </div>
</nav>

<!------To Edit ---->

<div class="container m-5">
          
          <div class="m-3">

          <table class="table"><form action=" " method="post">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Section</th>
      <th scope="col">Edit</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><label><h5 class="m-3">Raum-Nutzer :</h5> </label></td>
      <td><input type="text" name ="raum" ></td>

    </tr>
    <tr>
      <th scope="row">2</th>
      <td><label><h5 class="m-3">VLAN :</h5> </label></td>
      <td><input type="text" name ="vlan" ></td>

    </tr>
    <tr>
      <th scope="row">3</th>
      <td ><label><h5 class="m-3">PORT :</h5> </label></td>
      <td><input type="text" name ="port" ></td>

    </tr>
    <tr>
      <th scope="row">4</th>
      <td ><label><h5 class="m-3">Gerät-IP :</h5> </label></td>
      <td><input type="text" name ="gerat" ></td>

    </tr>
  </tbody></form>
</table>
 <input type= "submit" value= "Submit" name= "up" class='btn btn-outline-success'>

 </div>
  </div>

<?php
if(isset($_POST["up"])){
    $id=$_GET["patch_id"];
    $raum= $_POST["raum"];
    $vlan= $_POST["vlan"];
    $port= $_POST["port"];
    $gerat= $_POST["gerat"];
    
  
      $update= "UPDATE patchfelder_tbl SET raum_nutzer='$raum', vlan='$vlan',geraete_ip='$gerat',port='$port' WHERE id=$id";
      if (mysqli_query($conn, $update)) {
        echo "<h5 class='text-success m-5'>The record has been updated successfully! :)</h5>";
        echo "<input type= 'submit' value= 'Back'  onclick= 'location.href=\"patchplan.php\";' class='btn btn-outline-success m-5'>";
     }else{ echo "<h5 class='text-danger m-5'>Didn't update! :)</h5>";}
    }

  ?>
          </main>
        </body>
        </html>