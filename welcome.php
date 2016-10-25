<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome page</title>
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
      <li><a href='./welcome.php' class='btn btn-info btn-lg'> <span class='glyphicon glyphicon-shopping-cart'></span> Add to Cart</a></li>
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
if(isset($_GET['view_product'])) {
	$category_id = mysqli_real_escape_string($db,$_GET['view_product']);
   $sql = "SELECT product_id,product_name,product_desc FROM product where category_id = '$category_id'";

   $retval = mysqli_query($db,$sql);
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
echo "<div class='rightSide'>";
echo "<div class='row'>";
echo "<p style='font-style:italic;margin-left:25px;'>Welcome to Flopkart retail store:" . $login_session . "</p>";
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
	$product_id = $row['product_id'];
	$product_name = $row['product_name'];
	echo "<div class='col-md-3 tileStyle'><a href='./viewItems.php?view_Item=$product_id'>$product_name</a> <br>
			<p style='font-style:italic;margin-left:25px'>{$row['product_desc']} <br></p></div>";
    
}
echo "</div></div>";
}
echo "</div>";
?>
<footer class="footer">
<div class="leftFooter">An exciting place for the whole family to shop!!</div>
<div class="centerFooter">
Copyright &copy; 2016, Flopkart Retail Store</div>
<div class="rightFooter"><div style="float: right"><i class="fa fa-map-marker"></i>
                  <p style=    "float: left;
    padding-top: 10px;padding-right:150px"><span>Charlotte, United States</span></p></div>
    <div style="padding-top:10px">
                  <i style="margin-left: 159px;" class="fa fa-phone"></i>
                  <span style="margin-right: 108px">+1 704-906-6315</span>
               </div></div>
 </footer>
</body>   
</html>

