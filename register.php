<?php
require_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/home.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style='background-color:#f8f8f8';>
<div class="Container">
<form class="form-horizontal" role="form" method="post" action="">
	<h2 style="color:gray;" align="center">Flopkart Registration Form!!</h2>
	 <div class="form-group">
                    <label for="userName" class="col-sm-3 control-label">User Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="firstName" name="userName" placeholder="User Name" class="form-control" autofocus required>
                        <span class="help-block">User Name, eg: Sampath, Virat</span>
                    </div>
                </div>
       <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">First Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="firstName" name="firstName" placeholder="First Name" class="form-control" autofocus required>
                    </div>
                </div>
       <div class="form-group">
                    <label for="middleName" class="col-sm-3 control-label">Middle Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="middleName" name="middleName" placeholder="Middle Name" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastName" class="col-sm-3 control-label">Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="lastName" name="lastName" placeholder="Last Name" class="form-control" autofocus required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="addr" class="col-sm-3 control-label">Addr Line1</label>
                    <div class="col-sm-9">
                        <input type="text" id="addrline1" name="addrline1" placeholder="Address Line 1" class="form-control" autofocus required>
                    </div>
                </div>
		<div class="form-group">
                    <label for="addr" class="col-sm-3 control-label">Addr Line2</label>
                    <div class="col-sm-9">
                        <input type="text" id="addrline2" name="addrline2" placeholder="Address Line 2" class="form-control" autofocus>
                    </div>
                </div>
		<div class="form-group">
                    <label for="addr" class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input type="text" id="city" name="city" placeholder="City" class="form-control" autofocus required>
                    </div>
                </div>
		<div class="form-group">
                    <label for="addr" class="col-sm-3 control-label">State</label>
                    <div class="col-sm-9">
                        <input type="text" id="state" name="state" placeholder="State" class="form-control" autofocus required>
                    </div>
                </div>
			<div class="form-group">
                    <label for="addr" class="col-sm-3 control-label">Zipcode</label>
                    <div class="col-sm-9">
                        <input type="text" id="zipcode" name="zipcode" placeholder="Zipcode" class="form-control" autofocus required>
                    </div>
                </div>
		<div class="form-group">
                    <label for="addr" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control" autofocus required>
                    </div>
                </div>
		<div class="form-group">
                    <label for="addr" class="col-sm-3 control-label">Confirm Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="password" name="password" placeholder="Confirm Password" class="form-control" autofocus required>
                    </div>
                </div>
        <div class="form-group">
                    <label for="addr" class="col-sm-3 control-label">Email address</label>
                    <div class="col-sm-9">
                        <input type="text" id="userEmail" name="userEmail" placeholder="Email address" class="form-control" autofocus required>
                    </div>
                </div>
        <div class="form-group">
                    <label for="addr" class="col-sm-3 control-label">Phone number</label>
                    <div class="col-sm-9">
                        <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" class="form-control" autofocus required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox">I accept Terms and Conditions</input>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <a href="login.php" class="btn btn-primary btn-block" role="button">Cancel</a>
                    </div>
                </div>
</form>
</div>
</body>
</html>
<?php
if(isset($_POST['register'])){
$first_name = $_POST['firstName'];
$middle_name = $_POST['middleName'];
$last_name = $_POST['lastName'];
$addr_line_1 = $_POST['addrline1'];
$addr_line_2 = $_POST['addrline2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip_code = $_POST['zipcode'];
$email_addr = $_POST['userEmail'];
$phone_number = $_POST['phoneNumber'];
$user_name = $_POST['userName'];
$password = md5($_POST['password']);
$query = "INSERT INTO customer (password,first_name, middle_name, last_name, addr_line_1, addr_line_2, city, state, zip_code, email_addr, phone_number, username) VALUES
('$password','$first_name','$middle_name','$last_name','$addr_line_1','$addr_line_2','$city','$state','$zip_code','$email_addr','$phone_number','$user_name')";
$insert_pro = mysqli_query($db,$query);
	 if(!$insert_pro ){
  		die('Could not register due to DB error: ' . mysqli_error($db));
		}
	 if($insert_pro){
	 	echo "<script>alert('Registered succesfully! Login to shop..')</script>";
	 	echo "<script>window.open('login.php','_self')</script>";
	 }
}
?>