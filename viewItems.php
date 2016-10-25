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
      <li><a href='./welcome.php' class='btn btn-info btn-lg'> <span class='glyphicon glyphicon-shopping-cart'></span>View Cart</a></li>
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
if(isset($_GET['view_Item'])) {
	$product_id = mysqli_real_escape_string($db,$_GET['view_Item']);
$sql = "select item_id,product_name,list_price,item_availabilty,discount_percentage,product_addeddate,sell_startdate,sell_enddate,size,weight,i.quantity 
from item as i inner join product as p on i.product_id = p.product_id where i.product_id = '$product_id'";
$user = "select membership_id from customer where username = '$login_session'";
$user_name = mysqli_query($db,$user);
$row1 = mysqli_fetch_array($user_name, MYSQLI_ASSOC);
$mem_id = $row1['membership_id'];
$date = date('Y-m-d');
$retval = mysqli_query($db,$sql);
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
if(isset($_POST['Cart'])){
		$itemid = (int)$_POST["hidden_id"];
		$qty = (int)$_POST["quantity"];
		if($qty >0)
		{
			$sql = "select item_id from cart where item_id = '$itemid'";
			$result = mysqli_query($db,$sql);
			$sql = "select item_availabilty from item where item_id = '$itemid'";	
			$available = mysqli_query($db, $sql);
			$row1 = mysqli_fetch_array($available, MYSQLI_ASSOC);
			if($row1['item_availabilty'] == "yes")
			{
				if(mysqli_num_rows($result) == 0)
				{
					$query = "INSERT INTO cart (membership_id,item_id,created_date,quantity) VALUES ('$mem_id', '$itemid', '$date', '$qty')";
					$insert_pro = mysqli_query($db,$query);
					if(!$insert_pro ){
					die('Could not add items to the cart due to DB error: ' . mysqli_error($db));
					}
					if($insert_pro){
					echo "<script>alert('Item added to cart successfully!')</script>";
					}
				}
				else
				{
					echo "<script>alert('Item already present in cart. Make changes in cart')</script>";
				}
			}
			else
			{
				echo "<script>alert('Item out of stock. Please continue shopping other items	')</script>";
			}
		}
		else
		{
			echo "<script>alert('Specify Quantity correctly')</script>";
		}
}
echo "<div class='rightSide'><div class='row'><p style='font-style:italic;margin-left:20px;'>Welcome to Online retail application:" . $login_session . "</p>";
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
	echo "<form method='post'>";
    echo "<div class='col-md-8 tileStyle'>
    	Product name: {$row['product_name']}
    	<span style='margin-left:15px;'><input class='form-check-input' type='checkbox' value=''/></span>
    	<i>Like it? Click here to Buy!!</i>
		<br> ".
         "List price: {$row['list_price']} $<br> ".
    	 "Product added date: {$row['product_addeddate']}  <br> ".
         "Sale end date: {$row['sell_enddate']}  <br> ".
         "Size: {$row['size']} <br> ".
         "Weight: {$row['weight']}  <br> ".
         "In stock: {$row['item_availabilty']} <br> ".
         "Quantity : <input type='text' style='width: 45px' name='quantity' />". 
    	 "<span style='margin-left:55px;'> <span class='glyphicon glyphicon-shopping-cart'></span><input type = 'hidden' name = 'hidden_id' value ='{$row['item_id']}'/>
			<input type = 'submit' name = 'Cart' value = 'Add to cart'/></span>".
    	 "</div></form>";
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
