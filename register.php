<!DOCTYPE html>
<html>

<head>
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
</head>

<body> 

<?php include("functions/header.php");?>
<?php
require("functions/dbconn.php");


if (isset($_REQUEST['username'])) {
    // removes backslashes
    $username = stripslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($conn, $username);
    $email    = stripslashes($_REQUEST['email']);
    $email    = mysqli_real_escape_string($conn, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    $create_datetime = date("Y-m-d H:i:s");
    $securityQ = stripslashes($_REQUEST['securityq']);
    $securityQ = mysqli_real_escape_string($conn, $securityQ);
    $securityA = stripslashes($_REQUEST['securitya']);
    $securityA = mysqli_real_escape_string($conn, $securityA);
    
    
    
  /*  $query    = "INSERT into `user` (user_username, user_password, user_email, create_datetime)
    VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
  */  
  $check    = "SELECT * FROM user WHERE user_username='$username'"; //OR user_email=$email
$runCheck   = mysqli_query($conn, $check);


$check2    = "SELECT * FROM user WHERE user_email='$email'";
$runCheck2   = mysqli_query($conn, $check2);

if (mysqli_num_rows($runCheck) > 0){
  while ($row = $runCheck->fetch_assoc()) {
    echo "<h1> Username taken, please try again </h1>";
    
    echo "<a href='register.php'>Try Again</a><br><hr>";
  }


} elseif(mysqli_num_rows($runCheck2) > 0){
  while ($row = $runCheck2->fetch_assoc()) {
    echo "<h1> Email already registered, please login or try again </h1>";
    echo "<a href='login.php'>Login</a><br><hr>";
    echo "<a href='register.php'>Try Again</a><br><hr>";
  }
}  else{
    
    
    

    $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?register";

$postdata=http_build_query(
  array(
      'username' => $username,
      'password' => $password,
      'email' => $email,
      'date' => $create_datetime,
      'q' => $securityQ,
      'a' => $securityA,

      
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




    if ($resource) {
        echo "<div class='form'>
              <h3>You are registered successfully.</h3><br/>
              <p class='link'>Click here to <a href='login.php'>Login</a></p>
              </div>";
    } else {
        echo "<div class='form'>
              <h3>Required fields are missing.</h3><br/>
              <p class='link'>Click here to <a href='register.php'>registration</a> again.</p>
              </div>";
    }
  } 
}

else {
?>
<form class="form" action="" method="post">
    <h1 class="login-title">Registration</h1>
    <div id="loginInputs">

    <input type="text" class="login-input" name="username" placeholder="Username" required />
    <input type="text" class="login-input" name="email" placeholder="Email Adress">
    <input type="password" class="login-input" name="password" placeholder="Password"><br>
    <input type="text" class="securityq" name="securityq" placeholder="Security Question">
    <input type="text" class="securitya" name="securitya" placeholder="Security Answer"><br>
    <input type="submit" name="submit" value="Register" class="login-button">
   

</div>


 <p class="link">
  <div id="centred_p">   
 <a href="login.php">Click to Login</a>

</div>
</p>
 



</form>
<?php
}


?>
   

    


 <!---   comment blank   --->



</div>

</body>

</html>