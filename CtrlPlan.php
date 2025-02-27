<?php
include("connecto.php");
?>
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
    <!--name of the page selected from Hub-->
    <h1 class="mb-3 text-center py-3" style="background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;">Control Plan</h1>

    <!-- Search Filters -->
    <div class="row mb-3">
        <form method="post" style='width:100%;'>
        <div class="form-group">
            <label for="customerSel" class="form-label" style= "font-weight: bold;">Customer:</label>
            <?php
            echo "<select name='customer' id='divisionSelect' class='form-select'><option></option>";
            $sql="SELECT customerName FROM customer";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
                echo "<option value='" . $row['customerName'] . "'>" . $row['customerName'] . "</option>";
            }
            echo "</select>";
            ?>
        </div>
        <div class="form-group">
            <label for="partNumberSelect" class="form-label" style= "font-weight: bold;">Part Number:</label>            
            <?php
            echo "<select name='partNumber' id='partNumberSelect' class='form-select'><option></option>";
            $sql="SELECT partNo FROM parts";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
                echo "<option value='" . $row['partNo'] . "'>" . $row['partNo'] . "</option>";                
            }
            echo "</select>";
            ?>
            <br>
        </div>
        <div class="col-md-3 d-flex justify-content-center">
            <button name="submit" class="btn btn-primary w-100" style= "font-weight: bold; background-color: rgb(140, 139, 137);">Search</button>
            <button type="button" class="btn btn-primary w-100" style="margin-left: 10px; font-weight: bold; background-color: rgb(140, 139, 137);" onclick="redirectHub()">Back</button>
            </div>
        </div>
        </form>
    </div>

    <div>
    <?php
    //submit button takes the value of the Select
    //and fills $find accordingly to build the parameters.
    //of the SQL
if(isset($_POST['submit'])){
    $find="";
    if($_POST['division'] != ""){
        $find.="division='".$_POST['division']."'";
    }
    //if value is NOT the first, it adds the AND before the variable
    if($_POST['customer'] != "" && $find==""){
        $find.="customer='".$_POST['customer']."'";
    }else if($_POST['customer'] != ""){
        $find.=" AND customer='".$_POST['customer']."'";
    }
    if($_POST['partNumber'] != ""  && $find==""){
        $find.="partNo='".$_POST['partNumber']."'";
    }else if($_POST['partNumber'] != ""){
        $find.=" AND partNo='".$_POST['partNumber']."'";
    }
    //sql query is built and php constructs the html elements
    $sql="SELECT * FROM workinst WHERE ".$find;
    $result=mysqli_query($conn,$sql);
    if($result){
        $noRows=mysqli_num_rows($result);
        if($noRows>=1){
            echo "<table class='text-center table-bordered mx-auto w-auto'>";
        echo "<thead><tr><th colspan=".$noRows.">Files</th></tr></thead>";
        echo "<tbody>";
        echo "<tr>";
        while($row = mysqli_fetch_array($result)){

            echo "<td><img width='100px' style='margin: auto;' src="."'crap.jpg'"." onclick=\"showFile('".$row['filename']."')\" /><br>
            ".$row['filename']."
            </td>";
        }   
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        }else{
            echo "<p class='text-muted'>No results found.</p>";
        }   
    }
} else {
    echo "<p class='text-muted'>Select filters and click 'Search' to view files.</p>";
}
?>

<div id="fileContainer" class="text-center mt-4">
    <iframe id="fileIframe" style="display:none" width="100%" height="500px"></iframe>
</div>

    <script>
      function showFile(filename) {
        window.location.replace(`wi-found.php?filename=${filename}`)
}
    function redirectHub(){
        window.location.replace('centralHub.php')
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
