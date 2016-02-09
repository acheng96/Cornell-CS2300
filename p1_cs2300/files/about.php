<!doctype html>

<html>

	<head>
		<meta charset="utf-8">
	    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>About Page</title>
	</head>

	<body>

		<!-- Define About Info -->
		<?php 
			// CREDITS: I created the student, developer, and designer icons.
			$about_ids = array("student-icon", "developer-icon", "designer-icon");
			$about_images = array("student_icon.png", "developer_icon.png", "designer_icon.png");
			$about_titles = array("STUDENT", "DEVELOPER", "DESIGNER");
			$about_descriptions = array(
				"At Cornell, I am a CUAppDev Project Team developer, an Interaction Design Lab researcher, an ACSU Academic Officer, a Python consultant, and a WICC member. I am also involved in intramural basketball and volleyball, CFA, and CSA.", 
				"I am an iOS mobile developer with 1.5+ years of experience coding in Swift and using Xcode. Currently, I’ve worked on over 10 iOS apps related to social media, music, education etc. Many of these projects can be found on my Github account.", 
				"With a keen interest for human-computer interaction and UI/UX design, I strongly believe that design and code go hand in hand. Design tools I have worked with include Sketch, Photoshop, and many wireframing/prototyping softwares."
			);
		?>

		<!-- Header -->
		<?php include("header.php"); ?>

		<!-- Body -->
		<div id="about-body-container">
			<!-- Title -->
			<div id="title">
				<p>A BIT ABOUT MYSELF</p>
				<div id="title-underline"></div>
			</div>

			<!-- Categories -->
			<div class="about-categories-container">
				<!-- Set up each about category -->
				<?php for ($i = 0; $i < count($about_ids); $i++) { ?>
						<div class="about-category">
							<img id=<?php echo $about_ids[$i]; ?> src=<?php echo "../images/{$about_images[$i]}"; ?> alt="About Icon">
							<h2><?php echo $about_titles[$i]; ?></h2>
							<p><?php echo $about_descriptions[$i]; ?></p>
						</div>
    			<?php } ?>
			</div>
		</div>

		<!-- Footer -->
		<?php include("footer.php"); ?>

	</body>

</html>