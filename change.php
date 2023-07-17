<head>
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
</head>

<?php

session_start();

if(!isset($_SESSION['id']))
	{header("location:login.php");
	}



include("functions/header.php");

$userid = $_SESSION["id"];


if(isset($_REQUEST['username'])) {

$query = "SELECT user.create_datetime FROM user WHERE user.user_id = $userid";
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$data = json_decode($resource, true);

 foreach($data as $row){
    $userCreated=$row["create_datetime"];

  }

  $username = stripslashes($_REQUEST['username']);
  $email    = stripslashes($_REQUEST['useremail']);



  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?updateUser";

$postdata=http_build_query(
  array(
      'username' => $username,
      'email' => $email,
      'usercreated' => $userCreated,
      'userid' => $userid,
      
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

  if($resource){
    echo '<div id=centred_p><h1>Success! record updated</h1></div>'; 
  } else {
    echo 'ERROR';
  }
}

exit();

?>