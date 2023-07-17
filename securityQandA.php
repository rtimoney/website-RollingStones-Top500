<html>


<head>
    <title>500GreatestExplored</title>
    <link href="ui.css" rel="stylesheet"/>
</head>

<?php include("functions/header.php");?>



<?php
     
     
     if (isset($_REQUEST['email'])){

   
        $username=($_REQUEST['username']);
        $email=($_POST['email']);
        $query    = "SELECT * FROM user WHERE user_username=$username AND user_email=$email";
        $endpoint = "http://rtimoney02.webhosting6.eeecs.qub.ac.uk/project500ForServer/functions/api.php?getUserSpecial&email=$email&username=$username";
          $resource = file_get_contents($endpoint);
          $data = json_decode($resource, true);
        
        
        if(!$data){echo "Error, please try again!";}
        
        elseif(!count($data)==1){echo "Error, please try again.";}
        elseif(count($data)==1){

            foreach($data as $row){
                $securityq=$row['security_question'];
                $securitya=$row['security_answer'];
                $userid=$row['user_id'];}



        





?>
<br><hr>
<div id="centred_p">
<h1>Username and Password Submitted successfully</h1><hr>
       
       <?php echo "Your security question is :  ' $securityq '" ;?><br>
       <form method="post" action="newPassword.php">
      <input type="text" name="security" placeholder="Answer to Security Question"><br>
      <input name="username" type="hidden" value="<?php echo $username ?>"/>
      <input name="email" type="hidden" value="<?php echo $email ?>"/>
      <input name="userid" type="hidden" value="<?php echo $userid ?>"/>
      <input type="submit" value="submit"> </div>
          
           <?php }} ?>
      </body>
</div>
</html>