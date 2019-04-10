<?php

	ob_start();
	session_start();

	require_once 'db_connection.php';

	if (isset($_SESSION['user'])){
	$res=mysqli_query($mysqli, "SELECT * FROM `users` WHERE user_id=". $_SESSION['user']. "");
	$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
	}

	$emailError = "";
	$passwordError = "";
	$errMSG = "";
	$error = false;

	if( isset($_POST['login'])){
		$userEmail = trim($_POST["userEmail"]);
		$userEmail = strip_tags($userEmail);
		$userEmail = htmlspecialchars($userEmail);

		$password = trim($_POST["password"]);	
		$password = strip_tags($password);
		$password = htmlspecialchars($password);

		if(empty($userEmail)){
			$error = true;
			$emailError = "This field is required";
		}

		if(empty($password)){
		 $error = true;
		 $passwordError = "Please enter your password.";
		}

		if (!$error) {
		 
			$pass = hash('sha256', $password);

			$res=mysqli_query($mysqli, "SELECT user_id, userFirstName, userLastName, userPassword FROM `users` WHERE userEmail='$userEmail'");

			$row=mysqli_fetch_array($res, MYSQLI_ASSOC);
			$count = mysqli_num_rows($res);
		 
			if($count == 1 && $row['userPassword']==$pass) {
				$_SESSION['user'] = $row['user_id'];
				header("Location: index.php");
				} else {
					$errMSG = "Incorrect email or password";
		 		}
			}
	}

	if (isset($_POST['logout'])) {
		unset($_SESSION['user']);
		session_unset();
	 	session_destroy();
		header("Location: index.php");
		exit;
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<style>
			.login{
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
				<h1>Login</h1>
			</div>
			<a class="mainpageback" href="index.php"><i class="fas fa-arrow-left"></i>Back to main page</a>
			<hr>
			<?php 
				if (isset($_SESSION['user'])) {
					echo '
					<form class="centerpls" method="post">
						<input class="btn btn-danger" type="submit" name="logout" value="Sign out">
					</form>';
				} else{
					echo '
					<form class="login" method="POST" accept-charset="utf-8">
						<span><?php echo $errMSG ?></span>
						<input class="field" type="text" name="userEmail" placeholder="Email">
						<span><?php echo $emailError ?></span>
						<input class="field" type="password" name="password" placeholder="Password">
						<span><?php echo $passwordError ?></span>
						<input class="btn btn-success" type="submit" name="login" value="LOGIN">
						<p>No account yet? <a href="register.php" title="register">Sign up here!</a></p>
					</form>';
			}
			?>
		</div>
		<div class="footer">
			<p>Markus Szokoll 2019</p>
		</div>
	</body>
</html>
<?php ob_end_flush(); ?>