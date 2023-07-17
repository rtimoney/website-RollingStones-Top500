



<?php



















function favourite($albumID,$userid){



  $query="SELECT * FROM favourite WHERE user_id=$userid AND album_id=$albumID";
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $runCheck = json_decode($resource, true);


  if (count($runCheck) > 0){

    echo '<div id=centred_p><h1>THIS ALBUM IS ONE OF YOUR FAVOURITES</h1>';
    
    
    ?>
    <form method="post">
    <input type="submit" name="removefav"
    class="button" value="REMOVE FROM FAVS" /></div>


<?php
    if (isset($_POST['removefav'])) {

      $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?removeFromFav";

      $postdata=http_build_query(
        array(
            'userid' => $userid,
            'albumid' => $albumID
            
                )
      
      );
      
      $opts=array(
        'http'=>array(
            'method'=>'POST',
            'header'=>'Content-Type: application/x-www-form-urlencoded',
            'content'=>$postdata
      
        )
      
        );
      
        $context= stream_context_create($opts);
        $resource = file_get_contents($endpoint, false, $context);





      echo "<br></div><meta http-equiv='refresh' content='0'>"; 
        }
      
  
    } 


// }
   else {
    ?>
    <div id=centred_p>
    <h1> ADD THIS ALBUM TO YOUR FAVOURITES : </h1>
    <form method="post">
    
   
    <input type="submit" name="favourite"
            class="button" value="FAVOURITE" />
            
            
  </div>
            <?php    
} 
  
       if (isset($_POST['favourite'])) {

        $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?addToFav";

$postdata=http_build_query(
  array(
    'userid' => $userid,
    'albumid' => $albumID
          )

);

$opts=array(
  'http'=>array(
      'method'=>'POST',
      'header'=>'Content-Type: application/x-www-form-urlencoded',
      'content'=>$postdata

  )

  );

  $context= stream_context_create($opts);
  $resource = file_get_contents($endpoint, false, $context);
       
       

        echo "<meta http-equiv='refresh' content='0'>"; 
  
    } 
}










/*
if(array_key_exists('favourite', $_POST)) {
  favourite($albumID,$userid);
}
*/








function favatt($albumID,$userid){

favourite($albumID,$userid)


 ?>
<!---
    <form method="post">
        <input type="submit" name="favourite"
                class="button" value="favourite" />
  --->
  
  
  
  <?php         
            }
        
     ?>