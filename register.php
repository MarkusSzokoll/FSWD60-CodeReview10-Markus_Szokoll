<?php 

  require_once 'db_connection.php';

  $emailError="";
  $userFirstName = "";
  $userLastName = "";
  $userEmail = "";

  if(isset($_POST["register"])){
  	$userFirstName = trim($_POST['userFirstName']);
    $userLastName = trim($_POST['userLastName']);
  	$userEmail = trim($_POST["userEmail"]);
  	$userPassword = trim($_POST["userPassword"]);
  	$error = false;
  	$userPass = hash('sha256', $userPassword);

  	$query = "SELECT userEmail FROM `users` WHERE userEmail='$userEmail'";
  	$result = mysqli_query($mysqli, $query);
  	$count = mysqli_num_rows($result);

  	if($count!=0){
  	  $error = true;
  	  $emailError = "Provided Email is already in use.";
  	}

  	if(!$error){
  	$sql = "INSERT INTO `users` (userFirstName, userLastName, userEmail, userPassword) VALUES ('$userFirstName', '$userLastName', '$userEmail', '$userPass')";
  	header("Location: a_register.php");

  	if($mysqli->query($sql) === FALSE){
  		echo "Error signing up". $mysqli->connect_error;
  		}
  	}
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
	<title>Register</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    .register{
      display: flex;
      flex-direction: column;
      width: 35%;
      margin: auto;
    }
    .field{
      height: 50px;
      margin: 15px 0;
      outline: none;
      border: none;
      border-bottom: 1px solid black;
    }
    .btn-success{
      height: 50px;
      width: 100%;
    }
    .container > h1{
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <p>The big library</p>
    <span class="navbar-login">
      <a href="login.php" title="Zum Login">
      <?php
        if (isset($_SESSION['user'])) {
          $displayName = $userRow['userFirstName']. " ". $userRow['userLastName'];
          echo '<i class="fas fa-sign-out-alt"></i> '.$displayName;
        }
        else {
          echo '<i class="fas fa-sign-in-alt"></i> Login';
        }
      ?>
      </a>
    </span>
  </div>
  <div class="container">
    <div class="heading">
      <h1>Please insert your data</h1>
    </div>
    <a class="mainpageback" href="index.php"><i class="fas fa-arrow-left"></i>Back to main page</a>
    <hr>
	<form class="register" action="register.php" method="post" accept-charset="utf-8">
		<input class="field" type="text" name="userFirstName" maxlength="55" placeholder="Enter First Name" value="<?= $userFirstName ?>" required>
		<input class="field" type="text" name="userLastName" maxlength="55" placeholder="Enter last Name" value="<?= $userLastName ?>" required>
		<input class="field" type="text" name="userEmail" maxlength="100" placeholder="Enter Email" value="<?= $userEmail ?>" required>
		<span><?php echo $emailError; ?></span>
		<input class="field" type="password" name="userPassword" maxlength="25" placeholder="Enter Password" required>
		<a href="a_register.php"><input class="btn btn-success" type="submit" name="register" value="Sign Up"></a>
	</form>
</div>
  <div class="footer">
    <p>Markus Szokoll 2019</p>
  </div>
</body>
</html>