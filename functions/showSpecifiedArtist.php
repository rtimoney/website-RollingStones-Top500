
<?php

$k = $_POST['id'];
$search = trim($k);
require("dbconn.php");
$query = "SELECT * FROM album WHERE album_artist='";
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom1&query=".urlencode($query)."&search=".urlencode($search);
 $resource = file_get_contents($endpoint);
$runCheck = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resource), true );

foreach($runCheck as $rows){


   
?>

<tr>
<td><?php echo $rows['album_artist']; ?> </td>
<td><?php echo $rows['album_artist_tmp']; ?> </td>
<td><?php echo $rows['album_name']; ?> </td>
<td><?php echo $rows['album_id']; ?> </td>
</tr>

<?php

}

?>


