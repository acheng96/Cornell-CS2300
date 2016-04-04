<?php
	// Delete photo from album popup box
	print "<div id='delete-photo-in-album-popup' class='modal'>
		<div id='delete-photo-in-album-content' class='modal-content'>
		    <button class='close' onclick='closeDeletePhotoPopup()'>×</button>
		    <div class='popup-message-container'>
			    <p class='form-description'><b>Warning:</b> Once you delete this photo, you cannot undo this action.</p>
		        <p id='delete-photo-in-album-confirmation' class='form-description'>Are you sure you want to delete this photo from this album?</p>
		        <form class='delete-photo-form' name='deletePhotoForm' action='index.php' method='POST'>
		        	<input type='hidden' id='deletePhotoIdField' name='deletePhotoIdField' value='0'><br>
		        	<input type='hidden' id='deletePhotoAlbumIdField' name='deletePhotoAlbumIdField' value='0'><br>
			    	<input type='submit' name='deletePhotoInAlbum' value='delete'>
				</form>
	        </div>
		</div>
	</div>";
?>