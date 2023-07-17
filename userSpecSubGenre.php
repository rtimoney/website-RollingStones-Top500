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

// release_year.album_release_year
$query = "SELECT DISTINCT subgenre_name FROM subgenre ORDER BY subgenre_name"; 
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$data = json_decode($resource, true);


?>

<div id=centred_p> 

 Select  Subgenre  :  

 <select id="subgenre_name" onchange="selectArtist('functions/showSpecifiedSubGenre.php', 'subgenre_name')"> 
 

 <?php 
foreach($data as $rows){
    ?>
<option value="" selected disabled hidden>Select a Subgenre</option>

    <option value="<?php echo $rows['subgenre_name']; ?>" > <?php echo $rows['subgenre_name']; ?> 

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

<th>Subgenre</th>
<th>Album Release Year</th>
<th>Artist Name</th>

<th>Album Name</th>

<th>Album Rank</th> 
 
<tbody id="ans">




</tbody>

</table>






 <!---   comment blank   --->
 <?php 

 ?>
</body>

</html>