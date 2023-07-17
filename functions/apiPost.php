
<?php

header("Content-Type: application/json");

  if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['updateUsername'])) && (isset($_GET['userid']))){

 //   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['customPost']))){


include("dbconn.php");




  $addData = $conn->real_escape_string($_POST['addData']);
  $user_id=$_GET['userid'];
  // $addData2 = $conn->real_escape_string($_POST['addData2']);


 //$query    = "INSERT into `comment` (comment_text)
   //                         VALUES ('$commentdata')";

   $query = "UPDATE user SET user_username='$addData' WHERE user_id='$user_id'"; 
   

// $query    = "INSERT into `album` (album_name, album_artwork_link) VALUES ('$addData','$addData2')";
                        
                 $result = $conn->query($query);

                if ($result) {
                echo "<div class='form'>
                    <h3>Success.</h3><br/>
                    </div>";
                } else {
                echo "<div class='form'>
                    <h3>Not This Time</h3><br/>
                    </div>";
                }

} // end 




if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['updateEmail'])) && (isset($_GET['userid']))){

    //   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['customPost']))){
   
   
   include("dbconn.php");
   
   
   
   
     $addData = $conn->real_escape_string($_POST['addData']);
     $user_id=$_GET['userid'];
     // $addData2 = $conn->real_escape_string($_POST['addData2']);
   
   
    //$query    = "INSERT into `comment` (comment_text)
      //                         VALUES ('$commentdata')";
   
      $query = "UPDATE user SET user_email='$addData' WHERE user_id='$user_id'";  
      
   
   // $query    = "INSERT into `album` (album_name, album_artwork_link) VALUES ('$addData','$addData2')";
                           
                    $result = $conn->query($query);
   
                   if ($result) {
                   echo "<div class='form'>
                       <h3>Success.</h3><br/>
                       </div>";
                   } else {
                   echo "<div class='form'>
                       <h3>Not This Time</h3><br/>
                       </div>";
                   }
   
   } // end 



// create an album
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['createAlbum']))){

 
   
   include("dbconn.php");
   
   
   
   $album = $conn->real_escape_string($_POST['album']);
     $rank = $conn->real_escape_string($_POST['rank']);
     $artwork = $conn->real_escape_string($_POST['cover']);
     $spotify = $conn->real_escape_string($_POST['spotify']);
     $yearID = $conn->real_escape_string($_POST['year']);
     $artistID = $conn->real_escape_string($_POST['artist']);

   
      $query="INSERT INTO `album` (`album_ranking`,`album_name`, `album_artwork_link`, `album_spotify_embed`, `album_year`, `album_artist`) 
        VALUES ('$rank', '$album', '$artwork', '$spotify', '$yearID', '$artistID')";

                           
                    $result = $conn->query($query);
   
                   if ($result) {
                   echo "<div class='form'>
                       <h3>Success.</h3><br/>
                       </div>";
                   } else {
                   echo "<div class='form'>
                       <h3>Not This Time</h3><br/>
                       </div>";
                   }
   
   } // end 

   // create a Genre
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['createGenre']))){

 
   
    include("dbconn.php");
    $genre = $conn->real_escape_string($_POST['genre']);
    
    $query = "INSERT INTO genre (genre_name)
    VALUES ('$genre')";
                            
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 


       // populate album_genre
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['addAlbumGenre']))){

 
   
    include("dbconn.php");
    $genreID = $conn->real_escape_string($_POST['genreid']);
    $albumID = $conn->real_escape_string($_POST['albumid']);
    
    $query = "INSERT INTO `album_genre` (`album_id`,`genre_id`) 
    VALUES ('$albumID', '$genreID')";
                            
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 

    
   // create a Subgenre
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['createSubgenre']))){


 
   
    include("dbconn.php");

    $subgenre = $conn->real_escape_string($_POST['subgenre']);
    
    $query = "INSERT INTO subgenre (subgenre_name)
    VALUES ('$subgenre')";
                            
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 

     // populate album_subgenre
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['addAlbumSubgenre']))){

 
   
    include("dbconn.php");
    $subgenreID = $conn->real_escape_string($_POST['subgenreid']);
    $albumID = $conn->real_escape_string($_POST['albumid']);
    
    $query = "INSERT INTO `album_subgenre` (`album_id`,`subgenre_id`) 
    VALUES ('$albumID', '$subgenreID')";
                            
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 

     // add a comment
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['createComment']))){

    include("dbconn.php");

    $comment = $conn->real_escape_string($_POST['comment']);
    $create_datetime = $conn->real_escape_string($_POST['date']);
    $userid = $conn->real_escape_string($_POST['userid']);
    $albumID = $conn->real_escape_string($_POST['albumid']);
    $userRating = $conn->real_escape_string($_POST['rating']);

    
    $query    = "INSERT into `comment` (comment_text, comment_time, user_id, album_id, rating)
    VALUES ('$comment', '$create_datetime','$userid',$albumID,$userRating)";
                            
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 


         // set album name only
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['albumName']))){

    include("dbconn.php");

    $album_name = $conn->real_escape_string($_POST['albumname']);
    $album_id = $conn->real_escape_string($_POST['albumid']);

    
    $query = "UPDATE album SET album_name='$album_name' WHERE album_id='$album_id'";   
                    //  echo $query;      
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 


            // set album rank only
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['albumRank']))){

    include("dbconn.php");

    $album_id = $conn->real_escape_string($_POST['albumid']);
    $album_rank = $conn->real_escape_string($_POST['albumrank']);

    
    $query = "UPDATE album SET album_ranking='$album_rank' WHERE album_id='$album_id'";   
                            
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 

    
            // set year only
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['albumYear']))){

    include("dbconn.php");

    $year = $conn->real_escape_string($_POST['year']);
   

    
    $results = "INSERT INTO release_year (album_release_year)
    VALUES ('$year')"; 
                            
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 

      // set album yearid
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['albumYearid']))){

    include("dbconn.php");

    $year_id = $conn->real_escape_string($_POST['yearid']);
    $album_id = $conn->real_escape_string($_POST['albumid']);
   
    $query = "UPDATE album SET album_year='$year_id' WHERE album_id='$album_id'";
   
                            
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 

    
      // add artist only
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['addArtist']))){

    include("dbconn.php");

    $artist = $conn->real_escape_string($_POST['artist']);
  
    
    $query = "INSERT INTO artist (artist_name) VALUES ('$artist')";
                            
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 


       // set artist id
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['setArtistID']))){

    include("dbconn.php");

    $artist_id = $conn->real_escape_string($_POST['artistid']);
    $album_id = $conn->real_escape_string($_POST['albumid']);
  
    
    $query = ("UPDATE album SET album_artist='$artist_id' WHERE album_id='$album_id'");
                            
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 

    
       // remove a genre from a particular album
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['deleteGenre']))){

    include("dbconn.php");

   

    $i = $conn->real_escape_string($_POST['genreid']);
    $album_id = $conn->real_escape_string($_POST['albumid']);
  
    $query    = "DELETE FROM album_genre WHERE album_genre.album_id='$album_id' AND album_genre.genre_id='$i'";
                            
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 



           // remove a subgenre from a particular album
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['deleteSubgenre']))){

    include("dbconn.php");

 

    $i = $conn->real_escape_string($_POST['subgenreid']);
    $album_id = $conn->real_escape_string($_POST['albumid']);
  
    $query    = "DELETE FROM album_subgenre WHERE album_subgenre.album_id='$album_id' AND album_subgenre.subgenre_id='$i'";
    echo $query;                            
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 


   // DELETE a particular album PERMANENTLY
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['deleteAlbum']))){

    include("dbconn.php");

 
    $album_id = $conn->real_escape_string($_POST['albumid']);

    
    $query    = "DELETE FROM album_subgenre WHERE album_id='$album_id'"; $result = $conn->query($query);
    $query    = "DELETE FROM album_genre WHERE album_id='$album_id'"; $result = $conn->query($query);
    $query    = "DELETE FROM comment WHERE album_id='$album_id'"; $result = $conn->query($query);
    $query    = "DELETE FROM favourite WHERE album_id='$album_id'"; $result = $conn->query($query);
    $query    = "DELETE FROM owned WHERE album_id='$album_id'"; $result = $conn->query($query);
    $query    = "DELETE FROM album WHERE album_id='$album_id'"; $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 



      // update artwork link
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['setArt']))){

    include("dbconn.php");

    $art = $conn->real_escape_string($_POST['art']);
    $album_id = $conn->real_escape_string($_POST['albumid']);
  
    $query = "UPDATE album SET album_artwork_link='$art' WHERE album_id='$album_id'";
                              
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 


         // update spotify
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['setSpotify']))){

    include("dbconn.php");

    $spotify = $conn->real_escape_string($_POST['spotify']);
    $album_id = $conn->real_escape_string($_POST['albumid']);
  
    $query = "UPDATE album SET album_spotify_embed='$spotify' WHERE album_id='$album_id'";
                              
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 

       // update a user review
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['updateReview']))){

    include("dbconn.php");


    $comment = $conn->real_escape_string($_POST['comment']);
    $reviewDate = $conn->real_escape_string($_POST['date']);
    $userid = $conn->real_escape_string($_POST['userid']);
    $id = $conn->real_escape_string($_POST['albumid']);
    $rating = $conn->real_escape_string($_POST['rating']);
  
    $query    = "UPDATE comment SET comment_text='$comment', comment_time='$reviewDate', user_id='$userid', album_id='$id', rating='$rating', approval='PENDING'
  WHERE user_id='$userid' AND album_id='$id'";
                              
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 




         // update user information
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['updateUser']))){

    include("dbconn.php");


    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $userCreated = $conn->real_escape_string($_POST['usercreated']);
    $userid = $conn->real_escape_string($_POST['userid']);

  
    $query = ("UPDATE user SET user_username='$username', user_email='$email', create_datetime='$userCreated' WHERE user.user_id='$userid'");   
                              
                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 


     // delete a user
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['deleteUser']))){

    include("dbconn.php");

    $id = $conn->real_escape_string($_POST['userid']);

    $query="DELETE FROM comment WHERE user_id=$id;"; $result = $conn->query($query);
    $query="DELETE FROM favourite WHERE user_id=$id;"; $result = $conn->query($query);
    $query="DELETE FROM owned WHERE user_id=$id;"; $result = $conn->query($query);
    $query="DELETE FROM user_role WHERE user_id=$id;"; $result = $conn->query($query);
    $query="DELETE FROM user WHERE user_id=$id;"; $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 

      // reset password
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['resetPass']))){

    include("dbconn.php");

    $userid = $conn->real_escape_string($_POST['userid']);
    $userCreated = $conn->real_escape_string($_POST['date']);
    $newPass = $conn->real_escape_string($_POST['pass']);
    $email = $conn->real_escape_string($_POST['email']);



   // $query = ("UPDATE user SET user_password='" . password_hash($newPass, PASSWORD_DEFAULT) . "', create_datetime='$userCreated' WHERE user.user_id='$userid' AND user.user_email='$email'");   
   $query = ("UPDATE user SET user_password='" . password_hash($newPass, PASSWORD_DEFAULT) . "' WHERE user.user_id='$userid' AND user.user_email='$email'");  
   
   echo $query;
   

                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 


      // remove an album from the owned table
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['removeFromOwned']))){

    include("dbconn.php");

    $userid = $conn->real_escape_string($_POST['userid']);
    $albumID = $conn->real_escape_string($_POST['albumid']);
     $query = "DELETE FROM owned WHERE album_id=$albumID AND user_id=$userid";
 
   

                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 

          // add an album to the owned table
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['addToOwned']))){

    include("dbconn.php");

    $userid = $conn->real_escape_string($_POST['userid']);
    $albumID = $conn->real_escape_string($_POST['albumid']);

      $query    = "INSERT into `owned` (user_id, album_id) VALUES ('$userid',$albumID)";
 
   

                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 


          // remove an album from the favourite table
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['removeFromFav']))){

    include("dbconn.php");

    $userid = $conn->real_escape_string($_POST['userid']);
    $albumID = $conn->real_escape_string($_POST['albumid']);
     $query = "DELETE FROM favourite WHERE album_id=$albumID AND user_id=$userid";
 
   

                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 
    

      // add an album to the favourites table
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['addToFav']))){

    include("dbconn.php");

    $userid = $conn->real_escape_string($_POST['userid']);
    $albumID = $conn->real_escape_string($_POST['albumid']);

      $query    = "INSERT into `favourite` (user_id, album_id) VALUES ('$userid',$albumID)";
 
   

                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 



    
      // add an album to the favourites table
   if (($_SERVER['REQUEST_METHOD']==='POST') && (isset($_GET['register']))){

    include("dbconn.php");

    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $email = $conn->real_escape_string($_POST['email']);
    $create_datetime = $conn->real_escape_string($_POST['date']);
    $securityQ = $conn->real_escape_string($_POST['q']);
    $securityA = $conn->real_escape_string($_POST['a']);

    $query    = "INSERT into `user` (user_username, user_password, user_email, create_datetime, security_question, security_answer)
    VALUES ('$username','".password_hash($password, PASSWORD_DEFAULT)."', '$email', '$create_datetime', '$securityQ','$securityA')";

 
   

                     $result = $conn->query($query);
    
                    if ($result) {
                    echo "<div class='form'>
                        <h3>Success.</h3><br/>
                        </div>";
                    } else {
                    echo "<div class='form'>
                        <h3>Not This Time</h3><br/>
                        </div>";
                    }
    
    } // end 






    
?>