<!DOCTYPE html>
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
include("functions/adminFunctions.php");
$user_id = $_GET["info"];

  $restriction='';
  $query="SELECT * FROM user WHERE user_id=$user_id";
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $data = json_decode($resource, true);

  if (!$data) {
    echo "No data available";
  } 

  foreach($data as $oneRun){
    $restriction=$oneRun["restriction"];}

function displayUserComments($user_id){









  $query = "SELECT album.album_id, album.album_name, comment_text, comment_time, rating, comment.user_id, comment.approval, comment_id, album.album_ranking FROM album INNER JOIN comment ON album.album_id = comment.album_id WHERE comment.user_id ='$user_id'";
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $data = json_decode($resource, true);

  if (!$data) {
    echo "No data available ";  // $conn->error;
  } else {

    

    // while ($row = $resultComments->fetch_assoc()) {
       foreach ($data as $row){
     
?>
       <table>
<tr>
<td> Album Ranking </td>
<td> Album Name </td>
<td> Comment ID </td>
<td> User ID </td>
<td> Rating </td>
<td> Comment </td>      

</tr>
<tr>
        <td><?php  echo $row["album_ranking"]; ?></td>
        <td><?php  echo $row["album_name"]; ?></td>
        <td><?php  echo $row["comment_id"]; ?></td>
        <td><?php  echo $row["user_id"]; ?></td>
        <td><?php  echo $row["rating"]; ?></td>
        <td><?php  echo $row["comment_text"]; ?></td>

        </tr>
    </table> 
    <br>
    <div id=centred_id>
    <a href="functions/deleteComment.php?comment_id=<?php echo $row["comment_id"];?>" class=a_button_deny> DELETE COMMENT </a> </div>
    <hr>
  <?php
  }}

}

?>

<head>
    <!-- Required meta tags -->
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
    <meta charset="utf-8">
  
 
</head>

<body>
<?php
$query = "SELECT * FROM user WHERE user.user_id='$user_id'";
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $data = json_decode($resource, true);

  if (!$data) {
    echo "error";
  } 
  foreach ($data as $row){
      $username = $row['user_username'];
      $email = $row['user_email'];
    }
?>

<div id="centred_p">


<br><h1> Edit User ID : <?php echo $user_id ?></h1><br><hr>

                                                                                            <!--- UPDATE USERNAME  --->

<form action="" action="" method="post">

                                                                                                                  
    <div>
      <label><a>Edit User Username:</a></label>
      <br><br>
      <input type="text" name="username"  value="<?php echo $username?>"/>
    </div> 

    <input type="submit"  value="CHANGE">

  </form><hr><br>


<?php
  if(isset($_REQUEST['username'])) {

  $insertdata = $_POST['username'];


   $endpoint="http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?updateUsername&userid=".urlencode($user_id);


  
  $postdata=http_build_query(
      array(
          'addData' => 
          $insertdata,           
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

      echo $resource;

 // $query = "UPDATE user SET user_username='$newname' WHERE user_id='$user_id'";   
 
   

 if($resource !== FALSE) {
 $dataUpdated='User Username';
   refreshButton($dataUpdated);
}}

?>



                                                                                            <!--- UPDATE email  --->

<form action="" action="" method="post">

                                                                                                                  
<div>
  <label><a>Edit User Email:</a></label>
  <br><br>
  <input type="text" name="email"  value="<?php echo $email?>"/>
</div> 

<input type="submit"  value="CHANGE">

</form><hr><br>


<?php
if(isset($_REQUEST['email'])) {

  
  $insertdata = $_POST['email'];


   $endpoint="http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?updateEmail&userid=".urlencode($user_id);


  
  $postdata=http_build_query(
      array(
          'addData' => 
          $insertdata,           
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

      echo $resource;

// $newemail = stripslashes($_REQUEST['email']);
// $newemail = mysqli_real_escape_string($conn, $newemail);
   



if($resource !== FALSE) {
$dataUpdated='User Email';
refreshButton($dataUpdated);
}}



?>

<!--- VIEW AND DELETE COMMENTS MADE BY CURRENT USER --->


<h1> Reviews by this User : </h1>
<?php  displayUserComments($user_id); 
?>
<br><hr>
<!--- RESTRICT OR UNRESTRICT ACCOUNT FOR CURRENT USER --->



<?php echo $restriction;

if ($restriction=='RESTRICTED'){ ?>




<h1> UNRESTRICT USER ACCOUNT : </h1>
<p> Allow user to begin making new reviews of albums.</p>
<br>
    <div id=centred_p>
    <a href="functions/unrestrictUserAccount.php?user_id=<?php echo $user_id;?>" class=a_button_deny> UNRESTRICT USER ACCOUNT FOR USER ID : <?php echo $user_id;?>  </a> </div>
    <hr>

</div>
<?php } else {



?>
<h1> RESTRICT USER ACCOUNT : </h1>
<p>Prevents user from making new reviews of albums.</p>
<br>
    <div id=centred_p>
    <a href="functions/restrictUserAccount.php?user_id=<?php echo $user_id;?>" class=a_button_deny> RESTRICT USER ACCOUNT FOR USER ID : <?php echo $user_id;?>  </a> </div>
    <hr>

</div>
<?php } ?>
<!--- DELETE ACCOUNT FOR CURRENT USER --->
<div id="centred_p">
<h1> DELETE USER ACCOUNT : </h1>
<br>
    
    <a href="functions/deleteUserAccount.php?user_id=<?php echo $user_id;?>" class=a_button_deny> DELETE USER ACCOUNT FOR USER ID : <?php echo $user_id;?>  </a> </div>
    <hr>

</div>
</body>
</html>