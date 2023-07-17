
<?php

include("dbconn.php");

$filename = "album_list.csv";

// get the resource object (open the file)
$contents = fopen($filename, "r");

// loop to read each line from CSV file into $row array
$count = 0;
$counter2 =0; //included to skip first line in csv to account for headings
while ( ($row = fgetcsv($contents)) !== FALSE ) {
   


    // INSERT the contents of the row INTO the database
  
    if($counter2 != 0){

    $albumyeardata=$row[1];

      

 


    // create the INSERT INTO query
  $insertquery1 = "INSERT IGNORE INTO release_year (album_release_year) VALUES ('$albumyeardata')";

    

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

echo "<h3>Total of {$count} rows successfully inserted into database year table.</h3>"
?>