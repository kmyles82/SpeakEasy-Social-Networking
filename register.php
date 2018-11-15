<?php
session_start();
$con = mysqli_connect('localhost','speakeasy','','speakeasy');

if(mysqli_connect_errno()){
	echo "Failed to connect: ".mysqli_connect_errno();
}

//$query = mysqli_query($con, "INSERT INTO test VALUES('','kerry')");

//declaring variables to prevent errors
$fname = ""; //first name
$lname = ""; //last name
$email = ""; //email
$email2 = ""; //confirm email
$password = ""; //password
$password2 = ""; //confirm password
$date = ""; //sign up date
$error_array = ""; //hold error messages

if(isset($_POST['register_button'])){

  //registration form values

  //first name
  $fname = strip_tags($_POST['reg_fname']); //remove html tags
  $fname = str_replace(' ','',$fname); //remove spaces
  $fname = ucfirst(strtolower($fname)); //captilize first letter the rest lowercase
  $_SESSION['reg_fname'] = $fname; //stores first name into session variable

  //last name
  $lname = strip_tags($_POST['reg_lname']); //remove html tags
  $lname = str_replace(' ','',$lname); //remove spaces
  $lname = ucfirst(strtolower($lname)); //captilize first letter the rest lowercase
  $_SESSION['reg_lname'] = $lname; //stores last name into session variable

  //email
  $email = strip_tags($_POST['reg_email']); //remove html tags
  $email = str_replace(' ','',$email); //remove spaces
  $email = ucfirst(strtolower($email)); //captilize first letter the rest lowercase
  $_SESSION['reg_email'] = $email; //stores email into session variable

  //confirm email
  $email2 = strip_tags($_POST['reg_email2']); //remove html tags
  $email2 = str_replace(' ','',$email2); //remove spaces
  $email2 = ucfirst(strtolower($email2)); //captilize first letter the rest lowercase
	$_SESSION['reg_email2'] = $email2; //stores email2 into session variable

  //password
  $password = strip_tags($_POST['reg_password']); //remove html tags
  $password2 = strip_tags($_POST['reg_password2']); //remove html tags
  

  //date
  $date = date("Y-m-d");
	
	if($email == $email2){
		//check if email is in valid format
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);
			
			//check if email already exist
			$email_check = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");
			
			//count number of rows return
			$num_rows = mysqli_num_rows($email_check);
			
			if($num_rows > 0){
				echo "Email already in use";
			} 
			
		} else {
			echo "Invalid format";
		}
		
	} else {
		echo "Emails don't match";
	}
	
	if(strlen($fname) > 25 || strlen($fname) < 2){
		echo "Your first name must between 2 and 25 characters";
	}
	
	if(strlen($lname) > 25 || strlen($lname) < 2){
		echo "Your last name must between 2 and 25 characters";
	}
	
	if(password != password2){
		echo "Your passwords do not match";
	} else {
		if(preg_match('/[^A-Za-z0-9]/', $password)){
			#
			echo "Your password can only contain english characters or numbers";
		}
	}
	
	if(strlen($password > 30 || strlen($password) < 5)){
		echo "Your password must be between 5 and 30 characters";
	}
	
	
	
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
   
<form action="register.php" method="post">

	<input type="text" class="input-field" name="reg_fname" placeholder="First Name" value="<?php
		if(isset($_SESSION['reg_fname'])){
			echo $_SESSION['reg_fname'];
		}	   
	?>" required>
	<input type="text" class="input-field" name="reg_lname" placeholder="Last Name" value="<?php
		if(isset($_SESSION['reg_lname'])){
			echo $_SESSION['reg_lname'];
		}	   
	?>" required>
	<input type="email" class="input-field" name="reg_email" placeholder="Email" value="<?php
		if(isset($_SESSION['reg_email'])){
			echo $_SESSION['reg_email'];
		}	   
	?>" required>
	<input type="email" class="input-field" name="reg_email2" placeholder="Confirm Email" value="<?php
		if(isset($_SESSION['reg_email2'])){
			echo $_SESSION['reg_email2'];
		}	   
	?>" required>
	<input type="password" class="input-field" name="reg_password" placeholder="password" value="<?php
		if(isset($_SESSION['reg_password'])){
			echo $_SESSION['reg_password'];
		}	   
	?>" required>
	<input type="password" class="input-field" name="reg_password2" placeholder="Confirm Password" value="<?php
		if(isset($_SESSION['reg_password2'])){
			echo $_SESSION['reg_password2'];
		}	   
	?>" required>
	<input type="submit" name="register_button" value="Register">

</form>
	
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   <script src="script.js" ></script>
</body>
</html>
