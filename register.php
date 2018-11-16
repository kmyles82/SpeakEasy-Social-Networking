<?php

require'config/config.php';
require'includes/form_handlers/register_handler.php';
require'includes/form_handlers/login_handler.php';



//$query = mysqli_query($con, "INSERT INTO test VALUES('','kerry')");

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
	<link rel="stylesheet" href="assets/css/register_style.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<?php
	if(isset($_POST['register_button'])){
		echo '
		<script>

			$(document).ready(function(){

				$("#first").hide();
				$("#second").show();
			});

		</script>
		';
	}
?>
 
 <div class="wrapper">
	 
	<div class="login_box">

	<div class="login_header">
		 <h1>SpeakEasy</h1>
		 Login or Sign Up below
	 </div>
	<div id="first">
			<form action="register.php" method="post">
				<div class="input-field col s12">
				<input type="email" name="log_email" id="log_email" value="<?php
					if(isset($_SESSION['log_email'])){
						echo $_SESSION['log_email'];
					}	   
				?>" required>
				<label for="log_email">Email Address</label>
				</div>
				
				<div class="input-field col s12">
				<input type="password" name="log_password" id="log_password">
				<label for="log_password">Password</label>
			<?php
				if(in_array("Email or password was incorrect.<br>", $error_array)){
					echo "Email or password was incorrect.<br>";
				}
			?>
				</div>
				
				<br>
				<input type="submit" class="btn waves-effect waves-light" name="login_button" value="Login">
				<br>
				<a href="#" id="signup" class="signup ">Need an account? Register Here</a>

			</form>
		</div>

	<div id="second">
			<form action="register.php" method="post">
				<div class="input-field col s12">
				<input type="text"  name="reg_fname" id="reg_fname" value="<?php
				if(isset($_SESSION['reg_fname'])){
					echo $_SESSION['reg_fname'];
				}	   
			?>" required>
			<label for="reg_fname">First Name</label>
			<?php 
				if(in_array("Your first name must between 2 and 25 characters</br>", $error_array)){ 
					echo "Your first name must between 2 and 25 characters</br>";} 
			?>
				</div>
			
					<div class="input-field col s12">
					<input type="text" name="reg_lname" id="reg_lname" value="<?php
				if(isset($_SESSION['reg_lname'])){
					echo $_SESSION['reg_lname'];
				}	   
			?>" required>
			<label for="reg_lname">Last Name</label>
			<?php 
				if(in_array("Your last name must between 2 and 25 characters</br>", $error_array)){ 
					echo "Your last name must between 2 and 25 characters</br>";} 
			?>

					</div>
			
					<div class="input-field col s12">
					<input type="email" name="reg_email" id="reg_email" value="<?php
				if(isset($_SESSION['reg_email'])){
					echo $_SESSION['reg_email'];
				}	   
			?>" required>
				<label for="reg_email">Email Address</label>
					</div>
			
				<div class="input-field col s12">
				<input type="email"  name="reg_email2" id="reg_email2" value="<?php
				if(isset($_SESSION['reg_email2'])){
					echo $_SESSION['reg_email2'];
				}	   
			?>" required>
			<label for="reg_email2">Confirm Email</label>
			<?php 
				if(in_array("Email already in use<br>", $error_array)){ 
					echo "Email already in use<br>";
				} else if(in_array("Invalid format</br>", $error_array)){ 
					echo "Invalid format</br>";
				} else if(in_array("Emails don't match</br>", $error_array)){ 
					echo "Emails don't match</br>";
				} 
			?>
				</div>
			
				<div class="input-field col s12">
				<input type="password" id="reg_password" name="reg_password"  required>
				<label for="reg_password">Password</label>
				</div>
			
			<div class="input-field col s12">
			<input type="password" id="reg_password2" name="reg_password2"  required>
			<label for="reg_password2">Confirm Password</label>
			<?php 
				if(in_array("Your passwords do not match</br>", $error_array)){ 
					echo "Your passwords do not match</br>";
				} else if(in_array("Your password can only contain english characters or numbers</br>", $error_array)){ 
					echo "Your password can only contain english characters or numbers</br>";
				} else if(in_array("Your password must be between 5 and 30 characters</br>", $error_array)){ 
					echo "Your password must be between 5 and 30 characters</br>";
				} 
			?>

			</div>
			
			<input type="submit" class="btn waves-effect waves-light" name="register_button" value="Register">
			<br>

			<?php
				if(in_array("<span style='color: #14C800;'>You're all set, go ahead and login!</span></br>", $error_array)){ 
					echo "<span style='color: #14C800;'>You're all set, go ahead and login!</span></br>";
				} 
			?>
			<a href="#" id="signin" class="signin ">Already have an account? Sign in here</a>

		</form>
	</div>
	</div>
 </div>
  


	
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   <script src="assets/js/register.js" ></script>

   <script>
	   
		
	</script>

</body>
</html>
