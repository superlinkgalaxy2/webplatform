<?php
//date("Y-m-d H:i:s")
require_once '../../includes/dbconfig.php';
$user_id = $_SESSION['user_session'];

if(!$user->is_loggedin())
{
 $user->redirect("/");
}

$stmt = $DB_con->prepare("SELECT * FROM chat WHERE user_from=:user_id OR user_to=:user_id ORDER BY date");
$stmt->execute(array(":user_id"=>$user_id));
$chat=$stmt->fetchAll();

if(isset($_POST['btn-send'])){
    $stmt = $DB_con->prepare("SELECT * FROM users WHERE user_name=:user");
    $stmt->execute(array(":user"=>$_POST['user']));
    $usersearch=$stmt->fetch(PDO::FETCH_ASSOC);

  if ($usersearch) {
    $user->redirect("chat.php?userid=".$usersearch['user_id']);
  } else {
    $error = "Error: no user found!";
  }


}

 ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <meta charset="utf-8">
    <title>Chat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <meta name="author" content="Robin De Wolf">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../css/screen.css">
  </head>
  <body>
    <?php
    include_once '../../includes/nav.php';
    if(isset($error))
    {
          ?>
          <div class="alert alert-danger notification">
              <?php echo $error; ?>
          </div>
          <?php
    }
    ?>
     <ul class="list-group">
<?php
  $userspresent = array();
foreach ($chat as $row) {
  if ($row[0] == $user_id) {
    if (!(in_array($row[1], $userspresent))) {
      $stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
      $stmt->execute(array(":user_id"=>$row[1]));
      $other=$stmt->fetch(PDO::FETCH_ASSOC);
      echo '<a href="chat.php?userid='.$row[1].'"><li class="list-group-item">';
      echo $other['user_name'].'</li></a>';
      array_push($userspresent, $row[1]);
    }
  } else {
    if (!(in_array($row[0], $userspresent))) {
      $stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
      $stmt->execute(array(":user_id"=>$row[0]));
      $other=$stmt->fetch(PDO::FETCH_ASSOC);
      echo '<a href="chat.php?userid='.$row[0].'"><li class="list-group-item">';
      echo $other['user_name'].'</li></a>';
      array_push($userspresent, $row[0]);
    }
  }
}
 ?>
    </ul>
    <form class="" method="post">
      <input type="text" class="form-control" name="user" placeholder="Search user...">
      <button type="submit" name="btn-send" class="btn btn-primary">Search</button>
    </form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>
