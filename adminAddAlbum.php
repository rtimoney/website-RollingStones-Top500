<!DOCTYPE html>

<head>
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/hide.js"></script>
 
</head>

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

include('functions/adminFunctions.php');

createAnAlbum();




?>
