<?php 
	// PHP Function to set active page
	function getClass($page) {
		return (basename($_SERVER['PHP_SELF']) == $page) ? 'active-page' : 'inactive-page';
	}

	// Header
	print "<div class='header'>
		<div class='header-container'>
			<!-- CREDITS: I created this personal logo. -->
			<a href='../index.php'><img id='logo' src='../images/personal_logo.png' alt='Logo'></a>

			<!-- Navigation Bar -->
			<div id='navbar-container'>
				<ul class='navbar-items'>
					<li class=".getClass('../index.php')."><a href='../index.php'><span>HOME</span></a></li>
	  				<li class=".getClass('about.php')."><a href='about.php'><span>ABOUT</span></a></li>
	  				<li class=".getClass('work.php')."><a href='work.php'><span>WORK</span></a></li>
	  				<li class=".getClass('projects.php')."><a href='projects.php'><span>PROJECTS</span></a></li>
	  				<li class=".getClass('contact.php')."><a href='contact.php'><span>CONTACT</span></a></li>
	  				<li><a href='https://www.dropbox.com/s/fbztz8d5x64g5uk/Annie_Cheng_Resume.pdf?dl=0' target='_blank'><span>RESUME</span></a></li>
				</ul>
			</div>
		</div>
	</div>";
?>







