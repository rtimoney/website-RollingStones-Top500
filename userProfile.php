<!DOCTYPE html>
<html lang="en">



<head>
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/hide.js"></script>
</head>
<body>
<?php


session_start();


	if(!isset($_SESSION['id']))
	{header("location:login.php");
	}


include("functions/header.php");

$userid = $_SESSION["id"];


  $query = "SELECT user.user_id, user.user_email, user.user_username, user.create_datetime FROM user WHERE user.user_id =$userid";
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $data = json_decode($resource, true);




 
  foreach($data as $row){
    $userEmail=$row["user_email"];
    $userUsername=$row["user_username"];
    $userCreated=$row["create_datetime"];
    $userCreatedDT= new DateTime($row["create_datetime"]);

  }

  $current_datetime = new DateTime(date("Y-m-d H:i:s"));
 
  $interval = $current_datetime->diff($userCreatedDT);

?>
<br>
<div id=centred_p><h1> Welcome to your User Profile </h1></div>
<br><hr>
<table>
<td> You have been a member since : </td>
<td><?php echo $userCreated; ?> </td>
<td> It has been a wonderful <?php echo $interval->format('%d days')?> </td>
</tr>
</table>
<br>
<hr>








<div id=centred_p>
<h1> Your Details <h1> </div>
<table>
<tr>
<td> Your Username </td>
<td><?php echo $userUsername; ?> </td>

<tr>
<td> Your Email </td>
<td><?php echo $userEmail; ?> </td>

</tr>
</table>
<br>
<hr>
<br>

<div id=centred_p>
<h1> Your Reviews <h1> </div>

<?php
include("functions/userFunctions.php");
displayReviews($userid);?>

<div id=centred_p>
<h1> Your Favourites <h1> </div>


<?php

displayFavs($userid);?>

<div id=centred_p>
<h1> Your Owned Albums<h1> </div>


<?php

displayOwned($userid);



if(!isset($_SESSION['id'])) {
    header("Location: index.php");
  }

 
  $query = "SELECT user.user_id, user.user_email, user.user_username, user.create_datetime FROM user WHERE user.user_id = $userid";
 $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
 $resource = file_get_contents($endpoint);
 $data = json_decode($resource, true);

  foreach($data as $row){
    $userEmail=$row["user_email"];
    $userUsername=$row["user_username"];

 
?>
<hr>
<div id="centred_p"><h1>Update your info :</h1></div>
<div id="loginInputs">
<button onclick="hide()">** Edit Profile Here **</button>

<div id="hiddenDiv" style="display:none">

 
<form action="change.php" action="" method="post">
    <div>
      <label for="uname"><a>User Name:</a></label>
      <input type="text" name="username"  value="<?php echo $row["user_username"]?>"/>
    </div>

    <div>
      <label for="email"><a>Email:</a></label>
      <input type="text" name="useremail"  value="<?php echo $row["user_email"]?>"/>
    </div>

    <input type="submit"  value="Submit">

  </form>
  
</div>
<hr><br>
<h1>Change Password:</h1>
<a href='updatePassword.php'>Change Your Password Here
    </a>
    <br><hr>

</div>
<?php

 




}


{ // edit comments 
  ?>
  <div id="centred_p">
  <h1>Edit your reviews:</h1>
<hr><?php 

  $query = "SELECT album.album_name, album.album_artwork_link, artist.artist_name, comment_text, comment_time, rating, comment.album_id FROM album INNER JOIN artist ON album.album_artist = artist.artist_id INNER JOIN comment ON album.album_id = comment.album_id WHERE comment.user_id = {$userid}";

  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $result = json_decode($resource, true);

  if (!$result) {
      echo "";
    } else {

     

      foreach ($result as $row){
          $reviewDate=$row["comment_time"];
          $reviewText = $row['comment_text'];
          $reviewRating = $row['rating'];
          $albumName = $row['album_name'];
          $id = $row['album_id'];


          ?>




<form method="post">
  <h1 class="login-title"> Your Review of : <?php echo $row['album_name']; ?></h1>
  <div id="loginInputs">

  <input type="text" class="login-input" name="review<?php echo $id?>" value="<?php echo $reviewText?>" maxlength="250" required />
  <br>
  <?php  echo "<select name='reviewRatingFor$id' id='reviewRatingFor$id'>"?>

<?php  echo "<option value='$reviewRating' selected>'$reviewRating/10'</option>"?> 
<?php  for ($x = 1; $x <= 10; $x++) {echo "<option value=$x>$x/10</option>";} ?>
</select>
<br>
  <input type="submit" name="review<?php echo $albumName?>" value="Update Review" class="login-button">
  </form>

<br><hr>

  <?php

if (isset($_REQUEST["review$id"])) {

  $rating= ($_REQUEST["reviewRatingFor$id"]);
  $comment= ($_REQUEST["review$id"]);

   
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?updateReview";

$postdata=http_build_query(
  array(
      'comment' => $comment,
      'date' => $reviewDate,
      'userid' => $userid,
      'albumid' => $id,
      'rating' => $rating,
      
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
  



   echo "<meta http-equiv='refresh' content='0'>"; 
   ?>
   </div> <?php

} // if submitted
} // result as row 

} // else 


}// end of edit review block 



{ // allow user to delete their own account

?>
<div id="centred_p">
  <h1> DELETE USER ACCOUNT : </h1>
<br>
    
    <a href="functions/deleteUserAccountbyUser.php?user_id=<?php echo $userid;?>" class=a_button_deny> DELETE YOUR ACCOUNT PERMANENTLY  </a> </div><br><hr><br>
    <hr>

<?php


    echo  "<a href='index500.php'>home
    </a>";
}?>
</div>

</body>
    </html>