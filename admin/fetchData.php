<?php
include("../connecto.php");

$q1 = $_POST['division'] ?? "";
$q2 = $_POST['customer'] ?? "";
$q3 = $_POST['partNumber'] ?? "";
$q4 = $_POST['itemKey'] ?? "";
$page = $_POST['page'] ?? "";

$sql = "SELECT * FROM `files` WHERE 1";

if (!empty($q1)) $sql .= " AND division = '$q1'";
if (!empty($q2)) $sql .= " AND customer = '$q2'";
if (!empty($q3)) $sql .= " AND partNo = '$q3'";
if (!empty($page)) $sql .= " AND fileType = '$page'";

$sql .= " ORDER BY `fileType` DESC";

$result = mysqli_query($conn, $sql);
if($result){
    $noRows=mysqli_num_rows($result);
    if($noRows>=1){
        echo "<div class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">";
        echo "<table class='text-center mx-auto w-auto' style='background-color: rgb(105, 105, 105)'>";
    echo "<thead><tr><th colspan=".$noRows.">Files</th></tr></thead>";
    echo "<tbody>";
    
    $cellCount=1;
    $lastR=mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result)){
        if($cellCount==0){
            echo "<tr>";
        }
        echo "<td><img width='100px' style='margin: auto;' id='".$row['fileName']."' onclick='showFile(\"".$row['fileName']."\")' src="."'crap.jpg'"."/><br>
        ".$row['fileName']."<br>";
        
        echo "</td>";
        if($cellCount==3 || $cellCount==$lastR){
            echo "</tr>";
            $cellCount=0;
        }
        $cellCount+=1;
    }   
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    }else{
        echo "<p class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">No results found.</p>";
    }   
}else{
    echo "<p class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">No results found.</p>";
}
?>
