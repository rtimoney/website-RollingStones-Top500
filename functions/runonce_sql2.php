<?php
 $host = "localhost";
 $user = "root";
 $pw = "";
 $db = "500greatestdb";


 $conn = new mysqli($host, $user, $pw, $db);

 if ($conn->connect_error) {

     $check = "Not connected ".$conn->connect_error;

 }  else {
 
    $check = "Connected to MySQL DB.";
}



    # GENRE BLOCK
{
#Remove spacing errors
     $query1 = "UPDATE genre set genre.genre_name = TRIM(' ' FROM genre.genre_name);";
     $result = $conn -> query($query1);

#Copy only the distinct year values to a temporary table
     $query2 = "CREATE TABLE tmp_genre SELECT genre_id, genre_name 
     FROM genre
     GROUP BY genre_name;";    
     $result = $conn -> query($query2);

#Clear original table
$query3 = "DELETE FROM genre;";    
$result = $conn -> query($query3);

#Move now distinct values from temp to original table
$query4 = "INSERT INTO genre (SELECT * FROM tmp_genre);";
$result = $conn -> query($query4);

#Remove the temporary table entirely
$query5 = "DROP TABLE tmp_genre;";
$result = $conn -> query($query5);

#Populate the many to many table linking album and genre
$query6 = "INSERT INTO album_genre (album_genre.album_id,album_genre.genre_id)
SELECT album.album_id,genre.genre_id FROM album INNER JOIN genre
ON UPPER(album.album_genre_tmp) LIKE UPPER(CONCAT('%',genre.genre_name,'%'));";
$result = $conn -> query($query6);
} // end of genre


# SUBGENRE BLOCK
{
#Remove spacing errors
    $query7 = " UPDATE subgenre set subgenre.subgenre_name = TRIM(' ' FROM subgenre.subgenre_name);";
    $result = $conn -> query($query7);
    

#Copy only the distinct year values to a temporary table
$query8 = "CREATE TABLE tmp_subgenre SELECT subgenre_id, subgenre_name 
    FROM subgenre
    GROUP BY subgenre_name;";
$result = $conn -> query($query8);

#Clear original table
$query9 = "DELETE FROM subgenre;";
$result = $conn -> query($query9);

#Move now distinct values from temp to original table
$query10 = "INSERT INTO subgenre (SELECT * FROM tmp_subgenre);";
$result = $conn -> query($query10);

#Remove the temporary table entirely
$query11 = "DROP TABLE tmp_subgenre;";
$result = $conn -> query($query11);

#Populate the many to many table linking album and subgenre
$query12 = "INSERT INTO album_subgenre (album_subgenre.album_id,album_subgenre.subgenre_id)
SELECT album.album_id,subgenre.subgenre_id FROM album INNER JOIN subgenre
ON UPPER(album.album_subgenre_tmp) LIKE UPPER(CONCAT('%',subgenre.subgenre_name,'%'));";
$result = $conn -> query($query12);
} // end of subgenre

# ARTIST BLOCK
{
    #Copy only the distinct artist values to a temporary table
    $query13 = " CREATE TABLE tmp_artist SELECT artist.artist_id, artist.artist_name
                FROM artist
                GROUP BY artist.artist_name;";
$result = $conn -> query($query13);

#Clear original table
$query14 = "DELETE FROM artist;";
$result = $conn -> query($query14);

#Move now distinct values from temp to original table
$query15 = "INSERT INTO artist (SELECT * FROM tmp_artist);";
$result = $conn -> query($query15);

#Remove the temporary table entirely
$query16 = "DROP TABLE tmp_artist;";
$result = $conn -> query($query16);

# Update the foreign key reference to artist in the main aldum table 
$query17 = "UPDATE album SET album.album_artist = (SELECT artist.artist_id FROM artist WHERE album.album_artist_tmp = artist.artist_name);";
$result = $conn -> query($query17);
} // emd of artist 


# YEAR BLOCK
{

// remove duplicates from year table 
#Copy only the distinct year values to a temporary table
$query19 = "CREATE TABLE tmp_yrank SELECT release_year.year_id, release_year.album_release_year
    FROM release_year
    GROUP BY release_year.album_release_year;";
    $result = $conn -> query($query19);

#Clear original table
$query20 = "DELETE FROM release_year;";
$result = $conn -> query($query20);

#Move now distinct values from temp to original table
$query21 = "INSERT INTO release_year (SELECT * FROM tmp_yrank);";
$result = $conn -> query($query21);

#Remove the temporary table entirely
$query22 = "DROP TABLE tmp_yrank;";
$result = $conn -> query($query22);



// update album table with foreign key ids
$query23 = "UPDATE album SET album.album_year = (SELECT release_year.year_id FROM release_year WHERE release_year.album_release_year = album.album_year_tmp);";
$result = $conn -> query($query23);
} // emd of year


// correct the name of the 'Country' genre. 
$query24 = "UPDATE genre
    SET
    genre_name = REPLACE(genre_name, 'and Country', 'Country');"
    $result = $conn -> query($query24);




?>