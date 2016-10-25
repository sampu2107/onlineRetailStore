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
      <li><a href="./inventoryManage.php">Home</a></li>
      <li><a href='./inventoryManage.php' class='btn btn-info btn-lg'> <span class='glyphicon glyphicon-eye-open'></span> Add Products</a></li>
      <li><a href="./logout.php"><span class="glyphicon glyphicon-user"></span>logout</a></li>
    </ul>
  </div>
</nav>
</header>
<?php
require_once("config.php");
   $sql = "SELECT product_id,product_name,product_desc FROM product";
   $retval = mysqli_query($db,$sql);
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
echo "<div class='mainContainer'>";
echo "<div class='leftSide'>";
echo "<h1>Products</h1>";

while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
	$product_id = $row['product_id'];
	$product_name = $row['product_name'];
	echo "<li style='margin:15px;'><a href='./inventoryViewProducts.php?add_Item=$product_id'>$product_name</a></li>";
}
echo "</div>";	
if(isset($_GET['add_Item'])) {
	$product_id = mysqli_real_escape_string($db,$_GET['add_Item']);
$sql = "select product_name from product where product_id = '$product_id'";
$retval = mysqli_query($db,$sql);
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{	
    $Product_name = $row['product_name']; 
}
/*<?php if(isset($_GET['add_Item'])) ?><h1>Insert Item Details for: <?php echo "$Product_name" ?></h1>*/
?>
<div class="rightSide">
<h3 style='font-style:italic'>Click on the products to add items</h3>
<form class="form-horizontal" role="form" action = "" method = "post">
<h3 style="font-style: italic" align="center">Insert Item Details for: <?php echo "$Product_name" ?></h3>
		<div class="form-group">
                    <label for="listPrice" class="col-sm-3 control-label">List Price</label>
                    <div class="col-sm-9">
                        <input type="text" id="listPrice" name="list_price" placeholder="List Price" class="form-control" autofocus required>
                    </div>
                </div>
   		<div class="form-group">
                    <label for="itemAvailability" class="col-sm-3 control-label">Item Availability</label>
                    <div class="col-sm-9">
                        <input type="text" id="itemavailability" name="item_availability" placeholder="Item Availability" class="form-control" autofocus required>
                    </div>
                </div>    
		<div class="form-group">
                    <label for="size" class="col-sm-3 control-label">Size</label>
                    <div class="col-sm-9">
                        <input type="text" id="item_size" name="item_size" placeholder="Item Size" class="form-control" autofocus>
                        <span class="help-block">Size, eg: Small, Medium, Large</span>
                    </div>
                </div>    
		<div class="form-group">
                    <label for="Weight" class="col-sm-3 control-label">Weight</label>
                    <div class="col-sm-9">
                        <input type="text" id="item_weight" name="item_weight" placeholder="Item Weight" class="form-control" autofocus>
                    </div>
                </div>    
		<div class="form-group">
                    <label for="DiscPercentage" class="col-sm-3 control-label">Discount Percentage</label>
                    <div class="col-sm-9">
                        <input type="text" id="item_discount" name="item_discount" placeholder="Item Discount" class="form-control" autofocus>
                    </div>
                </div>   
                 
		<div class="form-group">
                    <label for="ItemAddeddate" class="col-sm-3 control-label">Item added date</label>
                    <div class="col-sm-9">
                        <input type="date" id="item_add" name="item_add" placeholder="Item added date" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ItemSellStartdate" class="col-sm-3 control-label">Item sell start date</label>
                    <div class="col-sm-9">
                        <input type="date" id="item_sellstart" name="item_sellstart" placeholder="Item sell date" class="form-control" autofocus>
                    </div>
                </div>   
		<div class="form-group">
                    <label for="ItemSellEnddate" class="col-sm-3 control-label">Sell end date</label>
                    <div class="col-sm-9">
                        <input type="date" id="item_sellend" name="item_sellend" placeholder="Item end date" class="form-control" autofocus>
                    </div>
                </div>   
	<div class="form-group">
                    <label for="Quantity" class="col-sm-3 control-label">Quantity</label>
                    <div class="col-sm-9">
                        <input type="text" id="item_quantity" name="item_quantity" placeholder="Quantity" class="form-control" autofocus>
                    </div>
                </div>   
		<div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" name="insert_item" class="btn btn-primary btn-block">Add Item</button>
                    </div>
                </div>	   
	</form>
	</div>
<?php }?>
</div>
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

<?php 
if(isset($_POST['insert_item'])){
	$list_price = $_POST['list_price'];
	$item_availability = $_POST['item_availability'];
	$item_size = $_POST['item_size'];
	$item_weight = $_POST['item_weight'];
	$item_discount = $_POST['item_discount'];
	$item_add = trim($_POST['item_add']);
	$item_add = strtotime($item_add);
	$item_add = date('Y-m-d', $item_add);
	$item_sellstart = trim($_POST['item_sellstart']);
	$item_sellstart = strtotime($item_sellstart);
	$item_sellstart = date('Y-m-d', $item_sellstart);
	$item_sellend = trim($_POST['item_sellend']);
	$item_sellend = strtotime($item_sellend);
	$item_sellend = date('Y-m-d', $item_sellend);
	$item_quantity = $_POST['item_quantity'];
    $insert_sql = "Insert into item(product_id,list_price,item_availabilty,size,
	 weight,discount_percentage,product_addeddate,sell_startdate,sell_enddate,quantity) VALUES
	('$product_id','$list_price','$item_availability','$item_size','$item_weight','$item_discount',
	'$item_add','$item_sellstart','$item_sellend','$item_quantity')";
	 $insert_pro = mysqli_query($db,$insert_sql);
	 if(!$insert_pro ){
  		die('Could not get data: ' . mysqli_error($db));
		}
	 
	 if($insert_pro){
	 	echo "<script>alert('Item has been added!!')</script>";
	 	echo "<script>window.open('inventoryViewProducts.php','_self')</script>";
	 }
}
?>