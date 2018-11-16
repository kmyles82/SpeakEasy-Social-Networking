<?php
require'config/config.php';

if(isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE  username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
} else {
    header("Location: register.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>freek-a-leek</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Compiled and minified CSS -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      	<link rel="stylesheet" href="../assets/css/style.css" type="text/css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

    

    <!-- Dropdown Structure -->
    <nav>
    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo">freak-a-leek</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="<?php echo $userLoggedIn ?>"><?php echo $user['first_name']; ?></a></li>
        <li><a href="#"><i class="material-icons">home</i></a></li>
        <li><a href="#"><i class="material-icons">inbox</i></a></li>
        <li><a href="#"><i class="material-icons">notifications</i></a></li>
        <li><a href="#"><i class="material-icons">group</i></a></li>
        <li><a href="#"><i class="material-icons">settings</i></a></li>
        <li><a href="includes/handlers/logout.php"><i class="material-icons">exit_to_app</i></a></li>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
        <li><a href="#"><img src="../assets/images/profile_pics/defaults/head_deep_blue.png" alt=""><?php echo $user['first_name']; ?></a></li>
        <li><a href="#"><i class="material-icons">inbox</i>Inbox</a></li>
        <li><a href="#"><i class="material-icons">home</i>Home</a></li>
        <li><a href="#"><i class="material-icons">notifications</i>Notifications</a></li>
        <li><a href="#"><i class="material-icons">group</i>Groups</a></li>
        <li><a href="#"><i class="material-icons">settings</i>Settings</a></li>
        <li><a href="includes/handlers/logout.php"><i class="material-icons">exit_to_app</i>Logout</a></li>
  </ul>

  <div class="wrapper">

