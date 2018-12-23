<?php

$data=$_POST;

?>

<!DOCTYPE html>
<html>
<head>
    <title>8 puzzle solver</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style type="text/css">
        body{
            background-color:#43A047;
            font-family:sans-serif;
        }
        td{
            color:#43A047;
            height:100px;
            width:100px;
            padding:12px;
            border: 2px solid #43A047;
            border-radius:5px;
            text-align:center;
            font-size:40px;
        }
        table{
            margin-top:20px;
            margin-bottom:20px;
            background:rgba(1,1,1,0);
            border-radius:5px;
            background:white;
        }
        h1{
            margin:5px;
            text-shadow: -5px 5px 2px rgba(11,11,11,0.5);
            color:white;
            font-weight:bold;
        }
    </style>
</head>
<body>
<center><h1>8 puzzle game</h1></center>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <center>
                <h1>Agent Solution steps</h1>
                <?php include "solver.php"; ?>
            </center>
        </div>
    </div>
</div>
<center>
    <div class="knk" style="color:white; position:static; font-family:sans-serif; text-decoration:none; bottom:0px;
    right:20px; margin: 20px">
        <h5>Designed with &#9829; by Sayedul sayem</h5>
    </div>
</center>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>

</html>

