<!DOCTYPE html>
<html>

<head>

    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>

  
</head>



<body> 



<?php 
session_start();


if(!isset($_SESSION['id']))
	{header("location:login.php");
	}
 include("functions/header.php");?>






    <h1>YOU HAVE SUCCESSFULLY LOGGED IN TO 500 Greatest Explored</h1>
    <h2>Enjoy your stay :) </h2>

    <p>
        This website is intended to take a closer look at the 500 greatest albums list produced by American music & pop
        culture magazing Rolling Stone
    </p>
    <hr>
    <h2>Introduction</h2>
    <p>
        Some more text aboout our website.
    </p>
    <hr>
    <h2>What you can do here : </h2>
    <ol>
        <li>More</li>
        <li>Than When </li>
        <li>You visit without logging in</li>
    </ol>
    Share your thoughts on all things music in our <a href="forum.html">FORUM</a>
    <hr>

    <p>View the list from Rolling Stone themselves <a
            href=" https://www.rollingstone.com/music/music-lists/best-albums-of-all-time-1062063/ " target="_blank">
           HERE.  </a>
        </p>

        <table>
            <tr>
              <th>Number</th>
              <th>Year</th>
              <th>Album</th>
              <th>Artist</th>
              <th>Genre</th>
               <th>Subgenre</th>
            </tr>
            <tr>
              <td>1</td>
              <td>1967</td>
            <td>Sgt. Pepper's Lonely Hearts Club Band</td>
                      <td>The Beatles</td>
          <td>Rock</td>
          <td>Rock & Roll, Psychedelic Rock</td>
            
            </tr>
            <tr>
            <td>2</td>
                  <td>1966</td>
              <td>Pet Sounds</td>
                <td>The Beatles</td>
              <td>Rock</td>
          <td>Pop Rock & Roll, Psychedelic Rock</td>
            </tr>
           
           <tr> 
             <td>3</td>
               <td>1966</td>
               <td>Revolver</td>
              <td>The Beatles</td>
              <td>Rock</td>
          <td>Rock & Roll, Psychedelic Rock</td>
            
            </tr>
            
          </table>

    <ol>
        <li>View the Rolling Stones Top 500 Greatest Albums List</li>
        <li>Sort the list by a number of attributes</li>
        <li>Leave a review of you favourite album</li>
    </ol>

    <p>HEY MAN? <a href="logout.php">LOG OUT</a>.</p>

    <p> Come here to leave comments <a href="comment.php"> COMMENT </a>.</p>


    <p> check supers <a href="loggedin.php"> HERE </a>.</p>




</body>

</html>