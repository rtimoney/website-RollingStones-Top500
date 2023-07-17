<?php

include("dbconn.php");

{

    // create user table
    // user_password is stored as a VARBINARY to enable basic encryption
$query9 = "CREATE TABLE `500greatestdb`.`user` ( `user_id` INT NOT NULL AUTO_INCREMENT , `user_email` VARCHAR(255) NOT NULL , `user_username` VARCHAR(255) NOT NULL , `user_password` VARBINARY(255) NOT NULL , `create_datetime` TIMESTAMP NOT NULL, PRIMARY KEY (`user_id`)) ENGINE = InnoDB;
";
$result = $conn -> query ($query9);


$query10 = "CREATE TABLE `500greatestdb`.`review` ( `review_id` INT NOT NULL AUTO_INCREMENT , `album_id` INT NOT NULL , `user_id` INT NOT NULL , `review_text` INT NOT NULL , `review_date` DATE NOT NULL , PRIMARY KEY (`review_id`)) ENGINE = InnoDB;
";
$result = $conn -> query ($query10);

$query11 = "CREATE TABLE `500greatestdb`.`role` ( `role_id` INT NOT NULL AUTO_INCREMENT , `role_name` VARCHAR(255) NOT NULL , `role_description` TEXT NOT NULL , PRIMARY KEY (`role_id`)) ENGINE = InnoDB;
";
$result = $conn -> query ($query11);

$query12 = "CREATE TABLE `500greatestdb`.`user_role` ( `user_role_id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `role_id` INT NOT NULL , PRIMARY KEY (`user_role_id`)) ENGINE = InnoDB;
";
$result = $conn -> query ($query12);



// CREATE TABLE `500greatestdb`.`comment` ( `comment_id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `comment_time` TIMESTAMP NOT NULL , `comment_text` TEXT NOT NULL , PRIMARY KEY (`comment_id`)) ENGINE = InnoDB;



$query13 = "CREATE TABLE `500greatestdb`.`comment` ( `comment_id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `comment_time` TIMESTAMP NOT NULL , `comment_text` TEXT NOT NULL , PRIMARY KEY (`comment_id`)) ENGINE = InnoDB;
";
$result = $conn -> query ($query13);
/*
$query14 = " 
";
$result = $conn -> query ($query14);
*/

}

echo "<h3> User-related tables successfully created in Database! </h3>"
?>