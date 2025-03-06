<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="hepc.jpg" type="image/x-icon">
    <title>File Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>

    body{

        background-color: rgb(74, 96, 128);
        color: white;
    }
</style>
<body class="container mt-4">
        <?php
        /*
        Weird bug found; when file becomes update, the file viewer would display the older file instead of the newer file.
        Known solutions:
        -restarting server
        -deleting cache
        -switching to EDGE seems to work better tho....but it mucks up the code. it's best not to change it.
        */ 
        $rtrn=$_GET['rtrn'];
        $page=$_GET['page'];
        $q=json_decode(urldecode($_GET['q']), true);
        $q2=json_encode($q);
        $qE = urlencode($q2);
        echo "<button style=\"width:50%; height:10vh;\" onclick=\"window.location.replace('".$rtrn.".php?page=".$page."&q=".$qE."')\">BACK</button>";?>
        <button style="width:49%; height:10vh;" onclick="window.location.replace('centralHub.php')">HOME</button>
        
        <br>
        <?php 
        $file=$_GET['filename'];
        echo "<iframe src=\"files/$page/$file\" style=\"height:90vh; width:100%; border:none;\"></iframe>";
?>
    </body>
</html>