<?php

	ob_start();
		session_start();

		require_once 'db_connection.php';

		if (isset($_SESSION['user'])){
		$res=mysqli_query($mysqli, "SELECT * FROM `users` WHERE user_id=". $_SESSION['user']. "");
		$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
		}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Publishers</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="navbar">
		<p>Markus' library</p>
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
			<h1>List publishers</h1>
		</div>
		<a class="mainpageback" href="index.php"><i class="fas fa-arrow-left"></i>Back to main page</a>
		<hr>
		<?php

		echo '<form method="get">';
		echo '<select name="id">';
			
		$sql = mysqli_query($mysqli, "SELECT * FROM `publisher`");

		while($rowPublisher = mysqli_fetch_assoc($sql)){
			echo "<option value=". $rowPublisher["id"]. ">". $rowPublisher["id"]. ")  ". $rowPublisher["name"]. "</option>";
		}
			
		echo '</select>';

		echo '<input class="btn btn-success" type="submit" name="btnPublisher" value="Show media">';
		echo '</form>';

		if(isset($_GET['id'])) {
			$sql = mysqli_query($mysqli, "SELECT * FROM `medias` WHERE fk_publisher_id = ".$_GET['id']);
			echo '<ul>';
			while($rowMedia = mysqli_fetch_assoc($sql)){
				echo "<li>".$rowMedia['title']."</li>";
			}
			echo '</ul>';
		}
	
		?>
	</div>
	<div class="footer">
		<p>Markus Szokoll 2019</p>
	</div>
</body>
</html>