<!DOCTYPE html>
<html lang="en">


<?php
session_start();

if(!isset($_SESSION['id']))
	{header("location:login.php");
	}

    if(!isset($_SESSION['admin']))
	{header("location:login.php");
	}



include("functions/header.php");


$userid = $_SESSION["id"];

  $album = $_GET["info"];

?>


<head>
    <!-- Required meta tags -->
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
    <meta charset="utf-8">
  
 
</head>

<body>

  <div>
    <?php

    include('functions/albumPageFunctions.php');


  include('functions/adminFunctions.php');
editAnAlbum($album);
?>


</body>
    </html>