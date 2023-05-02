<meta charset="utf-8" />

<?php

$db_port = '3307';
$host= 'localhost';
$username='root';
$password= '';
$DB_name= 'patchfeldplan';

$conn= mysqli_connect($host, $username, $password, $DB_name, $db_port);

mysqli_select_db($conn, "patchfeldplan") or die ("no database");       
if(!$conn){
echo mysqli_connect_error("Connection error") . mysqli_connect_error();

}
       
        

       



function close_db(){
    global $conn;
    mysql_close($conn);
}


/*
if (empty($_SESSION['tan']))
{
  $_SESSION['tan']=0;
}
*/
?>