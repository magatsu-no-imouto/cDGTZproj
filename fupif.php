<html>
<body>

<?php
include("connecto.php");

if (!isset($_POST['fileType'], $_FILES['file'], $_POST['customer'], $_POST['division'], $_POST['partNumber'], $_POST['lineNo'], $_POST['lineLead'], $_POST['itemKey'])) {
    die("Missing form data!");
}

$fileType = mysqli_real_escape_string($conn, $_POST['fileType']);
$rawFile=$_FILES['file']['name'];
$fileExt = pathinfo($rawFile,PATHINFO_EXTENSION);
echo $fileExt,"<br>";
$customer= mysqli_real_escape_string($conn, $_POST['customer']);
$custShort="";
$division=mysqli_real_escape_string($conn, $_POST['division']);
$partNo=mysqli_real_escape_string($conn, $_POST['partNumber']);
$lNo=mysqli_real_escape_string($conn, $_POST['lineNo']);
$lLead=mysqli_real_escape_string($conn, $_POST['lineLead']);
$itemKey=mysqli_real_escape_string($conn, $_POST['itemKey']);
$date=date('m/d/Y');


$sqla="SELECT * FROM customer WHERE customerName='".$customer."'";
$sqlb="SELECT * FROM division WHERE divisionName='".$division."'";
$sqlc = "SELECT * FROM parts WHERE partNo = '$partNo'";
$sqld = "SELECT * FROM lineleaders WHERE lLead = '$lLead'";

$finda=mysqli_query($conn,$sqla);
if($row=mysqli_fetch_assoc($finda)){
    $custShort=$row['customerShort'];
}else{
    if(!isset($_POST['custShort'])){
        die("NO CUSTOMER ACRONYM");
    }
    $custShort=mysqli_real_escape_string($conn,$_POST['custShort']);
    $sqlaa="INSERT INTO `customer`(`customerName`,`customerShort`,`dateAdded`) VALUES ('$customer','$custShort','$date')";
    $sqlaf=mysqli_query($conn,$sqlaa);
    if($sqlaf){
        echo "<p>customer database updated</p>";
    }else{
        echo "<p>customer database error</p>";
    }
}

$findb=mysqli_query($conn,$sqlb);
$cData[$custShort]=$customer;
$cJSON=json_encode($cData);
$sqlbb="";
if(!$q=mysqli_fetch_assoc($findb)){
    $sqlbb="INSERT INTO `division`(`divisionName`,`customers`,`dateAdded`) VALUES ('$division','$cJSON','$date')";
    
}else{
    echo print_r($q);
    $qCust=json_decode($q['customers'],true);
    $nCust="";
    if(!in_array($customer,$qCust)){
        $qCust[$custShort]=$customer;
        $nCust=json_encode($qCust);
        $sqlbb="UPDATE `division` SET `customers`='".$nCust."' WHERE `divisionName`='".$division."'";
    }
}
if(!$sqlbb==""){
$sqlbf=mysqli_query($conn,$sqlbb);
    if($sqlbf){
        echo "<p>division database updated</p>";
    }else{
        echo "<p>division database error</p>";
        }
    }
$findc=mysqli_query($conn,$sqlc);
if(!mysqli_fetch_assoc($findc)){
    $sqlcc="INSERT INTO `parts`(`partNo`,`dateAdded`) VALUES ('$partNo','$date')";
    $sqlcf=mysqli_query($conn,$sqlcc);
    if($sqlcf){
        echo "<p>Parts database updated</p>";
    }else{
        echo "<p>Parts database error</p>";
    }
}

$findd=mysqli_query($conn,$sqld);
if(!mysqli_fetch_assoc($findd)){
    $sqldd="INSERT INTO `lineleaders`(`lNo`,`lLead`,`dateAdded`) VALUES('$lNo','$lLead','$date')";
    $sqldf=mysqli_query($conn,$sqldd);
    if($sqldf){
        echo "<p>Line Leader database updated</p>";
    }else{
        echo "<p>Line Leader database error</p>";
    }
}

$pItemKey="f-".$custShort."-".$itemKey;
$fileName=$pItemKey." ".$partNo." $fileType";

$sql = "INSERT INTO `files` (`division`, `customer`, `partNo`, `itemKey`, `lineNo`, `lineLeader`, `fileName`, `filetype`,`dateAdded`) 
        VALUES ('$division', '$customer', '$partNo', '$pItemKey','$lNo', '$lLead', '$fileName.pdf', '$fileType','$date')";

$result = mysqli_query($conn, $sql);
if($result){
    echo "<p>file database updated</p>";
    echo "<script>window.location.replace('fupd.php')</script>";
}else{
    echo "<p>file database error</p>";
}

$location="files/".$fileType."/".$fileName.".".$fileExt;
if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    echo '<p>File Uploaded</p>';
}else{
    echo "error";
}



?>
</body>
</html>