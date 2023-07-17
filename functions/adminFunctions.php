<head>
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/hide.js"></script>
 
</head>


<?php


function createAnAlbum()
{



$query = "SELECT DISTINCT genre_name FROM genre ORDER BY genre_name"; 
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$genre = json_decode($resource, true);

$query = "SELECT DISTINCT album_release_year FROM release_year ORDER BY album_release_year"; 
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$year = json_decode($resource, true);


$query = "SELECT DISTINCT subgenre_name FROM subgenre ORDER BY subgenre_name"; 
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$subgenre = json_decode($resource, true);


$query = "SELECT DISTINCT artist_name FROM artist ORDER BY artist_name"; 
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$artist = json_decode($resource, true);



?>





<div id="loginInputs">
<button onclick="hide()">** Add New Album Here **</button>

<div id="hiddenDiv" style="display:none">
<br><h1>Add a New Album</h1><br>
 
<form action="functions/createAlbum.php" action="" method="post">

<!--- NAME  --->
    <div>
      <label><a>Album Name:</a></label>
      <br>
      <input type="text" name="album_name"  value=""/>
    </div> <br>

    <!--- RANKING  --->
    <div>
      <label><a>Album Ranking:</a></label>
      <br>
      <input type="text" name="album_rank"  value=""/>
    </div>
    <br>

    <!--- YEAR  --->

    <div id= centred_p>

<label><a>Select One Year:</a></label>
<br>
<p>Only enter a new year if the correct year is not available as a pre-populated option.</p>
<select id ="year" name="year[]" size="10" multiple="yes>

<?php 
foreach($year as $rows){
?>


<option value="<?php echo $rows['album_release_year']; ?>" > <?php echo $rows['album_release_year']; ?></option>


<?php } ?>
</select>
<input type="text" name="year[]"  value=""/></option>
</div>
<br>




    <!--- GENRE  --->

    <div id= centred_p>

<label><a>Select Genre(s):</a></label>
<br>
<p>You may control-click (Windows) or command-click (Mac) to select more than one.</p>
<select id ="genre" name="genre[]" multiple="yes" size="10">

<?php 
foreach ($genre as $rows){
?>


<option value="<?php echo $rows['genre_name']; ?>" > <?php echo $rows['genre_name']; ?></option>


<?php } ?>
</select>
<input type="text" name="genre[]"  value=""/></option>
</div>
<br>



    <!--- SUBGENRE  --->

    <div id= centred_p>

<label><a>Select Subgenre:</a></label>
<br>
<p>You may control-click (Windows) or command-click (Mac) to select more than one.</p>
<select id ="subgenre" name="subgenre[]" multiple="yes" size="10">
<option value="" selected disabled hidden>Select or Enter Artist</option>

<?php 
foreach($subgenre as $rows){
?>


<option value="<?php echo $rows['subgenre_name']; ?>" > <?php echo $rows['subgenre_name']; ?></option>


<?php } ?>
</select>
<input type="text" name="subgenre[]"  value=""/></option>
</div>
<br>

  <!--- ARTIST  --->

  
  <div id= centred_p>

<label><a>Select One Artist:</a></label>
<br>
<p>Only enter a new artist if the correct artist is not available as a pre-populated option.</p>
<select id ="artist" name="artist[]" size="10" multiple="yes">

<?php 
foreach($artist as $rows){
?>


<option value="<?php echo $rows['artist_name']; ?>" > <?php echo $rows['artist_name']; ?></option>


<?php } ?>
</select>
<input type="text" name="artist[]"  value=""/></option>
</div>
<br>


  

<!--- ARTWORK  --->
<div>
      <label><a>Link to Album Artwork:</a></label>
      <br>
      <input type="text" name="album_artwork"  value=""/>
    </div>
    <br>

    <!--- SPOTIFY EMBED  --->
<div>
      <label><a>Subway Embeded :</a></label>
      <br>
      <input type="text" name="album_spotify"  value=""/>
    </div>
    <br>

    <input type="submit"  value="Submit">

  </form>
  
</div>
<?php
}






/*
NEW FUNCTION --------------------------------------------___________________________________________________________________________------------------------------------

*/






function editAnAlbum($album_id)
{



$query = "SELECT DISTINCT genre_name FROM genre ORDER BY genre_name"; 
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$genre = json_decode($resource, true);

$query = "SELECT DISTINCT album_release_year FROM release_year ORDER BY album_release_year"; 
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$year = json_decode($resource, true);


$query = "SELECT DISTINCT subgenre_name FROM subgenre ORDER BY subgenre_name"; 
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$subgenre = json_decode($resource, true);


$query = "SELECT DISTINCT artist_name FROM artist ORDER BY artist_name"; 
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$artist = json_decode($resource, true);

$query = "SELECT album_ranking,album_name,album_artwork_link,album_spotify_embed, artist_name, album_release_year FROM album INNER JOIN release_year ON release_year.year_id = album.album_year INNER JOIN artist ON album_artist=artist_id WHERE album_id='$album_id'";
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$data1 = json_decode($resource, true);


foreach($data1 as $rows){

$albumRank= $rows['album_ranking']; 
$albumName= $rows['album_name']; 
$albumArtwork= $rows['album_artwork_link']; 
$albumSpotify= $rows['album_spotify_embed']; 
$albumYear= $rows['album_release_year']; 
$albumArtist= $rows['artist_name']; 

} ?>

<div id="loginInputs">




<br><h1> Edit Album : <?php echo $albumName ?></h1><br><hr>
 
<form action="" action="" method="post">

                                                                                                                    <!--- NAME  --->
    <div>
      <label><a>Edit Album Name:</a></label>
      <br><br>
      <input type="text" name="album_name"  value="<?php echo $albumName?>"/>
    </div> 

    <input type="submit"  value="CHANGE">

  </form><hr><br>


<?php
  if(isset($_REQUEST['album_name'])) {

  $album_name = stripslashes($_REQUEST['album_name']);

  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?albumName";

  
  $postdata=http_build_query(
    array(
        'albumname' => 
        $album_name,   'albumid' => 
        $album_id,             
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


  if($resource){  if($resource){
    $dataUpdated='Album Name';
    refreshButton($dataUpdated);
}}}


?>



 
                                                                                                                     <!--- RANKING  --->
 <form action="" action="" method="post">
                                                                                                                  
    <div>
      <label><a>Edit Album Ranking:</a></label>
      <br><br>
      <input type="text" name="album_rank"  value="<?php echo $albumRank?>"/>
    </div>
    
    <input type="submit"  value="CHANGE">

  </form><hr><br>

  
<?php
  if(isset($_REQUEST['album_rank'])) {

  $album_rank = stripslashes($_REQUEST['album_rank']);

$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?albumRank";

  
$postdata=http_build_query(
  array(
      'albumrank' => 
      $album_rank,   'albumid' => 
      $album_id,             
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


if($resource){  if($resource){
    $dataUpdated='Album Ranking';
    refreshButton($dataUpdated);
}}}

?>



                                                                                                                    <!--- YEAR  --->

    <div id= centred_p>
<form action="" action="" method="post">

<label><a>Edit Release Year:</a></label>
<br><br>

<input type="text" name="year"  value="<?php echo $albumYear?>"/>
</div>
<input type="submit"  value="CHANGE">

</form><hr><br>




<?php
  if(isset($_REQUEST['year'])) {




   
      $year = $_REQUEST['year'];
    
      $year = stripslashes($year); 
      
      if (!$year==""){ 

      $query = "SELECT album_release_year FROM release_year WHERE album_release_year='$year'";
       $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
          $resource = file_get_contents($endpoint);
          $query1 = json_decode($resource, true);
      
      if (count($query1)==0) { 
      
      

      $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?albumYear";

  
      $postdata=http_build_query(
        array(
            'year' => 
            $year,               
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
    
      }
      


  $album_year = stripslashes($_REQUEST['year']);
  $query = "SELECT year_id FROM release_year WHERE album_release_year='$album_year'";   
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $getYearIDRun = json_decode($resource, true);

  foreach($getYearIDRun as $row){
      $year_id=$row['year_id'];
}
    

 
  
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?albumYearid";

  
  $postdata=http_build_query(
    array(
        'yearid' => $year_id,
        'albumid'=> $album_id,                 
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

  if($resource){
    $dataUpdated='Album Release Year';
    refreshButton($dataUpdated);
}}}

?>

                                                                                                                    <!--- artist  --->

<div id= centred_p>
<form action="" action="" method="post">

<label><a>Edit Album Artist:</a></label>
<br><br>

<input type="text" name="artist"  value="<?php echo $albumArtist?>"/>
</div>
<input type="submit"  value="CHANGE">

</form><hr><br>





<?php
  if(isset($_REQUEST['artist'])) {




   
      $artist = $_REQUEST['artist'];
    
      $artist = stripslashes($artist);
    
      if (!$artist==""){ 
      $query = "SELECT artist_id FROM artist WHERE artist_id='$artist'";
      $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
      $resource = file_get_contents($endpoint);
      $query1 = json_decode($resource, true);
      
      if (count($query1)==0) { 

      $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?addArtist";

  
      $postdata=http_build_query(
        array(
            'artist' => 
            $artist,            
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
      }
      


  $album_artist = stripslashes($_REQUEST['artist']);
  $query = "SELECT artist_id FROM artist WHERE artist_name='$album_artist'";   
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $getartistIDRun = json_decode($resource, true);


 foreach($getartistIDRun as $rows){
      $artist_id=$rows['artist_id'];
  }  

  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?setArtistID";

  
  $postdata=http_build_query(
    array(
        'artistid' => 
        $artist_id,  'albumid' => 
        $album_id,           
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


  if($resource){
    $dataUpdated='Album Artist';
    refreshButton($dataUpdated);
}}}

?>









                                                                                                                    <!--- ARTWORK --->
    <div>

    <form action="" action="" method="post">
      <label><a>Edit Artwork Source:</a></label>
      <br><br>
      <input type="text" name="album_art"  value="<?php echo $albumArtwork?>"/>
    </div> 

    <input type="submit"  value="CHANGE">

  </form><hr><br>

  <form action="" action="" method="post">



<?php
  if(isset($_REQUEST['album_art'])) { 
   
  $art = $_REQUEST['album_art'];
  $art = stripslashes($art);
  
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?setArt";

  
  $postdata=http_build_query(
    array(
        'art' => 
        $art,  'albumid' => 
        $album_id,           
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


  if($resource){
    $dataUpdated='Album Artwork';
    refreshButton($dataUpdated);}
  
  }
  ?>


                                                                                                                    <!--- EMBEDED MUSIC PLAYER --->
<div>
<form action="" action="" method="post">
<label><a>Edit Music Player Source:</a></label>
<br><br>
<input type="text" name="album_spotify"  value="<?php echo htmlspecialchars($albumSpotify)?>"/>
</div> 

<input type="submit"  value="CHANGE">

</form><hr><br>
<?php
if(isset($_REQUEST['album_spotify'])) { 
   
   $spotify = $_REQUEST['album_spotify'];
   $spotify = stripslashes($spotify);
   
   $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?setSpotify";
 
   
   $postdata=http_build_query(
     array(
         'spotify' => 
         $spotify,  'albumid' => 
         $album_id,           
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
 
 
   if($resource){
     $dataUpdated='Spotify';
     refreshButton($dataUpdated);}
   
   }
   ?>











                                                                                                                  <!--- REMOVE GENRE  --->




                                                                                                                 

    <div id= centred_p>

<label><a>Remove Genre(s):</a></label>
<br>

<?php 

$query = "SELECT album.album_id, genre_name, genre.genre_id FROM album INNER JOIN album_genre ON album.album_id = album_genre.album_id INNER JOIN genre ON album_genre.genre_id = genre.genre_id WHERE album.album_id='$album_id'";
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$data1 = json_decode($resource, true);





  foreach ($data1 as $rows){
  $g=$rows['genre_name'];
  $i=$rows['genre_id'];

?>

  <form method="post">
<?php echo "
 <input type='submit' name='test{$i}'
  class='button' value='REMOVE $g'>"?>

  
</form>
</form>

<?php
  if (isset($_POST["test$i"])) {



      $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?deleteGenre";

  
      $postdata=http_build_query(
        array(
            'genreid' => 
            $i,  'albumid' => 
            $album_id,           
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
      
      
      if ($resource) {
      
      echo "<br></div><meta http-equiv='refresh' content='0'>"; 
      }
    

  } 
} ?>
</div>
<br>


<hr><br>



 <!--- ADD A GENRE - FORM --->

 <div id= centred_p>

 <form action="" action="" name="genre[]" method="post">
<label><a>Add Genre(s):</a></label>
<br>

 
<p>You may control-click (Windows) or command-click (Mac) to select more than one.</p>




<select id ="genre" name="genre[]" multiple="yes" size="10">

<?php
foreach($genre as $rows){   ?>
<option value="<?php echo $rows['genre_name']; ?>" > <?php echo $rows['genre_name']; ?></option>
<?php } ?> 
<input type="text" name="genre[]"  value=""/></option>
</select>


<input type="submit">
</div> <br>
</form>
<?php


// add any new genres to the database and then populate genre_album table


if (isset($_REQUEST["genre"])) {
$genres = $_REQUEST['genre'];
foreach ($genres as $genre)
{

  echo $genre;

  $genre = stripslashes($genre); 

if (!$genre==""){ 
$query = "SELECT genre_name FROM genre WHERE genre_name='$genre'";
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$query1 = json_decode($resource, true);

if (count($query1)==0) { 

  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?createGenre";

  $postdata=http_build_query(
    array(
        'genre' => $genre,
        
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

    if ($resource) {
      
      echo "<br></div><meta http-equiv='refresh' content='0'>"; 
      }



}}


if (!$genre==""){


 
  $query = "SELECT genre_id FROM genre WHERE genre_name='$genre'";
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $rungetgenreID = json_decode($resource, true);



    foreach ($rungetgenreID as $row){
     

    $genreID = $row["genre_id"];


  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?addAlbumGenre";
   
$postdata=http_build_query(
  array(
      'genreid' => $genreID, 'albumid' => $album_id, 
      
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

  if ($resource) {
      
    echo "<br></div><meta http-equiv='refresh' content='0'>"; 
    }





        }
      }
}


}

?>


<br><hr><br>


<!--- REMOVE SUBGENRE  --->




       
<div id= centred_p>

<label><a>Remove Subenre(s):</a></label>
<br>

<?php 

$query = "SELECT album.album_id, subgenre_name, subgenre.subgenre_id FROM album INNER JOIN album_subgenre ON album.album_id = album_subgenre.album_id INNER JOIN subgenre ON album_subgenre.subgenre_id = subgenre.subgenre_id WHERE album.album_id='$album_id'";
 $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
 $resource = file_get_contents($endpoint);
 $data1 = json_decode($resource, true);




foreach ($data1 as $rows){
$g=$rows['subgenre_name'];
$i=$rows['subgenre_id'];



?>

<form method="post">
<?php echo "
<input type='submit' name='test{$i}'
class='button' value='REMOVE $g'>"?>


</form>
</form>

<?php
if (isset($_POST["test$i"])){  
  
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?deleteSubgenre";

  
  $postdata=http_build_query(
    array(
        'subgenreid' => 
        $i,  'albumid' => 
        $album_id,           
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
  
  if ($resource) {
    
  echo "<br></div><meta http-equiv='refresh' content='0'>"; 
  }


} 
} ?> </div> <br> <hr><br>

<!--- ADD A Subgenre - FORM --->

<div id= centred_p>

<form action="" action="" name="subgenre[]" method="post">
<label><a>Add subgenre(s):</a></label>
<br>


<p>You may control-click (Windows) or command-click (Mac) to select more than one.</p>




<select id ="subgenre" name="subgenre[]" multiple="yes" size="10">

<?php
foreach($subgenre as $rows) {   ?>
<option value="<?php echo $rows['subgenre_name']; ?>" > <?php echo $rows['subgenre_name']; ?></option>
<?php } ?> 
<input type="text" name="subgenre[]"  value=""/></option>
</select>


<input type="submit">
</div> <br>
</form>
<?php


// add any new subgenres to the database and then populate subgenre_album table


if (isset($_REQUEST["subgenre"])) {
$subgenres = $_REQUEST['subgenre'];
foreach ($subgenres as $subgenre)
{

 echo $subgenre;

 $subgenre = stripslashes($subgenre);   

if (!$subgenre==""){ 
$query = "SELECT subgenre_name FROM subgenre WHERE subgenre_name='$subgenre'";
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$query1 = json_decode($resource, true);

if (count($query1)==0) { 

  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?createSubgenre";

  $postdata=http_build_query(
    array(
        'subgenre' => $subgenre,
        
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
    
    if ($resource) {
    
      echo "<br></div><meta http-equiv='refresh' content='0'>"; 
      }
}}


if (!$subgenre==""){



 $query = "SELECT subgenre_id FROM subgenre WHERE subgenre_name='$subgenre'";
 $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
 $resource = file_get_contents($endpoint);
 $rungetsubgenreID = json_decode($resource, true);



   foreach ($rungetsubgenreID as $row){
    

   $subgenreID = $row["subgenre_id"];


$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?addAlbumSubgenre";

$postdata=http_build_query(
  array(
      'subgenreid' => $subgenreID, 'albumid' => $album_id, 
      
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
  
  if ($resource) {
    
    echo "<br></div><meta http-equiv='refresh' content='0'>"; 
    }
       }
     }
}










}

?>
<br><hr><br><h1> REMOVE ALBUM : <?php echo $albumName ?></h1><br>

<form method="post">
<?php echo "
<input type='submit' name='test{$album_id}'
class='button' value='REMOVE $albumName'>"?>
</form>

<?php
if (isset($_POST["test$album_id"])) {


  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?deleteAlbum";

  $postdata=http_build_query(
    array(
       'albumid'=>$album_id, 
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
    
  
  if ($resource) {
    $dataUpdated = 'List of Albums';
    backtoEditAlbumPage($dataUpdated);
  }


}


}

 ?> </div> <br> <hr><br>


















<?php







  function refreshButton($dataUpdated){
    echo "$dataUpdated Successfully Updated";
    ?>
        <form method="post">
        <?php echo "
         <input type='submit' name='refresh'
          class='button' value='Refresh Page'><br><hr><br>"?>
        
          
        </form>
        </form>
        
    <?php
    
    if (isset($_POST["refresh"])) {echo "<br></div><meta http-equiv='refresh' content='0'>";
    
       // echo "<br></div><meta http-equiv='refresh' content='0'>"; 
      } 
    }
 


    function backtoEditAlbumPage($dataUpdated){
      echo "$dataUpdated Successfully Updated";
      ?>
        
          <?php echo "<a href='./editAlbum.php'>Return to Album List</a>"?>
          
     <?php
      }
?>

       