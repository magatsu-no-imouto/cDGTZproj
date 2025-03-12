<?php
include(__DIR__ . '/../connecto.php');

$which="";

if (isset($_GET['custN'])) {
    $divN = mysqli_real_escape_string($conn, $_GET['custN']);
    if($divN==""){
        $query = "SELECT divisionName FROM division";
        $which="all";
    }else{
        $which="some";
        $query = "SELECT divisionName FROM division WHERE customers LIKE '%$divN%'";
    }
    
    $result = mysqli_query($conn, $query);
    
    $divisions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $divisions[] = $row['divisionName'];  // Each row will be an object
    }

    
    echo json_encode($divisions);
}
?>
