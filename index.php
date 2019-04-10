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
	<title>Library</title>
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
			<h1>Welcome to our library!</h1>
		</div>
		<a href="publishers.php" class="btn btn-primary create">List publishers</a>
		<div class="title">
			<?php  

				if (isset($_SESSION['user'])){
					echo '
						<a href="create.php" title="Create new entry"><button class="btn btn-primary create" type="submit" name ="create">Create new entry</button></a>
						';
				}
			?>
		</div>

		<?php 

			$sql=mysqli_query($mysqli, "SELECT *, medias.id AS id FROM `medias` INNER JOIN `author` ON fk_author_id = author.id INNER JOIN `media_type` ON fk_media_type = media_type.id");

			$count = mysqli_num_rows($sql);

			if($count > 0) {
				while($row = mysqli_fetch_array($sql)){
				echo "
					<hr>
					<div class='row'>
						<div class='thumbnails col-md-4'>
				    		<div class='image'>
				    			<img src='". $row["img_link"]. "' alt='image'>
				    		</div>
			    			<p>". $row["isbn"]. "</p>
			    		</div>
			    		<div class='data col-md-7'>
			    			<h2>". $row["title"]. "</h2>
			    			<p>by: ". $row["name"]. " ". $row["surname"]. "</p>
			    			<p>type: ". $row["name"]. "</p>
			    			<p class='desc'>". $row["short_description"]. "</p>
			    			<a href='mediainfo.php?id=". $row['id']. "'><button class='btn btn-primary media' type='button'>Show Media</button></a>
			    		</div>
			    	</div>
			    	";
				}
			} 
			else {
			    echo "No data available";
			}
		?>

	</div>
	<div class="footer">
		<p>Markus Szokoll 2019</p>
	</div>
</body>
</html>