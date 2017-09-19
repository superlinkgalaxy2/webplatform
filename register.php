<?php
require_once 'includes/dbconfig.php';

if($user->is_loggedin()!="")
{
 $user->redirect('home');
}

if(isset($_POST['btn-login'])){
  $user->redirect("index.php");
}

if(isset($_POST['btn-register'])){
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $pass2 = trim($_POST['pass2']);

   if($username=="") {
      $error[] = "Provide username!";
   }
   else if($password != $pass2) {
      $error[] = "Passwords don't match!";
   }
   else if($password=="") {
      $error[] = "Provide password!";
   }
   else if($pass2=="") {
      $error[] = "Please verify your password!";
   }
   else if(strlen($password) < 6){
      $error[] = "Password must be atleast 6 characters";
   }
   else
   {
      try
      {
         $stmt = $DB_con->prepare("SELECT user_name FROM users WHERE user_name=:uname");
         $stmt->execute(array(':uname'=>$username));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);

         if($row['user_name']==$username) {
            $error[] = "Sorry username already taken!";
         }
         else
         {
            if($user->register($username,$password))
            {
                $user->redirect('index.php?success');
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  }
}
?>
 <!DOCTYPE html>
 <html lang="en">
   <head>
     <link rel="stylesheet" type="text/css" href="css/reset.css">
     <meta charset="utf-8">
     <title>Register</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
     <meta name="author" content="Robin De Wolf">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/screen.css">
   </head>
   <body>
     <?php
     if(isset($error))
       {
         ?>
         <div class="alert alert-danger notification">
           <?php
          foreach($error as $error)
          {
              echo $error;
          }
          ?>
           </div>
           <?php
        }
          ?>
     <form action="" method="post" class="center login">
       <div class="form-group">
           <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username">
         </div>
         <div class="form-group">
             <label for="password">Password:</label>
              <input type="password" id="password" name="password" placeholder="********">
           </div>
           <div class="form-group">
               <label for="pass2">Verify password:</label>
                <input type="password" id="pass2" name="pass2" placeholder="********">
             </div>

      <button type="submit" name="btn-login" class="btn btn-primary">< back</button>
      <button type="submit" name="btn-register" class="btn btn-primary">Register!</button>
     </form>

     <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
     <?php include_once 'includes/miner.html'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   </body>
 </html>
