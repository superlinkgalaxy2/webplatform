<?php
$stmt = $DB_con->prepare("SELECT * FROM permissions WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$_SESSION['user_session']));
$permissionsRow=$stmt->fetch(PDO::FETCH_ASSOC);?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">
  <li <?php if ((strpos($permissionsRow['permissions'], 'cloud') == false) and (strpos($permissionsRow['permissions'], 'chat') == false))  {
    echo 'class="nav-item active"';
  } ?>>
    <a class="nav-link" href="/home">Home </a>

  </li>
  <?php

  if (strpos($permissionsRow['permissions'], 'cloud') !== false) {
    echo '<li class="nav-item';
    if (strpos("{$_SERVER['REQUEST_URI']}", 'cloud') !== false) {
      echo ' active';
    }
    echo '"><a class="nav-link" href="/home/cloud">Cloud</a>';
    echo "</li>";
  }
  if (strpos($permissionsRow['permissions'], 'chat') !== false) {
    echo '<li class="nav-item';
    if (strpos("{$_SERVER['REQUEST_URI']}", 'chat') !== false) {
      echo ' active';
    }
    echo '"><a class="nav-link" href="/home/chat">Chat</a>';
    echo "</li>";
  }
  if ($permissionsRow['permissions'] == "") {
    echo "";
  }

   ?>
</ul>
</div>
</nav>
