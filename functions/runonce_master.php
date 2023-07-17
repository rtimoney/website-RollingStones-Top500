<?php


$host = "localhost";
$user = "root";
$pw = "";
$db = "";


$conn = new mysqli($host, $user, $pw, $db);

if ($conn->connect_error) {

    $check = "Not connected ".$conn->connect_error;

}  else {

   $check = "Connected to MySQL DB.";
}

{
# Create the empty database
    $query1 = "CREATE DATABASE 500greatestdb";
    $result = $conn -> query($query1);

# Create an album table
    $query2 = "CREATE TABLE `500greatestdb`.`album` ( `album_id` INT NOT NULL AUTO_INCREMENT , `album_ranking` INT NOT NULL , `album_year_tmp` INT NOT NULL , `album_name` VARCHAR(255) NOT NULL , `album_artist_tmp` VARCHAR(255) NOT NULL , `album_genre_tmp` VARCHAR(255) NOT NULL , `album_subgenre_tmp` VARCHAR(255) NOT NULL , `album_artwork_link` TEXT NOT NULL , `album_spotify_embed` TEXT NOT NULL , `album_year` INT NOT NULL , `album_artist` INT NOT NULL , PRIMARY KEY (`album_id`)) ENGINE = InnoDB;
    ";    
    $result = $conn -> query($query2);

# Create a year table
$query3 = "CREATE TABLE `500greatestdb`.`release_year` ( `year_id` INT NOT NULL AUTO_INCREMENT , `album_release_year` INT NOT NULL , PRIMARY KEY (`year_id`)) ENGINE = InnoDB;";    
$result = $conn -> query($query3);

# Create an artist table
$query4 = "CREATE TABLE `500greatestdb`.`artist` ( `artist_id` INT NOT NULL AUTO_INCREMENT , `artist_name` VARCHAR(255) NOT NULL , PRIMARY KEY (`artist_id`)) ENGINE = InnoDB;";
$result = $conn -> query($query4);

# Create a genre table
$query5 = "CREATE TABLE `500greatestdb`.`genre` ( `genre_id` INT NOT NULL AUTO_INCREMENT , `genre_name` VARCHAR(255) NOT NULL , PRIMARY KEY (`genre_id`)) ENGINE = InnoDB;";
$result = $conn -> query($query5);

# Create a subgenre table
$query6 = "CREATE TABLE `500greatestdb`.`subgenre` ( `subgenre_id` INT NOT NULL AUTO_INCREMENT , `subgenre_name` VARCHAR(255) NOT NULL , PRIMARY KEY (`subgenre_id`)) ENGINE = InnoDB;";
$result = $conn -> query($query6);

# Create a many to many table for album and genre
$query7 = "CREATE TABLE `500greatestdb`.`album_genre` ( `album_genre_id` INT NOT NULL AUTO_INCREMENT , `album_id` INT NOT NULL , `genre_id` INT NOT NULL , PRIMARY KEY (`album_genre_id`)) ENGINE = InnoDB;";
$result = $conn -> query($query7);

# Create a many to many table for album and subgenre
$query8 = "CREATE TABLE `500greatestdb`.`album_subgenre` ( `album_subgenre_id` INT NOT NULL AUTO_INCREMENT , `album_id` INT NOT NULL , `subgenre_id` INT NOT NULL , PRIMARY KEY (`album_subgenre_id`)) ENGINE = InnoDB;";
$result = $conn -> query ($query8);
}

include("runonce_album.php");

include("runonce_year.php");

include("runonce_artist.php");

include("runonce_genre.php");

include("runonce_subgenre.php");

include("runonce_sql2.php");

include("runonce_relationships.php");

include("runonce_users.php");


?>