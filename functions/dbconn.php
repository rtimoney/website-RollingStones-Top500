
<?php
 
 $host = "rtimoney.webhosting6.eeecs.qub.ac.uk";
 $user = "rtimoney02";
 $pw = "PNbPQg21Y4JBGBNt";
 $db = "rtimoney02";


 $conn = new mysqli($host, $user, $pw, $db);

 if ($conn->connect_error) {

  echo $check = "Not connected cuz ".$conn->connect_error;

 }  else {
 
  $check = "Connected to MySQL DB.";
}

?>