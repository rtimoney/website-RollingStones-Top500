<?php
session_start();
if(!isset($_SESSION['id']))
{
header("location:login.php");
}
if(!isset($_SESSION['admin']))
{header("location:login.php");
}


$id=$_GET['user_id'];

$query="UPDATE user SET restriction='' WHERE user_id=$id;";

$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$data = json_decode($resource, true);

header("location:../admin_userProfiles.php");



?>
