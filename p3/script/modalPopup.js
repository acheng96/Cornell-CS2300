/* ========================= *
 * = Modal Popup Functions = *
 * ========================= */ 

/* ================================ *
 * = Delete Album Popup Functions = *
 * ================================ */ 

// Show delete album form popup 
function showDeleteAlbumPopup(albumId) {
	document.getElementById('delete-album-popup').style.display = "block";
	var album = document.getElementById('#' + albumId);
	document.getElementById('delete-confirmation').innerHTML = "Are you sure you want to delete the entire " + album.dataset.albumTitle + " album?";
	document.getElementById('deleteAlbumIdField').value = albumId;
}

// Hide delete album form popup
function closeDeleteAlbumPopup() {
	document.getElementById('delete-album-popup').style.display = "none";
}

/* ========================================= *
 * = Delete Photo In Album Popup Functions = *
 * ========================================= */ 

// Show delete photo form popup 
function showDeletePhotoInAlbumPopup(photoId) {
	document.getElementById('delete-photo-in-album-popup').style.display = "block";
	var photo = document.getElementById('#' + photoId);
	document.getElementById('delete-photo-in-album-confirmation').innerHTML = "Are you sure you want to delete the photo " + photo.dataset.photoName + " from this album?";
	document.getElementById('deletePhotoIdField').value = photoId;
	document.getElementById('deletePhotoAlbumIdField').value = photo.dataset.photoAlbumId;
	console.log(photo.dataset.photoAlbumId);
}

// Hide delete photo form popup
function closeDeletePhotoInAlbumPopup() {
	document.getElementById('delete-photo-in-album-popup').style.display = "none";
}

/* ================================ *
 * = Delete Photo Popup Functions = *
 * ================================ */ 

// Show delete photo form popup 
function showDeletePhotoPopup(photoId) {
	document.getElementById('delete-photo-popup').style.display = "block";
	var photo = document.getElementById('##' + photoId);
	document.getElementById('delete-photo-confirmation').innerHTML = "Are you sure you want to delete the photo " + photo.dataset.allPhotoName + " from all albums?";
	document.getElementById('deleteAllPhotoIdField').value = photoId;
	document.getElementById('deleteAllPhotoAlbumIdField').value = photo.dataset.allPhotoAlbumTitle;
}

// Hide delete photo form popup
function closeDeletePhotoPopup() {
	document.getElementById('delete-photo-popup').style.display = "none";
}

/* ============================== *
 * = Add Photo Popup Functions = *
 * ============================== */ 

// Show add photo form popup 
function showAddPhotoPopup(albumId) {
	document.getElementById('add-photo-popup').style.display = "block";
	var album = document.getElementById('add-photo-' + albumId);
	document.getElementById('addPhotoAlbumIdField').value = albumId;
}

// Hide add photo form popup
function closeAddPhotoPopup() {
	document.getElementById('add-photo-popup').style.display = "none";
}

/* ============================== *
 * = Edit Album Popup Functions = *
 * ============================== */ 

// Show edit album form popup 
function showEditAlbumPopup(albumId) {
	document.getElementById('edit-album-popup').style.display = "block";
	var album = document.getElementById('edit-album-' + albumId);
	document.getElementById('edit-album-title').innerHTML = "EDIT ALBUM #" + albumId + ": " + album.dataset.albumTitle;
	document.getElementById('editAlbumIdField').value = albumId;
}

// Hide edit album form popup
function closeEditAlbumPopup() {
	document.getElementById('edit-album-popup').style.display = "none";
}

/* ============================== *
 * = Edit Photo Popup Functions = *
 * ============================== */ 

// Show edit photo form popup 
function showEditPhotoPopup(photoId) {
	document.getElementById('edit-photo-popup').style.display = "block";
	var photo = document.getElementById('edit-photo-' + photoId);
	document.getElementById('edit-photo-title').innerHTML = "EDIT PHOTO #" + photoId + ": " + photo.dataset.photoName;
	document.getElementById('editPhotoIdField').value = photoId;
}

// Hide edit photo form popup
function closeEditPhotoPopup() {
	document.getElementById('edit-photo-popup').style.display = "none";
}

/* ==================== *
 * = Helper Functions = *
 * ==================== */ 

// When the user clicks anywhere outside of a modal popup, close it
window.onclick = function(event) {
	var imagePopup = document.getElementById('image-popup');
	var deleteAlbumPopup = document.getElementById('delete-album-popup');
	var deletePhotoInAlbumPopup = document.getElementById('delete-photo-in-album-popup');
	var deletePhotoPopup = document.getElementById('delete-photo-popup');
	var editAlbumPopup = document.getElementById('edit-album-popup');
	var addPhotoPopup = document.getElementById('add-photo-popup');
	var editPhotoPopup = document.getElementById('edit-photo-popup');

    if (event.target == imagePopup) {
        imagePopup.style.display = "none";
    } else if (event.target == deleteAlbumPopup) {
    	deleteAlbumPopup.style.display = "none";
    } else if (event.target == deletePhotoInAlbumPopup) {
    	deletePhotoInAlbumPopup.style.display = "none";
    } else if (event.target == deletePhotoPopup) {
    	deletePhotoPopup.style.display = "none";
    } else if (event.target == editAlbumPopup) {
    	editAlbumPopup.style.display = "none";
    } else if (event.target == addPhotoPopup) {
    	addPhotoPopup.style.display = "none";
    } else if (event.target == editPhotoPopup) {
    	editPhotoPopup.style.display = "none";
    }
}










