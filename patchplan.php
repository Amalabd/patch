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
      
       echo "<table class='table table-bordered table-striped'>";
    

       // Adding the first row for the horizontal headings
       echo "<tr>";
       echo "<th></th>";
       // ========= Columns ======
       // In ASCII from A to Z has values (65-90), then I use chr() to convert numbers to letters ($i = 65; $i <91; $i++)
       for ($i = 1; $i <=24; $i++) {
       
         echo "<th>" . $i. "</th>";
       }
       echo "</tr>";
       
//============Rows =========

$qry= "SELECT  DISTINCT(koordinate_2) FROM patchfelder_tbl";
$qry2= "SELECT koordinate_2 FROM patchfelder_tbl";
$rw = mysqli_query($conn, $qry);
$rw2 = mysqli_query($conn, $qry2);

$rws= mysqli_num_rows($rw2);
$res= mysqli_fetch_array($rw2);


     //  for ($j = 0; $j <=25; $j++)
     while($rws2= mysqli_fetch_array($rw)) {
      
        
        
         echo "<tr>";

echo "<td>" . $rws2[0] . "</td>";
         
// ============= Cells =======
         for ($i = 1; $i <=24; $i++) {
          
          echo "<td>";
         $id= intval($res) * 24 + $i;
        
          $stmt=mysqli_prepare($conn, "SELECT raum_nutzer ,vlan,port, belegt, gepatcht FROM patchfelder_tbl WHERE patch_id=? ");
          mysqli_stmt_bind_param($stmt, "s",$id);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$raum_nutzer,$vlan,$port,$belegt,$gepatcht);

          while( mysqli_stmt_fetch($stmt)){
echo  "<br> <span class='text-primary'>raum_nutzer:</span> ". htmlspecialchars($raum_nutzer). "<br>" . "vlan : " .htmlspecialchars($vlan). 
"<br>"."port : " .htmlspecialchars($port). "<br>".
"belegt : " .htmlspecialchars($belegt). "<br>"."gepatcht : " .htmlspecialchars($gepatcht). "<br>"."<br>";}

          echo "</td>";
         }
echo '</tr>';
       }
       
       echo "</table>";

          mysqli_close($conn);

          ?>
          </main>
        </body>
        </html>