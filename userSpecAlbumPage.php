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


$query = "SELECT DISTINCT album_name FROM album ORDER BY album_id"; 
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$data = json_decode($resource, true);


?>

<?php
function setalbumName($name){
// return $name;
$nameset = $name;
}


?>
<div id= centred_p>

 Select  Album  :  


 <select id="album_name" onchange="selectArtist('functions/showSpecifiedAlbumSumm.php', 'album_name'),selectAlbumDataBody('functions/showSpecifiedAlbumBody.php', 'album_name'), setalbumName('album_name')"> 





 <!--- ,selectAlbumDataBody('functions/showSpecifiedAlbumBody.php', 'album_name') --->




 <?php 
foreach($data as $rows){
    ?>

<option value="" selected disabled hidden>Select an Album</option>

    <option value="<?php echo $rows['album_name']; ?>" > <?php echo $rows['album_name']; ?> 

</option>





<?php 

echo $nameset; 
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

 <!---   <tbody id="indalbumpagedata">  --->
<br>
 <br>
<hr>
<br>
<br>

<table>

<th>Spotify</th>

 <tbody id="indalbumpagedata">
<?php

 // selectAlbumDataBody('functions/showSpecifiedAlbumBody.php', 'album_name');

?>

</div>

</div> 


 <!---   comment blank   --->

</body>

</html>