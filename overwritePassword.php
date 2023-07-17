

<html>


<head>
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
</head>

<?php include("functions/header.php");?>




<?php
     
        

if (isset($_REQUEST['id'])){

        $username=($_REQUEST['username']);
        $email=($_REQUEST['email']);
        $userid=($_REQUEST['id']);
        $newPass=($_REQUEST['password']);
        $userCreated=($_REQUEST['datetime']);


        



$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?resetPass";

$postdata=http_build_query(
  array(
      'pass' => $newPass,
      'date' => $userCreated,
      'userid' => $userid,
      'email' => $email,
      
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
          echo '<div id=centred_p><h1>Success! Password updated</h1><br>
          <a href="login.php">Login Here</a>.</p></div>'; 
        } else {
          echo 'ERROR';
        }}

?>

        

      </body>
</div>
            </html>  













































