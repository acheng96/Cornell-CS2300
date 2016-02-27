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
			<h4>Image from <a href='https://scontent-yyz1-1.xx.fbcdn.net/hphotos-xfp1/v/t34.0-12/12735613_1059802657394214_883930009_n.jpg?oh=fbf21338a7e036c707ecd4ae25fc85f1&oe=56CE5EDD' target='_blank'><b>here</b></a>.</h4>
		</div>
	</div>

	<div id='divider'></div>";

?>