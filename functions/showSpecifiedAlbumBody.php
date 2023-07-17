
<?php

$k = $_POST['id'];
$search = trim($k);
$query = "SELECT * FROM album WHERE album_name LIKE";
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom1&query=".urlencode($query)."&search=".urlencode($search);
 $resource = file_get_contents($endpoint);
$runCheck = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resource), true );

foreach($runCheck as $rows){


?>

<?php echo $rows['album_spotify_embed']; ?> 







<?php

}

?>

