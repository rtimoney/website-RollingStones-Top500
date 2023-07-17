
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

    $albumartistdata=$row[3];
 


    if (str_contains($albumartistdata, '\'')){
        $albumartistdata=str_replace("'", ' ',$albumartistdata); 
    }


    // create the INSERT INTO query
    $insertquery1 = "INSERT IGNORE INTO artist (artist_name) VALUES ('$albumartistdata')";
   
  //  $insertquery2 = "INSERT INTO brank (brank_id, artist) VALUES (NULL, '$albumartistdata')"; 
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

echo "<h3>Total of {$count} rows successfully inserted into artist table.</h3>"
?>