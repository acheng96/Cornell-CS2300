<?php session_start(); ?>
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
			if (isset($_POST['logout']) && isset($_SESSION['logged_user'])) {
				$olduser = $_SESSION['logged_user'];
				unset($_SESSION['logged_user']);
				print("<p class='page-description'>You are logged out, $olduser!</p>");
				print("<p class='page-description'>Return to the <a href='login.php'>login form.</a></p>");
			} else {
				// Sanitize input
				$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING); 
				$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

				if (!isset($_SESSION['logged_user']) && (empty($username) || empty($password))) { // No user logged in, so display login form
					print "<h2 class='general-description'>LOG IN AS AN ADMIN</h2>
					<h3 id='login-form-subtitle' class='general-subtitle'></h3>
					<div class='login-form-container'>
						<form class='login-form' name='loginForm' action='login.php' onsubmit='return validLoginForm();' method='POST'>
						    <input id='username-field' type='text' placeholder='USERNAME' name='username' maxlength='50' required title='Letters, numbers, spaces, dashes, and underscores only.'><br>
						    <input id='password-credit-field' type='password' placeholder='PASSWORD' name='password' maxlength='50' required title='Letters, numbers, spaces, dashes, and underscores only.'><br>
						    <input type='submit' name='login' value='login'>
						</form>
					</div>";
				} else { // Check for logged in user
					// Initialize database connection
					require_once 'config.php';
					$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

					// Check database connection
					if($mysqli->connect_errno) {
						die( "Couldn't connect to database");
					}

					// Get user from database
					$query = "SELECT * FROM Users WHERE Users.username LIKE '$username'";
					$result = $mysqli->query($query);

					// Check for exactly one user with username = $username
					if ($result && $result->num_rows == 1) {
						$row= $result->fetch_assoc();
						$db_hash_password = $row['hashpassword'];

						// Verify inputted password matches with database hashed password
						if (password_verify($password, $db_hash_password)) {
							$_SESSION['logged_user'] = $row['username'];
						}
					}

					$mysqli->close();

					if (isset($_SESSION['logged_user'])) { // If a user is logged in
						$logged_user = $_SESSION['logged_user']; 
						print "<p class='page-description'>You are logged in as $logged_user!</p>";
						print "<p class='page-description'>You may now edit your photos and albums.</p>";
						print 
						"<form class='logout-form' name='logoutForm' action='login.php' method='POST'>
						    <input type='submit' name='logout' value='logout'>
						</form>";
					} else { // If no user is logged in
						print "<p class='page-description'>Incorrect username or password.</p>";
						print "<p class='page-description'>Please <a href='login.php'>try again</a>.</p>";
					}
				} 
			}

		?>

	</body>

</html>