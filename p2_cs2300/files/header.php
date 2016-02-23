<?php

	// PHP Function to set active page
	function getClass($page) {
		return (basename($_SERVER['PHP_SELF']) == $page) ? 'active-form' : 'inactive-form';
	}

	// Header
	print "<div id='header'>
		<div id='header-content-container'>
			<ul id='header-title'>
				<li class='title-tags'>&lt;</li>
				<li><h1>PUPPYTAG</h1></li>
				<li class='title-tags'>&gt;</li>
			</ul>
			<h2>Find your puppy tag team!</h2>
		</div>
	</div>

	<div id='divider'></div>";

?>