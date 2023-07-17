

<!DOCTYPE html>
<html>

<head>
    <title>500GreatestExploredByYear</title>
    <link href="ui.css" rel="stylesheet"/>
</head>



 

  <body>


  <?php include("functions/header.php");?>

  
  <section class="section">
    <div class="container">
      <h1 class="title">
 
        
 
      </h1>

      <p class="subtitle">
 
 <?php

   $query = "SELECT album.album_ranking, album.album_name, album.album_artwork_link, release_year.album_release_year, artist.artist_name FROM album INNER JOIN release_year ON album.album_year = release_year.year_id INNER JOIN artist ON album.album_artist = artist.artist_id ORDER BY release_year.album_release_year";
            $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
            $resource = file_get_contents($endpoint);
            $result = json_decode($resource, true);
                    
          if(!$result){
             echo "No data available at this time";
          }
          foreach($result as $row){








               $albumrankdata=$row['album_ranking'];
              
               $albumnamedata=$row['album_name'];
            
               $artworkdata=$row['album_artwork_link'];
           
            $albumyeardata=$row['album_release_year'];

            $albumartistdata=$row['artist_name'];
        
               
     
     

echo '<div class ="dataDiv">';
            echo " 
            Year : $albumyeardata
            <br>
            Rank :  $albumrankdata 
            Name : $albumnamedata
            Artist : $albumartistdata"; 

            echo '</div>';
       
            echo "<br>";

           


           echo "<img src='$artworkdata'>"; 

        

         

            
               echo "<br>";
               ;          

               
               
   
 }
  
  ?>
 </p>


</div>
  </section>
  </body>
</html>











