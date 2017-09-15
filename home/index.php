<?php

require_once '../includes/dbconfig.php';

if(!$user->is_loggedin())
{
 $user->redirect("/");
}

$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

 if(isset($_POST['btn-logout'])){
   $user->logout();
  }

 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <link rel="stylesheet" type="text/css" href="../css/reset.css">
     <meta charset="utf-8">
     <title>Welcome</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
     <meta name="author" content="Robin De Wolf">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" type="text/css" href="../css/screen.css">
   </head>
   <body>
     <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <form class="navbar-nav mr-auto" method="post">
          <button type="submit" name="btn-logout">Logout</button>
         </form>
         <form class="form-inline my-2 my-lg-0">
           <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
           <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
         </form>
     </nav>

     <?php
   echo "hello ".$userRow['user_name'];
   $stmt = $DB_con->prepare("SELECT * FROM permissions WHERE user_id=:user_id");
   $stmt->execute(array(":user_id"=>$user_id));
   $permissionsRow=$stmt->fetch(PDO::FETCH_ASSOC);

   echo '<div class="cf">';

   if (strpos($permissionsRow['permissions'], 'cloud') !== false) {
     echo '<div class="card">
       <img class="card-img-top" src="images/cloud.png" alt="Card image cap">
       <div class="card-body">
         <h4 class="card-title">Cloud storage</h4>
         <p class="card-text">Store your shizzle online</p>
         <a href="cloud" class="btn btn-primary">To the cloud!</a>
       </div>
     </div>';
   }
   if (strpos($permissionsRow['permissions'], 'chat') !== false) {
     echo '<div class="card">
       <img class="card-img-top" src="images/chat.png" alt="Card image cap">
       <div class="card-body">
         <h4 class="card-title">Chat</h4>
         <p class="card-text">Chat with your friends :)</p>
         <a href="chat" class="btn btn-primary">To the chat!</a>
       </div>
     </div>';
   }
   if ($permissionsRow['permissions'] == "") {
     echo "There's nothing here";
   }
      ?>

</div>
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   </body>
 </html>
