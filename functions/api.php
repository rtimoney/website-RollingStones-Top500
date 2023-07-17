<?php

header("Content-Type: application/json");

// custom Get R.API

      if (($_SERVER['REQUEST_METHOD']==='GET') && isset(($_GET['custom'])) && isset(($_GET['query']))) {

        include ("dbconn.php");
        $q= $_GET['query'];
        $q= urldecode($q);
        $q= mysqli_real_escape_string($conn,$q);
        //$q = str_replace('\'', '', $q);
        $q = str_replace('\n', '', $q);
        $q = str_replace('\\', '', $q);
        $read = "$q";

        //echo $read;

        $result = $conn->query($read);
        
        if (!$result) {
            echo $conn -> error;
        }
    
        // build a response array
        $api_response = array();
        
        while ($row = $result->fetch_assoc()) {
            
            array_push($api_response, $row);
        }
            
        // encode the response as JSON
        $response = json_encode($api_response);
        // echo out the response
        echo $response;

    }


    if (($_SERVER['REQUEST_METHOD']==='GET') && isset(($_GET['getUserSpecial'])) && isset(($_GET['email'])) && isset(($_GET['username']))) {

        include ("dbconn.php");

        // $query    = "SELECT * FROM user WHERE user_username=$username AND user_email=$email";
        $email= $_GET['email'];
        $username= $_GET['username'];
        $query    = "SELECT * FROM user WHERE user_username='$username' AND user_email='$email'";

        
        $result = $conn->query($query);
        
        if (!$result) {
            echo $conn -> error;
        }
    
        // build a response array
        $api_response = array();
        
        while ($row = $result->fetch_assoc()) {
            
            array_push($api_response, $row);
        }
            
        // encode the response as JSON
        $response = json_encode($api_response);
        
        // echo out the response
        echo $response;

    }

    if (($_SERVER['REQUEST_METHOD']==='GET') && isset(($_GET['getSecurity'])) && isset(($_GET['id']))) {

        include ("dbconn.php");

        // $query    = "SELECT * FROM user WHERE user_username=$username AND user_email=$email";
        $id= $_GET['id'];
        $query    = "SELECT security_answer, user_id, create_datetime FROM user WHERE user_id='$id'";

        
        $result = $conn->query($query);
        
        if (!$result) {
            echo $conn -> error;
        }
    
        // build a response array
        $api_response = array();
        
        while ($row = $result->fetch_assoc()) {
            
            array_push($api_response, $row);
        }
            
        // encode the response as JSON
        $response = json_encode($api_response);
        
        // echo out the response
        echo $response;

    }



 
 
// custom1 Get R.API

if (($_SERVER['REQUEST_METHOD']==='GET') && isset(($_GET['custom1'])) && isset(($_GET['query'])) && isset(($_GET['search']))) {

    include ("dbconn.php");
    $q= $_GET['query'];
    $q= mysqli_real_escape_string($conn,$q);
    $search= $_GET['search'];
    $search= mysqli_real_escape_string($conn,$search);
   
    
    $query= $q."'%".$search."%'";

    // echo $query;
   

    $result = $conn->query($query);
    
    if (!$result) {
        echo $conn -> error;
    }

    // build a response array
    $api_response = array();
    
    while ($row = $result->fetch_assoc()) {
        
        array_push($api_response, $row);
    }
        
    // encode the response as JSON
    $response = json_encode($api_response);
    
    // echo out the response
    echo $response;

}

// custom1 Get R.API

if (($_SERVER['REQUEST_METHOD']==='GET') && isset(($_GET['selectAlbum']))) {

    include ("dbconn.php");
    
    
    $query = "SELECT album_ranking, album_id, album_name, artist_name FROM album INNER JOIN artist ON artist.artist_id=album.album_artist ORDER BY album_ranking";

    $result = $conn->query($query);
    
    if (!$result) {
        echo $conn -> error;
    }

    // build a response array
    $api_response = array();
    
    while ($row = $result->fetch_assoc()) {
        
        array_push($api_response, $row);
    }
        
    // encode the response as JSON
    $response = json_encode($api_response);
    
    // echo out the response
    echo $response;

}













































?>
