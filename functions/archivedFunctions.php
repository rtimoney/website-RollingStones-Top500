<?php

function wiki_apiSearch($search){
    $topic= $search;
    $topic= str_replace(' ','%20',$topic);  



    // handle known exceptions where wikipedia url is formatted differently
    // 
    if($topic=='Sgt.%20Pepper%20s%20Lonely%20Hearts%20Club%20Band'){
        $topic='Sgt._Pepper%27s_Lonely_Hearts_Club_Band';}
        // 
    if($topic=='Tim'){
        $topic='Tim_(The_Replacements_album)';}
     // 
     if($topic=='What%20s%20Going%20On'){
        $topic='What%27s_Going_On_(Marvin_Gaye_album)';}
        // 
     if($topic=='The%20Beatles%20("The%20White%20Album")'){
        $topic='The_Beatles_(album)';}

    $endp = "https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&titles=$topic";
    $jsonstring = json_decode(file_get_contents($endp));
    foreach($jsonstring->query->pages as $key=>$val){
    $pageId = $key;
    break;
    }
    
    $content = $jsonstring->query->pages->$pageId->extract;
 
    return $content;
}

function printAlbumReviews($albumID){
  include("functions/dbconn.php");
  $query = "SELECT album.album_name, user.user_username, comment_time, comment_text, approval, rating  
  FROM album
  INNER JOIN comment 
  ON album.album_id = comment.album_id
  INNER JOIN user
  ON comment.user_id = user.user_id   
  WHERE album.album_id = {$albumID} AND comment.approval = 'APPROVED'";

  $result = $conn->query($query);
?>
  <table>
  <tr>
            <td> Username </td>
            <td> Rating </td>
            <td> Review </td>
            <td> Review Date </td>      
    </tr>

    <?php

  if (!$result) {
      echo $conn->error;
    } else {

      while ($row = $result->fetch_assoc()) {

        ?>

        <!---
        <table>
        <tr>
                  <td> Username </td>
                  <td> Rating </td>
                  <td> Review </td>
                  <td> Review Date </td>      
          </tr>
          --->
         
         <tr>
                    <td><?php  echo $row["user_username"]; ?></td>
                   <td><?php  echo $row["rating"]; ?></td>
                   <td><?php  echo $row["comment_text"]; ?></td>
                   <td><?php echo $row["comment_time"]; ?></td>
           </tr>
         






<?php

/*        
  
echo "<div id=album_title_align>";
echo "<h1><br> Album Name : "; echo $row["album_name"]; echo "</h1><br><br><br><br></div><div id=centred_p><br><br><br><hr>";
// echo "<h1><br> Album Artist : "; echo $row["artist_name"] ; echo "</h1><br><hr>";
echo "<h1> Commenter : "; echo $row["user_username"] ; echo "</h1><hr>";
echo "<h1> Review : "; echo $row["comment_text"] ; echo "</h1><hr>";
// echo "<h1> Album Artwork : "; echo "<img src=$row[album_artwork_link]>"; echo "</h1><br><hr>";

// echo "<h1> Listen Here : </h1><div id=spotifyalign>"; echo $row["album_spotify_embed"]; echo "</div><br><br><hr><br></div>";
*/
}} echo "</table>";} 



function printAlbumAverageRating($albumID){
  include("functions/dbconn.php");
  $query = "SELECT CAST(AVG(rating)AS DECIMAL (10,1))
  FROM comment
  WHERE album_id=$albumID AND approval='PENDING';";

  $result = $conn->query($query);


  if (!$result) {
      echo $conn->error;
    } else {

      while ($row = $result->fetch_assoc()) {

        $albumRating=$row["CAST(AVG(rating)AS DECIMAL (10,1))"];

echo"<span class='album_rating_number';'> Avg Rating : $albumRating </span>";
// echo "<br><br><br><br><br><br>";



// echo $row["AVG(rating)"];

}}} 



function printAlbumSpecificDetails($albumID){
    include("functions/dbconn.php");
    $query = "SELECT album.album_id, album.album_ranking, album.album_name, album.album_artwork_link, album.album_spotify_embed, release_year.album_release_year, artist.artist_name
    FROM album
    INNER JOIN release_year 
    ON album.album_year = release_year.year_id
    INNER JOIN artist
    ON album.album_artist = artist.artist_id   
    WHERE album.album_id = {$albumID}";
  
    $result = $conn->query($query);

    if (!$result) {
        echo $conn->error;
      } else {

        while ($row = $result->fetch_assoc()) {

$albumrankdata=$row["album_ranking"];
echo"<span class='album_rank_number';'>$albumrankdata</span>";
echo "<br><br><br><br><br><br>";


echo "<div id=album_title_align>";
echo "<h1><br> Album Name : "; echo $row["album_name"]; echo "</h1><br><br><br><br></div><div id=centred_p><br><br><br><hr>";
// echo "<h1><br> Album Artist : "; echo $row["artist_name"] ; echo "</h1><br><hr>";
echo "<h1> Album Artist : "; echo $row["artist_name"] ; echo "</h1><hr>";
echo "<h1> Release Year : "; echo $row["album_release_year"] ; echo "</h1><hr>";
echo "<h1> Album Artwork : "; echo "<img src=$row[album_artwork_link]>"; echo "</h1><br><hr>";

echo "<h1> Listen Here : </h1><div id=spotifyalign>"; echo $row["album_spotify_embed"]; echo "</div><br><br><hr><br></div>";
}}} 



function printAlbumSubgenreDetails($albumID){
    include("functions/dbconn.php");
    $query2 = "SELECT album.album_id,  subgenre.subgenre_name
    FROM album
    INNER JOIN album_subgenre ON album.album_id = album_subgenre.album_id
    INNER JOIN subgenre ON album_subgenre.subgenre_id = subgenre.subgenre_id   
    WHERE album.album_id = {$albumID}";
  
    $result2 = $conn->query($query2);
  
    if (!$result2) {
      echo $conn->error;
    } else {
   echo "<h1>Subgenre(s) : <br>";
      while ($row = $result2->fetch_assoc()) {
 
                                                echo $row["subgenre_name"]; echo " , "; 
        }
      } 
      echo "</h1><hr><br>"
     ; 
    }

















function printAlbumGenreDetails($albumID){
    include("functions/dbconn.php");
    $query2 = "SELECT album.album_id,  genre.genre_name
    FROM album
    INNER JOIN album_genre ON album.album_id = album_genre.album_id
    INNER JOIN genre ON album_genre.genre_id = genre.genre_id   
    WHERE album.album_id = {$albumID}";
  
    $result2 = $conn->query($query2);
  
    if (!$result2) {
      echo $conn->error;
    } else {
   echo "<h1>Subgenre(s) : <br>";
      while ($row = $result2->fetch_assoc()) {
 
                                                echo $row["genre_name"]; echo " , "; 
        }
      } 
      echo "</h1><hr><br>"
     ; 
    }


    function albumReview($albumID,$userid){
      include("dbconn.php");

       if (isset($_REQUEST['comment'])) {
        // removes backslashes
        $comment = stripslashes($_REQUEST['comment']);
        //escapes special characters in a string
        $comment = mysqli_real_escape_string($conn, $comment);
     
        $create_datetime = date("Y-m-d H:i:s");
   //     $userid = $_SESSION["id"];
        
        $query    = "INSERT into `comment` (comment_text, comment_time, user_id, album_id)
                     VALUES ('$comment', '$create_datetime','$userid',$albumID)";
        $result   = mysqli_query($conn, $query);
    
        echo $comment;
    
        if ($result) {
            echo "<div class='form'>
                  <h3>Success.</h3><br/>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Not This Time</h3><br/>
                  </div>";
        }
    } else {
    ?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Review this Album</h1>
        <div id="loginInputs">
    
        <input type="text" class="login-input" name="comment" placeholder="Comment" required />
    
        <input type="submit" name="submit comment" value="submit comment" class="login-button">
        
    </p>
    
    </form>
    <?php
    }
      }?>




<?php
function albumReviewWithCheck($albumID,$userid){
      include("dbconn.php");

      $check="SELECT * FROM comment WHERE user_id=$userid AND album_id=$albumID";
      
      $runCheck = mysqli_query($conn,$check);
    
      if (mysqli_num_rows($runCheck) > 0){
        while ($row = $runCheck->fetch_assoc()) {
          echo "<h1> Your review : </h1>";


          ?>
          <table>
          <tr>
                    
                    <td> Rating </td>
                    <td> Review </td>
                    <td> Review Date </td>  
                    <td> Approval Status : </td>
                    

            </tr>
           <tr>
                      <td><?php  echo $row["user_username"]; ?></td>
                     <td><?php  echo $row["rating"]; ?></td>
                     <td><?php  echo $row["comment_text"]; ?></td>
                     <td><?php echo $row["comment_time"]; ?></td>
                     <td><?php  echo $row["approval"]; ?></td>
             </tr>
            </table>


<?php









          //echo $row["comment_text"] ;
          echo "<br><hr>";
        }
      } else{
       if (isset($_REQUEST['comment'])) {
        // removes backslashes
        $comment = stripslashes($_REQUEST['comment']);
        //escapes special characters in a string
        $comment = mysqli_real_escape_string($conn, $comment);
     
        $create_datetime = date("Y-m-d H:i:s");
   //     $userid = $_SESSION["id"];
        
        $query    = "INSERT into `comment` (comment_text, comment_time, user_id, album_id)
                     VALUES ('$comment', '$create_datetime','$userid',$albumID)";
        $result   = mysqli_query($conn, $query);
    
        echo $comment;
    
        if ($result) {
            echo "<div class='form'>
                  <h3>Success.</h3><br/>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Not This Time</h3><br/>
                  </div>";
        }
    } else {
    ?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Review this Album</h1>
        <div id="loginInputs">
    
        <input type="text" class="login-input" name="comment" placeholder="Comment" required />
    
        <input type="submit" name="submit comment" value="submit comment" class="login-button">
        
    </p>
    
    </form>
    <?php
    }
    }
      }





      
      function reviewAlbum($albumID,$userid){
            include("dbconn.php");
      
            $check="SELECT * FROM comment WHERE user_id=$userid AND album_id=$albumID";
            
            $runCheck = mysqli_query($conn,$check);
          
            if (mysqli_num_rows($runCheck) > 0){
              while ($row = $runCheck->fetch_assoc()) {
                echo "<h1> Your review : </h1>";

                ?>
                <table>
                <tr>
                          
                          <td> Rating </td>
                          <td> Review </td>
                          <td> Review Date </td>  
                          <td> Approval Status : </td>
                          
      
                  </tr>
                 <tr>
                            <td><?php  echo $row["user_username"]; ?></td>
                           <td><?php  echo $row["rating"]; ?></td>
                           <td><?php  echo $row["comment_text"]; ?></td>
                           <td><?php echo $row["comment_time"]; ?></td>
                           <td><?php  echo $row["approval"]; ?></td>
                   </tr>
                  </table>
      
      
      <?php


                //echo $row["comment_text"] ;
                echo "<br><hr>";
              }
            } else{
             if (isset($_REQUEST['comment'])) {
              // removes backslashes
              $comment = stripslashes($_REQUEST['comment']);
              //escapes special characters in a string
              $comment = mysqli_real_escape_string($conn, $comment);
           
              $create_datetime = date("Y-m-d H:i:s");
         //     $userid = $_SESSION["id"];

         if (isset($_REQUEST['rating'])) { echo 'We have something happening'; }
         $userRating = ($_REQUEST['rating']);
         echo $userRating;


              
              $query    = "INSERT into `comment` (comment_text, comment_time, user_id, album_id, rating)
                           VALUES ('$comment', '$create_datetime','$userid',$albumID,$userRating)";
              $result   = mysqli_query($conn, $query);
          
              echo $comment;
         
              if ($result) {
                  echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
              } else {
                  echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
              }
          } else {
          ?>
          <form class="form" action="" method="post">
              <h1 class="login-title">Review this Album</h1>
              <div id="loginInputs">
          
              <input type="text" class="login-input" name="comment" placeholder="Comment" required />

              <label for="rating">Rating</label>
<select name="rating" id="rating">
              <option value="" selected disabled hidden >Select an Star Rating</option>

              <?php for ($x = 1; $x <= 10; $x++) {

echo "<option value=$x>$x/10</option>";

}

?>
</select>







<!---              <option value="1" >Select an Star Rating 1</option>
              <option value="2" >Select an Star Rating 2</option>
              <option value="3" >Select an Star Rating 3</option>
              <option value="4" >Select an Star Rating 4</option>  --->
          
              <?php

              /*
for ($x = 1; $x <= 10; $x++) {

  echo "<option name='rating' value=$x>$x/10</option>";
  
}
*/
?>
 
   
    
   
    

</option>
          
              <input type="submit" name="submit comment" value="submit comment" class="login-button">
              
          </p>
          
          </form>
          <?php
          }
          }
            }     



/*


DIVIDE

*/


function reviewAlbumRatingRequired($albumID,$userid){
  include("dbconn.php");

  $check="SELECT * FROM comment WHERE user_id=$userid AND album_id=$albumID";
  
  $runCheck = mysqli_query($conn,$check);

  if (mysqli_num_rows($runCheck) > 0){
    while ($row = $runCheck->fetch_assoc()) {
      echo "<div id='centred_p'><h1> Your review : </h1></div>";
      ?>
      <table>
      <tr>
                
                <td> Rating </td>
                <td> Review </td>
                <td> Review Date </td>  
                <td> Approval Status : </td>
                

        </tr>
       <tr>
                  
                 <td><?php  echo $row["rating"];echo ' out of 10'; ?></td>
                 <td><?php  echo $row["comment_text"]; ?></td>
                 <td><?php echo $row["comment_time"]; ?></td>
                 <td><?php  echo $row["approval"]; ?></td>
         </tr>
        </table>


<?php


      // echo $row["comment_text"] ;
      echo "<br><hr>";
    }
  } else{
   if (isset($_REQUEST['comment'])) {
    // removes backslashes
    $comment = stripslashes($_REQUEST['comment']);
    //escapes special characters in a string
    $comment = mysqli_real_escape_string($conn, $comment);
 
    $create_datetime = date("Y-m-d H:i:s");
//     $userid = $_SESSION["id"];

$userRating = ($_REQUEST['rating']);



    
    $query    = "INSERT into `comment` (comment_text, comment_time, user_id, album_id, rating)
                 VALUES ('$comment', '$create_datetime','$userid',$albumID,$userRating)";
    $result   = mysqli_query($conn, $query);

    echo $comment;

    if ($result) {
        echo "<div class='form'>
              <h3>Success.</h3><br/>
              </div>";
    } else {
        echo "<div class='form'>
              <h3>Not This Time</h3><br/>
              </div>";
    }
} else {
?>
<form class="form" action="" method="post">
    <h1 class="login-title">Review this Album</h1>
    <div id="loginInputs">

    <input type="text" class="login-input" name="comment" placeholder="Comment" required />

    <label for="rating">Rating</label>
<select name="rating" id="rating" required>
    <option value="" selected disabled hidden >Select an Star Rating</option>

    <?php for ($x = 1; $x <= 10; $x++) {

echo "<option value=$x>$x/10</option>";

}

?>
</select>







<!---              <option value="1" >Select an Star Rating 1</option>
    <option value="2" >Select an Star Rating 2</option>
    <option value="3" >Select an Star Rating 3</option>
    <option value="4" >Select an Star Rating 4</option>  --->

    <?php

    /*
for ($x = 1; $x <= 10; $x++) {

echo "<option name='rating' value=$x>$x/10</option>";

}
*/
?>






</option>

    <input type="submit" name="submit comment" value="submit comment" class="login-button">
    
</p>

</form>
<?php
}
}
  }     