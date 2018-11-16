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
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
</head>
<body>
 
 <div class="wrapper">
	 
	<div class="login_box">

	<div class="login_header">
		 <h1>SpeakEasy</h1>
		 Login or Sign Up below
	 </div>
	<div id="first">
			<form action="register.php" method="post">
		
				<input type="email" name="log_email" placeholder="Email Address" value="<?php
					if(isset($_SESSION['log_email'])){
						echo $_SESSION['log_email'];
					}	   
				?>" required>
				<br>
				<input type="password" name="log_password" placeholder="Password">
			
				<?php
					if(in_array("Email or password was incorrect.<br>", $error_array)){
						echo "Email or password was incorrect.<br>";
					}
				?>
				<br>
				<input type="submit" name="login_button" value="Login">
				<br>
				<a href="#" id="signup" class="signup">Need an account? Register Here</a>

			</form>
		</div>

	<div id="second">
			<form action="register.php" method="post">

			<input type="text" class="input-field" name="reg_fname" placeholder="First Name" value="<?php
				if(isset($_SESSION['reg_fname'])){
					echo $_SESSION['reg_fname'];
				}	   
			?>" required>
			<?php 
				if(in_array("Your first name must between 2 and 25 characters</br>", $error_array)){ 
					echo "Your first name must between 2 and 25 characters</br>";} 
			?>

			<input type="text" class="input-field" name="reg_lname" placeholder="Last Name" value="<?php
				if(isset($_SESSION['reg_lname'])){
					echo $_SESSION['reg_lname'];
				}	   
			?>" required>
			<?php 
				if(in_array("Your last name must between 2 and 25 characters</br>", $error_array)){ 
					echo "Your last name must between 2 and 25 characters</br>";} 
			?>

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
			<?php 
				if(in_array("Email already in use<br>", $error_array)){ 
					echo "Email already in use<br>";
				} else if(in_array("Invalid format</br>", $error_array)){ 
					echo "Invalid format</br>";
				} else if(in_array("Emails don't match</br>", $error_array)){ 
					echo "Emails don't match</br>";
				} 
			?>

			<input type="password" class="input-field" name="reg_password" placeholder="password" required>
			<input type="password" class="input-field" name="reg_password2" placeholder="Confirm Password" required>
			<?php 
				if(in_array("Your passwords do not match</br>", $error_array)){ 
					echo "Your passwords do not match</br>";
				} else if(in_array("Your password can only contain english characters or numbers</br>", $error_array)){ 
					echo "Your password can only contain english characters or numbers</br>";
				} else if(in_array("Your password must be between 5 and 30 characters</br>", $error_array)){ 
					echo "Your password must be between 5 and 30 characters</br>";
				} 
			?>

			<input type="submit" name="register_button" value="Register">
			<br>

			<?php
				if(in_array("<span style='color: #14C800;'>You're all set, go ahead and login!</span></br>", $error_array)){ 
					echo "<span style='color: #14C800;'>You're all set, go ahead and login!</span></br>";
				} 
			?>
			<a href="#" id="signin" class="signin">Already have an account? Sign in here</a>

		</form>
	</div>
	</div>
 </div>
  


	
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   <script src="script.js" ></script>

   <script>
	   
		$(document).ready(function(){
			//on click signup, hide login and show registration form
			$('#signup').click(function(){
				$('#first').slideUp("slow", function(){
					$('#second').slideDown("slow");
				});
			});

			//on click signin, show login and show registration form
			$('#signin').click(function(){
				$('#second').slideUp("slow", function(){
					$('#first').slideDown("slow");
				});
			});
		});
	</script>

</body>
</html>
