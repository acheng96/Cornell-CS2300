<!doctype html>

<html>

	<head>
		<meta charset="utf-8">
	    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Projects Page</title>
	</head>

	<body>

		<!-- Define Projects Info -->
		<?php 
			$project_ids = array("icefishing", "eatery", "fire-emblem", "haven", "spaceship-vr", "hungry-brown");
			$project_titles = array("ICEFISHING", "EATERY", "FIRE EMBLEM", "HAVEN", "SPACESHIP VR", "HUNGRY@BROWN");
			$project_description = array("Music Discovery &amp; Sharing", "Cornell University Dining", "OCaml Final Project", "Anonymous Social", "3D Interactive Virtual", "Brown University Dining");
			$project_type = array("iOS App", "iOS App", "Strategy Game", "Communication Web App", "Reality Game", "iOS App");
			$project_github = array("https://github.com/cuappdev/icefishing", "https://github.com/cuappdev/eatery", "https://github.com/Houka/OCaml_Fire_Emblem", "https://github.com/ghostling/haven", "https://github.com/acheng96/SpaceshipVR", "https://github.com/ss50/hungryatbrown-web");
		?>

		<!-- Header -->
		<?php include("header.php"); ?>

		<!-- Body -->
		<div id="projects-body-container">
			<!-- Title -->
			<div id="title">
				<p>A BIT ABOUT MYSELF</p>
				<div id="title-underline"></div>
			</div>

			<!-- Categories -->
			<div class="projects-categories-container">
				<?php for ($i = 0; $i < count($project_ids); $i++) { ?>
						<div id=<?php echo $project_ids[$i]; ?> class="projects-category">
							<div class="overlay">
								<div class="project-details-container">
									<h2><?php echo $project_titles[$i]; ?></h2>
								    <div class="project-category-divider"></div>
								    <h4><?php echo $project_description[$i]; ?><br><?php echo $project_type[$i]; ?></h4>
								    <a href=<?php echo $project_github[$i]; ?> target="_blank"><div class="github-button">GITHUB</div></a>
								</div>
							</div>
					    </div>
    			<?php } ?>
			</div>
		</div>

		<!-- Image Credits -->
		<div class="image-credits">
			<h1>IMAGE CREDITS</h1>
			<div id="title-underline"></div>
			<ul>
				<li><b>Icefishing:</b> The Icefishing image was created by Cornell University's CUAppDev Core Design Team.</li>
				<li><b>Eatery:</b> The Eatery image was created by Cornell University's CUAppDev Core Design Team.</li>
				<li><b>Fire Emblem:</b> The Fire Emblem image was taken from the <a href="http://fireemblem.wikia.com/wiki/Fire_Emblem:_The_Sacred_Stones" target="_blank">Fire Emblem Wikia Page.</a></li>
				<li><b>Haven:</b> The Haven image was created by me.</li>
				<li><b>SpaceshipVR:</b> The SpaceshipVR image was taken by fellow Cornellian, Henry Chen.</li>
				<li><b>Hungry@Brown:</b> The Hungry@Brown image was created by my former hackathon teammates, Ria Mirchandani and Shreya Srinivas.</li>
			</ul>
		</div>


		<!-- Footer -->
		<?php include("footer.php"); ?>

	</body>

</html>