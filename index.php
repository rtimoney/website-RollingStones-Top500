<head>

    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>

  
</head>



<?php

session_start();


if(!isset($_SESSION['id']))
	{header("location:login.php");
	}







  
  //$query = "SELECT * FROM album";

  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?selectAlbum";
  $resource = file_get_contents($endpoint);
  $data = json_decode($resource, true);
  if (!$data) {
    echo "No data found!";
  } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!---
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
    <link rel="stylesheet" href="solar.css">
     --->
</head>

<body class=" h-vh-100 bg-dark">
<?php include("functions/header.php"); ?>
<!---

  <div data-role="appbar" data-expand-point="md" class="bg-crimson fg-gray">
      <a href="#" class="brand no-hover">
            <span class="mif-spinner4 ani-spin black"> </span>  <span class="pl-2">Solar Me</span>
      </a>

      <ul class="app-bar-menu">

          <?php /*
            if (!$showBtn) {
              echo "<li><a href='login.php'>Login</a></li>";
            } else {
              echo "<li><a href='logout.php'>Logout</a></li>
                    <li><strong>Hello, $currentUser!</strong></li>";
            } */
          ?>

 
      </ul>
  </div>

  --->

  <div class="begincontent fg-white bg-black p-6 mx-auto border bd-default win-shadow">
    <h2>Albums : </h2>
    <?php
          foreach($data as $row){

           

            $a=$row["album_ranking"]."  :  '".$row["album_name"]."' by ".$row["artist_name"];

            echo "<div class=' bg-crimson fg-white p-1 mb-2 p-3-md p-5-lg p-8-xl text-center'>
                        <a class='button yellow outline pl-10 pr-10' href='album.php?info={$row["album_id"]}'>{$a}</a>
                </div> ";
          }
    ?>
  </div>
  
  <script src="https://cdn.metroui.org.ua/v4.3.2/js/metro.min.js"></script>

</body>
</html>