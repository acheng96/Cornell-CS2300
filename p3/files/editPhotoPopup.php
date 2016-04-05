<?php
	// Edit photo popup box
	print "<div id='edit-photo-popup' class='modal'>
		<div id='edit-photo-content' class='modal-content'>
		    <button class='close' onclick='closeEditPhotoPopup()'>×</button>
		    <div class='popup-message-container'>
			    <p id='edit-photo-title' class='form-description'>EDIT PHOTO</p>
		        <form class='edit-photo-form' name='editPhotoForm' action='gallery.php' method='POST'>
		        	<input type='hidden' id='editPhotoIdField' name='editPhotoIdField' value='0'><br>
		        	<input id='edit-photo-name-field' type='text' placeholder='PHOTO NAME' name='editPhotoName' maxlength='50' required title='Letters, numbers, spaces, dashes, and underscores only.'><br>
		        	<input id='edit-photo-caption-field' type='text' placeholder='PHOTO LOCATION' name='editPhotoCaption' maxlength='50' required title='Letters, numbers, spaces, dashes, and underscores only.'><br>
			    	<input type='submit' name='editPhoto' value='save changes'>
				</form>
	        </div>
		</div>
	</div>";
?>