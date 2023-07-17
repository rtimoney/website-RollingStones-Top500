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

 
require("functions/dbconn.php");
 
$userid = $_SESSION["id"];

$password = "";
$password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
     
    // Check if password is empty
    if(empty(trim($_POST["oldPassword"]))){
        $password_err = "Please enter your current password.";
    } else{
        $oldPassword = trim($_POST["oldPassword"]);
       // $newPassword = trim($_POST["newPassword"]);
       
    }
    
    // Validate credentials
    if(empty($password_err)){
        // Prepare a select statement
      //  $sql = "SELECT user_id, user_username, user_password FROM user WHERE user_username = ?";
      $sql = "SELECT user_password FROM user WHERE user_id = $userid";
      
      $stmt = $conn->query($sql);
      
        echo "<hr>"; 
        while ($row = $stmt->fetch_assoc()) {
            $hashed_password=$row["user_password"];
           
         if(password_verify($oldPassword, $hashed_password)){

if(isset($_REQUEST['newPassword'])) {

    $query = "SELECT user.create_datetime FROM user WHERE user.user_id = '$userid'";
      $result = $conn->query($query);
     
      while ($row = $result->fetch_assoc()) {
        $userCreated=$row["create_datetime"];
    
      }
    
      $newPass = stripslashes($_REQUEST['newPassword']);
      $newPass = mysqli_real_escape_string($conn, $newPass);
   
    
      $results = ("UPDATE user SET user_password='" . password_hash($newPass, PASSWORD_DEFAULT) . "', create_datetime='$userCreated' WHERE user.user_id='$userid'");   
     
      $resultsRun = $conn->query($results); 
    
      if($resultsRun){
        echo '<div id=centred_p><h1>Success! Password updated</h1></div>'; 
      } else {
        echo 'ERROR';
      }

                        } 
                    } 
                  
                } 
            } 
        } 
         
       


?>
 
<body>
    <div class="wrapper">
        <h2>Change Password</h2>
        <!--- <p>Please fill in your current password to continue.</p> --->

   
        <div id="loginInputs">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
           
            <div class="form-group">
              <!---  <label>Password</label> --->
                <input type="password" name="oldPassword" placeholder='Enter your CURRENT password' class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="password" name="newPassword" placeholder='Enter your NEW password' class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Change Password">
            </div>
        </form>

        </div>
    </div>
</body>
</html> 