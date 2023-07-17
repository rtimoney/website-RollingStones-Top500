<?php
session_start();
if(!isset($_SESSION['id']))
{
header("location:login.php");
}


$id=$_GET['user_id'];

$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?deleteUser";

$postdata=http_build_query(
  array(
      
    'userid' => $id,
      
          )

);

$opts=array(
  'http'=>array(
      'method'=>'POST',
      'header'=>'Content-Type: application/x-www-form-urlencoded',
      'content'=>$postdata

  )

  );

  $context= stream_context_create($opts);
  $resource = file_get_contents($endpoint, false, $context);






header("location:../logout.php");


?>
