<?php
   include("config.php");
   session_start();

   global $error;
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM user WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     // $active = $row['active'];
      $error = "";
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        session_start();
         $_SESSION['login_user'] = $myusername;
         
         header("location: addNew.php");
      }else {
         $error = "Your Login Name or Password is invalid";

      }
   }
?>



<!DOCTYPE html>
<html>

<meta charset="UTF-8">

<head>
<link rel="stylesheet" href="index.css">
<title> ALSEC VMS</title>

</head>



<body > 


<div id="disp" >
 <img src ="sec.gif" class="logo">
 <h2 class="title"> Visitor Management System</h2>
     <div id="setLogin">
        <form action="index.php" method="POST">
             <label for="username">Username:</label>
             <input type="text" name="username" id="username" /> </br></br>
             <label for="password">Password:</label>
             <input type="password" name="password" id="password" /></br></br>
             <input type="submit"  value="Submit" class="btn-login"/>
        </form>
        <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
    </div>
</div>


</body>
</html>