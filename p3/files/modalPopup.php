<?php
	// Modal popup box
	print "<div id='image-popup' class='modal'>
		<div class='modal-content'>
		    <button class='close' onclick='closeImagePopup()'>×</button>
	        <p id='photo-title' class='photo-title'></p>
	        <img id='photo-image' src='' alt=''>
			<p id='photo-caption' class='photo-caption'></p>
			<h4 class='photo-credit'>Image from <a id='photo-credit' href='' target='_blank'><b>here</b></a>.</h4>
			<p id='photo-albums' class='photo-albums'>From Albums: </p>
		</div>
	</div>";
?>