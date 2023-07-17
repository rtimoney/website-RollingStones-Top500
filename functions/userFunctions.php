 <?php 
function displayReviews($userId){
    include("functions/dbconn.php");
    $query = "SELECT album.album_name, album.album_artwork_link, artist.artist_name, comment_text, comment_time, rating
    FROM album
    INNER JOIN artist ON album.album_artist = artist.artist_id
    INNER JOIN comment ON album.album_id = comment.album_id   
    WHERE comment.user_id = {$userId}";

    $result = $conn->query($query);

    if (!$result) {
        echo $conn->error;
      } else {

        while ($row = $result->fetch_assoc()) {
            $reviewDate=$row["comment_time"];
            ?>

<?php echo "<img id=thumbnail src=$row[album_artwork_link]></div>"; ?> 
<table>
<tr>

<td> Album Name </td>
<td> Album Artist </td>
<td> Review </td>
<td> Rating </td>
<td> Review Date</td>      

</tr>
<tr>
<td><?php echo $row['album_name']; ?> </td>
<td><?php echo $row['artist_name']; ?> </td>
<td><?php echo $row['comment_text']; ?> </td>
<td><?php echo $row['rating']; echo " / 10"; ?> </td>
<td><?php echo $reviewDate; ?> </td>            
</tr>
</table>
<table>
<?php
}}}
?>




<?php 
/** 
 * display a list of albums favourited by user  
 */
function displayFavs($userId){
    include("functions/dbconn.php");
    $query = "SELECT album.album_name, favourite.album_id, artist.artist_name
    FROM album
    INNER JOIN favourite ON album.album_id = favourite.album_id 
    INNER JOIN artist ON artist_id = album_artist  
    WHERE favourite.user_id = {$userId}";

    $result = $conn->query($query);
?>
    <table>
<tr>

<td> Album Name </td>
<td> Link to Album Page </td>
 

</tr>


<?php

    if (!$result) {
        echo $conn->error;
      } else {

        while ($row = $result->fetch_assoc()) {
            $a=$row["album_id"]."  :  '".$row["album_name"]."' by ".$row["artist_name"];
?>

<tr>
<td><?php echo $row['album_name']; ?> </td>

<?php
echo "<td><div class=' bg-crimson fg-white p-1 mb-2 p-3-md p-5-lg p-8-xl text-center'>
                        <a class='button yellow outline pl-10 pr-10' href='album.php?info={$row["album_id"]}'>{$a}</a>
                </div></td>";?>         
</tr>


<?php
}} echo "</table>"; }
?>



<?php 
/** 
 * display a list of albums owned by user  
 */
function displayOwned($userId){
    include("functions/dbconn.php");
    $query = "SELECT album.album_name, owned.album_id, artist.artist_name
    FROM album
    INNER JOIN owned ON album.album_id = owned.album_id 
    INNER JOIN artist ON artist_id = album_artist  
    WHERE owned.user_id = {$userId}";

    $result = $conn->query($query);
?>
    <table>
<tr>

<td> Album Name </td>
<td> Link to Album Page </td>
 

</tr>


<?php

    if (!$result) {
        echo $conn->error;
      } else {

        while ($row = $result->fetch_assoc()) {
            $a=$row["album_id"]."  :  '".$row["album_name"]."' by ".$row["artist_name"];
?>

<tr>
<td><?php echo $row['album_name']; ?> </td>

<?php
echo "<td><div class=' bg-crimson fg-white p-1 mb-2 p-3-md p-5-lg p-8-xl text-center'>
                        <a class='button yellow outline pl-10 pr-10' href='album.php?info={$row["album_id"]}'>{$a}</a>
                </div></td>";?>         
</tr>


<?php
}} echo "</table>"; }
?>