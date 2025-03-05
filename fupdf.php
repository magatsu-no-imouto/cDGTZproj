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
$filetype="";
$dateS=date('mdy');
echo $dateS;
echo "<br><br>";
$sql="SELECT * FROM files WHERE fileName='".$fileName."'";
$result=mysqli_query($conn,$sql);
if($row=mysqli_fetch_assoc($result)){
    $customer=$row['customer'];
    $division=$row['division'];
    $partNo=$row['partNo'];
    $lNo=$row['lineNo'];
    $lLead=$row['lineLeader'];
    $filetype=$row['filetype'];
}
$rando=sprintf('%04d', rand(1, 9999));
echo $rando;

$locationA="files/".$filetype."/".$fileName.".pdf";
$locationB="files/".$filetype."/BACK"."/".$fileName."-BACK-".$dateS."-".$rando.".pdf";
echo "<br><br>";
echo "I will now put [".$locationA."] to [".$locationB."]";
echo "<br><br>";
if(copy($locationA,$locationB)){
    echo '<p>viola</p>';
}else{
    echo "error";
}

?>
</body>
</html>