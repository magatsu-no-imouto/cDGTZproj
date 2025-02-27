<?php
$user="root";
$pass="";
$db="dgtz";
$conn="";

try{
    $conn=new mysqli('localhost',$user,$pass,$db);
}catch(mysqli_sql_exception){
    echo "UNABLE TO CONNECT<br>";
}
?>        