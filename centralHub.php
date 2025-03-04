<?php
include("connecto.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="hepc.jpg" type="image/x-icon">
    <title>Centralized Digitization</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for social media icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
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
            padding: 60px 0;
        }

        .gallery h2 {
            font-size: 3rem;
            text-align: center;
            margin-bottom: 40px;
            font-weight: 600;
        }

        .gallery .card {
            color: rgb(180, 180, 0);
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .gallery .card:hover {
            transform: translateY(-10px);
        }

        .gallery .card-img-top {
            
            height: 100px;
            width: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .gallery .card-body {
            padding: 15px;
            text-align: center;
        }

        .gallery .card-title {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .gallery .card-text {
            font-size: 1rem;
            color: #555;
        }

        /* Footer */
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
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
            background-color: #121212;
            color: #ffffff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        body.dark-mode .carousel-caption {
            background-color: rgba(0, 0, 0, 0.7);
        }

        body.dark-mode .gallery .card {
            background-color: #1f1f1f;
            border: 1px solid #444;
        }

        body.dark-mode .footer {
            background-color: #222;
        }

        /* Dark mode toggle button */
        .dark-mode-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
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
            background-color: #333;
            color: white;
        }
    </style>
</head>

<body class="dark-mode">

    <!-- Dark Mode Toggle Button -->
    <button class="dark-mode-toggle" id="darkModeToggle">
        <i class="fas fa-sun"></i>
    </button>

    <!-- Gallery Section -->
    <section class="gallery">
        <h2>Hayakawa Electronics (Phils.) Corps.</h2>
        <form method="post">
        <div class="row">
            <div class="col">
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
            <select name='division' id='divisionSelect' class='form-select' onchange="filter()"><option></option>
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
            echo "<select name='customer' id='customerSelect' class='form-select' onchange='filter()''><option></option>";
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
            <?php
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
        </div>
        <div id="divLLead" class="col">
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
        <div class="col">
            <label for="itemKey" class="form-label" style= "font-weight: bold;">Item Key:</label>
            <input id="itemKey" name="itemKey" oninput='filter();' maxlength="4" class="form-control">
        </div>
        <div class="container mt-4">
            <a id="wi" name="links" href = "fm.php?page=wi" style = "text-decoration: none; color:white;">
            <div class="row row-cols-3 row-cols-md-3 g-3">
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 1">
                        <div class="card-body">
                            <h5 class="card-title">WORK INSTRUCTION</h5>
                            
                        </div>
                    </div>
                </div>
            </a>
            <a name="links" id="cp" href = "fm.php?page=cp" style = "text-decoration: none; color:white;">
            <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 3">
                        <div class="card-body">
                            <h5 class="card-title">CONTROL PLAN</h5>
                            
                        </div>
                    </div>
                </div>
            
            </a>
            <a name="links" id="fic" href = "fm.php?page=fic" style = "text-decoration: none; color:white;">
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 4">
                        <div class="card-body">
                            <h5 class="card-title">FIC</h5>
            
                        </div>
                    </div>
                </div>
            </a>
            <a name="links" id="ps" href = "fm.php?page=ps" style = "text-decoration: none; color:white;">
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 5">
                        <div class="card-body">
                            <h5 class="card-title">PRODUCT SPECIFICATIONS</h5>
                           
                        </div>
                    </div>
                </div>
                </a>
            <a name="links" id="md" href = "fm.php?page=md" style = "text-decoration: none; color:white;">
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 6">
                        <div class="card-body">
                            <h5 class="card-title">MATERIAL DETAILS</h5>
                           
                        </div>
                    </div>
                </div>
                </a>
            <a name="links" id="diaor" href = "fm.php?page=diaor" style = "text-decoration: none; color:white;">
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 6">
                        <div class="card-body">
                            <h5 class="card-title">DIAOR</h5>
                           
                        </div>
                    </div>
                </div>
                </a>
            <a name="links" id="dmc" href = "fm.php?page=dmc" style = "text-decoration: none; color:white;">
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 6">
                        <div class="card-body">
                            <h5 class="card-title">DAILY MAINTENANCE CHECKSHEET</h5>
                           
                        </div>
                    </div>
                </div>
                </a>
            <a id="par" name="links" href = "fm.php?page=par" style = "text-decoration: none; color:white;">
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 6">
                        <div class="card-body">
                            <h5 class="card-title">PRODUCTION ASSEMBLY RECORD</h5>
                           
                        </div>
                    </div>
                </div>
                </a>
            <a name="links" id="dcior" href = "fm.php?page=dcior" style = "text-decoration: none; color:white;">
                <div class="col-sm">
                    <div class="card">
                        <img src="crap.jpg" class="card-img-top" alt="Artwork 6">
                        <div class="card-body">
                            <h5 class="card-title">DCIOR</h5>
                           
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="row mb-3">
        
        <button name="submit" class="btn btn-primary w-100" style= "font-weight: bold; background-color: rgb(140, 139, 137);" type="button" onclick="window.location.replace('fup.php')">upload file</button>
        <button name="submit" class="btn btn-primary w-100" style= "font-weight: bold; background-color: rgb(140, 139, 137);" type="button" onclick="window.location.replace('fupd.php')">update file</button>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <p>&copy; 2025 Hayakawa Electronics (Phils.) Corps. . All rights reserved.</p>
      
    </footer>

    <!-- Bootstrap and JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        // Toggle dark mode
        document.getElementById('darkModeToggle').addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');
            const icon = document.querySelector('.dark-mode-toggle i');
            if (document.body.classList.contains('dark-mode')) {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            } else {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
        });

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
    xhr.open("GET", "fetchlNo.php?lLead=" + encodeURIComponent(lLead), true);
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

    </script>
</body>

</html>
