<html>
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
</head>
<style>
    /*
    *{
        border:1px solid red;
    }
    */
    form{
        display: block;
    }
</style>
<body>

<div class="row">
    <div class="col-auto">
    <img style="height:100px; width:100px;" src="/dgcentre/logo.jpg">
    </div><div class="col mt-5 mb-2">
    <h3 style="color:red;">Hayakawa Electronics Phils. Corp</h3>
    </div>
    </div>

<div class="col mx-4">
<form action="aLogIn.php" enctype="multipart/form-data">
    <div class="col-1">
    <label>Username</label>
    <input name="aUser" id="USER" type="text"></input>
    <label>Password</label>
    <input name="aPass" id="PASS" type="password"></input>
    <button type="submit" class="btn btn-primary w-150 mt-2">LOGIN</button>
    </div>
</form>
</div>

<br>

</body>
<script>

document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form").addEventListener("submit", validateForm);
});

function validateForm(event){
    let u=document.getElementById('USER').value;
    let p=document.getElementById('PASS').value;
    if(u=="" || p==""){
        alert('PLEASE INPUT CREDENTIALS!!');
        event.preventDefault();
    }
}

</script>
</html>