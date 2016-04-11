<?php
	// Delete photo from all albums popup box
	print "<div id='delete-photo-popup' class='modal'>
		<div id='delete-photo-content' class='modal-content'>
		    <button class='close' onclick='closeDeletePhotoPopup()'>×</button>
		    <div class='popup-message-container'>
			    <p class='form-description'><b>Warning:</b> Once you delete this photo, you cannot undo this action.</p>
		        <p id='delete-photo-confirmation' class='form-description'>Are you sure you want to delete this photo from all albums?</p>
		        <form class='delete-photo-form' name='deletePhotoForm' action='gallery.php' method='POST'>
		        	<input type='hidden' id='deleteAllPhotoIdField' name='deleteAllPhotoIdField' value='0'><br>
			    	<input type='submit' name='deletePhoto' value='delete'>
				</form>
	        </div>
		</div>
	</div>";
?>