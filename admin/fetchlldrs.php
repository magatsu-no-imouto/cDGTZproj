<?php
include("connecto.php");

if (isset($_GET['lNo'])) {
    $lNo = mysqli_real_escape_string($conn, $_GET['lNo']);
    if($lNo==""){
        $query = "SELECT lLead FROM lineLeaders";
    }else{
        $query = "SELECT lLead FROM lineLeaders WHERE lNo = '$lNo'";
    }
    
    $result = mysqli_query($conn, $query);
    
    $leaders = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $leaders[] = $row['lLead'];
    }
    
    echo json_encode($leaders);
}
?>
