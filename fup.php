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
            $q4="";
            $q5="";
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
                if($q[3]!=""){
                    $q4=$q[3];
                }
                if($q[4]!=""){
                    $q5=$q[4];
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
        <div id="divLNo" class="col">
            <label for="lineNoSelect" class="form-label" style= "font-weight: bold;">Line No:</label>            
            <?php
            echo "<select name='lineNo' id='lineNoSelect' class='form-select' onchange='selLLead()'><option></option>";
            $sql="SELECT lNo, COUNT(lNo) AS frequency FROM `lineleaders` GROUP BY lNo ORDER BY `lineleaders`.`lNo` ASC;";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
                if($q4==$row['lNo']){
                    echo "<option value='" . $row['lNo'] . "' selected >" . $row['lNo'] . "</option>";
                }else{
                    echo "<option value='" . $row['lNo'] . "'>" . $row['lNo'] . "</option>";}                
            }
            echo "</select>";
            ?>
            <button id="lNoBTN" type="button" onclick="changeInput('divLNo','lNoBTN');">new</button>
        </div>
        <div id="divLLead" class="col">
        <label for="lineLeadSelect" class="form-label" style= "font-size:10px;font-weight: bold;">Line Leader:</label>            
            <?php
            echo "<select name='lineLead' id='lineLeadSelect' class='form-select' onchange='selLNoSel()'><option></option>";
            $sql="SELECT lLead FROM lineLeaders";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
                if($q5==$row['lLead']){
                    echo "<option value='" . $row['lLead'] . "' selected >" . $row['lLead'] . "</option>";
                }else{
                    echo "<option value='" . $row['lLead'] . "'>" . $row['lLead'] . "</option>";}                
            }
            echo "</select>";
            ?>
            <button id="lLeadBTN" type="button" onclick="changeInput('divLLead','lLeadBTN');">new</button>
        </div>
        <div class="col">
            <label for="itemKey" class="form-label" style= "font-size:14px;font-weight: bold;">Item Key:</label>
            <input id="itemKey" name="itemKey"  maxlength="7" oninput="formatIK(this)"  class="form-control">
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

    <?php
    
?>


</body>
<script>
    function redirectHub(){
        window.location.replace('centralHub.php')
    }

    document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form").addEventListener("submit", validateForm);
});

function selLLead(){
    let lNo=document.getElementById('lineNoSelect').value;
    let lLeadSel=document.getElementById('lineLeadSelect');


    let xhr=new XMLHttpRequest();
    xhr.open("GET","fetchlldrs.php?lNo="+encodeURIComponent(lNo),true);
    xhr.onload=function(){
        if(this.status===200){
            let data = JSON.parse(this.responseText);
            lLeadSel.innerHTML = "<option></option>";  // Reset dropdown
            data.forEach(function(leader) {
                let option = document.createElement("option");
                option.value = leader;
                option.textContent = leader;
                lLeadSel.appendChild(option);
            });
        }
    }
    xhr.send();
}

function selLNoSel() {
    let lLead = document.getElementById('lineLeadSelect').value;  // Get selected Line Leader
    let lNoSelect = document.getElementById('lineNoSelect');      // Get Line Number dropdown

    if (lLead === "") {
        lNoSelect.value = ""; // Reset dropdown if no Line Leader is selected
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "fetchlNo.php?lLead=" + encodeURIComponent(lLead), true);
    xhr.onload = function () {
        if (this.status === 200) {
            let data = JSON.parse(this.responseText);
            
            if (data.length > 0) {
                // Auto-select the first Line Number if available
                lNoSelect.value = data[0];
                
            }
        }
    };
    xhr.send();
}


function formatIK(input) {
    let value = input.value; 
    let numVal=0;
    for(let i=0;i<value.length;i++){
        if(parseInt(value[i]) || value[i]==0){
            numVal+=1;
           
        }else{
           
        }
    }
    if (numVal>4 && numVal==value.length) {
        input.value = value.slice(0, 4) + '-' + value.slice(4);
    }
}

function validateForm(event) {
    let error = false;
    let messages = [];

    let division = document.querySelector("[name='division']").value;
    let customer = document.querySelector("[name='customer']").value;
    let partNumber = document.querySelector("[name='partNumber']").value;
    let lNo=document.querySelector("[name='lineNo']").value;
    let lLead=document.querySelector("[name='lineLead']").value;
    let itemKey = document.querySelector("[name='itemKey']").value;
    let fileType = document.querySelector("[name='fileType']").value;
    let fileInput = document.querySelector("[name='file']");

    if (division === "") messages.push("Please select Division.");
    if (customer === "") messages.push("Please select Customer.");
    if (partNumber === "") messages.push("Please select Part Number.");
    if (fileType === "") messages.push("Please select Document Type.");
    if (lNo==="") messages.push("Please select Line Number.");
    if (lLead==="") messages.push("Please select Line Leader.");
    let itemKeyPattern = /^\d{4}-\d{1}$/;  
    if (!itemKeyPattern.test(itemKey)) {
        messages.push("Invalid Key: Format must be 4 digits, a hyphen, and 1 digit (e.g., 1234-5).");
    }

    if (fileInput.files.length === 0) {
        messages.push("Please select a file.");
    } else {
        let fileName = fileInput.files[0].name;
        let fileExtension = fileName.split('.').pop().toLowerCase();
        if (fileExtension !== 'pdf') {
            messages.push(`Invalid File: ${fileName} is not a PDF.`);
        }
    }

    if (messages.length > 0) {
        alert(messages.join("\n"));
        event.preventDefault();
    }
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