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
  
  $query = "SELECT album.album_name, user.user_username, comment_time, comment_text, approval, rating FROM album INNER JOIN comment ON album.album_id = comment.album_id INNER JOIN user ON comment.user_id = user.user_id WHERE album.album_id = {$albumID} AND comment.approval = 'APPROVED'";
 $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
 $resource = file_get_contents($endpoint);
 $data = json_decode($resource, true);
?>
  <table>
  <tr>
            <td> Username </td>
            <td> Rating </td>
            <td> Review </td>
            <td> Review Date </td>      
    </tr>

    <?php

  if (!$data) {
      echo "";
    } else {

foreach($data as $row){
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
<?php }} echo "</table>";} 



function printAlbumAverageRating($albumID){
  
  $query = "SELECT CAST(AVG(rating)AS DECIMAL (10,1)) FROM comment WHERE album_id=$albumID;";
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
$resource = file_get_contents($endpoint);
$data = json_decode($resource, true);


  if (!$data) {
      echo "";
    } else {

      foreach($data as $row){

        $albumRating=$row["CAST(AVG(rating)AS DECIMAL (10,1))"];

echo"<span class='album_rating_number';'> Avg Rating : $albumRating </span>";

}}} 



function printAlbumSpecificDetails($albumID){
 
    $query = "SELECT album.album_id, album.album_ranking, album.album_name, album.album_artwork_link, album.album_spotify_embed, release_year.album_release_year, artist.artist_name FROM album INNER JOIN release_year ON album.album_year = release_year.year_id INNER JOIN artist ON album.album_artist = artist.artist_id WHERE album.album_id = {$albumID}";
  
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $data = json_decode($resource, true);

  if (!$data) {
    echo "";
  }else {

       foreach($data as $row){

$albumrankdata=$row["album_ranking"];
echo"<span class='album_rank_number';'>Rank : $albumrankdata</span>";
echo "<div id='spacerforAlbum'><br><br><br><br><br><br><br><br><br><br><br><hr><br></div>";


echo "<div id=album_title_align>";
echo "<br><br><br><br>";
echo "<h1><br> Album Name : "; echo $row["album_name"]; echo "</h1><br><br><br><br></div><div id=centred_p><br><br><br><hr>";
// echo "<h1><br> Album Artist : "; echo $row["artist_name"] ; echo "</h1><br><hr>";
echo "<h1> Album Artist : "; echo $row["artist_name"] ; echo "</h1><hr>";
echo "<h1> Release Year : "; echo $row["album_release_year"] ; echo "</h1><hr>";
echo "<h1> Album Artwork : "; echo "<img src=$row[album_artwork_link]>"; echo "</h1><br><hr>";

echo "<h1> Listen Here : </h1><div id=spotifyalign>"; echo $row["album_spotify_embed"]; echo "</div><br><br><hr><br></div>";
}}} 



function printAlbumSubgenreDetails($albumID){
   
    $query = "SELECT album.album_id, subgenre.subgenre_name FROM album INNER JOIN album_subgenre ON album.album_id = album_subgenre.album_id INNER JOIN subgenre ON album_subgenre.subgenre_id = subgenre.subgenre_id WHERE album.album_id = {$albumID}";
  
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $data = json_decode($resource, true);

  if (!$data) {
    echo "";}
   else {
   echo "<h1>Subgenre(s) : <br>";
      foreach($data as $row){
 
                                                echo $row["subgenre_name"]; echo " , "; 
        }
      } 
      echo "</h1><hr><br>"
     ; 
    }



function printAlbumGenreDetails($albumID){
    $query = "SELECT album.album_id,  genre.genre_name FROM album INNER JOIN album_genre ON album.album_id = album_genre.album_id INNER JOIN genre ON album_genre.genre_id = genre.genre_id WHERE album.album_id = {$albumID}";
  
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $data = json_decode($resource, true);

  if (!$data) {
    echo "";}
  else {
   echo "<h1>Genre(s) : <br>";
     foreach($data as $row){
 
                                                echo $row["genre_name"]; echo " , "; 
        }
      } 
      echo "</h1><hr><br>"
     ; 
    }




function reviewAlbumRatingRequired($albumID,$userid){
  $restriction='';


  $query="SELECT * FROM user WHERE user_id=$userid";
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $data = json_decode($resource, true);

  foreach($data as $oneRun){
    $restriction=$oneRun['restriction'];}



  $query="SELECT * FROM comment WHERE user_id=$userid AND album_id=$albumID";
  $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?custom&query=".urlencode($query);
  $resource = file_get_contents($endpoint);
  $data = json_decode($resource, true);

  if (!$data) {
    echo "";}
  
  if (count($data) > 0){
    foreach($data as $row) {
      
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

    if (!$restriction=='RESTRICTED'){


   if (isset($_REQUEST['comment'])) {
    // removes backslashes
    $comment = stripslashes($_REQUEST['comment']);
  
 
    $create_datetime = date("Y-m-d H:i:s");
//     $userid = $_SESSION["id"];

$userRating = ($_REQUEST['rating']);
    
$endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/apiPost.php?createComment";

$postdata=http_build_query(
  array(
      'comment' => $comment,'date' => $create_datetime,'userid' => $userid,'albumid' => $albumID,'rating' => $userRating,
      
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
        echo "<div class='centred_p'>
              <h3>Review submitted. This page will now refresh.</h3><br/>";
              
             // header("Refresh:3");

              echo "<meta http-equiv='refresh' content='0'>"; 

              echo "</div>";
    } else {
        echo "<div class='form'>
              <h3>There has been an issue, please try again later.</h3><br/>
              </div>";
    }
} else {
?>
<div id="centred_p">
<form class="form" action="" method="post">
    <h1 class="login-title">Review this Album</h1>
    <div id="loginInputs">

    <input type="text" class="login-input" name="comment" placeholder="Comment" maxlength="250" required /><br>

    <label for="rating">Rating&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
<select name="rating" id="rating" required>
    <option value="" selected disabled hidden >Select an Star Rating</option>

    <?php for ($x = 1; $x <= 10; $x++) {

echo "<option value=$x>$x/10</option>";

}

?>
</select><br>







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
</div>
<hr>
<?php
}
} else {echo "<div id='centred_p'><h1>You are not permitted to leave reviews at this time.</h1></div>";} // end of restriction 
} // end of else
  }     