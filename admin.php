<!DOCTYPE html>

<head>
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/hide.js"></script>
 
</head>

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


function displayForReviewed(){
    
    $query = "SELECT album.album_id, album.album_name, comment_text, comment_time, rating, comment.user_id, comment.approval, comment_id, album.album_ranking FROM album INNER JOIN comment ON album.album_id = comment.album_id WHERE comment.approval ='PENDING'";
    $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
    $resource = file_get_contents($endpoint);
    $data = json_decode($resource, true);
    
?>

<div id="centred_p">
<h1> Reviews awaiting approval : </h1>



<?php

    if (!$data) {
        echo " No data available at this time :) ";
      } else {

       foreach($data as $row){
           
           
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



            <?php
    
           ?>
           <br>
     
  <div id=centred_p>
    

<div id=centred_id> <a href="functions/approve.php?comment_id=<?php echo $row["comment_id"];?>" class=a_button_app> Approve </a> 
 <a href="functions/deny.php?comment_id=<?php echo $row["comment_id"];?>" class=a_button_deny> Deny </a> </div>

      </div>
       
            <?php
            echo "<br>"; 

        }}}
        


    displayForReviewed();










// INSERT INTO `role` (`role_id`, `role_name`, `role_description`) VALUES (NULL, 'admin', 'Site admin');

?>
