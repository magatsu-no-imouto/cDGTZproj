<?php
include("connecto.php");

if (isset($_GET['lLead'])) {  // Fixed parameter name
    $lLead = mysqli_real_escape_string($conn, $_GET['lLead']);
    
    $query = "SELECT lNo FROM lineLeaders WHERE lLead = '$lLead'";
    $result = mysqli_query($conn, $query);
    
    $lNos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $lNos[] = $row['lNo'];
    }
    
    echo json_encode($lNos); // Send the Line Numbers as a JSON response
}
?>
