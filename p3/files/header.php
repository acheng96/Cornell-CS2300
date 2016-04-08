<?php 

	// PHP Function to set active page
	function getClass($page) {
		return (basename($_SERVER['PHP_SELF']) == $page) ? 'active-page' : 'inactive-page';
	}

	// Header
	print "<div class='header'>
		<div class='header-container'>
			<h1 class='header-title'>WORLDWIDE WONDERS</h1>

			<!-- Navigation Bar -->
			<div class='navbar-container'>
				<ul class='navbar-items'>
					<li class=".getClass('../index.php')."><a href='../index.php'><span>HOME</span></a></li>
	  				<li class=".getClass('gallery.php')."><a href='gallery.php'><span>GALLERY</span></a></li>
	  				<li class=".getClass('add.php')."><a href='add.php'><span>ADD</span></a></li>
	  				<li class=".getClass('search.php')."><a href='search.php'><span>SEARCH</span></a></li>
	  				<li class=".getClass('login.php')."><a href='login.php'><span>LOGIN</span></a></li>
				</ul>
			</div>
		</div>
	</div>";
?>