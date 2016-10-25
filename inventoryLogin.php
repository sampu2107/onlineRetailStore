<?php
   include('config.php');
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      $mypassword = md5($mypassword);
      $sql = "SELECT username FROM inventorymanager WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_admin'] = $myusername;
         
         header("location: inventoryManage.php");
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
               <h1>Flopkart Manager Login Form</h1>
               <div>
               		<input type="text" placeholder="Username" required="" id="username" name="username" />
               </div>
               <div>
               		<input type="password" placeholder="Password" required="" id="password" name="password" />
               </div>
               <div>
               <input type = "submit" value = " Log in "/>
               		<a href='./login.php'>Login as Customer</a>
               </div>
               <div>
               	<h2><?php 
			   if (empty($error)) $error = '';
			   echo $error; ?></h2>	
               </div>
               </form>
               </section>
               </div>               
   </body>
</html>