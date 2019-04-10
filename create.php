<?php

	ob_start();
	session_start();

	require_once 'db_connection.php';

	if (isset($_SESSION['user'])){
	$res=mysqli_query($mysqli, "SELECT * FROM `users` WHERE user_id=". $_SESSION['user']. "");
	$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
	}	

	if(isset($_POST['create'])){
		$title = $_POST['title'];
		$img_link = $_POST['img_link'];
		$fk_media_type = $_POST['fk_media_type'];
		$fk_publisher_id = $_POST['fk_publisher_id'];
		$fk_author_id = $_POST['fk_author_id'];
		$isbn = $_POST['isbn'];
		$short_description = $_POST['short_description'];
		$status = $_POST['status'];

		$sql = "INSERT INTO `medias`(`title`, `img_link`, `isbn`, `short_description`, `status`, `fk_media_type`, `fk_author_id`, `fk_publisher_id`) VALUES ('$title', '$img_link', '$isbn', '$short_description', $status, '$fk_media_type', '$fk_author_id', '$fk_publisher_id');";

		if($mysqli->query($sql) === TRUE) {
		   header("Location: a_create.php");
		} else {
		    echo "Error while updating record : ". $mysqli->error;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create new Entry</title>
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
			<h1>Create a new record</h1>
		</div>
		<a class="mainpageback" href="index.php"><i class="fas fa-arrow-left"></i>Back to main page</a>
		<hr>
		<form class="updatemedia" method="POST" accept-charset="utf-8">
			<p>Title</p>
			<input class="field" type="text" name="title" maxlength="150" required>
			<p>Media Image (url)</p>
			<input class="field" type="text" name="img_link" maxlength="500" required>
			<p>Type</p>
			<select class="field" name="fk_media_type">
				<?php
				$sql = mysqli_query($mysqli, "SELECT * FROM `media_type`");

				while($rowType = mysqli_fetch_assoc($sql)){
					echo "<option id=". $rowType["id"]. ">". $rowType["id"]. ")  ". $rowType["name"]. "</option>";
				}
				?>
			</select>
			<p>Publisher</p>
			<select class="field" name="fk_publisher_id">
				<?php
				$sql = mysqli_query($mysqli, "SELECT * FROM `publisher`");

				while($rowType = mysqli_fetch_assoc($sql)){
					echo "<option id=". $rowType["id"]. ">". $rowType["id"]. ")  ". $rowType["name"]. "</option>";
				}
				?>
			</select>
			<p>Author</p>
			<select class="field" name="fk_author_id">
				<?php 
				$sql = mysqli_query($mysqli, "SELECT * FROM `author`");
				while($rowAuthor = mysqli_fetch_assoc($sql)){
					echo "<option id=". $rowAuthor["id"]. ">". $rowAuthor["id"]. ")  ". $rowAuthor["name"]. "</option>";
				}
				?>
			</select>
			<p>ISBN</p>
			<input class="field" type="text" name="isbn" maxlength="25" required>
			<p>Short Description</p>
			<textarea name="short_description" maxlength="250" required></textarea>
			<p>Status</p>
			<select class="field" name="status">
				<option value="reserved"> reserved</option>
				<option value="available"> available</option>
			</select>
			
			<input class="btn btn-success" type="submit" name="create" value="CREATE">
		</form>
	</div>
	 <div class="footer">
		<p>Markus Szokoll 2019</p>
	</div>
</body>
</html>