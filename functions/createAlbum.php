<head>
    <title>500GreatestExplored</title>
    <link href="../ui.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/hide.js"></script>
</head>

<?php

session_start();


include("header.php");



// add new year to the database and set year id as $yearID

$years = ($_REQUEST['year']);



foreach ($years as $year){ 


//$year = stripslashes($year);


if (!$year==""){

         
   // $query1 = "SELECT album_release_year FROM release_year WHERE album_release_year='$year'";
   // $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query1);
   $query1 = "SELECT album_release_year FROM release_year WHERE album_release_year LIKE";
   $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom1&query=".urlencode($query1)."&search=".urlencode($year);
      $resource = file_get_contents($endpoint);
        $data = json_decode($resource, true);

      
      
     
    

    if (count($data)==0) { 
    
      $query1 = "INSERT INTO release_year (album_release_year)
      VALUES ('$year')";
      $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query1);
       $resource = file_get_contents($endpoint);
       $data = json_decode($resource, true);
        }
      
        $query = "SELECT year_id FROM release_year WHERE album_release_year='$year'";
        $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
       
    $resource = file_get_contents($endpoint);
    $data = json_decode($resource, true);

        foreach($data as $row){
          $yearID = $row["year_id"];

         
          
        }
      
      // echo "Year ID : ".$yearID;
      
      
      }}




// add new artists to the database and set artist id

$artists = $_REQUEST['artist'];

foreach ($artists as $artist){
  $artist = stripslashes($artist);
if (!$artist==""){

  

         
    $query = "SELECT * FROM artist WHERE artist_name='$artist'";
    $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
    $resource = file_get_contents($endpoint);
  
    $data = json_decode($resource, true);

    // echo count($data); 



    if (count($data)<1) { 

      
      
      $query = "INSERT INTO artist (artist_name) VALUES ('$artist')";
      $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
      $resource = file_get_contents($endpoint);
      $data = json_decode($resource, true);      
        }



        $query = "SELECT artist_id FROM artist WHERE artist_name='$artist'";
        $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
    $resource = file_get_contents($endpoint);
    $data = json_decode($resource, true);
       

        foreach ($data as $row) {
          $artistID = $row["artist_id"];
        
        }
      
      // echo $artistID;
      
      
      }}

      
  // set items which can go straight into album table
        $album = stripslashes($_REQUEST['album_name']);
        $rank = stripslashes($_REQUEST['album_rank']);
        $artwork = stripslashes($_REQUEST['album_artwork']);
        $spotify = stripslashes($_REQUEST['album_spotify']);

        
      //  echo $album;
   //     echo $rank;
   //     echo $artwork;
    //    echo $spotify;
    //    echo $artistID;
    //    echo $yearID; 



        $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?createAlbum";

        $postdata=http_build_query(
          array(
              'album' => $album,
              'rank' => $rank, 
              'cover' => $artwork, 
              'spotify' => $spotify, 
              'artist' => $artistID, 
              'year' => $yearID,
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



  
    
  
  
$query="SELECT album_id from album WHERE album_name='$album' AND album_artist='$artistID'";
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);  
$resource = file_get_contents($endpoint);
    $data = json_decode($resource, true);
foreach ($data as $row ) {
  $albumID = $row["album_id"];
}

// echo "album id : ".$albumID;


// add any new genres to the database and then populate genre_album table
$genres = $_REQUEST['genre'];

foreach ($genres as $genre)
{

  $genre = stripslashes($genre);

if (!$genre==""){

 
$query = "SELECT genre_name FROM genre WHERE genre_name='$genre'";
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
    $resource = file_get_contents($endpoint);
    $data = json_decode($resource, true);

   // echo "<br> genre count : ";
//    echo count($data);


if (count($data)==0) { 



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
}}


if (!$genre==""){


 
  $query = "SELECT genre_id FROM genre WHERE genre_name='$genre'";
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
    $resource = file_get_contents($endpoint);
    $data = json_decode($resource, true);



    foreach ($data as $row){


      $genreID = $row["genre_id"];


      

$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?addAlbumGenre";

$postdata=http_build_query(
  array(
      'genreid' => $genreID, 'albumid' => $albumID, 
      
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
  }

}



// add any new subgenres to the database and then populate subgenre_album table

$subgenres = $_REQUEST['subgenre'];

        foreach ($subgenres as $subgenre)
        {

          $subgenre = stripslashes($subgenre);


if (!$subgenre==""){

         
    $query = "SELECT subgenre_name FROM subgenre WHERE subgenre_name='$subgenre'";
    $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
    $resource = file_get_contents($endpoint);
    $data = json_decode($resource, true);
   // echo "<br> subgenre count : ";
   // echo count($data);
  


    if (count($data)==0) { 

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


        }}
      
      
      
      
        if (!$subgenre==""){



 
          $query = "SELECT subgenre_id FROM subgenre WHERE subgenre_name='$subgenre'";
          $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
          $resource = file_get_contents($endpoint);
          $data = json_decode($resource, true);
          
        

         foreach($data as $row){
    
            $subgenreID = $row["subgenre_id"];
          
            
           

$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?addAlbumSubgenre";

$postdata=http_build_query(
  array(
      'subgenreid' => $subgenreID, 'albumid' => $albumID, 
      
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
          }
      
      
      
      
      
      
      
      
      
      
          
      
      
      
      
      
      }

echo "<div id=centred_p><a href='../index.php'>Return to Album List</a></div>";


?>