
<?php

$k = $_POST['id'];
$search = trim($k);
$query = "SELECT * FROM album INNER JOIN artist on album.album_artist=artist.artist_id INNER JOIN release_year on album.album_year = release_year.year_id WHERE album_name LIKE";
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom1&query=".urlencode($query)."&search=".urlencode($search);
 $resource = file_get_contents($endpoint);
$runCheck = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resource), true );

foreach($runCheck as $rows){


?>

<tr>
<td><?php echo $rows['artist_name']; ?> </td>
<td><?php echo $rows['album_name']; ?> </td>    

<td><?php echo $rows['album_ranking']; ?> </td>

<td><?php echo $rows['album_release_year']; ?> </td>



</tr>




<?php

}

?>

