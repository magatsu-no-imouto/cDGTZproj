<html>
<body>
<?php
include(__DIR__ . '/../connecto.php');
session_start();
$user=mysqli_real_escape_string($conn,$_GET['aUser']);
$pass=mysqli_real_escape_string($conn,$_GET['aPass']);

echo "<br>",$user,"<br>";
echo "<br>",$pass,"<br>";

$sql="SELECT * FROM admin WHERE aUser='".$user."'";
$auth=mysqli_query($conn,$sql);
if($row=mysqli_fetch_assoc($auth)){
    if($row['aPass']==$pass){
        echo "<br>welcome dood.<br>";
        $_SESSION['loggedin']=true;
        header("Location: /dgcentre/admin/aHub.php");
        exit;
    }else{
        echo "<script>
            alert('Uh, dood. You sure you\'re him?');
            window.location.href = '/dgcentre/admin/';
        </script>";
        exit;
    }        
}else{
    echo "<script>
            alert('Sorry, dood. You\'re not on the list.');
            window.location.href = '/dgcentre/admin/';
        </script>";
}

?>
I'm supposed to check yer credentials here as a form action...

</body>

</html>