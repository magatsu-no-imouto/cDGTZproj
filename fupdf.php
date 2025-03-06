<html>
<body>

<?php
include("connecto.php");
echo "form";
echo print_r($_POST);
echo "<br><br>";
echo print_r($_FILES);
$fileName=$_POST['selFile'];
echo "<br><br>";
echo $fileName;
echo "<br><br>";

$customer="";
$custShort="";
$division="";
$partNo="";
$lNo="";
$lLead="";
$itemKey="";
$fileType="";
$dateS=date('mdy');
$dateA=date('m/d/y');

$sql="SELECT * FROM files WHERE fileName='".$fileName."'";
$result=mysqli_query($conn,$sql);
if($row=mysqli_fetch_assoc($result)){
    $fileType=$row['fileType'];
}
$rando=sprintf('%04d', rand(1, 9999));
echo $rando;

$locationA="files/".$fileType."/".$fileName;
$locationB="files/".$fileType."/BACK"."/".$fileName."-BACK-".$dateS."-".$rando.".pdf";
echo "<br><br>";
echo "I will now put [".$locationA."] to [".$locationB."]";
echo "<br><br>";
if(copy($locationA,$locationB)){
    echo '<p>viola. Now to claim the original file as my own:</p>';
    if( move_uploaded_file($_FILES['file']['tmp_name'],$locationA)){
    echo '<script>window.location.replace(\'fupd.php\')</script>';  
    }
}else{
    echo "error";
}

$sql="UPDATE files SET dateAdded=".$dateA." WHERE fileName=".$fileName;
?>
</body>
</html> 