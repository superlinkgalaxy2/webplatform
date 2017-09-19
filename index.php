<?php
require_once 'includes/dbconfig.php';

if($user->is_loggedin()!="")
{
 $user->redirect('home');
}

if(isset($_POST['btn-login'])){
 $username = $_POST['username'];
 $password = $_POST['password'];

   if($user->login($username,$password)){
    $user->redirect('home');
   }
   else{
    $error = "Username or password is incorrect!";
   }
}
if(isset($_POST['btn-register'])){
 $user->redirect("register.php");
}
?>
 <!DOCTYPE html>
 <html lang="en">
   <head>
     <link rel="stylesheet" type="text/css" href="css/reset.css">
     <meta charset="utf-8">
     <title>Login</title>
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
                    <?php echo $error; ?>
                </div>
                <?php
          }
          else if(isset($_GET['success']))
            {
                 ?>
                 <div class="alert alert-info notification">
                      Successfully registered! You can login now
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

      <button type="submit" name="btn-login" class="btn btn-primary">Login ></button>
      <button type="submit" name="btn-register" class="btn btn-primary">Register</button>
     </form>
     <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<?php include_once 'includes/miner.html'; ?>
   </body>
 </html>
