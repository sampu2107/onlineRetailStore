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
$user = "select membership_id from customer where username = '$login_session'";
$user_name = mysqli_query($db,$user);
$row1 = mysqli_fetch_array($user_name, MYSQLI_ASSOC);
$mem_id = $row1['membership_id'];
$sql = "select c.item_id,product_name,list_price,discount_percentage,c.quantity 
from item as i inner join product as p on i.product_id = p.product_id inner join cart as c on i.item_id = c.item_id where c.membership_id='$mem_id'";
$retval = mysqli_query($db,$sql);
$no_of_items = mysqli_num_rows($retval);
$subTotal = 0;
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
echo "<div class='rightSide'>
<div class='row'>
<p style='font-style:italic;margin-left:20px;'>Welcome to Online retail application:" . $login_session . "</p>";
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
$subTotal = $subTotal + ($row['list_price'] * $row['quantity']);
echo "<div class='col-sm-6 tileStyle'>
  Product name: {$row['product_name']} <br> ".
  "List price: {$row['list_price']} $<br> ".
  "Discount %: {$row['discount_percentage']} <br> ".
  "Quantity: {$row['quantity']} <a href='editCart.php?editCart=$row[item_id]'>Edit item </a><br> ".
"</div>";
}
echo "<form method='post'>";
echo "<div style='border-style:dashed;border-width:3px;margin-left:862px;margin-right:193px;background-color:#f8f8f8'>";
echo "<span style='margin-left:140px;'>Subtotal ($no_of_items items): $ $subTotal </span>
 <p><span style='margin-left:140px;'><span style='margin-top:30px;' class='glyphicon glyphicon-thumbs-up'></span>
			<input class = 'btn-success btn-lg' type = 'submit' name ='checkOut' value = 'Proceed to Checkout'/></span></p>".
"</form></div></div></div>";
if(isset($_POST['checkOut'])){
$curr =	date("Y-m-d");
$currdate = strtotime($curr);
$reqddate = strtotime("+7 day", $currdate);
$reqd = date('Y-m-d', $reqddate);
$status = "In_Progress"; 
$checkoutSql = "insert into orders(membership_id,order_date,required_date,order_status) VALUES ('$mem_id','$curr', '$reqd', '$status')";
$insert_pro = mysqli_query($db,$checkoutSql);
					if(!$insert_pro ){
					die('Could not checkout items due to DB error: ' . mysqli_error($db));
					}
					if($insert_pro){
					$order_id = mysqli_insert_id($db);
					echo "orderId".$order_id;
					$cartDetails = "select c.item_id,c.quantity,list_price from item as i inner join cart as c on i.item_id=c.item_id where c.membership_id='$mem_id'";
					//$orderDetails = "select order_id from orders where membership_id='$mem_id'";
					$cartVal = mysqli_query($db,$cartDetails);
					//$orderVal = mysqli_query($db,$orderDetails);
					//$orderData = mysqli_fetch_array($orderVal, MYSQLI_ASSOC);	
					//$order_id = $orderData['order_id'];
					if(! $cartVal )
					{
  					die('Could not get data: ' . mysqli_error($db));
					}
					while($row = mysqli_fetch_array($cartVal, MYSQLI_ASSOC))
					{
						$item_id = $row['item_id'];
						$quantity = $row['quantity'];
						$list_price = $row['list_price'];
						$duplicateItems = "select od.item_id from orderdetails as od inner join cart as c on c.item_id=od.item_id where od.item_id='$item_id' and c.membership_id='$mem_id'";
						$dup = mysqli_query($db,$duplicateItems);
						if(mysqli_num_rows($dup) == 0){ 
						$orderDetailsSql = "insert into orderdetails(order_id,item_id,quantityOrdered,unit_price) VALUES ('$order_id',$item_id,$quantity,$list_price)";
						$insert_pro = mysqli_query($db,$orderDetailsSql);
						echo "<script>window.open('deliveryAddress.php','_self')</script>";
						}
						if(!$insert_pro ){
						die('Could not checkout items due to DB error: ' . mysqli_error($db));
						}
					  }
					}	
}
echo "</div>"

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



