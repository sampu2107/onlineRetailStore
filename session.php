<?php
   include('config.php');
   session_start();
   if(isset($_SESSION['login_user'])){
   $user_check = $_SESSION['login_user'];
   $ses_sql = mysqli_query($db,"select username from customer where username = '$user_check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['username'];
   }
   /*else if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }*/
   if(isset($_SESSION['login_admin'])){
   	$admin_check = $_SESSION['login_admin'];
   $adm_sql = mysqli_query($db,"select username from inventorymanager where username = '$admin_check' ");
   $adm_row = mysqli_fetch_array($adm_sql,MYSQLI_ASSOC);
   $login_session = $adm_row['username'];
   }
   /*else if(!isset($_SESSION['login_admin'])){
      header("location:inventoryLogin.php");
   }*/
?>
