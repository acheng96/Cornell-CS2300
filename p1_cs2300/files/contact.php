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
			<div class="fun-fact-section">
				<h1 id="fun-fact">Fun Fact: I love potatoes.</h1>
				<img id="potato" src="../images/hot_potato.png" alt="Potato">
				<p id="fun-fact-question">What's your favorite type of potato?</p>
				<select name="potatoes">
					<option value="0">Hot</option>
					<option value="1">Baked</option>
					<option value="2">French Fries</option>
					<option value="3">Hashbrown</option>
					<option value="4">Mashed</option>
				</select>
			</div>

			<!-- Contact Form -->
			<div class="contact-form-container">
				<h1>SAY HELLO</h1>
				<div id="contact-hdivider"></div>
				<form class="contact-form" action="">
				  <input type="text" name="Name" placeholder="NAME"><br>
				  <input type="text" name="Email" placeholder="EMAIL"><br>
				  <input type="text" name="Subject" placeholder="SUBJECT"><br>
				  <textarea name="Message" placeholder="MESSAGE"></textarea><br>
				  <input type="submit" value="Submit">
				</form>
			</div>
		</div>

	    <!-- Footer -->
	    <?php include("footer.php"); ?>
	</body>
</html>