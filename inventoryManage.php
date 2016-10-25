<?php 
include('session.php');
require_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Inventory manage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style='background-color:#f8f8f8';>
<header>
<nav class="navbar navbar-default">
<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Flopkart Retail Store</a> 
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="./inventoryManage.php">Home</a></li>
      <li><a href='./inventoryViewProducts.php' class='btn btn-info btn-lg'> <span class='glyphicon glyphicon-eye-open'></span> View Products</a></li>
      <li><a href="./logout.php"><span class="glyphicon glyphicon-user"></span>logout</a></li>
    </ul>
  </div>
</nav>
</header>
<div class="mainContainer">
	<form class="form-horizontal" role="form" action = "" method = "post">
	<p style='font-style:italic;margin-left:20px;font-size:30px;' align="center">Insert Product Details!</p>
	<div class="form-group">
                    <label for="productName" class="col-sm-3 control-label">Product Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="productName" name="product_name" placeholder="Product Name" class="form-control" autofocus required>
                        <span class="help-block">Product Name, eg: T-shirts, Shirts</span>
                    </div>
                </div>
    <div class="form-group">
                    <label for="productCategory" class="col-sm-3 control-label">Product Category</label>
                    <div class="col-sm-9">
                        <select name="prod_cat" class="form-control" autofocus required>
                        <option>Select a Category</option>
                        <?php 
				$sql = 'SELECT category_id,category_name FROM category';
				 $retval = mysqli_query($db,$sql);
					if(! $retval )
					{
			  			die('Could not get data: ' . mysql_error());
					}
				while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)){
					$category_name = $row['category_name'];
					$category_id = $row['category_id'];
					echo "<option value='$category_id'>$category_name</option> ";
				}			
				?>
			</select>

                    </div>
                </div>
	<div class="form-group">
                    <label for="productDescription" class="col-sm-3 control-label">Product Description</label>
                    <div class="col-sm-9">
                        <textarea id="productDesc" name="product_desc" cols="20" rows="10" placeholder="Product Description" class="form-control" autofocus required></textarea>
                    </div>
                </div>
    		 <div class="form-group">
                    <label for="prodQuantity" class="col-sm-3 control-label">Product Quantity</label>
                    <div class="col-sm-9">
                        <input type="text" id="productQuantity" name="product_quantity" placeholder="Product Quantity" class="form-control" autofocus required>
                                          <span class="help-block">Product Quantity, eg: 5,10</span>
                    </div>
                </div>
      <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" name="insert_product" class="btn btn-primary btn-block">Add Product</button>
                    </div>
                </div>	
	</form>
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
if(isset($_POST['insert_product'])){
	$product_name = $_POST['product_name'];
	$product_category = $_POST['prod_cat'];
	$product_desc = $_POST['product_desc'];
	$product_quantity = $_POST['product_quantity']; 
	 $insert_sql = "Insert into product(category_id,product_name,product_desc,quantity) VALUES
	('$product_category','$product_name','$product_desc','$product_quantity')";
	 $insert_pro = mysqli_query($db,$insert_sql);
	 if($insert_pro){
	  	echo "<script>alert('Product has been added!')</script>";
	 	echo "<script>window.open('inventoryManage.php','_self')</script>";
	 	
	}
   }   
?>