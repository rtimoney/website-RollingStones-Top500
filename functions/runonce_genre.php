
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

    $albumgenredata=$row[4];

    if (str_contains($albumgenredata, 'Ê')){
        $albumgenredata=str_replace("Ê", ' ',$albumgenredata); 
    }

    $albumgenredata = explode(",", $albumgenredata);

    foreach ($albumgenredata as $genre) {

        $genre1 = preg_replace('/&/', 'and', $genre);
        $genreClean = preg_replace('/[^\p{L}0-9 .-]+/u', ' ', $genre1);
    
   
     $insertquery1 = "INSERT IGNORE INTO genre (genre_name) VALUES ('$genreClean')";
     $result = $conn -> query($insertquery1);
     $count++;
   
     }
   
    
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

$query9 = "DELETE FROM genre WHERE genre_name=' ' OR genre_name IS NULL;";
$result = $conn -> query ($query9);

echo "<h3>Total of {$count} rows successfully inserted into genre table.</h3>"
?>