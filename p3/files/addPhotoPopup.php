<?php
	global $existingPhotos;

	// Add photo popup box
	print "<div id='add-photo-popup' class='modal'>
		<div id='add-photo-content' class='modal-content'>
		    <button class='close' onclick='closeAddPhotoPopup()'>×</button>
		    <div class='popup-message-container'>
			    <p class='form-description'><b>Note: </b>To add new images, navigate to add page.</p>
		        <p class='form-description'>Choose the existing photo(s) to add to this album:</p>
		        <form class='add-photo-form' name='addPhotoForm' action='gallery.php' method='POST'>
		        	<input type='hidden' id='addPhotoAlbumIdField' name='addPhotoAlbumIdField' value='0'><br>
		        	<select class='photo-select' name='photoSelect' required title='Please select a photo to add!'>
						<option selected='selected' value>PHOTO</option>";
						for ($i = 0; $i < count($existingPhotos); $i++) {
							print "<option value='{$existingPhotos[$i]->photoId}'>#{$existingPhotos[$i]->photoId}: {$existingPhotos[$i]->photoName}</option>";
						}
					print "</select>
			    	<input type='submit' name='addPhoto' value='add'>
				</form>
	        </div>
		</div>
	</div>";
?>