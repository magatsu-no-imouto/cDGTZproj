<html>
<body>
<?php
include('connecto.php');
$fileName=$_GET['id'];
$fileType=$_GET['type'];
echo $fileName,"<br>";
echo $fileType,"<br>";

$sql="DELETE FROM `files` WHERE `fileName`='".$fileName."' AND fileType='".$fileType."'";

echo $sql;

$dir=sprintf('%s/files/'.$fileType,__DIR__);
echo "<br>",$dir,"<br>";
$path=$dir."/".$fileName;

if(file_exists($path)){
    unlink($path);
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "it should be gone now.";
        echo "<script>window.location.replace('fupd.php')</script>";
    }
}else{
    echo "check the code again..";
}
?>

</body>
</html>