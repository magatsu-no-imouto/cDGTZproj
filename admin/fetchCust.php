<?php
include(__DIR__ . '/../connecto.php');

$which="";

if (isset($_GET['divN'])) {
    $divN = mysqli_real_escape_string($conn, $_GET['divN']);
    if($divN==""){
        $query = "SELECT customerName FROM customer";
        $which="all";
    }else{
        $which="some";
        $query = "SELECT customers FROM division WHERE divisionName = '$divN'";
    }
    
    $result = mysqli_query($conn, $query);
    
    $customers = [];
    if($which=="all"){
        while ($row = mysqli_fetch_assoc($result)) {
            $customers[] = $row['customerName'];  // Each row will be an object
        }
    }else{
        while ($row = mysqli_fetch_assoc($result)) {
            $customers[] = $row;  // Each row will be an object
        }
    }

    
    echo json_encode($customers);
}
?>
