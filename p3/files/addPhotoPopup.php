<?php
	// Add photo popup box
	print "<div id='add-photo-popup' class='modal'>
		<div id='add-photo-content' class='modal-content'>
		    <button class='close' onclick='closeAddPhotoPopup()'>×</button>
		    <div class='popup-message-container'>
			    <p class='form-description'><b>Note:</b>To add new images, navigate to add page.</p>
		        <p id='delete-confirmation' class='form-description'>Choose the existing photo(s) to add to this album:</p>
		        <form class='add-photo-form' name='addPhotoForm' action='gallery.php' method='POST'>
		        	<input type='hidden' id='addPhotoAlbumIdField' name='addPhotoAlbumIdField' value='0'><br>
			    	<input type='submit' name='addPhoto' value='add'>
				</form>
	        </div>
		</div>
	</div>";
?>