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
      
       echo "<table class='table table-bordered'>";
    

       // Adding the first row for the horizontal headings
       echo "<tr>";
       echo "<th></th>";
       for ($i = 0; $i <26; $i++) {
        $ch= chr($i + 65);
         echo "<th>" . $ch. "</th>";
       }
       echo "</tr>";
       
//============Rows =========
       for ($j = 1; $j <= 25; $j++) {
         echo "<tr>";

         echo "<td>" . $j . "</td>";
// ============= Cells =======
         for ($i = 0; $i <26; $i++) {
          echo "<td>";
          $stmt=mysqli_prepare($conn, "SELECT raum_nutzer ,vlan, geraete_ip, port, belegt, gepatcht FROM patchplan WHERE koordinate_1 =? AND koordinate_2 =?");
          mysqli_stmt_bind_param($stmt, "ss", $j, $i);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$raum_nutzer,$vlan,$geraete_ip,$port,$belegt,$gepatcht);

          if( mysqli_stmt_fetch($stmt) == true){
echo  "<br> raum_nutzer: ". htmlspecialchars($raum_nutzer). "<br>" . "vlan : " .htmlspecialchars($vlan). "<br>". 
"geraete_ip : " .htmlspecialchars($geraete_ip). "<br>"."port : " .htmlspecialchars($port). "<br>".
"belegt : " .htmlspecialchars($belegt). "<br>"."gepatcht : " .htmlspecialchars($gepatcht). "<br>"."<br>";}

          echo "</td>";
         }
echo '</tr>';
       }
       
       echo "</table>";
          /*
            // Loop through each letter column
            for ($j = 1; $j <= 26; $j++) {
              echo "<td>";
// Loop through each row to get data for the cell
              for ($k = 0; $k < $num_rows; $k++) {
                if ($result_array[$k]['A'] == $j && $result_array[$k]['B'] == $i) {
                  echo "<div class='border-bottom border-primary'>".$result_array[$k]['C']."</div>";
                  echo "<div class='border-bottom border-primary'>".$result_array[$k]['D']."</div>";
                  echo "<div class='border-bottom border-primary'>".$result_array[$k]['E']."</div>";
                  echo "<div class='border-bottom border-primary'>".$result_array[$k]['F']."</div>";
                  echo "<div class='border-bottom border-primary'>".$result_array[$k]['G']."</div>";
                  echo "<div>".$result_array[$k]['H']."</div>";
                }
              }
              
              echo "</td>";
            }
            
            echo "</tr>";
          }
          
          echo "</tbody>";
          echo "</table>";
        */
          // Free the result set
      //    mysqli_free_result($result);
          
          // Close the database connection
          mysqli_close($conn);

          ?>
          </main>
        </body>
        </html>