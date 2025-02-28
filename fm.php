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
    <!--[]name of the page selected from Hub-->
    <?php
    $page=$_GET['page'];
    $name="";
    if($page==="wi"){
        $name="Work Instruction";
    }else if($page==="cp"){
        $name="Control Plan";
    }else if($page==="fic"){
        $name="Final Inspection Checkpoints";
    }else if($page==="ps"){
        $name="Product Specifications";
    }else if($page==="md"){
        $name="Material Details";
    }else if($page==="diaor"){
        //[]unsure about what this one means. I'll ask later.
        $name="Daily Individual Aggregate(?) Output Report";
    }else if($page==="dmc"){
        $name="Daily Maintenance Sheet";
    }else if($page==="par"){
        $name="Product Assembly Record";
    }else if($page==="dcior"){
        $name="Daily Crimping Inspection Output Report";
    }

    echo "<h1 class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">".$name."</h1>";
    ?>
    <!-- Search Filters -->
    <div class="row mb-3">
        <form id="fomm" method="post">
        <div class="row">
            <div class="col">
            <label for="divisionSelect" class="form-label" style= "font-weight: bold;">Division:</label>
            <?php
            $q=array();
            $q1="";
            $q2="";
            $q3="";
            $q4="";
            if(isset($_GET['q'])){
                $q=json_decode(urldecode($_GET['q']), true);
            }
            if(!empty($q)){
                
                if($q[0]!=""){
                    $q1=$q[0];
                }
                if($q[1]!=""){
                    $q2=$q[1];
                }
                if($q[2]!=""){
                    $q3=$q[2];
                }
                if($q[3]!=""){
                    $q4=$q[3];
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $q1 = $_POST['division'] ?? "";
                $q2 = $_POST['customer'] ?? "";
                $q3 = $_POST['partNumber'] ?? "";
                $q4 = $_POST['itemKey'] ?? "";
            }

            ?>

            <select name='division' id='divisionSelect' class='form-select'><option></option>
            <?php
            $sql="SELECT divisionName FROM division";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
                if($q1==$row['divisionName']){
                    echo "<option value='" . $row['divisionName'] . "' selected >" . $row['divisionName'] . "</option>";
                }else{
                    echo "<option value='" . $row['divisionName'] . "'>" . $row['divisionName'] . "</option>";
                }
            }
            echo "</select>";
            ?>
        </div>
        
        <div class="col">
            <label for="customerSelect" class="form-label" style= "font-weight: bold;">Customer:</label>
            <?php
            echo "<select name='customer' id='customerSelect' class='form-select'><option></option>";
            $sql="SELECT customerName FROM customer";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
                if($q2==$row['customerName']){
                    echo "<option value='" . $row['customerName'] . "' selected>" . $row['customerName'] . "</option>";
                }else{
                    echo "<option value='" . $row['customerName'] . "'>" . $row['customerName'] . "</option>";}    
            }
            echo "</select>";
            ?>
        </div>
        <div class="col">
            <label for="partNumberSelect" class="form-label" style= "font-weight: bold;">Part Number:</label>            
            <?php
            echo "<select name='partNumber' id='partNumberSelect' class='form-select'><option></option>";
            $sql="SELECT partNo FROM parts";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
                if($q3==$row['partNo']){
                    echo "<option value='" . $row['partNo'] . "' selected >" . $row['partNo'] . "</option>";
                }else{
                    echo "<option value='" . $row['partNo'] . "'>" . $row['partNo'] . "</option>";}                
            }
            echo "</select>";
            ?>
        </div>
        <div class="col">
            <label for="itemKey" class="form-label" style= "font-weight: bold;">Item Key:</label>
            <?php
            if($q4!=""){
                echo "<input id='itemKey' name='itemKey' class='form-control' value='$q4'>";
            }else{
                echo "<input id='itemKey' name='itemKey' class='form-control'>";
            }
            ?>
        </div>
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
    $empy=1;
    if($_POST['division'] != ""){
        $find.="WHERE division='".$_POST['division']."'";
        $empy=0;
    }
    //if value is NOT the first, it adds the AND before the variable
    if($_POST['customer'] != "" && $find==""){
        $find.="WHERE customer='".$_POST['customer']."'";
        $empy=0;
    }else if($_POST['customer'] != ""){
        $find.=" AND customer='".$_POST['customer']."'";
        $empy=0;
    }
    
    if($_POST['partNumber'] != ""  && $find==""){
        $find.="WHERE partNo='".$_POST['partNumber']."'";
        $empy=0;
    }else if($_POST['partNumber'] != ""){
        $find.=" AND partNo='".$_POST['partNumber']."'";
        $empy=0;
    }
    if($_POST['itemKey']!="" && $find==""){
        $find.="WHERE itemKey LIKE '%".$_POST['itemKey']."%'";
        $empy=0;
    }else if($_POST['itemKey']!=""){
        $find.=" AND itemKey LIKE '%".$_POST['itemKey']."%'";
        $empy=0;
    }
    $q[0]=$_POST['division'];
    $q[1]=$_POST['customer'];
    $q[2]=$_POST['partNumber'];
    $q[3]=$_POST['itemKey'];

    $filterQ="WHERE fileType='$page'";
    if($empy==0){
        $filterQ="AND fileType='$page'";
        
    }
    
    //sql query is built and php constructs the html elements
    $sql="SELECT * FROM files $find $filterQ";
    $result=mysqli_query($conn,$sql);
    if($result){
        $noRows=mysqli_num_rows($result);
        if($noRows>=1){
            echo "<div class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">";
            echo "<table class='text-center mx-auto w-auto' style='background-color: rgb(105, 105, 105)'>";
        echo "<thead><tr><th colspan=".$noRows.">Files</th></tr></thead>";
        echo "<tbody>";
        echo "<tr>";
        echo "</div>";
        while($row = mysqli_fetch_array($result)){

            echo "<td><img width='100px' style='margin: auto;' src="."'crap.jpg'"." onclick=\"showFile('".$row['fileName']."-".$page."')\" /><br>
            ".$row['fileName']."
            </td>";
        }   
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        }else{
            echo "<p class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">No results found.</p>";
        }   
    }else{
        echo "<p class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">No results found.</p>";
    }
} else {
    $sql="SELECT * FROM files WHERE fileType='$page'";
    $result=mysqli_query($conn,$sql);
    if($result){
        if($result){
            $noRows=mysqli_num_rows($result);
            if($noRows>=1){
                echo "<div class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">";
                echo "<table class='text-center mx-auto w-auto' style='background-color: rgb(105, 105, 105)'>";
            echo "<thead><tr><th colspan=".$noRows.">Files</th></tr></thead>";
            echo "<tbody>";
            echo "<tr>";
            echo "</div>";
            while($row = mysqli_fetch_array($result)){
    
                echo "<td><img width='100px' style='margin: auto;' src="."'crap.jpg'"." onclick=\"showFile('".$row['fileName']."-".$page."')\" /><br>
                ".$row['fileName']."
                </td>";
            }   
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
            }else{
                echo "<p class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">No results found.</p>";
            }   
        }else{
            echo "<p class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">No results found.</p>";
        }
    }
}
?>
</div>
<div id="fileContainer" class="text-center mt-4">
    <iframe id="fileIframe" style="display:none" width="100%" height="500px"></iframe>
</div>

    <script>
      function showFile(filename) {
        var page2="fm"
        var page=<?php echo "'".$page."'";
        ?>

        var q=<?php echo json_encode($q);
        ?>

        var qE = encodeURIComponent(JSON.stringify(q));
        window.location.replace(`found.php?filename=${filename}&rtrn=${page2}&page=${page}&q=${qE}`)
}

    

    function redirectHub(){
        window.location.replace('centralHub.php')
    }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
