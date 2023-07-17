<!DOCTYPE html>
<html>

<head>

    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/selectArtist.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>



<body> 

<?php include("functions/header.php");?>

<br>
<br>
<br>


<?php 

session_start();


if(!isset($_SESSION['id']))
	{header("location:login.php");
	}

// release_year.album_release_year
$query = "SELECT DISTINCT genre_name FROM genre ORDER BY genre_name"; 
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$data = json_decode($resource, true);


?>
<div id= centred_p>
 Select  Genre  :  


 <select id="genre_name" onchange="selectArtist('functions/showSpecifiedGenre.php', 'genre_name')"> 

 <option value="" selected disabled hidden>Select a Genre</option>
 

 <?php 
foreach($data as $rows){
    ?>


    <option value="<?php echo $rows['genre_name']; ?>" > <?php echo $rows['genre_name']; ?> 

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

<th>Genre</th>
<th>Album Release Year</th>
<th>Artist Name</th>

<th>Album Name</th>

<th>Album Rank</th> 
<tbody id="ans">




</tbody>

</table>






 <!---   comment blank   --->

</body>

</html>