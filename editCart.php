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
if(isset($_GET['editCart'])) {
	$item_id = mysqli_real_escape_string($db,$_GET['editCart']);
	$sql = "select c.item_id,product_name,list_price,discount_percentage,c.quantity 
from item as i inner join product as p on i.product_id = p.product_id inner join cart as c on i.item_id = c.item_id where c.item_id='$item_id'";
$retval = mysqli_query($db,$sql);
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
echo "<div class='rightSide'><div class='row'>";
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
echo "<form method='post'>";
echo "<div class='col-sm-6 tileStyle'>
  Product name: {$row['product_name']} <br> ".
  "List price: {$row['list_price']} $<br> ".
  "Discount %: {$row['discount_percentage']} <br> ".
  "Quantity:<input type='text' name='quantity' value='{$row['quantity']}' required />".
	"<span style='margin-left:140px;'> <span style='margin-top:30px;' class='glyphicon glyphicon-saved'></span>
	<input type = 'hidden' name = 'hidden_id' value ='{$row['item_id']}'/>
	<input class = 'btn-success btn-lg' type = 'submit' name ='cartUpdate' value = 'Update Cart'/></span>".
"</div></form>";  	
}
echo "</div></div>";
}
if(isset($_POST['cartUpdate'])){
	$quantity = $_POST['quantity'];
	$item_id = $_POST['hidden_id'];
	if($quantity>0){
	$updateSql = "update cart set quantity='$quantity' where item_id='$item_id'";
	$res = mysqli_query($db,$updateSql);
	if(! $retval )
	{
  		die('Could not update data: ' . mysql_error());
	}else {
	echo "<script>alert('Updated cart succesfully..')</script>";
	 	echo "<script>window.open('viewCart.php','_self')</script>";
	 }
	}else{
		echo "<script>alert('Specify Quantity correctly')</script>";
	}
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