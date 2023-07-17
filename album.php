<!DOCTYPE html>
<html lang="en">


<?php
session_start();



if(!isset($_SESSION['id']))
	{header("location:login.php");
	}



include("functions/header.php");


$userid = $_SESSION["id"];

  $thisAlbumID = $_GET["info"];


  $query = "SELECT album.album_id, album.album_ranking, album.album_name, album.album_artwork_link, album.album_spotify_embed, release_year.album_release_year, artist.artist_name FROM album INNER JOIN release_year ON album.album_year = release_year.year_id INNER JOIN artist ON album.album_artist = artist.artist_id WHERE album.album_id = {$thisAlbumID}";
 $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
 $resource = file_get_contents($endpoint);
 $data = json_decode($resource, true);

?>


<head>
    <!-- Required meta tags -->
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
</head>

<body>

  <div>
    <?php



    include('functions/albumPageFunctions.php');




    printAlbumAverageRating($thisAlbumID);
    printAlbumSpecificDetails($thisAlbumID);
    ?>  
    
    <div id=row>
    <div id=halfcolumn>
    <div id=centred_p>
    
  


    <?php
    printAlbumGenreDetails($thisAlbumID);
?>

    </div>
    </div>
    <div id=halfcolumn>
    <div id=centred_p>



    <?php
    printAlbumSubgenreDetails($thisAlbumID);
?>


</div>
</div>
</div>
<div id=clearflex>



<?php
printAlbumReviews($thisAlbumID);
echo "<br><hr><br>";











// $userid = $_SESSION["id"];
// albumReviewWithCheck($thisAlbumID,$userid);
//                                                          this one reviewAlbum($thisAlbumID,$userid);
// favourite($thisAlbumID,$userid);

reviewAlbumRatingRequired($thisAlbumID,$userid);

 include ("favourite.php");
 include ("owned.php");

// favatt($thisAlbumID,$userid);


// $albumID=$thisAlbumID;

// favatt($thisAlbumID,$userid);





?>

<div id=row>
<div id=halfcolumn>
<div id=centred_p>




<?php
favatt($thisAlbumID,$userid);
?>

</div>
</div>
<div id=halfcolumn>
<div id=centred_p>



<?php
callOwned($thisAlbumID,$userid);
?>

</div>
</div>
</div>




<div id=clearflex> 
<br><hr><br>
</div>
</div>
</div>
<div id=clearflex> 







<?php


















if (!$data) {
  echo "No data found!";
} else {

foreach ($data as $row){

// display wiki on artist

$artist = $row["artist_name"];
     
echo "<hr><div id=centred_p><h1> Read more about : $artist </div></h1>"; 
echo"<div id = wikitext>";
echo wiki_apiSearch($artist);
echo"</div><hr>";

// display wiki on album
$album = $row["album_name"];
 
echo "<hr><div id=centred_p><h1> Read more about : $album </div></h1>"; 
echo"<div id = wikitext>";
echo wiki_apiSearch($album);
echo"</div><hr>";
  }}








/*

if (!$result) {
      echo $conn->error;
    } else {

      while ($row = $result->fetch_assoc()) {
        $artist = $row["artist_name"];
     
        echo "<div id=centred_p><h1> Read more about : $artist </div></h1>"; 
        echo"<div id = wikitext>";
    echo wiki_apiSearch($artist);
    echo"</div><hr>";
      }
    
 }
*/






{

    echo  "<a href='index.php'>back
    </a>";
}


   
?>
</div>


   <?php
/*


      if (!$result) {
        echo $conn->error;
      } else {

        while ($row = $result->fetch_assoc()) {

         // $search = $row["album_name"];

echo "Album Name : "; echo $row["album_name"]; ?> <br>
<hr>
<br>
<?php echo "Album Rank : ";echo $row["album_ranking"]; ?> <br>
<br>
<?php echo " Image :  <img src=$row[album_artwork_link]>";  ?> <br>
<br> 
<div id=spotifyalign>
<?php echo $row["album_spotify_embed"]; ?> 
</div> 
<br>
<br>
<?php 

$search = $row["album_name"];

include('functions/albumPageFunctions.php');

// apifunction($search);

echo wiki_apiSearch($search);

// echo $content; 


?> 



       

     
 

    

  </div>
  <?php
  
    }}
  ?>

<?php
$query2 = "SELECT album.album_id, album.album_ranking, album.album_name, album.album_artwork_link, album.album_spotify_embed, release_year.album_release_year, artist.artist_name, subgenre.subgenre_name
  FROM album
  INNER JOIN release_year 
  ON album.album_year = release_year.year_id
  INNER JOIN artist
  ON album.album_artist = artist.artist_id
  INNER JOIN album_subgenre ON album.album_id = album_subgenre.album_id
  INNER JOIN subgenre ON album_subgenre.subgenre_id = subgenre.subgenre_id   
  WHERE album.album_id = {$thisAlbumID}";

  $result2 = $conn->query($query2);
  echo "Subgenre(s) : ";

  if (!$result2) {
    echo $conn->error;
  } else {

    while ($row = $result2->fetch_assoc()) {

     // $search = $row["album_name"];
       echo $row["subgenre_name"]; echo " , "; 
      
      }
      
      
    } 
    ?>


    <br><br><br>
    <hr>
    
    
    <a href='index.php'>back</a>  
    
    
    <?php
      ?> <br>































*/

?>

</body>
    </html>