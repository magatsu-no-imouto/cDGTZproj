<?php
include(__DIR__ . '/../connecto.php');
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
    *{
        border: 1px dashed red !important;
    }
    .sizeplease{
        height:100px;
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
    .form-label{
        font-size:24px;
    }
</style>
<body>
    <div class="container mx-auto w-auto">
        <div class="row">
            <div class="col text-center">
                <h3>Daily Crimping Inspection Output Report</h3>
            </div>
        </div>
    </div>

    <div class="m-3 overflow-auto" style="height:500px">
        <form class="m-3" id="fom" method="post">
            <div class="row m-3 px-5">
                <div class="col">
                    <label for="itemKey">Item Key</label>
                    <input id="itemKey" name="itemKey" class="form-control">
                </div>
            </div>
            
            <div class="row m-3 px-5">
                <h3>Machine:</h3>
                <div class="row m-1">
                    <div class="col m-3">
                        <input id="Auto" name="Machine" type="radio" value="Auto">
                        <label for="Auto">Auto</label>
                    </div>
                    <div class="col m-3">
                        <input id="SemiAuto" name="Machine" type="radio" value="SemiAuto">
                        <label for="SemiAuto">Semi Automatic</label>
                    </div>
                </div>
            </div>
            
            <div class="row m-3 px-5">
                <div class="col">
                    <label for="oName">Operator Name</label>
                    <input id="oName" name="operatorName" class="form-control">
                </div>
            </div>
            
            <div class="row m-3 px-5">
                <div class="col">
                    <label for="cInsp">Crimping Inspector</label>
                    <input id="cInsp" name="crimpInspector" class="form-control">
                </div>
            </div>
            
            <div class="row m-3 px-5">
                <div class="col">
                    <label for="lLead">Line Leader</label>
                    <input id="lLead" name="lineLeader" class="form-control">
                </div>
            </div>
            
            <div class="row m-3 px-5">
                <div class="col">
                    <button type="button" onclick="goTime(this)" class="btn btn-primary">Start</button>
                </div>
                <div class="col">
                    <label id="minutes" class="form-label">00</label>:<label id="seconds" class="form-label">00</label>
                </div>
            </div>
            
            <div class="row m-3 px-5">
                <div class="col">
                    <label for="hp1">HP No.</label>
                    <input id="hp1" name="hp1" class="form-control">
                </div>
                <div class="col">
                    <label for="hp2">HP No.</label>
                    <input id="hp2" name="hp2" class="form-control">
                </div>
            </div>
            
            <div class="row m-3 px-5">
                <div class="col">
                    <label for="terminaNo1">Terminal No.</label>
                    <input id="terminaNo1" name="terminaNo1" class="form-control">
                </div>
                <div class="col">
                    <label for="terminaNo2">Terminal No.</label>
                    <input id="terminaNo2" name="terminaNo2" class="form-control">
                </div>
            </div>
            
            <div class="row m-3 px-5">
                <label>Wire Description</label>
                <div class="col">
                    <textarea id="wd1" name="wireDescription1" class="form-control"></textarea>
                </div>
                <div class="col">
                    <textarea id="wd2" name="wireDescription2" class="form-control"></textarea>
                </div>
            </div>
            
            <div class="row m-3 px-5">
                <div class="col">
                    <label for="pNo">Production Number</label>
                    <input id="pNo" name="pNo" class="form-control">
                </div>
            </div>
            
            <div class="row m-3 px-5">
                <div class="col">
                    <label for="inspQty">Inspected Qty</label>
                    <input id="inspQty" name="inspQty" class="form-control">
                </div>
            </div>
            
            <div class="row m-3 px-5">
                <div class="col">
                    <label for="ipDefect">In Process Defect</label>
                    <input id="ipDefect" name="ipDefect" class="form-control">
                </div>
            </div>
            
            <div class="row m-3 px-5">
                <div class="col">
                    <label for="ciDefect">CI Defect</label>
                    <input id="ciDefect" name="ciDefect" class="form-control">
                </div>
            </div>
            
            <div class="row m-3 px-5">
                <div class="col text-center">
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    if(isset($_POST['submit'])){
        print "<pre>";
        echo print_r($_POST);
        print "</pre>";
    }
    ?>
</body>

<script>
    
    var minutesLabel = document.getElementById("minutes");
    var secondsLabel = document.getElementById("seconds");
    var totalSeconds = 0;
    var timerInterval;

    function goTime(button) {
        timerInterval = setInterval(setTime, 1000); 
        button.removeAttribute('onclick');
        button.setAttribute('onclick', 'stopTime(this)');
        button.innerText = "End"; 
    }

function setTime() {
  ++totalSeconds;
  secondsLabel.innerHTML = pad(totalSeconds % 60);
  minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
}

function pad(val) {
  var valString = val + "";
  if (valString.length < 2) {
    return "0" + valString;
  } else {
    return valString;
  }
}

function stopTime(button) {
        clearInterval(timerInterval);
        button.removeAttribute('onclick');
        button.setAttribute('onclick', 'goTime(this)');
        button.innerText = "Start";
    }

    
    
</script>
</html>
