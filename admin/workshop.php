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
    /**{
            border: 1px solid red !important;
    }  */
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
<body >

</body>

</html>
