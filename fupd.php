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
    
    .heldfile{
        border: 3px solid black;
        
    }
    .heldfile:hover{
        border: 4px dashed red;
        border-radius: 5px;
        cursor:pointer;
    }
    .heldBTN{
        border:none;
        border-radius: 5px 10px;
        margin-bottom:5px;
    }
    .heldBTN:hover{
        background-color: red;
    }
</style>
<body class="container mt-4">
<h1 class="mb-3 text-center py-3" style="background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;">UPDATE A FILE</h1>
<div class="row mb-3">
        <form id="fom" action="test.php" method="post" enctype="multipart/form-data">
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
            $q6="";
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
                if($q[4]!=""){
                    $q5=$q[4];
                }
                if($q[5]!=""){
                    $q6=$q[5];
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $q1 = $_POST['division'] ?? "";
                $q2 = $_POST['customer'] ?? "";
                $q3 = $_POST['partNumber'] ?? "";
                $q4 = $_POST['itemKey'] ?? "";
                $q5 = $_POST['lNo']?? "";
                $q6 = $_POST['lLead']?? "";
            }


            ?>
            <select name='division' id='divisionSelect' class='form-select' onchange="changeSelFunc('FIND')"><option></option>
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
            echo "<select name='customer' id='customerSelect' class='form-select' onchange='changeSelFunc(\"FIND\")'><option></option>";
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
            echo "<select name='partNumber' id='partNumberSelect' onchange='changeSelFunc(\"FIND\")' class='form-select'><option></option>";
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
            <input id="itemKey" name="itemKey"  maxlength="4" oninput="changeSelFunc('FIND')" class="form-control">
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
        <input type="file" name="file" id="fileInput" onchange="changeSelFunc('INSERT')" class="form-control">    
        </div>
        <input name="selFile" id="selectedFile" class="form-control" >
        <input name="selFunction" id="selFunction" class="form-control" value="INSERT" readonly>
        <div class="col-md-3 d-flex justify-content-center">
            <button name="submit" id="submitBTN" type="submit" class="btn btn-primary w-100" style= "font-weight: bold; background-color: rgb(140, 139, 137);">Find</button>
            <button type="button" class="btn btn-primary w-100" style="margin-left: 10px; font-weight: bold; background-color: rgb(140, 139, 137);" onclick="redirectHub()">Back</button>
        </div>
    
    </div>
<?php
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
    if($_POST['lineNo']!="" && $find==""){
        $find.="WHERE lineNo='".$_POST['lineNo']."'";
        $empy=0;
    }else if($_POST['lineNo']!=""){
        $find.=" AND lineNo='".$_POST['lineNo']."'";
        $empy=0;
    }
    if($_POST['lineLead']!="" && $find==""){
        $find.="WHERE lineLeader='".$_POST['lineLead']."'";
        $empy=0;
    }else if($_POST['lineLead']!=""){
        $find.=" AND lineleader='".$_POST['lineLead']."'";
        $empy=0;
    }
    $q[0]=$_POST['division'];
    $q[1]=$_POST['customer'];
    $q[2]=$_POST['partNumber'];
    $q[3]=$_POST['itemKey'];
    $q[4]=$_POST['lineNo'];
    $q[5]=$_POST['lineLead'];

    $filterQ="WHERE fileType='".$_POST['fileType']."'";
    if($empy==0){
        $filterQ="AND fileType='".$_POST['fileType']."'";
        
    }
    if($_POST['fileType']==""){
        $filterQ="";
    }
    //sql query is built and php constructs the html elements
    $sql="SELECT * FROM files $find $filterQ";
    echo $sql;
    $result=mysqli_query($conn,$sql);
    if($result){
        $noRows=mysqli_num_rows($result);
        if($noRows>=1){
            echo "<div class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">";
            echo "<table class='text-center mx-auto w-auto' style='background-color: rgb(105, 105, 105)'>";
        echo "<thead><tr><th colspan=".$noRows.">Files</th></tr></thead>";
        echo "<tbody>";
        echo "</div>";
        $cellCount=1;
        $lastR=mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)){
            if($cellCount==0){
                echo "<tr>";
            }
            echo "<td><img width='100px' style='margin: auto;' src="."'crap.jpg'"." class='heldfile'/><br>
            ".$row['fileName']."-<br>";
            echo "<button class='heldBTN'>trash</button> <button class='heldBTN'>update</button>";
            echo "</td>";
            if($cellCount==4 || $cellCount==$lastR){
                echo "</tr>";
                $cellCount=0;
            }
            $cellCount+=1;
        }   
        echo "</tbody>";
        echo "</table>";
        }else{
            echo "<p class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">No results found.</p>";
        }   
    }else{
        echo "<p class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">No results found.</p>";
    }
} else {
    $sql="";
    if(!empty($q)){
        $find="";
        $empy=1;
        if($q1!=""){
            $find="WHERE division='".$q1."'";
            $empy=0;
        }
        if($q2!="" && $find==""){
            $find="WHERE customer='".$q2."'";
            $empy=0;
        }else if($q2!=""){
            $find.=" AND customer='".$q2."'";
            $empy=0;
        }
        if($q3!="" && $find==""){
            $find="WHERE partNo='".$q3."'";
            $empy=0;
        }else if($q3!=""){
            $find.=" AND partNo='".$q3."'";
            $empy=0;
        }
        if($q4!="" && $find==""){
            $find.="WHERE itemKey LIKE '%".$q4."%'";
            $empy=0;
        }else if($q4!=""){
            $find.=" AND itemKey LIKE '%".$$q4."%'";
            $empy=0;
        }
        if($q5!="" && $find==""){
            $find="WHERE lineNo='".$q5."'";
            $empy=0;
        }else if($q5!=""){
            $find.=" AND lineNo='".$q5."'";
            $empy=0;
        }
        if($q6!="" && $find==""){
            $find.="WHERE lineLeader='".$q6."'";
            $empy=0;
        }else if($q6!=""){
            $find.=" AND lineleader='".$q6."'";
            $empy=0;
        }
        $q[0]=$q1;
        $q[1]=$q2;
        $q[2]=$q3;
        $q[3]=$q4;
        $q[4]=$q5;
        $q[5]=$q6;
    
        $filterQ="WHERE fileType='$page'";
        if($empy==0){
            $filterQ="AND fileType='$page'";
        }
        $sql="SELECT * FROM files $find $filterQ";
    }else{
        $sql="SELECT * FROM files ORDER BY `filetype` DeSC";
    }
    $result=mysqli_query($conn,$sql);
    if($result){
        $noRows=mysqli_num_rows($result);
        if($noRows>=1){
            echo "<div class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">";
            echo "<table class='text-center mx-auto w-auto' style='background-color: rgb(105, 105, 105)'>";
        echo "<thead><tr><th colspan=".$noRows.">Files</th></tr></thead>";
        echo "<tbody>";
        echo "</div>";
        $cellCount=1;
        $lastR=mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)){
            if($cellCount==0){
                echo "<tr>";
            }
            echo "<td><img width='100px' style='margin: auto;' id='".$row['fileName']."' onclick='selectFile(\"".$row['fileName']."\",this)' src="."'crap.jpg'"." class='heldfile' /><br>
            ".$row['fileName']."<br>";
            echo "<button class='heldBTN'>trash</button>";
            echo "<button class='heldBTN'>update</button>";
            echo "</td>";
            if($cellCount==4 || $cellCount==$lastR){
                echo "</tr>";
                $cellCount=0;
            }
            $cellCount+=1;
        }   
        echo "</tbody>";
        echo "</table>";
        }else{
            echo "<p class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">No results found.</p>";
        }   
    }else{
        echo "<p class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">No results found.</p>";
    }
}
?>
</form>



</body>
<script>

let prevID

function changeSelFunc(COMMANDO){
    var selectFunction=document.getElementById('selFunction');
    var please=COMMANDO;
    var submBTN=document.getElementById('submitBTN')
    var divSel=document.getElementById('divisionSelect')
    var custSel=document.getElementById('customerSelect')
    var partNoSel=document.getElementById('partNumberSelect')
    var lineNoSel=document.getElementById('lineNoSelect')
    var lineLdSel=document.getElementById('lineLeadSelect')
    var itemKey=document.getElementById('itemKey')
    var fileInp=document.getElementById('fileInput')
    var fileSel=document.getElementById('selectedFile')
    var x=(divSel.value!="" || custSel.value!="" || partNoSel.value!="" || lineNoSel.value!="" || lineLdSel.value!="" || itemKey.value!="");
    var y=(fileInput.files.length !=0)
    var z=(fileSel.value!="")
    console.log("filters: "+x+"\nnewfile: "+y+"\nselected file: "+z+"\ntrigger: "+please);
    var a=true;
    var b=false;
    console.log((x==a && y==b && z==b))
    
    if(COMMANDO=="FIND"){
        document.getElementById("fom").removeAttribute('action')
        document.getElementById("fom").removeAttribute('enctype')
        submBTN.innerHTML="FIND"
    }else if(COMMANDO=="INSERT"){
        document.getElementById("fom").setAttribute('action','fupf.php');
        document.getElementById("fom").setAttribute('enctype','multipart/form-data');
        submBTN.innerHTML="UPLOAD"
    }else if(COMMANDO=="UPDATE"){
        document.getElementById("fom").setAttribute('action','fupdf.php');
        document.getElementById("fom").setAttribute('enctype','multipart/form-data');
        submBTN.innerHTML="UPDATE"
    }
    selectFunction.value=please;
}


function selectFile(id,fileholder){
    var selectedFile=document.getElementById('selectedFile');
    var selectFunction=document.getElementById('selFunction');
    if(prevID!=id && selectedFile.value!=""){
        var prevFile=document.getElementById(prevID);
        prevFile.style="border: 3px black solid"
        
    }
    prevID=id;
    if(selectedFile.value!="" && selectedFile.value==id){
        selectedFile.value="";
        fileholder.style="border: 3px black solid";
    }else{
        selectedFile.value=id;
        fileholder.style="border: 5px red solid"
    }
    changeSelFunc('UPDATE');
}

function removeFile(id){
    //trash button, pass id to fdel.php, which would 
}

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
    changeSelFunc('FIND')
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
                lNoSelect.value = data[0];
                changeSelFunc('FIND')
            }
        }
    };
    xhr.send();
}



function validateForm(event) {
    let selFunc=document.getElementById('selFunction');
    if(selFunc.value=="INSERT"){
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