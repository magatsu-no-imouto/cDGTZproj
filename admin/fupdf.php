<html>
<?php
session_start();
?>
<body>

<?php
include(__DIR__ . '/../connecto.php');
echo "form";
echo print_r($_POST);
echo "<br><br>";
echo print_r($_FILES);
$fileName=$_POST['selFile'];
if ($_FILES['files']['error'] !== UPLOAD_ERR_OK) {
    echo "Upload Error: " . $_FILES['pdf_file']['error'];
} else {
    echo "File uploaded successfully!";
}
echo "<br><br>";
echo $fileName;
echo "<br><br>";
$setto="";
$division="";
$nuDivision="";
$customer="";
$custShort="";
$nuCustomer="";
$partNo="";
$nuPartNo="";
$lineNo="";
$nuLineNo="";
$lineLead="";
$nuLineLead="";
$itemKey="";
$nuItemKey="";
$fileType="";
$nuFileType="";
$change="";
if($_POST['division']){
    if($setto==""){
        $setto.=" `division`='".$_POST['division']."'";
    }
    $nuDivision=$_POST['division'];
}
if($_POST['customer']){
    if($setto!=""){
        $setto.=", `customer`='".$_POST['customer']."'";
    }else{
        $setto.=" `customer`='".$_POST['customer']."'";
    
    }
    $nuCustomer=$_POST['customer'];
}
if($_POST['partNumber']){
    if($setto!=""){
        $setto.=", `partNo`='".$_POST['partNumber']."'";
    }else{
        $setto.=" `partNo`='".$_POST['partNumber']."'";
    }
    $nuPartNo=$_POST['partNumber'];
    
}
if($_POST['lineNo']){
    if($setto!=""){
        $setto.=", `lineNo`='".$_POST['lineNo']."'";
    }else{
        $setto.=" `lineNo`='".$_POST['lineNo']."'";
    }
    $nuLineNo=$_POST['lineNo'];
}
if($_POST['lineLead']){
    if($setto!=""){
        $setto.=", `lineLeader`='".$_POST['lineLead']."'";
    }else{
        $setto.=" `lineLeader`='".$_POST['lineLead']."'";
    }
    $nuLineLead=$_POST['lineLead'];
}
if($_POST['itemKey']){
    if($setto!=""){
        $setto.=", `itemKey`='".$_POST['itemKey']."'";
    }else{
        $setto.=" `itemKey`='".$_POST['itemKey']."'";
    }
    $nuItemKey=$_POST['itemKey'];
    
}
if($_POST['fileType']){
    if($setto!=""){
        $setto.=", `fileType`='".$_POST['fileType']."'";
    }else{
        $setto.=" `fileType`='".$_POST['fileType']."'";
    }
    $nuFileType=$_POST['fileType'];
    }
echo "<br>",$setto,"<br>";
$ogIKey="";
$dateS=date('mdy');
$dateA=date('m/d/y');
$sql="SELECT * FROM files WHERE fileName='".$fileName."'";
$result=mysqli_query($conn,$sql);
if($row=mysqli_fetch_assoc($result)){
    $fileType=$row['fileType'];
    echo "[DIVISION]<br>";
    if($nuDivision=="" || ($row['division'] == $nuDivision && $row['division']!="")){
        $nuDivision=$row['division'];
        echo "retained:",$nuDivision,"<br>";
    }else{
        echo "original: ",$row['division'],"<br>";
        echo "changing: ",$nuDivision,"<br>";
    }
    echo "<br>[CUSTOMER]<br>";
    if( $nuCustomer=="" && ($row['customer']!="" || $nuCustomer==$row['customer'])){
        $nuCustomer=$row['customer'];
        echo "retained: ",$nuCustomer,"<br>";
    }else{
        echo "original: ",$row['customer'],"<br>";
        echo "changing: ",$nuCustomer,"<br>";
        $change="NOW";
    }
    echo "<br>[PART NUMBER]<br>";
    if( $nuPartNo=="" && ($row['partNo']!="" ||$nuPartNo==$row['partNo'])){
        $nuPartNo=$row['partNo'];
        echo "retained: ",$nuPartNo,"<br>";
    }else{
        echo "original: ",$row['partNo'],"<br>";
        echo "changing: ",$nuPartNo,"<br>";
        $change="NOW";
    }
    echo "<br>[LINE #]<br>";
    if(($nuLineNo==$row['lineNo'] || $row['lineNo']!="") &&  $nuLineNo==""){
        $nuLineNo=$row['lineNo'];
        echo "retained: ",$nuLineNo,"<br>";
    }else{
        echo "original: ",$row['lineNo'],"<br>";
        echo "changing: ",$nuLineNo,"<br>";
        $change="NOW";
    }
    echo "<br>[LINE LEADER]<br>";
    if(($nuLineLead==$row['lineLeader'] || $row['lineLeader']!="" ) && $nuLineLead==""){
        $nuLineLead=$row['lineLeader'];
        echo "retained: ",$nuLineLead,"<br>";
    }else{
        echo "original: ",$row['lineLeader'],"<br>";
        echo "changing: ",$nuLineLead,"<br>";
        $change="NOW";
    }
    echo "<br>[ITEM KEY]<br>";
    if(($nuItemKey==$row['itemKey'] || $row['itemKey']!="") && $nuItemKey=="" ){
        $nuItemKey=$row['itemKey'];
        echo "retained: ",$nuItemKey,"<br>";
    }else{
        echo "original: ",$row['itemKey'],"<br>";
        $ogIKey=$row['itemKey'];
        echo "changing: ",$nuItemKey,"<br>";
        $change="NOW";
    }
    echo "<br>[FILE TYPE]<br>";
    if($nuFileType=="" && ($nuFileType==$row['fileType'] || $row['fileType']!="")){
        $nuFileType=$row['fileType'];
        echo "retained: ",$nuFileType,"<br>";
        
    }else{
        echo "original: ",$row['fileType'],"<br>";
        echo "changing: ",$nuFileType,"<br>";
        $change="NOW";
    }
}
$nuItemKeyF="";
$nuFileName="";
$iKeyParts="";
if($change=="NOW"){
    $sql="SELECT * FROM customer WHERE customerName='$nuCustomer'";
    $result=mysqli_query($conn,$sql);
    $nuCustShort="";
    if($result){
        $row=mysqli_fetch_assoc($result);
        $nuCustShort=$row['customerShort'];
        echo $nuCustShort;
    }
    echo "<br> CHANGE, NOW-- <br>";
    if(str_contains($nuItemKey,"f")){
        $iKeyParts=explode('-',$nuItemKey);
    }else{
        $iKeyParts=array("f",$nuCustShort,$nuItemKey);
    }
    $iKeyCandidates=array("f",$nuCustShort,$nuItemKey);
    echo print_r($iKeyCandidates);
    for($i=1; $i<count($iKeyParts);$i++){
        if($iKeyParts[$i]!=$iKeyCandidates[$i] && !str_contains($iKeyCandidates[$i],"f-")){
            $iKeyParts[$i]=$iKeyCandidates[$i];
        }
    }
    echo print_r($iKeyParts);
    echo "<br>",count($iKeyParts);
    if(count($iKeyParts)>=4){
        $scoopah="";
        for($i=2; $i<count($iKeyParts);$i++){
            if($i>2){
                $scoopah.="-".$iKeyParts[$i];
            }else{
                $scoopah.=$iKeyParts[$i];
            }
            
        }
        $iKeyParts[2]=$scoopah;
    }

    $nuItemKeyF=sprintf("%s-%s-%s",$iKeyParts[0],$iKeyParts[1],$iKeyParts[2]);
    echo "<br>new Item Key:",$nuItemKeyF,"<br>";
    $setto.=", `itemKey`='".$nuItemKeyF."'";
    $nuFileName=sprintf("%s %s %s.pdf",$nuItemKeyF,$nuPartNo,$nuFileType);
    echo "<br>new File Name: ",$nuFileName,"<br>";
    $setto.=", `fileName`='".$nuFileName."'";
}


$rando=sprintf('%04d', rand(1, 9999));
echo $rando;

$locationA=__DIR__ ."/../files/".$fileType."/".$fileName;
$fileNameB=str_replace(".pdf","",$fileName);
$locationB=__DIR__ ."/../files/".$fileType."/BACK"."/".$fileNameB."-BACK-".$dateS."-".$rando.".pdf";
echo "<br><br>";
echo "I will now put [".$locationA."] to [".$locationB."]";
if(copy($locationA,$locationB)){
    echo '<p>viola. Now to claim the original file as my own:</p>';
    if($_FILES['files']['size'] != 0){
        if(move_uploaded_file($_FILES['files']['tmp_name'],$locationA)){
            echo 'awright<br>';  
        }
    }
}else{
    echo "error";
}
$locationC1=sprintf("%s/../files/%s/%s",__DIR__,$fileType,$nuFileName);
$locationC2=sprintf("%s/../files/%s/%s",__DIR__,$nuFileType,$nuFileName);
echo "<br>if fileType==nuFileType, ",$locationC1,"<br>";
echo "otherwise, ",$locationC2,"<br>";
$sql="UPDATE files SET `dateAdded`='".$dateA."', ".$setto." WHERE `fileName`='".$fileName."'";
echo "<br>",$sql,"<br>";
$results=mysqli_query($conn,$sql);
if(!$results){
    echo "error ".mysqli_error($conn);
}
$update="";
$whichIs="";
if($fileType==$nuFileType){
$update=rename($locationA,$locationC1);
$whichIs="SAME";
}else{
$update=copy($locationA,$locationC2);
$whichIs="DIFFERENT";
}

if($whichIs=="SAME" && $update){
echo "file renamed.";
#echo "<script>window.location.replace('fupd.php')</script>";
}else if($whichIs=="DIFFERENT" && $update){
unlink($locationA);
echo "file moved.";
#echo "<script>window.location.replace('fupd.php')</script>";
}else{
echo "ERROR.";
}

?>
</body>
</html> 