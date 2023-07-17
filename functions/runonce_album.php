

<?php

include("dbconn.php");

$filename = "album_list.csv";

// get the resource object (open the file)
$contents = fopen($filename, "r");

// loop to read each line from CSV file into $row array
$count = 0;
$counter2 =0; //included to skip first line in csv to account for headings
while ( ($row = fgetcsv($contents)) !== FALSE ) {
   

    // dump out content of the line
    //print_r($row);
    
    // INSERT the contents of the row INTO the database
  
    if($counter2 != 0){

    $albumrankdata=$row[0];
    $albumyeardata=$row[1];
    $albumdata=$row[2];
    $albumartistdata=$row[3];
    $albumgenredata=$row[4];
    $albumsubgenredata=$row[5];
    $albumartworkdata=$row[6];
    $albumembeddata=$row[7];


    if (str_contains($albumartistdata, '\'')){
        $albumartistdata=str_replace("'", ' ',$albumartistdata); 
    }

    if (str_contains($albumdata, '\'')){
        $albumdata=str_replace("'", ' ',$albumdata); 
    }



    $genre1 = preg_replace('/&/', 'and', $albumgenredata);
    $genreClean = preg_replace('/[^\p{L}0-9 .-]+/u', ' ', $genre1);

    $sub1 = preg_replace('/&/', 'and', $albumsubgenredata);
    $subClean = preg_replace('/[^\p{L}0-9 .-]+/u', ' ', $sub1);

    // create the INSERT INTO query
    $insertquery1 = "INSERT INTO 500greatestdb.album (album_ranking, album_year_tmp, album_name, album_artist_tmp, album_genre_tmp, album_subgenre_tmp, album_artwork_link, album_spotify_embed) 
                                VALUES ('$albumrankdata','$albumyeardata', '$albumdata','$albumartistdata','$genreClean','$subClean', '$albumartworkdata','$albumembeddata')";
    

   $result = $conn -> query($insertquery1);
 
    
}

    $counter2++;
        
    // execute the query
 

    
                
    // check the result
    // will have one error due to skipping the first row of csv to account for headings
    if(!$result) {
                    
        echo $conn -> error;
                
    } else {

        $count++;
    }











}

echo "<h3>Total of {$count} rows successfully inserted into arank (album) table.</h3>"
?>