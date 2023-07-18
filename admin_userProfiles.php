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




  
  $query = "SELECT * FROM user";
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $data = json_decode($resource, true);

  if (!$data) {
    echo $conn->error;
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
    <h2>Users : </h2>
    <?php
          foreach ($data as $row){

            $a="User ID : ".$row["user_id"].". Username : '".$row["user_username"];

            echo "<div class=' bg-crimson fg-white p-1 mb-2 p-3-md p-5-lg p-8-xl text-center'>
                        <a class='button yellow outline pl-10 pr-10' href='editUserPage.php?info={$row["user_id"]}'>{$a}</a>
                </div> ";
          }
    ?>
  </div>
  
  <script src="https://cdn.metroui.org.ua/v4.3.2/js/metro.min.js"></script>

</body>
</html>



