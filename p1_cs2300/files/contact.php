<!doctype html>

<html>
	<head>
		<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Contact Page</title>
	</head>
	<body>

		<!-- Header -->
		<?php include("header.php"); ?>

		<!-- Body -->
		<div id="contact-body-container">
			<div>
				<img id="potato" src="../images/potato.png" alt="Potato">
				<p id="fun-fact">Fun Fact: I like potatoes</p>
			</div>

			<!-- Contact Form -->
			<div class="contact-form">
				<div></div>
				<div id="about-hdivider"></div>
				<form action="">
				  <input type="text" name="Name"><br>
				  <input type="text" name="Email"><br>
				  <input type="text" name="Subject"><br>
				  <input type="text" name="Message"><br>
				  <input type="submit" value="Submit">
				</form>
			</div>
		</div>

		<!-- Footer -->
		<?php include("footer.php"); ?>

	</body>
</html>