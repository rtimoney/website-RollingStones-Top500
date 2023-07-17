
<html>


<head>
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
</head>


<?php include("functions/header.php");?>



<?php
     
        

if (isset($_REQUEST['security'])){

  
    
        $answer=($_REQUEST['security']);
      

        
        $username=($_REQUEST['username']);
        $email=($_POST['email']);
        $userId=($_POST['userid']);

      

        $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?getSecurity&id=$userId";
        
        $resource = file_get_contents($endpoint);
        $data = json_decode($resource, true);

   


    

 


            foreach($data as $row){
                $securitya=$row['security_answer'];}
                $userId=$row['user_id'];
                $userCreated=$row['create_datetime'];
            }

            if ($answer==$securitya){
               

?>
<div id="centred_p">
<h1> SET A NEW PASSWORD </h1><hr>
       
       <form method="post" action="overwritePassword.php">
      <input type="password" name="password"><br>
      <input name="username" type="hidden" value="<?php echo $username ?>"/>
      <input name="email" type="hidden" value="<?php echo $email ?>"/>
      <input name="datetime" type="hidden" value="<?php echo $userCreated ?>"/>
      <input name="id" type="hidden" value="<?php echo $userId ?>"/>



      <input type="submit" value="update password">
            </div>
          
<?php


            } else {
                echo "Error, please try again!";
            } 

         // }  } ?>
      </body>
</div>
            </html>  