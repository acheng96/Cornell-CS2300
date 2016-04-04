<?php
	// Modal popup box
	print "<div id='delete-album-popup' class='modal'>
		<div id='delete-album-content' class='modal-content'>
		    <button class='close' onclick='closeDeleteAlbumPopup()'>×</button>
		    <div class='popup-message-container'>
			    <p class='form-description'><b>Warning:</b> Once you delete this album, you cannot undo this action.</p>
		        <p id='delete-confirmation' class='form-description'>Are you sure you want to delete this entire album?</p>
		        <form class='delete-album-form' name='deleteAlbumForm' action='index.php' method='POST'>
		        	<input type='hidden' id='deleteAlbumIdField' name='deleteAlbumIdField' value='0'><br>
			    	<input type='submit' name='deleteAlbum' value='delete'>
				</form>
	        </div>
		</div>
	</div>";
?>