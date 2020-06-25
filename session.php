<?php

   session_start();
   
   define('DB_SERVER1', 'localhost');
   define('DB_USERNAME1', 'merk');
   define('DB_PASSWORD1', 'merkP@ssw0rd');
   define('DB_DATABASE1', 'vms');
   $sessionDB = mysqli_connect(DB_SERVER1,DB_USERNAME1,DB_PASSWORD1,DB_DATABASE1);

   if(mysqli_connect_errno($sessionDB))
{
		echo 'DB: Failed to connect';
}



   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($sessionDB,"select username from user where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   }
?>