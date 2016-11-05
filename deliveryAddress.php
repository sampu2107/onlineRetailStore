<?php 
include('session.php');
require_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Delivery address</title>
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
      <li><a href="./welcome.php">Home</a></li>
      <li><a href='./viewCart.php' class='btn btn-info btn-lg'> <span class='glyphicon glyphicon-shopping-cart'></span>View Cart</a></li>
      <li><a href="./logout.php"><span class="glyphicon glyphicon-user"></span>logout</a></li>
    </ul>
  </div>
</nav>
</header>
<div class="mainContainer">
	<form class="form-horizontal" role="form" action = "" method = "post">
	<div class="form-group">
					<h2 align='center'>Add a Shipping address</h2>
                    <label for="addressLine1" class="col-sm-3 control-label">Address Line 1</label>
                    <div class="col-sm-6">
                        <input type="text" id="addrLine1" name="addrLine1" placeholder="Address Line 1" class="form-control" autofocus required>
                    </div>
                </div>
    <div class="form-group">
                    <label for="addressLine2" class="col-sm-3 control-label">Address Line 2</label>
                    <div class="col-sm-6">
       <input type="text" id="addrLine2" name="addrLine2" placeholder="Address Line 2" class="form-control" autofocus required>            
       		</div>
                </div>
	<div class="form-group">
                    <label for="city" class="col-sm-3 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" id="city" name="city" placeholder="City" class="form-control" autofocus required>
                    </div>
                </div>
    		 <div class="form-group">
                    <label for="state" class="col-sm-3 control-label">State</label>
                    <div class="col-sm-6">
                        <input type="text" id="state" name="state" placeholder="State" class="form-control" autofocus required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="zipcode" class="col-sm-3 control-label">Zip code</label>
                    <div class="col-sm-6">
	                        <input type="text" id="zipcode" name="zipcode" placeholder="zipcode" class="form-control" autofocus required>
                    </div>
                </div>
      <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
                        <button type="submit" name="delivery_address" class="btn btn-primary btn-block">Deliver to this address</button>
                    </div>
                </div>	
	</form>
	<form class="form-horizontal" role="form" action = "" method = "post">
	<div class="form-group">
					<h2 align='center'>Add a Billing address</h2>
                    <label for="addressLine1" class="col-sm-3 control-label">Address Line 1</label>
                    <div class="col-sm-6">
                        <input type="text" id="addrLine1" name="addrLine1" placeholder="Address Line 1" class="form-control" autofocus required>
                    </div>
                </div>
    <div class="form-group">
                    <label for="addressLine2" class="col-sm-3 control-label">Address Line 2</label>
                    <div class="col-sm-6">
       <input type="text" id="addrLine2" name="addrLine2" placeholder="Address Line 2" class="form-control" autofocus required>            
       		</div>
                </div>
	<div class="form-group">
                    <label for="city" class="col-sm-3 control-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" id="city" name="city" placeholder="City" class="form-control" autofocus required>
                    </div>
                </div>
    		 <div class="form-group">
                    <label for="state" class="col-sm-3 control-label">State</label>
                    <div class="col-sm-6">
                        <input type="text" id="state" name="state" placeholder="State" class="form-control" autofocus required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="zipcode" class="col-sm-3 control-label">Zip code</label>
                    <div class="col-sm-6">
                        <input type="text" id="zipcode" name="zipcode" placeholder="zipcode" class="form-control" autofocus required>
                    </div>
                </div>
      <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
                        <button type="submit" name="billing_address" class="btn btn-primary btn-block">Add billing address</button>
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
if(isset($_POST['delivery_address'])){
	$user = "select membership_id from customer where username = '$login_session'";
	$user_name = mysqli_query($db,$user);
	$row1 = mysqli_fetch_array($user_name, MYSQLI_ASSOC);
	$mem_id = $row1['membership_id'];	
	$addrLine1 = $_POST['addrLine1'];
	echo "addr".$addrLine1."post".$_POST['addrLine1'];
	$addrLine2 = $_POST['addrLine2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zipcode = $_POST['zipcode'];
	$addr_type = "ShippingAddress"; 
	 $insert_sql = "Insert into address(membership_id,addr_line_1,addr_line_2,city,state,zip_code,address_type) VALUES
	('$mem_id','$addrLine1','$addrLine2','$city','$state','$zipcode','$addr_type')";
	 $insert_pro = mysqli_query($db,$insert_sql);
	 if($insert_pro){
	  	echo "<script>alert('Delivery address has been added! Kindly enter Billing address details..')</script>";	 	
	}
   }
if(isset($_POST['billing_address'])){
	$user = "select membership_id from customer where username = '$login_session'";
	$user_name = mysqli_query($db,$user);
	$row1 = mysqli_fetch_array($user_name, MYSQLI_ASSOC);
	$mem_id = $row1['membership_id'];	
	$addrLine1 = $_POST['addrLine1'];
	$addrLine2 = $_POST['addrLine2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zipcode = $_POST['zipcode'];
	$addr_type = "BillingAddress"; 
	 $insert_sql = "Insert into address(membership_id,addr_line_1,addr_line_2,city,state,zip_code,address_type) VALUES
	('$mem_id','$addrLine1','$addrLine2','$city','$state','$zipcode','$addr_type')";
	 $insert_pro = mysqli_query($db,$insert_sql);
	 if($insert_pro){
	  	echo "<script>alert('Product has been added!')</script>";	 	
	}
   }   
   
?>