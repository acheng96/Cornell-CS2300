<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<script src = "../script/valid.js"></script>
		<title>Login Page</title>
	</head>

	<body>

		<!-- Header -->
		<?php include("header.php"); ?>

		<!-- Body -->
		<?php 
			// Initialize database connection
			require_once 'config.php';
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

			// Sanitize input
			$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING); 
			$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
			$valid_password = password_verify($password, password_hash('password', PASSWORD_DEFAULT));

			// Get user from database
			$query = "SELECT * FROM users WHERE username = '$username';";
			$result = $mysqli->query($query);

			if ($result && $result->num_rows == 1) { // User found
				$row= $result->fetch_assoc();
				$db_hash_password = $row['hashpassword'];
			}

			if (!isset($_POST['username']) && !isset($_POST['password'])) {
				print "<!-- Login Form Container -->
				<h2 id='login-description'>LOG IN AS AN ADMIN</h2>
				<h3 id='login-form-subtitle' class='general-subtitle'></h3>
				<div class='login-form-container'>
					<form class='login-form' name='loginForm' action='login.php' onsubmit='return validLoginForm();' method='POST'>
					    <input id='username-field' type='text' placeholder='USERNAME' name='username' maxlength='50' required title='Letters, spaces, dashes, and underscores only.''><br>
					    <input id='password-credit-field' type='password' placeholder='PASSWORD' name='password' maxlength='50' required title='Letters, spaces, dashes, and underscores only.'><br>
					    <input type='submit' name='login' value='login'>
					</form>
				</div>";
			} elseif ($_POST['username'] == "acheng" && password_verify($password, $db_hash_password)) {
				print "<p>You have accessed the secret content of this page.</p>";
				$_SESSION['logged_user'] = $_POST['username'];
			} else {
				print "<p class='page-description'>You did not login successfully.</p>
				<p class='page-description'>Please <a href='login.php'>try again</a>.</p>";
			}
		?>

	</body>

</html>