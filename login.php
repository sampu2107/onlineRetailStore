<?php
   include('config.php');
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      $mypassword = md5($mypassword);
      $sql = "SELECT membership_id FROM Customer WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
   <body>
<div class="container">
	<section id="content">
               <form action = "" method = "post">
               <h1>Flopkart Login Form</h1>
               <div>
               		<input type="text" placeholder="Username" required="" id="username" name="username" />
               </div>
               <div>
               		<input type="password" placeholder="Password" required="" id="password" name="password" />
               </div>
               <div>
               <input type = "submit" value = " Log in "/>
               		<a href='./inventoryLogin.php'>Login as Inventory Manager</a>
               		<a href='./register.php'>New user? Click here to register</a>
               </div>
               </form>
               <div>
               	<h3 style="color: Red"><?php 
			   if (empty($error)) $error = '';
			   echo $error; ?></h3>	
               </div>
               </section>
               </div>               	
   </body>
</html>