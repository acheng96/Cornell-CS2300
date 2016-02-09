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

		    switch($selected_potato) {
		    	case 0:
		    	  $fun_fact = "I love hot potatoes.";
		    	  break;
		    	case 1:
		    	  $fun_fact = "I love baked potatoes.";
		    	  break;
		    	case 2:
		    	  $fun_fact = "I love french fries.";
		    	  break;
		    	case 3:
		    	  $fun_fact = "I love hashbrowns.";
		    	  break;
		    	default: 
		    	  $fun_fact = "I love mashed potatoes.";
		    	  break;
		    }
		?>

		<!-- Contact Form Setup -->
		<?php 
		  $title = "SAY HELLO";

		  function isValidEmail($email){ 
		    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
		  }

			if (isset($_POST["name"]) || isset($_POST["email"]) || isset($_POST["subject"]) || isset($_POST["message"])) {
				$subtitle = "Thanks for contacting me! I'll get back to you as soon as possible.";
				$name = $_POST["name"];
				$email = $_POST["email"];
				$subject = $_POST["subject"];
				$message = $_POST["message"];

				// Check for invalid user inputs
				$valid_email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

				if ($name == "" || $email == "" || $subject == "" || $message == "") {
					$subtitle = "Please fill in all fields.";
				} elseif (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  				$subtitle = "Please enter a name with only letters and white space."; 
				} elseif (!preg_match($valid_email_exp,$email)) {
					$subtitle = "Please enter a valid email address.";
				} else {
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
			<div class="fun-fact-section">
				<h1 id="fun-fact"><?php echo "Fun Fact: {$fun_fact}" ?></h1>
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
				<h2><?php echo $subtitle ?></h2>
				<form class="contact-form" action="contact.php" method="POST">
				  <input type="text" placeholder="NAME" name="name" value="<?php echo $_POST['name'];?>"><br>
				  <input type="text" placeholder="EMAIL" name="email" value="<?php echo $_POST['email'];?>"><br>
				  <input type="text" placeholder="SUBJECT" name="subject" value="<?php echo $_POST['subject'];?>"><br>
				  <textarea placeholder="MESSAGE" name="message" value="<?php echo $_POST['message'];?>"></textarea><br>
				  <input type="submit" name="submit" value="Submit">
				</form>

			</div>
		</div>

	    <!-- Footer -->
	    <?php include("footer.php"); ?>
	</body>
</html>