<?php 
	// PHP Function to set active page
	function getClass($page) {
		return (basename($_SERVER['PHP_SELF']) == $page) ? 'active-page' : 'inactive-page';
	}

	// Header
	print "<div class='header'>
		<div class='header-container'>
			<ul class='header-title'>
				<li><h1>WORLDWIDE WONDERS</h1></li>
				<li><h4>Image from <a class='header-image-url' href='https://s-media-cache-ak0.pinimg.com/736x/4d/07/ff/4d07ff22aba1feaeebc817d46e6b1021.jpg' target='_blank'><b>here</b></a>.</h4></li>
			</ul>

			<!-- Navigation Bar -->
			<div class='navbar-container'>
				<ul class='navbar-items'>
					<li class=".getClass('../index.php')."><a href='../index.php'><span>HOME</span></a></li>
	  				<li class=".getClass('add.php')."><a href='add.php'><span>ADD</span></a></li>
	  				<li class=".getClass('edit.php')."><a href='edit.php'><span>EDIT</span></a></li>
	  				<li class=".getClass('search.php')."><a href='search.php'><span>SEARCH</span></a></li>
	  				<li class=".getClass('login.php')."><a href='login.php'><span>LOGIN</span></a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class='divider'></div>";
?>