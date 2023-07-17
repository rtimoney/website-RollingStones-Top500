
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

    $albumsubdata=$row[5];
  

    if (str_contains($albumsubdata, '\'')){
        $albumsubdata=str_replace("'", ' ',$albumsubdata); 
    }

   

      

 //     $albumsubdata = implode("),(", $albumsubdata);
 $albumsubdata = explode(",", $albumsubdata);

 foreach ($albumsubdata as $sub) {

 //   $subClean = preg_replace('/[^\p{L}0-9 .-]+/u', '', $sub);
 $sub1 = preg_replace('/&/', 'and', $sub);
 $subClean = preg_replace('/[^\p{L}0-9 .-]+/u', ' ', $sub1);

  $insertquery1 = "INSERT IGNORE INTO subgenre (subgenre_name) VALUES ('$subClean')";
  // $insertquery1 = "INSERT IGNORE INTO subgenre (subgenre_name) VALUES ('$subClean')";
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

$queryrRemoveBlank = "DELETE FROM subgenre WHERE subgenre_name=' ' OR subgenre_name IS NULL;";
$result = $conn -> query ($queryrRemoveBlank);

echo "<h3>Total of {$count} rows successfully inserted into database table.</h3>"
?>