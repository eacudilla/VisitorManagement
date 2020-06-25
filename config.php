<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'merk');
   define('DB_PASSWORD', 'merkP@ssw0rd');
   define('DB_DATABASE', 'vms');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   $dblink = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   if(mysqli_connect_errno($db))
{
		echo 'DB: Failed to connect';
}

?>