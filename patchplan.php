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
  <title>Your Title Here</title>
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

<!------The table---->
<main class="container-fluid mt-5 p-5 border border-secondary rounded-3 shadow" style="background-color: rgba(255,255,255, 0.3);">
  <section>
    <h3 class="text-decoration-underline mb-5">Patch-Table</h3>
  </section>


        <?php

$qry= mysqli_query($conn, "SELECT  DISTINCT(koordinate_2) FROM patchfelder_tbl");
$qry2= mysqli_query($conn, "SELECT patch_id ,raum_nutzer ,vlan,port, belegt, gepatcht FROM patchfelder_tbl ORDER BY patch_id");


$row= mysqli_fetch_array($qry);
$res= mysqli_fetch_all($qry2, MYSQLI_ASSOC);


$count = mysqli_num_rows($qry2);
var_dump($count);
$count2= count($row);

       echo "<table class='table table-bordered table-striped'>";

       // Adding the first row for the horizontal headings
       echo "<tr>";
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
  
  echo  "<tr></tr>"; $cells=0;}
  echo "<td>";
 
$id =($rr ['patch_id']);



              
     

          $stmt=mysqli_prepare($conn, "SELECT patch_id ,raum_nutzer ,vlan,port, belegt, gepatcht FROM patchfelder_tbl WHERE patch_id = ? ");
          mysqli_stmt_bind_param($stmt, "i", $id);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$patch_id,$raum_nutzer,$vlan,$port,$belegt,$gepatcht);

          while( mysqli_stmt_fetch($stmt)){
           
            
echo  "<br> <span class='text-primary'>patch_id:</span> ". htmlspecialchars($patch_id). "<br>" . "raum_nutzer:". htmlspecialchars($raum_nutzer). "<br>" . "vlan : " .htmlspecialchars($vlan). 
"<br>"."port : " .htmlspecialchars($port). "<br>".
"belegt : " .htmlspecialchars($belegt). "<br>"."gepatcht : " .htmlspecialchars($gepatcht). "<br>"."<br>";}

          echo "</td>";
         }

       
       echo '</tr>';
     
       echo "</table>";

          mysqli_close($conn);

          ?>
          </main>
        </body>
        </html>