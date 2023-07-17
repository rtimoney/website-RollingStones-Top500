<?php
session_start();
if(!isset($_SESSION['id']))
{
header("location:login.php");
}

$id=$_GET['comment_id'];

$query="DELETE FROM comment WHERE comment_id=$id;";
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$data = json_decode($resource, true);

header("location:../admin.php");


?>
