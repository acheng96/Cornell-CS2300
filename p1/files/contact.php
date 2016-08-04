<!DOCTYPE html>

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
			// CREDITS: I created all the potato images.
		    $potato_images = array("hot_potato.png", "baked_potato.png", "french_fries.png", "hashbrown.png", "mashed_potato.png");
		    (isset($_POST["potato-select"])) ? $selected_potato = $_POST["potato-select"] : $selected_potato = 0;

		    // Get type of potato for fun fact display
		    function getPotatoType($potato) {
		    	switch($potato) {
		    	case 0:
		    	  $potato_type = "hot potatoes";
		    	  break;
		    	case 1:
		    	  $potato_type = "baked potatoes";
		    	  break;
		    	case 2:
		    	  $potato_type = "french fries";
		    	  break;
		    	case 3:
		    	  $potato_type = "hashbrowns";
		    	  break;
		    	default: 
		    	  $potato_type = "mashed potatoes";
		    	  break;
		    	}

		    	return $potato_type;
		    }

		    // Update fun fact
		    $selected_potato_type = getPotatoType($selected_potato);
		    $fun_fact = "I love {$selected_potato_type}.";
		?>

		<!-- Contact Form Setup -->
		<?php 
		  $title = "SAY HELLO";

		  // Check whether all fields have been set
			if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["subject"]) && isset($_POST["message"])) {
				$name = $_POST["name"];
				$email = $_POST["email"];
				$subject = $_POST["subject"];
				$message = $_POST["message"];
				$subtitle = "Hi {$name}, thanks for contacting me! I'll get back to you at {$email} as soon as possible.";

				// Check for invalid emails
				$valid_email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

				if ($name == "" || $email == "" || $subject == "" || $message == "") { // Check for empty field
					$subtitle = "Please fill in all fields.";
				} elseif (!preg_match("/^[a-zA-Z ]*$/",$name)) { // Check for invalid name
  				$subtitle = "Please enter a name with only letters and white space."; 
				} elseif (!preg_match($valid_email_exp,$email)) { // Check for invalid email
					$subtitle = "Please enter a valid email address.";
				} else { // Send email with form info
					mail($email, "{$subject} - {$name}", $message);
				}
			} else {
				  $subtitle = "Want to chat? Feel free to drop me a message!";
			}
		?> 

		<!-- Header -->
		<?php include("header.php"); ?>

		<!-- Body -->
		<div id="contact-body-container">
			<!-- Potato Select Form -->
			<div class="fun-fact-section">
				<!-- Fun Fact Text -->
				<h1 id="fun-fact"><?php echo "Fun Fact: {$fun_fact}"; ?></h1>
				<img id="potato" src=<?php echo "../images/{$potato_images[$selected_potato]}"; ?> alt="Potato">
				<p id="fun-fact-question">What's your favorite type of potato?</p>

				<!-- Select Form Body -->
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
				<!-- Contact Form Title -->
				<h1><?php echo $title ?></h1>
				<div id="contact-hdivider"></div>
				<h2><?php echo $subtitle ?></h2>

				<!-- Contact Form Body -->
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