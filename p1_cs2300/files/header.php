<html>
	<head>
		<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Footer</title>
	</head>

	<!-- Function to set active page -->
	<?php 
		function getClass($page) {
			return (basename($_SERVER['PHP_SELF']) == $page) ? "active-page" :"inactive-page";
		}
	;?>

	<body>
		<div class="header">
			<div class="header-container">
				<a href="../index.php"><img id="logo" src="../images/personal_logo.png" alt="Logo"></a>
				<div id="navbar-container">
					<ul class="navbar-items">
						<li class=<?php echo getClass("../index.php") ?>><a href="../index.php"><span>HOME</span></a></li>
		  				<li class=<?php echo getClass("about.php") ?>><a href="about.php"><span>ABOUT</span></a></li>
		  				<li class=<?php echo getClass("work.php") ?>><a href="work.php"><span>WORK</span></a></li>
		  				<li class=<?php echo getClass("projects.php") ?>><a href="projects.php"><span>PROJECTS</span></a></li>
		  				<li class=<?php echo getClass("contact.php") ?>><a href="contact.php"><span>CONTACT</span></a></li>
		  				<li><a href="https://www.dropbox.com/s/fbztz8d5x64g5uk/Annie_Cheng_Resume.pdf?dl=0" target="_blank"><span>RESUME</span></a></li>
					</ul>
				</div>
			</div>
		</div>
	</body>

</html>