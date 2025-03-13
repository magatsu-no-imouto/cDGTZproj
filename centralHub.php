<?php
include("connecto.php");
session_start();
if ($_SERVER['REQUEST_URI'] === 'centralHub.php') {
    header("Location: /", true, 301);
    exit;
}
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.jpg" type="image/x-icon">
    <title>Centralized Digitization</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for social media icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
      /* #warp border check *//*
        *{
            border: 1px solid red !important;
        }  
            */
        /* Hero Section */
        .carousel-item img {
            width: 100%;
            height: 80vh;
            object-fit: cover;
        }

        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 8px;
        }

        .carousel-caption h1,
        .carousel-caption p {
            color: white;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black;
        }

        /* Gallery Section */
        .gallery {
            padding: 10px 0;
        }
        
        a{
        display:flex;
    }
        .col-sm-3{
            padding:0px;
            height:125px;
            margin: auto;
        }
        .gallery .card {
            margin:auto;
            color: white;
            border: none;
            width: 120px;
            height:120px;
            border-radius: 12px;
            box-shadow: 1px 1px 8px 2px rgba(94, 94, 94,0.9);
            overflow: hidden;
            background-color: rgb(94, 94, 94);
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .gallery .card:hover {
            transform: translateY(-10px);
        }

        .gallery .card-img-top {
            height: 90px;
            width: 80%;
            margin: auto;
            object-fit: contain;
            transition: all 0.3s ease;
        }

        .gallery .card-body {
            padding: 0px;
            text-align: center;
        }

        .gallery .card-title {
            font-size: 10px;
            font-weight: 500;
            margin-bottom: 2px;
            margin-left: 2px;
            margin-right:2px;
            text-align: center;
        }

        .gallery .card-text {
            font-size: 1rem;
            color: #555;
        }
        .body{
            background-color 0.3s ease;
        }
        /* Footer */
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 18px 0;
        }

        @media(min-height: 800px){
            .card{
                margin-top:20px !important;
                margin-bottom:50px !important;
            }
        }
        @media(min-height:1280px){
        .card{
                margin-top:20px !important;
                margin-bottom:210px !important;
            }
        }

        .footer a {
            color: #fff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color:rgb(65,81,105);
            color:rgb(230, 28, 28);
            transition: background-color 0.3s ease, color 0.3s ease, text-shadow 0.3s ease;
        }
        .gallery h3 {
            font-size: 2.1rem;
            text-align: center;
            margin-top:5px;
            margin-bottom: 5px;
            font-weight: 600;
            text-shadow: -1px -1px 13px rgba(255,0,0,1);
            
        }
        body.dark-mode h3{
            text-shadow: -1px -1px 22px rgb(255, 113, 113);
            transition: background-color 0.3s ease, color 0.3s ease, text-shadow 0.3s ease;
        }
        body.dark-mode .carousel-caption {
            background-color: rgba(65, 104, 155, 0.7);
        }

        body.dark-mode .gallery .card {
            background-color: rgb(94, 94, 94);
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        body.dark-mode .footer {
            background-color: #222;
        }
        .col-1{
            padding:0px;
        }
        /* Dark mode toggle button */
        .dark-mode-toggle {
            margin:5px;
            z-index:1;
            background-color:rgb(255, 255, 255);
            color:black;
            border: none;
            padding: 10px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dark-mode-toggle:hover {
            background-color: rgb(70, 60, 0);
            color: orange;
        }
        .col.filter{
            background-color:rgb(112, 125, 141);
            padding-top:2px;
            border-radius:5px;
            padding-left:5px;
            padding-right:5px;
            padding-bottom:5px;
            transition: background-color 0.3s ease;
        }
        .col.butt{
            margin-top:24px;
        }
        .col.divFilt{
            margin-top:2px;
            margin-bottom:1px;
        }
        .row.main{
            margin-top:20px;
        }
        .row.page{
            margin-bottom:5px;
        }
        body{
            background-color:rgb(113, 142, 187);
            color:rgb(231, 0, 0);
            transition:background-color 0.3s ease;
        }
        .form-select{
            font-size:12px;
        }
    </style>
</head>
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
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $q1 = $_POST['division'] ?? "";
                $q2 = $_POST['customer'] ?? "";
                $q3 = $_POST['partNumber'] ?? "";
            }
            ?>
<body class="dark-mode">
    <!-- #warp Gallery -->
    <section class="gallery">
    <div class="container-md">
    <div class="row">
    <div class="col-2">
        <img class="logo" src="logo.jpg" style="width:80px; height:80px;"></img>
    </div>
    <div class="col">
    <h3>Document Integration System</h3>
    </div>
    <div class="col-1">
    </div>
    </div>
        <div class="row main">
            <div class="col">
            <!---#warp 9x9 container--->
            <div class="row page">
            <div class="col">
            <a id="wi" name="links" href = "fm.php?page=wi" style = "text-decoration: none; color:white;">
                    <div class="card">
                        <img src="crap.png" class="card-img-top" alt="Artwork 1">
                        <div class="card-body">
                            <h5 class="card-title">WORK INSTRUCTION</h5>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col">
            <a id="cp" name="links" href = "fm.php?page=cp" style = "text-decoration: none; color:white;">
                    <div class="card">
                        <img src="crap.png" class="card-img-top" alt="Artwork 1">
                        <div class="card-body">
                            <h5 class="card-title">CONTROL PLAN</h5>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col">
            <a id="fic" name="links" href = "fm.php?page=fic" style = "text-decoration: none; color:white;">
                    <div class="card">
                        <img src="crap.png" class="card-img-top" alt="Artwork 1">
                        <div class="card-body">
                            <h5 class="card-title">FINAL INSPECTION CHECK</h5>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="row page">
            <div class="col">
            <a id="ps" name="links" href = "fm.php?page=ps" style = "text-decoration: none; color:white;">
                    <div class="card">
                        <img src="crap.png" class="card-img-top" alt="Artwork 1">
                        <div class="card-body">
                            <h5 class="card-title">PRODUCT SPECIFICATIONS</h5>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col">
            <a id="md" name="links" href = "fm.php?page=wi" style = "text-decoration: none; color:white;">
                    <div class="card">
                        <img src="crap.png" class="card-img-top" alt="Artwork 1">
                        <div class="card-body">
                            <h5 class="card-title">MATERIAL DETAILS FORM</h5>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col">
            <a id="daior" href = "" style = "text-decoration: none; color:white;">
                    <div class="card">
                        <img src="brap.png" class="card-img-top" alt="Artwork 1">
                        <div class="card-body">
                            <h5 class="card-title">DAIOR</h5>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="row page">
                <div class="col">
            <a id="dmc" href = "" style = "text-decoration: none; color:white;">
                    <div class="card">
                        <img src="brap.png" class="card-img-top" alt="Artwork 1">
                        <div class="card-body">
                            <h5 class="card-title">DAILY MAINTENANCE CHECKSHEET</h5>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col">
            <a id="par" href = "" style = "text-decoration: none; color:white;">
                    <div class="card">
                        <img src="brap.png" class="card-img-top" alt="Artwork 1">
                        <div class="card-body">
                            <h5 class="card-title">PRODUCTION ASSEMBLY RECORD</h5>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col">
            <a id="dcior" href = "" style = "text-decoration: none; color:white;">
                    <div class="card">
                        <img src="brap.png" class="card-img-top" alt="Artwork 1">
                        <div class="card-body">
                            <h5 class="card-title">DCIOR</h5>
                        </div>
                    </div>
                    </a>
                </div>
        </div>    
    </div>
    <div class="col-3" style="padding-left:0px;">
    <div class="col filter">
        <!--#warp filter top-->
                <div class="col divFilt">
        <!--#warp filter top, division top-->
                <label for="divisionSelect" class="form-label" style= "font-weight: bold;">Division:</label>
                <select name='division' id='divisionSelect' class='form-select' onchange="selCust()"><option value=""></option>
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
            <!--#warp filter division Bottom, customer top-->
            <div class="col divFilt">
            <label for="customerSelect" class="form-label" style= "font-weight: bold;" >Customer:</label>
            <?php
            echo "<select name='customer' id='customerSelect' class='form-select' onchange='selDiv()'><option></option>";
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
        <!--#warp customer bottom, part top-->
        <div class="col divFilt">
            <label for="partNumberSelect" class="form-label" style= "font-weight: bold;">Part No:</label>            
            <?php
            echo $q1;
            echo "<select name='partNumber' id='partNumberSelect' class='form-select' onchange='filter()'><option></option>";
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
        <!--#warp part bottom, lineNo top-->
        <div id="divLNo" class="col divFilt">
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
        </div>
        <!---#warp lineNo bottom, lineLead top--->
        <div id="divLLead" class="col divFilt">
        <label for="lineLeadSelect" class="form-label" style= "font-size:13px;font-weight: bold;">Line Leader:</label>            
            <?php
            echo "<select name='lineLead' id='lineLeadSelect' class='form-select' onchange='selLNoSel();'><option></option>";
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
        </div>
        <!---#warp llead bottom iKey top--->
        <div class="col divFilt">
            <label for="itemKey" class="form-label" style= "font-weight: bold;">Item Key:</label>
            <input id="itemKey" name="itemKey" oninput='filter();' maxlength="4" class="form-control">
        </div>
        <!---#warp iKey bottom--->
        
        <!---#warp filter bottom--->
            </div>
    </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <p>&copy; 2025 Hayakawa Electronics (Phils.) Corp. All rights reserved.</p>
      
    </footer>

    <!-- Bootstrap and JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        function filter(){
            var selA=document.getElementById('divisionSelect').value;
            var selB=document.getElementById('customerSelect').value
            var selC=document.getElementById('partNumberSelect').value;
            var inpD=document.getElementById('itemKey').value;
            var selE=document.getElementById('lineNoSelect').value;
            var selF=document.getElementById('lineLeadSelect').value;
            const stuff = document.querySelectorAll(`[name="links"]`);
            var selArr=[selA,selB,selC,inpD,selE,selF]
            var qSel=encodeURIComponent(JSON.stringify(selArr))
            stuff.forEach(item=>{
                item.href="fm.php?page="+item.id+"&q="+qSel; 
            })
        }

filter();

    function selLLead(){
    let lNo=document.getElementById('lineNoSelect').value;
    let lLeadSel=document.getElementById('lineLeadSelect');


    let xhr=new XMLHttpRequest();
    xhr.open("GET","/dgcentre/admin/fetchlldrs.php?lNo="+encodeURIComponent(lNo),true);
    xhr.onload=function(){
        if(this.status===200){
            let data = JSON.parse(this.responseText);
            console.log(data)
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
    filter();
}

function selLNoSel() {
    let lLead = document.getElementById('lineLeadSelect').value;  // Get selected Line Leader
    let lNoSelect = document.getElementById('lineNoSelect');      // Get Line Number dropdown
    if (lLead === "") {
        lNoSelect.value = ""; // Reset dropdown if no Line Leader is selected
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
                filter()
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
    custN.innerHTML = "<option></option>";
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/dgcentre/admin/fetchCust.php?divN=" + encodeURIComponent(divisionN), true);
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
    filter();
    xhr.send();
}

function selDiv(){
    let divisionN=document.getElementById('divisionSelect')
    let custN=document.getElementById('customerSelect').value;
    console.log(custN);
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/dgcentre/admin/fetchDiv.php?custN=" + encodeURIComponent(custN), true);
    xhr.onload = function () {
        if (this.status === 200) {
            let data = JSON.parse(this.responseText);
            console.log(data);
            if (data.length > 0) {
                // Auto-select the first Line Number if available
                divisionN.value = data[0];
            }
        }
        if(custN===""){
        divisionN.value=""
        selCust();
    }
    };
    xhr.send();
    filter()
}

    </script>
</body>

</html>
