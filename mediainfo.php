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

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Media Info</title>
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
			<h1>Detailed Information for "<?php echo $row["title"] ?>"</h1>
		</div>
		<a class="mainpageback" href="index.php"><i class="fas fa-arrow-left"></i>Back to main page</a>
		<hr>
		<?php

			$sqlAuthor = mysqli_query($mysqli, "SELECT * FROM author, medias WHERE medias.id = {$id} AND author.id = medias.fk_author_id");
			$rowAuthor = mysqli_fetch_array($sqlAuthor);

			$sqlType = mysqli_query($mysqli, "SELECT * FROM media_type, medias WHERE media_type.id = medias.fk_media_type AND media_type.id = {$id}");
			$rowType = mysqli_fetch_array($sqlType);

			$sqlPublisher = mysqli_query($mysqli, "SELECT * FROM publisher, medias WHERE publisher.id = medias.fk_publisher_id AND publisher.id = {$id}");
			$rowPublisher = mysqli_fetch_array($sqlPublisher);

			if($row["status"] == 'available'){
				$status = "Yes";
			}
			else{
				$status = "No";
			}

			$editbuttons = "";

			if(isset($_SESSION['user'])){

			$editbuttons = "<a href='delete.php?id=". $row['id']."'><button class='btn btn-danger media' type='button'>Delete</button></a>
					<a href='update.php?id=". $row['id']."'><button class='btn btn-primary media' type='button'>Edit</button></a>";
			}

		echo "
		<div class='container'>
			<div class='row'>
				<div class='thumbnails col-md-4'>
					<div class='image'>
						<img src='". $row["img_link"]. "' alt='image'>
					</div>
					<p>ISBN: ". $row["isbn"]. "</p>
				</div>
				<div class='data col-md-7'>
					<h2>". $row["title"]. "</h2>
					<p>by: ". $rowAuthor["name"]. " ". $rowAuthor["surname"]. "</p>
					<p>type: ". $rowType["name"]. "</p>
					<p>Publisher: ". $rowPublisher["name"]. "</p>
					<p>Available: ". $status. "</p>
					<hr>
					<p>Description</p>
					<p class='desc'>". $row["short_description"]. "</p>
					". $editbuttons. "
				</div>
			</div>
		</div>";

		?>
	</div>
	<div class="footer">
		<p>Markus Szokoll 2019</p>
	</div>
</body>
</html>