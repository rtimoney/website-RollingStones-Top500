
<?php

function owned($albumID,$userid){


  $query="SELECT * FROM owned WHERE user_id=$userid AND album_id=$albumID";
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $runCheck = json_decode($resource, true);

  if(count($runCheck) > 0){

    echo '<div id=centred_p><h1>YOU OWN THIS ALBUM</h1>';
    
    
    ?>
    <form method="post">
    <input type="submit" name="removeowned"
    class="button" value="REMOVE FROM OWNED" />


<?php
    if (isset($_POST['removeowned'])) {
      
        $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?removeFromOwned";

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








        if ($resource) {
      echo "<br></div><meta http-equiv='refresh' content='0'>"; 
        }
      
  
    } 



  } else {
    ?>
    <div id=centred_p>
    <h1> DO YOU OWN A COPY OF THIS ALBUM? : </h1>
    <form method="post">
    
   
    <input type="submit" name="owned"
            class="button" value="ADD TO OWNED" />
            
            
  </div>
            <?php    
} 
  
       if (isset($_POST['owned'])) {
       
        $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?addToOwned";

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

function callOwned($albumID,$userid){

owned($albumID,$userid);

       
            }
        
     ?>