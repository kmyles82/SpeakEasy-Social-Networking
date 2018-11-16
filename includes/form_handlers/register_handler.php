<?php

//declaring variables to prevent errors
$fname = ""; //first name
$lname = ""; //last name
$email = ""; //email
$email2 = ""; //confirm email
$password = ""; //password
$password2 = ""; //confirm password
$date = ""; //sign up date
$error_array = array(); //hold error messages

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
				array_push($error_array, "Email already in use<br>");
			} 
			
		} else {
			array_push($error_array,"Invalid email format</br>");
		}
		
	} else {
		array_push($error_array,"Emails don't match</br>");
	}
	
	if(strlen($fname) > 25 || strlen($fname) < 2){
		array_push($error_array,"Your first name must between 2 and 25 characters</br>");
	}
	
	if(strlen($lname) > 25 || strlen($lname) < 2){
		array_push($error_array,"Your last name must between 2 and 25 characters</br>");
	}
	
	if($password != $password2){
		array_push($error_array, "Your passwords do not match</br>");
	} else {
		if(preg_match('/[^A-Za-z0-9]/', $password)){
			array_push($error_array, "Your password can only contain english characters or numbers</br>");
		}
	}
	
	if(strlen($password > 30 || strlen($password) < 5)){
		array_push($error_array, "Your password must be between 5 and 30 characters</br>");
	}
	
	if(empty($error_array)){
		$password = md5($password); //Encrypt password before sending to database
		
		//Generate username by concatenating first name and last name
		$username = strtolower($fname."_".$lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		
		$i = 0;
		//if username exists add number to username
		while(mysqli_num_rows($check_username_query) != 0 ){
			$i++;//add 1 to i
			$username = $username."_".$i;
			$check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$username'");
		}
		
		//profile picture assignment
		$rand = rand(1,16);//create random between 1 and 16
		$profile_pic = "";
		switch($rand){
			case 1:
				$profile_pic = "assets/images/profile_pics/defaults/head_alizarin.png";
				break;
			case 2:
				$profile_pic = "assets/images/profile_pics/defaults/head_amethyst.png";
				break;
			case 3:
				$profile_pic = "assets/images/profile_pics/defaults/head_belize_hole.png";
				break;
			case 4:
				$profile_pic = "assets/images/profile_pics/defaults/head_carrot.png";
				break;
			case 5:
				$profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
				break;
			case 6:
				$profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
				break;
			case 7:
				$profile_pic = "assets/images/profile_pics/defaults/head_green_sea.png";
				break;
			case 8:
				$profile_pic = "assets/images/profile_pics/defaults/head_nephritis.png";
				break;
			case 9:
				$profile_pic = "assets/images/profile_pics/defaults/head_pete_river.png";
				break;
			case 10:
				$profile_pic = "assets/images/profile_pics/defaults/head_pomegranate.png";
				break;
			case 11:
				$profile_pic = "assets/images/profile_pics/defaults/head_pumpkin.png";
				break;
			case 12:
				$profile_pic = "assets/images/profile_pics/defaults/head_red.png";
				break;
			case 13:
				$profile_pic = "assets/images/profile_pics/defaults/head_sun_flower.png";
				break;
			case 14:
				$profile_pic = "assets/images/profile_pics/defaults/head_turqoise.png";
				break;
			case 15:
				$profile_pic = "assets/images/profile_pics/defaults/head_wet_asphalt.png";
				break;
			case 16:
				$profile_pic = "assets/images/profile_pics/defaults/head_wisteria.png";
				break;
			default:
				break;
		}
		
		$query = mysqli_query($con, "INSERT INTO users VALUES('','$fname','$lname','$username','$email','$password','$date','$profile_pic','0','0','no',',')");
		array_push($error_array, "<span style='color: #14C800;'>You're all set, go ahead and login!</span></br>");
		
		
		//clear session variables
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
	}
	
}


?>