<?php
// Initialize the session
session_start();

if(!isset($_SESSION['id']))
	{header("location:login.php");
	}

 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
// header("location: __DIR__ . "/../somefilein_parent.php";'...project500/login.php'");  // __DIR__ . "/../somefilein_parent.php";
header("location: login.php");
exit;
?>