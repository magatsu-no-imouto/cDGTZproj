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
        <button style="width:50%; height:10vh;" onclick="window.location.replace('wi.php')">BACK</button>
        <button style="width:49%; height:10vh;" onclick="window.location.replace('centralHub.php')">HOME</button>
        <br>
        <?php 
        $file=$_GET['filename'];
        echo "<iframe src=\"files/$file.pdf\" style=\"height:90vh; width:100%; border:none;\"></iframe>";
?>
    </body>
</html>