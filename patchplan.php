<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('session.cookie_httponly', true);
include_once("pf.php");
if(session_start()){


$user= $_SESSION['mail'];
$clas =mysqli_query($conn, "SELECT class FROM users WHERE email= '$user' ") ;
$clas_data = mysqli_fetch_assoc($clas);
$classs= $clas_data['class'];}
$_SESSION['timestamp']= time();
if(time() - $_SESSION['timestamp'] > 40) { //subtract new timestamp from the old one
  echo"<script>alert('15 Minutes over!');</script>";
  session_unset();
  header("Location: log.php"); //redirect to index.php
  exit;
} else {
  $_SESSION['timestamp'] = time(); //set new timestamp
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>-- Patch-Table --</title>
</head>
<body>
  

<nav class="navbar navbar-expand-lg " style= "background-color:#EBEBEB ;">
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


<!------The table---->
<main class=" mt-5  p-5 " style="background-color: rgba(255,255,255, 0.3);">
  <section>
    <h3 class=" mb-5 fw-bold" style= "color:#7A003F">Patch-Table</h3>
  
  <table class= "mb-3 p-3" style= "border:solid #7A003F 2px; ">
  <thead>
    <tr>
      <th class= "p-2" style= "border:solid #7A003F 1px; ">Raum-Nutzer</th>
      <th class= "p-2" style= "border:solid #7A003F 1px; ">Vlan</th>
      <th class= "p-2" style= "border:solid #7A003F 1px;">Geräte_IP</th>
      <th class= "p-2" style= "border:solid #7A003F 1px; ">PORT</th>
      <th class= "p-2" style= "border:solid #7A003F 1px; ">Belegt</th>
      <th class= "p-2" style= "border:solid #7A003F 1px;">Gepatcht</th>
    </tr>
  </thead>
  <tr style= "text-align:center; ">
      <th class= "p-2" style= "border:solid 1px; ">1</th>
      <th class= "p-2" style= "border:solid 1px; ">2</th>
      <th class= "p-2" style= "border:solid 1px;">3</th>
      <th class= "p-2" style= "border:solid 1px; ">4</th>
      <th class= "p-2" style= "border:solid 1px; ">5</th>
      <th class= "p-2" style= "border:solid 1px;">6</th>
    </tr>
   
  </table>

  </section>


        <?php
 
$qry= mysqli_query($conn, "SELECT  DISTINCT(koordinate_2)FROM patchfelder_tbl");
$qry2= mysqli_query($conn, "SELECT * FROM patchfelder_tbl ORDER BY patch_id");



$res= mysqli_fetch_all($qry2, MYSQLI_ASSOC);

     echo "<table class='table table-bordered table-striped'>";
     
       // Adding the first row for the horizontal headings
       echo "<tr style= 'background-color:#7A003F; color:white;'>";
       echo "<th></th>";
       // ========= Columns ======

       for ($i = 1; $i <=24; $i++) {
       
         echo "<th>" . $i. "</th>";
       }
       echo "</tr>";
       
//============Rows =========

         echo "<tr>";
       
// ============= Cells =======
$cells= 0;
foreach($res as $rr){
 
  $cells++;
  
if($cells === 25){
  
  echo  "<tr></tr>"; $cells=1;}
  
  if($cells === 1){
    $row= mysqli_fetch_array($qry);
 
    echo  "<td>". $rr['koordinate_2']. "</td>"; 
    
  }

 
 
$id =$rr ['patch_id'];
$stmt=mysqli_prepare($conn, "SELECT raum_nutzer ,vlan,geraete_ip,port, belegt, gepatcht FROM patchfelder_tbl WHERE patch_id = ? ");
          mysqli_stmt_bind_param($stmt, "i", $id);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$raum_nutzer,$vlan,$geraete_ip,$port,$belegt,$gepatcht);

 if($classs === 'a'){         

echo "<td> <a href= 'ediit.php?patch_id=".$id."' role='button' aria-pressed='true' style='text-decoration:none; color:black;'>";}else{echo "<td>";}
  
          while( mysqli_stmt_fetch($stmt)){
           
            echo ""   ;  
echo  "<br> <span class='text-primary'></span> ". "1: ". htmlspecialchars($raum_nutzer). "<br>" . " 2 : " .htmlspecialchars($vlan).
"<br>" . "3 : " .htmlspecialchars($geraete_ip).
"<br>"."4 : " .htmlspecialchars($port). "<br>".
"5 : " .(($belegt == 0)? '<span class="text-danger"><i class="fa fa-plug" aria-hidden="true"></i>
</span>' : '<span class="text-success"><i class="fa fa-plug" aria-hidden="true"></i>
</span>').
 "<br>"."6 : " .(($gepatcht  == 0) ? '<span class="text-danger"><i class="fa fa-circle" aria-hidden="true"></i>
 </span>' : '<span class="text-success"><i class="fa fa-circle" aria-hidden="true"></i>
 </span>'). "<br>"."<br>";

}

          echo "</a></td>";
         }

       
       echo '</tr>';
     
       echo "</table>";

          mysqli_close($conn);

          ?>
          </main>
        </body>
        </html>