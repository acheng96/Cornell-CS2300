<?php
	// Edit album popup box
	print "<div id='edit-album-popup' class='modal'>
		<div id='edit-album-content' class='modal-content'>
		    <button class='close' onclick='closeEditAlbumPopup()'>×</button>
		    <div class='popup-message-container'>
			    <p class='form-description'><b>Edit Album</p>
		        <form class='edit-album-form' name='editAlbumForm' action='gallery.php' method='POST'>
		        	<input type='hidden' id='editAlbumIdField' name='editAlbumIdField' value='0'><br>
		        	<input id='edit-album-title-field' type='text' placeholder='ALBUM TITLE' name='editAlbumTitle' maxlength='50' required title='Letters, numbers, spaces, dashes, and underscores only.'><br>
			    	<input type='submit' name='editAlbum' value='save changes'>
				</form>
	        </div>
		</div>
	</div>";
?>