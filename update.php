<?php 

	ob_start();
	session_start();

	require_once 'db_connection.php';

	if (isset($_SESSION['user'])){
	$res=mysqli_query($mysqli, "SELECT * FROM `users` WHERE user_id=". $_SESSION['user']. "");
	$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
	}	

	if($_GET['id']) {
		$id = $_GET['id'];

		$sql = "SELECT * FROM `medias` WHERE id = {$id}";
		$result = $mysqli->query($sql);

		$row = $result->fetch_array();

	}

	if(isset($_POST['update'])) {
		$title = trim($_POST['title']);
		$short_description = trim($_POST['short_description']);
		$author = trim($_POST['author']);
		$publisher = $_POST['publisher'];

		$sql = "UPDATE `medias` SET title = '$title', short_description = '$short_description', fk_author_id = '$author', fk_publisher_id = '$publisher' WHERE id = {$id}";
		if($mysqli->query($sql) === TRUE) {
			header("Location: a_update.php");
		} else {
			echo "Error while updating record: ". $mysqli->error;
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>	
	</style>
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
			<h1>Edit "<?php echo $row["title"] ?>"</h1>
		</div>
		<a class="mainpageback" href="index.php"><i class="fas fa-arrow-left"></i>Back to main page</a>
		<hr>
		<form class="updatemedia" method="POST" accept-charset="utf-8">
			<p>Title</p>
			<input class="field" type="text" name="title" value=" <?php echo $row["title"] ?> ">
			<p>Author</p>
			<select class="field" name="author">
				<?php 

				$sql = mysqli_query($mysqli, "SELECT * FROM `author`");

				while($rowAuthor = mysqli_fetch_assoc($sql)){
					echo "<option id=". $rowAuthor["id"]. ">". $rowAuthor["id"]. ")  ". $rowAuthor["name"]. " ". $rowAuthor["surname"]. "</option>";
				}
				?>
			</select>
			<p>Short Description</p>
			<textarea name="short_description"> <?php echo $row["short_description"] ?></textarea>
			<p>Publisher</p>
			<select class="field" name="publisher">
				<?php

				$sql = mysqli_query($mysqli, "SELECT * FROM `publisher`");

				while($rowPublisher = mysqli_fetch_assoc($sql)){
					echo "<option id=". $rowPublisher["id"]. ">". $rowPublisher["id"]. ")  ". $rowPublisher["name"]. "</option>";
				}

				?>

			</select>
			<p></p>
			<?php echo "<a href='mediainfo.php?id=". $row['id']. "'><button class='btn btn-primary delete' type='button'>No go back</button></a>" ?>
			<input class="btn btn-success" type="submit" name="update" value="UPDATE">
		</form>
	 	</div>
 	<div class="footer">
 		<p>Markus Szokoll 2019</p>
 	</div>
</body>
</html>