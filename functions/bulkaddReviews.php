<?php

include("dbconn.php");


$comment="Fantastic album, fully deserving of its place in the top 500 greatest of all time.";
$create_datetime = date("Y-m-d H:i:s");
$userid="14";
$userRating="10";

$query = "SELECT * FROM album";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()){

    $albumID=$row['album_id'];


$query2    = "INSERT into `comment` (comment_text, comment_time, user_id, album_id, rating, approval)
    VALUES ('$comment', '$create_datetime','$userid',$albumID,$userRating,'APPROVED')";


                            
                     $result2 = $conn->query($query2);
}

