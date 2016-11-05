<!DOCTYPE html>
<html lang="en">
<head>
  <title>Items page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<header>
<nav class="navbar navbar-default">
<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Flopkart Retail Store</a> 
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="./welcome.php">Home</a></li>
      <li><a href='./viewCart.php' class='btn btn-info btn-lg'> <span class='glyphicon glyphicon-shopping-cart'></span>View Cart</a></li>
      <li><a href="./logout.php"><span class="glyphicon glyphicon-user"></span>logout</a></li>
    </ul>
  </div>
</nav>
</header>	
<?php
include('session.php');
require_once("config.php");
$sql = 'SELECT category_id,category_name,description,availability FROM category';

   $retval = mysqli_query($db,$sql);
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
echo "<div class='mainContainer'>";
echo "<div class='leftSide'>";
echo "<h1>Categories</h1>";
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
	
	$category_name = $row['category_name'];
	$category_id = $row['category_id'];
	echo "<li><a class='listStyle' href='./welcome.php?view_product=$category_id'>$category_name</a></li>";
} 
echo "</div>";
