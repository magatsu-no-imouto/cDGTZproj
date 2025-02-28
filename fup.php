<?php
include("connecto.php");
?>
<!DOCTYPE html>
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
<div class="row mb-3">
        <form action="fupf.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div id="divDivision" class="col">
            <label for="divisionSelect" class="form-label" style= "font-weight: bold;">Division:</label>
            <?php
            $q=array();
            $q1="";
            $q2="";
            $q3="";
            if(!empty($_GET['q'])){
                $q=json_decode(urldecode($_GET['q']), true);
                if($q[0]!=""){
                    $q1=$q[0];
                }
                if($q[1]!=""){
                    $q2=$q[1];
                }
                if($q[2]!=""){
                    $q3=$q[2];
                }                
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $q1 = $_POST['division'] ?? "";
                $q2 = $_POST['customer'] ?? "";
                $q3 = $_POST['partNumber'] ?? "";
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
            <button id="divBTN" type="button" onclick="changeInput('divDivision','divBTN');">new</button>
        </div>
        
        <div id="divCustomer" class="col">
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
            <button id="custBTN" type="button" onclick="changeInput('divCustomer','custBTN');">new</button>
        </div>
        <div id="divParts" class="col">
            <label for="partNumberSelect" class="form-label" style= "font-weight: bold;">Part No:</label>            
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
            <button id="partBTN" type="button" onclick="changeInput('divParts','partBTN');">new</button>
        </div>
        <div class="col">
            <label for="itemKey" class="form-label" style= "font-weight: bold;">Item Key:</label>
            <input id="itemKey" name="itemKey" class="form-control">
        </div>
        <div class="col">
            <label for="fileTypeSel" class="form-label" style= "font-weight: bold;">Doc. Type:</label>
            <select name="fileType" id="fileTypeSel" class="form-select">
                <option value=""></option>
                <option value="wi">Work Instruction</option>
                <option value="cp">Control Plan</option>
                <option value="fic">Final Inspection Check</option>
                <option value="ps">Product Specifications</option>
                <option value="md">Material Details</option>
                <option value="diaor">Daily Individual Aggregate Output Report</option>
                <option value="dmc">Daily Maintenance Checksheet</option>
                <option value="par">Product Assembly Record</option>
                <option value="dcior">Daily Crimping Inspection Output Report</option>
            </select>
        </div>
    </div>
        <div class="col-md-3 d-flex justify-content-center">
            <button name="submit" class="btn btn-primary w-100" style= "font-weight: bold; background-color: rgb(140, 139, 137);">Upload</button>
            <button type="button" class="btn btn-primary w-100" style="margin-left: 10px; font-weight: bold; background-color: rgb(140, 139, 137);" onclick="redirectHub()">Back</button>
        </div>
        <input type="file" name="file" id="fileInput" class="form-control">    
</form>
    </div>
</body>
<script>
    function redirectHub(){
        window.location.replace('centralHub.php')
    }

    function changeInput(fieldId,btnID) {
    var container = document.getElementById(fieldId);
    var selectElement = container.querySelector("select");
    if (selectElement) {
        var inputElement = document.createElement("input");
        inputElement.type = "text";
        inputElement.id=selectElement.id;
        inputElement.name = selectElement.name;
        inputElement.className = "form-control";
        inputElement.value = selectElement.value;

        container.replaceChild(inputElement, selectElement);

    }
    if(fieldId==="divCustomer"){
        var inputElement2 = document.createElement("input");
        container.id="divCustom";
        inputElement2.type = "text";
        inputElement2.name = "custShort";
        inputElement2.className = "form-control mt-2";
        container.appendChild(inputElement2);
    }
    var button=document.getElementById(btnID);
    button.hidden=true;
}


</script>
</html>