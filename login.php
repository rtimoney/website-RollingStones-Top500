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
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require("functions/dbconn.php");
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
      //  $sql = "SELECT user_id, user_username, user_password FROM user WHERE user_username = ?";
      $sql = "SELECT user_username, user_password FROM user WHERE user_username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password); //         mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                     if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                           // $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username; 
                            
                            $idstatement="SELECT user_id FROM user WHERE user_username = '$username'";
                            $result = $conn -> query($idstatement);
                            while ($row = $result->fetch_assoc()) {
                             $id= $row['user_id'];
                         
                         $_SESSION["id"] = $id;
                            }
 
                            

                           // $idstatement="SELECT user.user_id, role_id FROM user INNER JOIN user_role ON user_role.user_id =  user.user_id WHERE user.user_id = '$id' AND role_id='1'";
                           $idstatement="SELECT user.user_id, role_id FROM user INNER JOIN user_role ON user_role.user_id =  user.user_id WHERE user.user_id = ? AND role_id='1'";
                            
                           if($stmt = mysqli_prepare($conn, $idstatement)){
                            mysqli_stmt_bind_param($stmt, "i", $param_user_id);
                            $param_user_id = $id;
                            if(mysqli_stmt_execute($stmt)){
                                mysqli_stmt_store_result($stmt);
                                if(mysqli_stmt_num_rows($stmt) == 1){ 
                                    $_SESSION["admin"] = $id;

                           
                           
                           
                           }}}
/*
                           $result = $conn -> query($idstatement);
                            while ($row = $result->fetch_assoc()) {
                             $id= $row['user_id'];
                         
                            $_SESSION["admin"] = $id;
                            
                            }*/

                        




                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<body>
   <!--- <div class="wrapper"> --->
        <div id="centred_p">
        <h1>Login</h1> 
        <p>Please fill in your credentials to login.</p>
</div>
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <div id="loginInputs">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
              <!---  <label>Username</label> --->
                <input type="text" name="username" placeholder='Enter your name' class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
              <!---  <label>Password</label> --->
                <input type="password" name="password" placeholder='Enter your password' class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>

            <p>Forgot Password? <a href="resetPassword.php">Reset here</a>.</p>
        </form>

        </div>
    </div>
</body>
</html> 