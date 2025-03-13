<?php
include("connecto.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.jpg" type="image/x-icon">
    <title>File Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .sizeplease{
        height:350px;
    }
    @media(min-height: 800px){
        .sizeplease{
            height:500px;
        }
    }
    @media(min-height:1280px){
        .sizeplease{
        height:1000px;
    }
}
    body{
        background-color:rgb(65,81,105);
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
</style>
<body class="container mt-4">
    <!--[]name of the page selected from Hub-->
    <?php
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }
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
    }else if($page==="daior"){
        $name="Daily Assembly Inspection Output Report";
    }else if($page==="dmc"){
        $name="Daily Maintenance Sheet";
    }else if($page==="par"){
        $name="Product Assembly Record";
    }else if($page==="dcior"){
        $name="Daily Crimping Inspection Output Report";
    }

    echo "<h1 class=\"mb-1 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">".$name."</h1>";
    
    ?>
    <!-- Search Filters -->
    <div class="row mb-1">
        <form id="fomm">
        <?php
        echo "<input name='page' value='".$page."' hidden>";
        ?>
        <div class="row mt-1 mb-1 py-3" style="background-color: rgb(105, 105, 105); border-radius: 20px;">
            <div class="col">
            <label for="divisionSelect" class="form-label" style= "font-weight: bold;">Division:</label>
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
            }
            if(isset($_GET['page'])){
                $q7=$_GET['page'];
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

            <select name='division' id='divisionSelect' class='form-select' onchange="selCust();
"><option value=""></option>
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
            echo "<select name='customer' id='customerSelect' class='form-select' onchange='selDiv();'><option></option>";
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
            <label for="partNumberSelect" class="form-label" style= "font-weight: bold;">Part No:</label>            
            <select name='partNumber' id='partNumberSelect' class='form-select' onchange="document.getElementById('fomm').requestSubmit();"><option></option>
            <?php
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
    </div>
        <div class="col-md-3 d-flex justify-content-center">
            <button class="btn btn-primary w-100" style= "font-weight: bold; background-color: rgb(140, 139, 137);">Search</button>
            <button type="button" class="btn btn-primary w-100" style="margin-left: 10px; font-weight: bold; background-color: rgb(140, 139, 137);" onclick="redirectHub()">Back</button>
            </div>
        </div>
        </form>
    </div>

    <div id="resultsTable">
    <?php
    //submit button takes the value of the Select
    //and fills $find accordingly to build the parameters.
    //of the SQL
    #variable assigning
   $f=array();
   $i=array("division","customer","partNo","fileType");
   $sql="SELECT * FROM `files` ";
   if(isset($_POST['submit'])){
    $f[0]=$_POST['division'];
    $f[1]=$_POST['customer'];
    $f[2]=$_POST['partNumber'];
    $f[3]=$q7;
   }else{
    $f[0]=$q1;
    $f[1]=$q2;
    $f[2]=$q3;
    $f[3]=$q7;
   }
   
   $sql="SELECT * FROM `files` ";
   $num=0;
   foreach($i as $that){
    
    if($that=="fileType" && ($f[$num]==" "|| $f[$num]=="")){
        echo $num;
        $sql.="ORDER BY `fileType` DESC";
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
        echo "<div class=\"container mb-3 text-center py-3 sizeplease overflow-auto\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">";
        echo "<table class='text-center mx-auto w-auto'>";
       echo "<thead><tr><th colspan=".$noRows.">Files</th></tr></thead>";
       echo "<tbody>";
       
       $cellCount=1;
       $lastR=mysqli_num_rows($result);
       while($row = mysqli_fetch_array($result)){
           if($cellCount==0){
               echo "<tr>";
           }
           echo "<td style='font-size: 12px;'><img width='50px' style='margin: auto;'  id='".$row['fileName']."' onclick='showFile(\"".$row['fileName']."\")' src="."'crap.png'"."/><br>
           ".$row['fileName']."<br>";
           
           echo "</td>";
           if($cellCount==3 || $cellCount==$lastR){
               echo "</tr>";
               $cellCount=0;
           }
           $cellCount+=1;
       }   
       echo "</tbody>";
       echo "</table>";
       echo "</div>";
       }else{
           echo "<p class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">No results found.</p>";
       }   
   }else{
       echo "<p class=\"mb-3 text-center py-3\" style=\"background-color: rgb(105, 105, 105); border-radius: 20px; margin-top: 20px;\">No results found.</p>";
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
        <?php
        if(empty($q)){
            $q=$f;
        }
        ?>

        
        var q=<?php echo json_encode($q);
        
        ?>

        var qE = encodeURIComponent(JSON.stringify(q));
        
        window.location.replace(`found.php?filename=${filename}&rtrn=${page2}&page=${page}&q=${qE}`);
}

    

    function redirectHub(){
        var selA=document.getElementById('divisionSelect').value;
            var selB=document.getElementById('customerSelect').value
            var selC=document.getElementById('partNumberSelect').value;
            var selArr=[selA,selB,selC]
            var qSel=encodeURIComponent(JSON.stringify(selArr))
        window.location.replace(`/dgcentre/?q=${qSel}`);
    }


function selLLead(){
    let lNo=document.getElementById('lineNoSelect').value;
    let lLeadSel=document.getElementById('lineLeadSelect');


    let xhr=new XMLHttpRequest();
    xhr.open("GET","/dgcentre/admin/fetchlldrs.php?lNo="+encodeURIComponent(lNo),true);
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
        lNoSelect.value = ""; 
        // Reset dropdown if no Line Leader is selected
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/dgcentre/admin/fetchlNo.php?lLead=" + encodeURIComponent(lLead), true);
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
function selCust(){
    let divisionN=document.getElementById('divisionSelect').value;
    let custN=document.getElementById('customerSelect');
    console.log(divisionN +" "+custN.value);
    if(divisionN===""){
        custN.value="";
        
    }
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/dgcentre/admin/fetchCust.php?divN=" + encodeURIComponent(divisionN), true);
    xhr.onload = function () {
        custN.innerHTML = "<option></option>";
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
    document.getElementById('fomm').requestSubmit();
}

function selDiv(){
    let divisionN=document.getElementById('divisionSelect')
    let custN=document.getElementById('customerSelect').value;
    console.log(custN);
    if(custN===""){
        divisionN.value=""
    }else{
        let xhr = new XMLHttpRequest();
    xhr.open("GET", "/dgcentre/admin/fetchDiv.php?custN=" + encodeURIComponent(custN), true);
    xhr.onload = function () {
        if (this.status === 200) {
            let data = JSON.parse(this.responseText);
            console.log(data);
            if (data.length > 0) {
                divisionN.value = data[0];
            }
        }
    };
    xhr.send();
    }

    document.getElementById('fomm').requestSubmit();
}

let debounceTimer;
document.querySelectorAll("select").forEach(select => {
    select.addEventListener("change", function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            document.getElementById("fomm").dispatchEvent(new Event("submit", { bubbles: true }));
        }, 60); // Adjust delay as needed
    });
});

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("fomm").addEventListener("submit", function(event) {
        event.preventDefault(); 
        let fd = new FormData(this);

        fetch("admin/fetchData.php?setto=a", {
            method: "POST",
            body: fd
        })
        .then(response => response.text())
        .then(data => {
            let resultsTable = document.getElementById("resultsTable");
            if (resultsTable) {
                resultsTable.innerHTML = data; 
            } else {
                console.error("Element with ID 'resultsTable' not found!");
            }
        })
        .catch(error => console.error("Error:", error));
    });
});

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
