<html>
<body>

<?php
include("connecto.php");
echo print_r($_POST);
$fileType= $_POST['fileType'];
$rawFile=$_FILES['file']['name'];
echo $rawFile;
$fileExt=substr($rawFile,strpos($rawFile,"."));
echo "<p>".$fileExt."</p>";
$customer=$_POST['customer'];
$custShort="";
$division=$_POST['division'];
$partNo=$_POST['partNumber'];
$itemKey=$_POST['itemKey'];
$date=date('m/d/Y');

$sqla="SELECT * FROM customer";
$sqlb="SELECT divisionName FROM division";
$sqlc="SELECT partNo FROM parts";

$finda=mysqli_query($conn,$sqla);
$countA=0;
while($row=mysqli_fetch_assoc($finda)){
    if($customer==$row['customerName']){
        $custShort=$row['customerShort'];
        $countA=0;
        break;
    }
    $countA+=1;
}
if($countA>=1){
    $custShort=$_POST['custShort'];
    $sqlaa="INSERT INTO `customer`(`customerName`,`customerShort`,`dateAdded`) VALUES ('$customer','$custShort','$date')";
    echo "<p>$sqlaa</p>";
    $sqlaf=mysqli_query($conn,$sqlaa);
    if($sqlaf){
        echo "<p>customer database updated</p>";
    }else{
        echo "<p>customer database error</p>";
    }
}

$findb=mysqli_query($conn,$sqlb);
$countB=0;
while($row=mysqli_fetch_assoc($findb)){
    if($division==$row['divisionName']){
        $countB=0;
        break;
    }
    $countB+=1;
}

if($countB>1){
    $sqlbb="INSERT INTO `division`(`divisionName`,`dateAdded`) VALUES ('$division','$date')";
    $sqlbf=mysqli_query($conn,$sqlbb);
    if($sqlbf){
        echo "<p>division database updated</p>";
    }else{
        echo "<p>division database error</p>";
    }
}

$findc=mysqli_query($conn,$sqlc);
$countC=0;
while($row=mysqli_fetch_assoc($findc)){
    if($partNo==$row['partNo']){
        $countC=0;
        break;
    }
    $countC+=1;
}

if($countC>1){
    $sqlcc="INSERT INTO `parts`(`partNo`,`dateAdded`) VALUES ('$partNo','$date')";
    $sqlcf=mysqli_query($conn,$sqlcc);
    if($sqlcf){
        echo "<p>Parts database updated</p>";
    }else{
        echo "<p>Parts database error</p>";
    }
}
$fileName="f-".$custShort."-".$partNo."".$itemKey;

$sql = "INSERT INTO `files` (`division`, `customer`, `partNo`, `itemKey`, `lineNo`, `lineLeader`, `fileName`, `filetype`) 
        VALUES ('$division', '$customer', '$partNo', '$itemKey','', '', '$fileName', '$fileType')";

$result = mysqli_query($conn, $sql);
if($result){
    echo "<p>file database updated</p>";
    echo "<script>window.location.replace('fup.php')</script>";
}else{
    echo "<p>file database error</p>";
}
echo "<p>".$_FILES['file']['tmp_name']."</p>";
$location="files/".$fileType."/".$fileName."-".$fileType."".$fileExt;
if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    echo '<p>File Uploaded</p>';
}else{
    echo "error";
}

?>
</body>
</html>