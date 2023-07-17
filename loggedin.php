<!DOCTYPE html>
<html>

<head>
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
</head>

<?php include("functions/header.php");?>

<?php
// Initialize the session
session_start();


if(!isset($_SESSION['id']))
	{header("location:login.php");
	}


?>

<body>


<?php

    echo $_SESSION["username"];
    echo $_SESSION["id"];
    echo $_SESSION["username"];

?>
</body>





</html>