<!DOCTYPE html>
<html>

<head>
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
</head>

<body> 

<?php include("functions/header.php");?>
<?php

session_start();


if(!isset($_SESSION['id']))
	{header("location:login.php");
	}



if (isset($_REQUEST['search'])) {

    $search = stripslashes($_REQUEST['search']);
    
   
  $query    = "SELECT album_id, album_name, artist_name FROM album INNER JOIN artist ON album.album_artist = artist.artist_id WHERE artist_name LIKE"; //OR user_email=$email
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom1&query=".urlencode($query)."&search=".urlencode($search);
  $resource = file_get_contents($endpoint);
  $runCheck = json_decode($resource, true);


if (count($runCheck)===0){
    echo "<h1> No results found, please try again </h1>";
    
    echo "<a href='searchByArtist.php'>Try Again</a><br><hr>";


} else{
    
 foreach($runCheck as $row){
    echo "<h1><br> Album Name : "; echo $row["album_name"]; 

    $a=$row["album_id"]."  :  '".$row["album_name"]."' by ".$row["artist_name"];
    echo "<div class=' bg-crimson fg-white p-1 mb-2 p-3-md p-5-lg p-8-xl text-center'>
                        <a class='button yellow outline pl-10 pr-10' href='album.php?info={$row["album_id"]}'>{$a}</a>
                </div> ";


  }
  } 
}

else {
?>
<form class="form" action="" method="post">
    <h1 class="search">Search for albums by a particular Artist : </h1>
    <div id="search">

    <input type="text" class="search-input" name="search" placeholder="Search Artist" required />
    <input type="submit" name="submit" value="Search" class="login-button">
   

</div>






</form>
<?php
}


?>
   

    


 <!---   comment blank   --->



</div>

</body>

</html>