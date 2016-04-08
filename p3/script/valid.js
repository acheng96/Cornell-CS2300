
/* ======================== *
 * = Validation Functions = *
 * ======================== */ 

// Check that input field contains 1) only letters, numbers, spaces, dashes, and underscores and 2) not just all spaces
function validTextInput(id, text) {
	var allLegalChars = /^[A-Za-z0-9\s-_]+$/.test(text); // Return False if contains illegal chars
	var notAllSpaces = /\S/.test(text); // Return False if all spaces
	var isValidName = allLegalChars && notAllSpaces;

	updateFieldBorder(id, isValidName);

	if (!allLegalChars) {
		updateErrorMessage(id, "Letters, numbers, spaces, dashes, and underscores only.");
	} else if (!notAllSpaces) {
		updateErrorMessage(id, "Cannot be empty or contain only spaces.");
	}
	
	return (isValidName);
}

// Check that input field contains only letters, numbers, spaces, dashes, and underscores 
function validSearchInput(id, text) {
	var allLegalChars = /^[A-Za-z0-9\s-_]+$/.test(text); // Return False if contains illegal chars
	var empty = text.trim() == ""; // Return False if all spaces
	var isValidName = allLegalChars || empty;

	updateFieldBorder(id, isValidName);

	if (!isValidName) {
		console.log("illegal: " + id + "; text: " + text);
		updateErrorMessage(id, "Letters, numbers, spaces, dashes, and underscores only.");
	}
	
	return (isValidName);
}

// Check image url field for existence of displayable image or if no url is inputted
function validImageURL(id, url) {
    var image = new Image();
    image.src = url;

    var isValidImageURL = (image.height != 0) || (url.trim() == ""); // Return False if no image
    updateFieldBorder(id, isValidImageURL);

    if (!isValidImageURL) {
   		updateErrorMessage(id, "Invalid Image URL.");
    }

    return isValidImageURL;
}

/* ======================== *
 * = Valid Form Functions = *
 * ======================== */ 

// Validate all user input fields for add album form
function validAddAlbumForm() {
	var albumTitle = validTextInput("album-title-field", document.forms.addAlbumForm.albumTitle.value); 
	var albumPhotoCreditURL = validImageURL("album-photo-credit-field", document.forms.addAlbumForm.albumPhotoCredit.value); 
	var isValidForm = (albumTitle && albumPhotoCreditURL);

	if (isValidForm) {
		updateErrorMessage("album-title-field", "");
	}

	return isValidForm;
}

// Validate all user input fields for add photo form
function validAddPhotoForm() {
	var photoName = validTextInput("photo-name-field", document.forms.addPhotoForm.photoName.value); 
	var photoLocation = validTextInput("photo-caption-field", document.forms.addPhotoForm.photoCaption.value); 
	var photoCreditURL = validImageURL("photo-credit-field", document.forms.addPhotoForm.photoCredit.value); 
	var isValidForm = (photoName && photoLocation && photoCreditURL);

	if (isValidForm) {
		updateErrorMessage("photo-name-field", "");
	}

	return isValidForm;
}

// Validate all user input fields for search form
function validSearchForm() {
	var albumName = validSearchInput("search-album-name-field", document.forms.searchForm.searchAlbumName.value); 
	var photoName = validSearchInput("search-photo-name-field", document.forms.searchForm.searchPhotoName.value); 
	var photoCaption = validSearchInput("search-photo-caption-field", document.forms.searchForm.searchPhotoCaption.value); 
	var isValidForm = (albumName && photoName && photoCaption);

	if (isValidForm) {
		updateErrorMessage("search-album-name-field", "");
	}

	return isValidForm;
}

// Validate all user input fields for login form
function validLoginForm() {
	var username = validTextInput("username-field", document.forms.loginForm.username.value); 
	var password = validTextInput("password-field", document.forms.loginForm.password.value); 
	var isValidForm = (username && password);

	if (isValidForm) {
		updateErrorMessage("username-field", "");
	}

	return isValidForm;
}

/* ==================== *
 * = Helper Functions = *
 * ==================== */ 

// Show red border when input is invalid
function updateFieldBorder(id, valid) {
	document.getElementById(id).style.border = valid ? "solid 2px #4A4A4A" : "solid 3px red";
}

// Show error message for input forms
function updateErrorMessage(id, errorMessage) { 
	console.log(id);
	var albumFields = {"album-title-field": "Album Title", "album-photo-credit-field": "Album Photo Credit"};
	var photoFields = {"photo-name-field": "Photo Name", "photo-caption-field": "Photo Location", "photo-credit-field": "Photo Credit"};
	var searchFields = {"search-album-name-field": "Album Name", "search-photo-name-field": "Photo Name", "search-photo-caption-field": "Photo Caption"};
	var loginFields = {"username-field": "Username", "password-field": "Password"};

	if (id in albumFields) {
		document.getElementById("album-form-subtitle").innerHTML = (errorMessage == "") ? "" : (albumFields[id] + ": " + errorMessage);
	} else if (id in photoFields) {
		document.getElementById("photo-form-subtitle").innerHTML = (errorMessage == "") ? "" : (photoFields[id] + ": " + errorMessage);
	} else if (id in searchFields) {
		document.getElementById("search-form-subtitle").innerHTML = (errorMessage == "") ? "" : (searchFields[id] + ": " + errorMessage);
	} else if (id in loginFields) {
		document.getElementById("login-form-subtitle").innerHTML = (errorMessage == "") ? "" : (loginFields[id] + ": " + errorMessage);
	}
}
