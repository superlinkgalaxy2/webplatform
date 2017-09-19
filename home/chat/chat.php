<?php
//date("Y-m-d H:i:s")
require_once '../../includes/dbconfig.php';
$user_id = $_SESSION['user_session'];
$other = $_GET['userid'];

if(!$user->is_loggedin())
{
 $user->redirect("/");
}

$stmt = $DB_con->prepare("SELECT * FROM chat WHERE (user_from=:user_id AND user_to=:other) OR (user_to=:user_id AND user_from=:other) ORDER BY date");
$stmt->execute(array(":user_id"=>$user_id,":other"=>$other));
$chat=$stmt->fetchAll();

if(isset($_POST['btn-send'])){
  try
  {
      $stmt = $DB_con->prepare("INSERT INTO chat(user_from,user_to,message,date) VALUES(:from, :to, :m, :date)");
      $date = date("Y-m-d H:i:s");
      $stmt->bindparam(":from", $user_id);
      $stmt->bindparam(":to", $other);
      $stmt->bindparam(":m", $_POST['message']);
      $stmt->bindparam(":date", $date);
      $stmt->execute();
      header("Refresh:0");

  }
  catch(PDOException $e){
      echo $e->getMessage();
  }
 }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css">
    <meta charset="utf-8">
    <title>Chat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <meta name="author" content="Robin De Wolf">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../../css/screen.css">
  </head>
  <body>

<?php include_once '../../includes/nav.php'; ?>
<div id="chat">
     <ul class="list-group">
<?php

    foreach ($chat as $row) {
      echo '<li class="list-group-item">';
      if ($row[0] == $user_id) {
        echo 'You: '.$row[2];
      } elseif ($row[0] == $_GET['userid']) {
        $stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
        $stmt->execute(array(":user_id"=>$row[0]));
        $other=$stmt->fetch(PDO::FETCH_ASSOC);
        echo $other['user_name'].': '.$row[2];
      }
      echo '</li>';
    }

 ?>
    </ul>

    <form class="" method="post">
      <input type="text" class="form-control" name="message" placeholder="Say something...">
      <button type="submit" name="btn-send" class="btn btn-primary">Send</button>
    </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <?php include_once '../../includes/miner.html'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="script.js"></script>

  </body>
</html>
