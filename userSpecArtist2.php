<!DOCTYPE html>
<html>

<head>

    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/selectArtist.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>



<body> 



<?php
session_start();


if(!isset($_SESSION['id']))
	{header("location:login.php");
	}
 include("functions/header.php");?>

<br>
<br>
<br>


<?php 


$query = "SELECT DISTINCT artist_name FROM artist ORDER BY artist_name"; 
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$data = json_decode($resource, true);


?>

<div id= centred_p>

 Select  Artist  :  


 <select id="artist_name" onchange="selectArtist('functions/showSpecifiedNameArtist.php', 'artist_name')"> 
 

 <?php 
foreach($data as $rows){
    ?>

<option value="" selected disabled hidden>Select an Artist</option>

    <option value="<?php echo $rows['artist_name']; ?>" > <?php echo $rows['artist_name']; ?> 

</option>


</div>

<?php 
}
 ?>


</select>
<br>
<br>
<br>
<br>
<hr>
<br>
<br>

<table>

<!--- 
<tr>
<thead>Album Artist ID</thead>
<thead>Album Artist Name</thead>
<thead>Album Rank</thead>
<thead>Album Name</thead>
</tr>
 --->


<th>Album Artist</th>
<th>Album Name</th>
<th>Album Rank</th>
<th>Album Release Year</th>









<tbody id="ans">




</tbody>

</table>






 <!---   comment blank   --->

</body>

</html>