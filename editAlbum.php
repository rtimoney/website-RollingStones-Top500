<head>

    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>

  
</head>



<?php

session_start();

if(!isset($_SESSION['id']))
	{header("location:login.php");
	}

    if(!isset($_SESSION['admin']))
	{header("location:login.php");
	}








  
  $query = "SELECT album_id, album_ranking, album_name, artist_name FROM album INNER JOIN artist on artist.artist_id = album.album_artist ORDER BY album_ranking";
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
          $resource = file_get_contents($endpoint);
          $data = json_decode($resource, true);

  if (!$data) {
    echo "No albums found at this time";
  } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>

<body class=" h-vh-100 bg-dark">
<?php include("functions/header.php"); ?>


  <div class="begincontent fg-white bg-black p-6 mx-auto border bd-default win-shadow">
    <h2>Albums : </h2>
    <?php
          foreach($data as $row){

            $a=$row["album_ranking"]."  :  '".$row["album_name"]."' by ".$row["artist_name"];

            echo "<div class=' bg-crimson fg-white p-1 mb-2 p-3-md p-5-lg p-8-xl text-center'>
                        <a class='button yellow outline pl-10 pr-10' href='editAlbumPage.php?info={$row["album_id"]}'>{$a}</a>
                </div> ";
          }
    ?>
  </div>
  
  <script src="https://cdn.metroui.org.ua/v4.3.2/js/metro.min.js"></script>

</body>
</html>































