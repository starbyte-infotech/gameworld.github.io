<?php

session_start();
include("config.php");

if(isset($_POST['register'])){

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm_pass = $_POST['confirm_pass'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$country = $_POST['country'];
	$postal_code = $_POST['postal_code'];
	$about = $_POST['about'];
	$company = $_POST['company'];	

    if($password == $confirm_pass){

    	$ciphering = "AES-128-CTR";
	    $iv_length = openssl_cipher_iv_length($ciphering);
	    $options = 0;
	    $encryption_iv = '1234117891111121';
	    $encryption_key = "Nothing";
	    $encrypt_pass = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

	    $image = $_FILES["img"]["name"];
	    $image_temp = $_FILES["img"]["tmp_name"];   
	    $folder = "images/".$image;

    	$sql = "INSERT INTO `tbl_admin`(`id`, `first_name`, `last_name`, `email`, `username`, `password`, `address`, `city`, `country`, `postal_code`, `about`, `company`, `profile`, `created_at`) VALUES (NULL, '$first_name','$last_name', '$email', '$username', '$encrypt_pass', '$address', '$city', '$country', '$postal_code', '$about', '$company', '$image', current_timestamp() )"; 

	    $res = mysqli_query($conn, $sql);  
	    if($res){
	        echo "<script>alert('You have successfully registered');</script>";
	    }else{
	        echo "<script>alert('Failed to Register');</script>";
	    }
	    if (move_uploaded_file($image_temp, $folder))  {
	        $msg = "Image uploaded successfully";
	    }else{
	        $msg = "Failed to upload image";
	    }

    }else{

    	echo "<script>alert('Confirm Password doesn't matched !!);</script>";
    }    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V6</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="assets/images/icons/favicon.ico" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">		
				
				<form class="login100-form validate-form" method="POST" enctype="multipart/form-data">
					<span class="login100-form-title p-b-70">Welcome</span>
					<span class="login100-form-avatar">
						<img src="assets/images/avatar-01.jpg" alt="AVATAR">
					</span>

					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter First Name">
						<input class="input100" type="text" name="first_name">
						<span class="focus-input100" data-placeholder="FirstName"></span>
					</div>
					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter Last Name">
						<input class="input100" type="text" name="last_name">
						<span class="focus-input100" data-placeholder="LastName"></span>
					</div>
					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter Email">
						<input class="input100" type="email" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>
					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter Username">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter confirm password">
						<input class="input100" type="password" name="confirm_pass">
						<span class="focus-input100" data-placeholder="ConfirmPassword"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter address">
						<textarea class="input100" name="address" placeholder="Enter Address"></textarea> 
						<!-- <span class="focus-input100" data-placeholder="ConfirmPassword"></span> -->
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter city">
						<input class="input100" type="text" name="city">
						<span class="focus-input100" data-placeholder="City"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter country">
						<input class="input100" type="text" name="country">
						<span class="focus-input100" data-placeholder="Country"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter confirm password">
						<input class="input100" type="text" name="postal_code">
						<span class="focus-input100" data-placeholder="Postal Code"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter about">
						<input class="input100" type="text" name="about">
						<span class="focus-input100" data-placeholder="About You"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter company">
						<input class="input100" type="text" name="company">
						<span class="focus-input100" data-placeholder="Company"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter image">
						<input class="input100" type="file" name="img" id="img">
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" name="register">Register</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="assets/js/main.js"></script>

</body>
</html>