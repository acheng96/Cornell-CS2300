<!doctype html>

<html>
	<head>
		<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Contact Page</title>
	</head>
	<body>
		<!-- Potato Select Form Setup -->
		<?php
		    $potato_images = array("hot_potato.png", "baked_potato.png", "french_fries.png", "hashbrown.png", "mashed_potato.png");
		    (isset($_POST["potato-select"])) ? $selected_potato = $_POST["potato-select"] : $selected_potato = 0;
		?>

		<!-- Contact Form Setup -->
		<?php 
			if (isset($_POST["name"]) || isset($_POST["email"]) || isset($_POST["subject"]) || isset($_POST["message"])) {
				$title = "Form Submitted!";
				$name = $_POST["name"];
				$email = $_POST["email"];
				$subject = $_POST["subject"];
				$message = $_POST["message"];
				mail($email, "{$subject} - {$name}", $message);
				print("{$subject} - {$name} - {$email} - {$message}");
			} else {
				$title = "SAY HELLO";
			}
		?> 

		<!-- Header -->
		<?php include("header.php"); ?>

		<!-- Body -->
		<div id="contact-body-container">
			<div class="fun-fact-section">
				<h1 id="fun-fact">Fun Fact: I love potatoes.</h1>
				<img id="potato" src=<?php echo "../images/{$potato_images[$selected_potato]}"?> alt="Potato">
				<p id="fun-fact-question">What's your favorite type of potato?</p>
				<form class="potato-select-form" action="contact.php" method="POST">
					<select name="potato-select" onchange="this.form.submit();">
						<option <?php if ($selected_potato == 0) echo 'selected' ; ?> value="0">Hot</option>
						<option <?php if ($selected_potato == 1) echo 'selected' ; ?> value="1">Baked</option>
						<option <?php if ($selected_potato == 2) echo 'selected' ; ?> value="2">French Fries</option>
						<option <?php if ($selected_potato == 3) echo 'selected' ; ?> value="3">Hashbrown</option>
						<option <?php if ($selected_potato == 4) echo 'selected' ; ?> value="4">Mashed</option>
					</select>
				</form>
			</div>

			<!-- Contact Form -->
			<div class="contact-form-container">
				<h1><?php echo $title ?></h1>
				<div id="contact-hdivider"></div>
				<form class="contact-form" action="contact.php" method="POST">
				  <input type="text" placeholder="NAME" name="name"><br>
				  <input type="text" placeholder="EMAIL" name="email"><br>
				  <input type="text" placeholder="SUBJECT" name="subject"><br>
				  <textarea placeholder="MESSAGE" name="message"></textarea><br>
				  <input type="submit" name="submit" value="Submit">
				</form>

			</div>
		</div>

	    <!-- Footer -->
	    <?php include("footer.php"); ?>
	</body>
</html>