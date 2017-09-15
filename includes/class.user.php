<?php
class USER{
    private $db;

    function __construct($DB_con){
      $this->db = $DB_con;
    }

    public function register($username,$password){
       try
       {
           $new_password = password_hash($password, PASSWORD_DEFAULT);

           $stmt = $this->db->prepare("INSERT INTO users(user_name,user_pass) VALUES(:uname, :upass)");

           $stmt->bindparam(":uname", $username);
           $stmt->bindparam(":upass", $new_password);
           $stmt->execute();

           return $stmt;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
    }

    public function login($username,$password){
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:uname LIMIT 1");
          $stmt->execute(array(':uname'=>$username));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($password, $userRow['user_pass']))
             {
                $_SESSION['user_session'] = $userRow['user_id'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }

   public function redirect($url)
   {
       header("Location: $url");
   }

   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        header("Location: /");
        return true;
   }
}
