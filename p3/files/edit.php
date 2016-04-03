<?php session_start(); ?>

<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Edit Page</title>
	</head>

	<body>

		<!-- Header -->
		<?php include("header.php"); ?>

		<!-- Body -->

		<?php
			if (isset($_SESSION['logged_user'])) { // If a user is logged in
				$logged_user = $_SESSION['logged_user']; 
				print "<p class='page-description'>Welcome, $logged_user !</p>";
			} else { // If no user is logged in
				print "<p class='page-description'>Please <a href='login.php'>login</a> to edit images.</p>";
			} 
		?>

	</body>

</html>