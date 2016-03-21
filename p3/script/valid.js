
/* ======================== *
 * = Validation Functions = *
 * ======================== */ 

// Check that input field contains 1) only letters, spaces, dashes, and underscore and 2) not just all spaces
function validTextInput(formType, name) {
	var allLegalChars = /^[A-Za-z\s-_]+$/.test(name); // Return False if contains illegal chars
	var notAllSpaces = /\S/.test(name); // Return False if all spaces
	var isValidName = allLegalChars && notAllSpaces;

	updateFieldBorder("name-field", isValidName);

	if (!allLegalChars) {
		updateErrorMessage("name-field", "Letters, spaces, dashes, and underscores only.");
	} else if (!notAllSpaces) {
		updateErrorMessage("name-field", "Cannot be empty or contain only spaces.");
	} else {
		updateErrorMessage("name-field", "");
	}
	
	return (isValidName);
}

// Check that input field does not only contain spaces
function validSpacesTextInput(formType, id, text) {
	var isValidTextInput = /\S/.test(text); // Return False if all spaces
	updateFieldBorder(id, isValidTextInput);

	if (!isValidTextInput) {
		updateErrorMessage(id, "Cannot be empty or contain only spaces.");
	}

	return isValidTextInput;
}

// Check image url field for existence of displayable image or if no url is inputted
function validImageURL(formType, id, url) {
    var image = new Image();
    image.src = url;

    var isValidImageURL = (image.height != 0) || (url.trim() == ""); // Return False if no image
    updateFieldBorder("image-url-field", isValidImageURL);

    if (!isValidImageURL) {
   		updateErrorMessage(id, "Invalid Image URL.");
    }

    return isValidImageURL;
}

// Validate all user input fields for add album form
function validAddAlbumForm() {
	var albumTitle = validTextInput(document.forms.addAlbumForm.albumTitle.value); 
	var albumPhotoCreditURL = validImageURL(document.forms.addAlbumForm.albumPhotoCredit.value); 
	var isValidForm = (albumTitle && albumPhotoCreditURL);

	alert("validated album");
	console.log("validated album");
    console.log(isValidForm);

	// return isValidForm;
}

// Validate all user input fields for add photo form
function validAddPhotoForm() {
	var photoName = validTextInput(document.forms.addPhotoForm.photoName.value); 
	var photoLocation = validTextInput(document.forms.addPhotoForm.photoCaption.value); 
	var photoCreditURL = validImageURL(document.forms.addPhotoForm.photoCredit.value); 
	var isValidForm = (photoName && photoLocation && photoCreditURL);

	alert("validated photo");
	console.log("validated photo");
    console.log(isValidForm);

	// return isValidForm;
}

/* ==================== *
 * = Helper Functions = *
 * ==================== */ 

// Show red border when input is invalid
function updateFieldBorder(id, valid) {
	document.getElementById(id).style.border = valid ? "solid 2px #4A4A4A" : "solid 3px red";
}

// Show error message
function updateErrorMessage(id, errorMessage) { 
	var albumFields = {"album-title-field": "Album Title", "album-photo-field": "Album Photo Credit", "album-photo-credit-field": "Album Photo Credit"};
	var photoFields = {"photo-name-field": "Photo Name", "photo-caption-field": "Photo Caption", "photo-field": "Photo", "photo-credit-field": "Photo Credit"};

	if (id in albumFields) {
		var field = albumFields[id];
		document.getElementById("album-form-subtitle").innerHTML = (errorMessage == "") ? "" : (field + ": " + errorMessage);
	} else {
		var field = photoFields[id];
		document.getElementById("photo-form-subtitle").innerHTML = (errorMessage == "") ? "" : (field + ": " + errorMessage);
	}
}

