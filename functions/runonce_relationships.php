<?php

include("dbconn.php");

{

    
$query9 = "ALTER TABLE `album` ADD INDEX(`album_year`);
";
$result = $conn -> query ($query9);

$query10 = "ALTER TABLE `album` ADD CONSTRAINT `album_year_fk` FOREIGN KEY (`album_year`) REFERENCES `release_year`(`year_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
";
$result = $conn -> query ($query10);

$query11 = "ALTER TABLE `album` ADD INDEX(`album_artist`);
";
$result = $conn -> query ($query11);

$query12 = "ALTER TABLE `album` ADD CONSTRAINT `album_artist_fk` FOREIGN KEY (`album_artist`) REFERENCES `artist`(`artist_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
";
$result = $conn -> query ($query12);

$query13 = "ALTER TABLE `album_genre` ADD INDEX(`album_id`, `genre_id`);
";
$result = $conn -> query ($query13);

$query14 = "ALTER TABLE `album_genre` ADD CONSTRAINT `album_genre_genre_fk` FOREIGN KEY (`genre_id`) REFERENCES `genre`(`genre_id`) ON DELETE RESTRICT ON UPDATE RESTRICT; 
";
$result = $conn -> query ($query14);

$query15 = "ALTER TABLE `album_genre` ADD CONSTRAINT `album_genre_album_fk` FOREIGN KEY (`album_id`) REFERENCES `album`(`album_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
";
$result = $conn -> query ($query15);

$query16 = "ALTER TABLE `album_subgenre` ADD INDEX(`album_id`, `subgenre_id`);
";
$result = $conn -> query ($query16);

$query17 = "ALTER TABLE `album_subgenre` ADD CONSTRAINT `album_subgenre_subgenre_fk` FOREIGN KEY (`subgenre_id`) REFERENCES `subgenre`(`subgenre_id`) ON DELETE RESTRICT ON UPDATE RESTRICT; 
";
$result = $conn -> query ($query17);

$query18 = "ALTER TABLE `album_subgenre` ADD CONSTRAINT `album_subgenre_album_fk` FOREIGN KEY (`album_id`) REFERENCES `album`(`album_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
";
$result = $conn -> query ($query18);

}

echo "<h3> Foreign key relationships successfully represented in Database. Hooray! </h3>"
?>