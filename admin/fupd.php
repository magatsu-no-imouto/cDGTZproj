<?php
include(__DIR__ . '/../connecto.php');
include('auth.php');
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.jpg" type="image/x-icon">
    <title>File Manager</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for social media icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom styles -->
</head>
<style>
    /**{
            border: 1px solid red !important;
    }  */
    .sizeplease{
        height:90px;
    }
    @media(min-height: 800px){
        .sizeplease{
            height:200px;
        }
    }
    @media(min-height:1280px){
        .sizeplease{
        height:550px;
    }
    }
    .form-select{
        --bs-form-select-bg-img: none !important;
        font-size:12px;
    }
    .form-control{
        font-size:12px;
    }
    body{
        background-color:rgb(65,81,105);color: white;
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
        color:red;
    }
    .heldBTN:hover{
        background-color:rgb(210, 4, 45);
        color:rgb(208,0,208);
    }
    .btn{
        margin-top: 5px;
        margin-left:10px;
        border:none;
        font-weight: bold; background-color: rgb(94,94,94);
    }
    select.form-control{
        size:12px;
    }
    .addNu{
        background-color:rgb(210, 4, 45);
        border-radius:10px 5px;
        border:none;
        width:100%;
    }

    .form-label{
        font-size:10px;
    }
</style>
<body class="container mt-4">
<h1 class="mb-3 text-center py-3" style="background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;">UPDATE A FILE</h1>
<?php
            $q=array();
            $q1="";
            $q2="";
            $q3="";
            $q4="";
            $q5="";
            $q6="";
            $q7="";
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
            if(isset($_GET['page'])){
                $q7=$_GET['page'];
            } 
            ?>
<div class="container mb-3 px-0">
<form id="fom" action="test.php" method="post" enctype="multipart/form-data">
<div class="row m3 p-3" style="background-color: rgb(105, 105, 105); border-radius: 20px; ">
<div class="col-3 w-auto px-1 mx-auto">
    <label>Division</label>
        <select name='division' id='divisionSelect'  class='form-select' style="padding:5px" onchange="selCust()">
        <option value=""></option>
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
        </select>
        <button id="divBTN" type="button" class="addNu" onclick="changeInput('divDivision','divBTN');"><i class="fas fa-plus"></i></button>
</div>
<div id="divCustomer" class="col-3 w-auto px-1 mx-auto" >
<label>Customer</label>
        <select name="customer" id="customerSelect" class='form-select' style="padding:5px" onchange='selDiv()'>
        <option></option>
        <?php
        $sql="SELECT customerName FROM customer";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            if($q2==$row['customerName']){
                echo "<option value='" . $row['customerName'] . "' selected>" . $row['customerName'] . "</option>";
            }else{
                echo "<option value='" . $row['customerName'] . "'>" . $row['customerName'] . "</option>";}    
        }
        ?>
        </select>
        <button id="custBTN" type="button" class="addNu" onclick="changeInput('divCustomer','custBTN');"><i class="fas fa-plus"></i></button>
</div>
<div id="divParts" class="col-3 w-auto px-1 mx-auto">
<label>Part No.</label>
<select class='form-select' id='partNumberSelect' name="partNumber" style="padding:5px">
<option></option>
<?php
$sql="SELECT partNo FROM parts";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
    if($q3==$row['partNo']){
        echo "<option value='" . $row['partNo'] . "' selected >" . $row['partNo'] . "</option>";
    }else{
        echo "<option value='" . $row['partNo'] . "'>" . $row['partNo'] . "</option>";}                
}
?>
</select>
<button id="partBTN" type="button" class="addNu" onclick="changeInput('divParts','partBTN');"><i class="fas fa-plus"></i></button>
</div>
<!--end of document filters-->
</div>
<!--start of line filters-->
<div class="row m3 p-3" style="background-color: rgb(105, 105, 105); border-radius: 20px; margin-top:5px;">
<div id="divLNo" class="col-3 w-auto px-1 mx-auto">
    <label>Line Number</label>
        <select name='lineNo' id='lineNoSelect' class='form-select' style="padding:5px" onchange='selLLead()'>
            <option></option>
            <?php
            $sql="SELECT lNo, COUNT(lNo) AS frequency FROM `lineleaders` GROUP BY lNo ORDER BY `lineleaders`.`lNo` ASC;";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
                if($q5==$row['lNo']){
                    echo "<option value='" . $row['lNo'] . "' selected >" . $row['lNo'] . "</option>";
                }else{
                    echo "<option value='" . $row['lNo'] . "'>" . $row['lNo'] . "</option>";}                
            }
            ?>
        </select>
        <button id="lNoBTN" type="button" class="addNu" onclick="changeInput('divLNo','lNoBTN');"><i class="fas fa-plus"></i></button>
</div>
<div id="divLLead" class="col-3 w-auto px-1 mx-auto" >
<label>Line Leader</label>
        <select name='lineLead' id='lineLeadSelect' class='form-select' style="padding:5px" onchange='selLNoSel()'>
        <option></option>
        <?php
        $sql="SELECT lLead FROM lineLeaders";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            if($q6==$row['lLead']){
                echo "<option value='" . $row['lLead'] . "' selected >" . $row['lLead'] . "</option>";
            }else{
                echo "<option value='" . $row['lLead'] . "'>" . $row['lLead'] . "</option>";}                
        }
        ?>
        </select>
        <button id="lLeadBTN" type="button" class="addNu" onclick="changeInput('divLLead','lLeadBTN');"><i class="fas fa-plus"></i></button>
</div>
<div class="col-3 w-auto px-1 mx-auto">
<label>Item Key.</label>
<?php
            if($q4!=""){
                echo "<input id='itemKey' name='itemKey' maxlength='4' value='$q4' class='form-control'>";
            }else{
                echo "<input id='itemKey' name='itemKey' maxlength='4' class='form-control'>";
            }
            ?>
</div>
</div>
<div class="row mb-3 mt-1 py-3" style="background-color: rgb(105, 105, 105); border-radius: 20px;">
<div class="col">
<label>Document Type</label>
    <select name="fileType" class='form-select' style="padding:5px">
        <option value=""></option>
        <?php 
                $ops=["wi","cp","fic","ps","md"];
                $opt=["Work Instruction","Control Plan","Final Inspection Checkpoint","Product Specifications","Material Details"];
                echo "hi";
                for($i=0;$i<=(count($ops)-1);$i++){
                    if($q7==$ops[$i]){
                        echo "<option value=".$ops[$i]." selected>".$opt[$i]."</option>";
                    }else{
                        echo "<option value=".$ops[$i].">".$opt[$i]."</option>";
                    }
                }
                ?>
    </select>
</div>
<div class="col">
    <label>File</label>
    <input id="fileInput" name="files" type="file" class="form-control"></input>
</div>
<input name="selFile" id="selectedFile" class="form-control" hidden>
        <input name="selFunction" id="selFunction" class="form-control" value="INSERT" readonly hidden>
</div>
<div class="row-md-3 d-flex justify-content-center">
    <button class="btn btn-primary w-100" onclick="changeSelFunc('FIND'); return true">Find</button>
    <button class="btn btn-primary w-100" onclick="changeSelFunc('INSERT'); return true;">Insert</button>
    <button class="btn btn-primary w-100" onclick="changeSelFunc('UPDATE'); return true;">Update</button>
    <button type="button" class="btn btn-primary w-100" onclick="redirectHub()">Back</button>
</div>
</div>
</form>
</div>
<div class="container text-center py-1" style="background-color: rgb(105, 105, 105); border-radius: 20px;">FILES</div>
<div class="container sizeplease mb-1 text-center py-3 overflow-auto" style="background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 10px;">
    <table class='text-center mx-auto w-auto'>
<tbody>
   <?php
   $f=array();
   $i=array("division","customer","partNo","lineNo","lineLead","itemKey","fileType");
   $sql="SELECT * FROM `files` ";
   if(isset($_POST['submit'])){
    $f[0]=$_POST['division'];
    $f[1]=$_POST['customer'];
    $f[2]=$_POST['partNumber'];
    $f[3]=$_POST['lineNo'];
    $f[4]=$_POST['lineLead'];
    $f[5]=$_POST['itemKey'];
    $f[6]=$_POST['fileType'];
   }else{
    $f[0]=$q1;
    $f[1]=$q2;
    $f[2]=$q3;
    $f[3]=$q5;
    $f[4]=$q6;
    $f[5]=$q4;
    $f[6]=$q7;
   }
   
   $sql="SELECT * FROM `files` ";
   $num=0;
   foreach($i as $that){
    echo "<script>console.log('".$num."')</script>";
    echo "<script>console.log('".$that."')</script>";
    if($that=="fileType" && ($f[$num]==" "|| $f[$num]=="")){
        $sql.="ORDER BY `fileType` DESC";
    }else if($num==6 && $f[$num]!="" && str_contains($sql,"WHERE")){
        $sql.=" AND ".$that."='".$f[$num]."'";
    }else if($num==6 && $f[$num]!=""){
        $sql.="WHERE ".$that."='".$f[$num]."'";
    }else if(str_contains($sql,"WHERE") && $f[$num]!="" && $that=="itemKey"){
        $sql.=" AND ".$that." LIKE '%".$f[$num]."%' ";
    }else if($f[$num]!="" && $that=="itemKey"){
        $sql.="WHERE ".$that." LIKE '%".$f[$num]."%' ";
    }else if(str_contains($sql,"WHERE") && $f[$num]!=""){
        $sql.="AND ".$that."='".$f[$num]."' ";
    }else if($f[$num]!=""){
        $sql.="WHERE ".$that."='".$f[$num]."' ";
    }
    $num++;
   }
   $result=mysqli_query($conn,$sql);
   if($result){
    $noRows=mysqli_num_rows($result);
    if($noRows>=1){
        $cellCount=1;
        $lastR=mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)){
            if($cellCount==0){
                echo "<tr>";
            }
            echo "<td style='width:1000px; font-size:12px; text-wrap:wrap;'><img width='50px' style='margin: auto;' id='".$row['fileName']."' onclick='selectFile(\"".$row['fileName']."\",this)' src="."'../crap.jpg'"." class='heldfile' /><br>".$row['fileName']."<br>";
            echo "<button type='button' class='heldBTN' onclick='deleteP(\"".$row['fileName']."\",\"".$row['fileType']."\")'><i class=\"fas fa-trash\"></i></button>";
            echo "</td>";
            if($cellCount==4 || $cellCount==$lastR){
                echo "</tr>";
                $cellCount=0;
            }
            $cellCount+=1;
        }
    }
   }
   ?>
</tbody>    
</table>
</div>
</body>
<script>

let prevID

function changeSelFunc(COMMANDO){
    var selectFunction=document.getElementById('selFunction');
    var please=COMMANDO;
    if(COMMANDO=="FIND"){
        document.getElementById("fom").removeAttribute('action')
        document.getElementById("fom").removeAttribute('enctype')
    }else if(COMMANDO=="INSERT"){
        document.getElementById("fom").setAttribute('action','fupif.php');
        document.getElementById("fom").setAttribute('enctype','multipart/form-data');
    }else if(COMMANDO=="UPDATE"){
        document.getElementById("fom").setAttribute('action','fupdf.php');
        document.getElementById("fom").setAttribute('enctype','multipart/form-data');
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
}


    function redirectHub(){
        window.location.replace('aHub.php')
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
                lNoSelect.value = data[0];
            }
        }
    };
    xhr.send();
}



function validateForm(event) {
    let selFunc=document.getElementById('selFunction');
    let messages = [];
    if(selFunc.value=="INSERT"){
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
    }else if(selFunc.value=="UPDATE"){
        let selectedF=document.getElementById('selectedFile').value;
        
        if(selectedF==""){
            messages.push('Please Select A File To Update.')
        }
        if(fileInput.files.length!=0){
            let fileName = fileInput.files[0].name; 
            let fileExtension = fileName.split('.').pop().toLowerCase();
        if (fileExtension !== 'pdf') {
            messages.push(`Invalid File: ${fileName} is not a PDF.`);
        }   
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

function deleteP(id,type){
    window.location.replace(`fupef.php?id=${id}&type=${type}`);    
}
function selCust(){
    let divisionN=document.getElementById('divisionSelect').value;
    let custN=document.getElementById('customerSelect');
    console.log(divisionN +" "+custN.value);
    if(divisionN===""){
        custN.value="";
        
    }
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "fetchCust.php?divN=" + encodeURIComponent(divisionN), true);
    xhr.onload = function () {
        if (this.status === 200) {
            let base=this.responseText;
            console.log(base);
            let data = JSON.parse(this.responseText);
            console.log(data);
            if(typeof data[0]==="object"){
                let dc=JSON.parse(data[0].customers)
            console.log(dc);
        custN.innerHTML = "<option></option>";
            for(let key in dc){
                let option=document.createElement("option");
                option.value=dc[key]
                option.textContent=dc[key];
                custN.appendChild(option);
            }
            }else if(typeof data[0] === "string"){
                data.forEach(customer => {
                    let option = document.createElement("option");
                    option.value = customer;
                    option.textContent = customer;
                    custN.appendChild(option);
                });
            }
        }
    };
    xhr.send();
}

function selDiv(){
    let divisionN=document.getElementById('divisionSelect')
    let custN=document.getElementById('customerSelect').value;
    console.log(custN);
    if(custN===""){
        divisionN.value=""
        selCust();
    }
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "fetchDiv.php?custN=" + encodeURIComponent(custN), true);
    xhr.onload = function () {
        if (this.status === 200) {
            let data = JSON.parse(this.responseText);
            console.log(data);
            if (data.length > 0) {
                // Auto-select the first Line Number if available
                divisionN.value = data[0];
            }
        }
    };
    xhr.send();
}
</script>
</html>