
/* ======================== *
 * = Validation Functions = *
 * ======================== */ 

// Check name field contains 1) only letters, spaces, dashes, and underscore and 2) not just all spaces
function validName(name) {
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
function validTextInput(id, text) {
	var isValidTextInput = /\S/.test(text); // Return False if all spaces
	updateFieldBorder(id, isValidTextInput);

	if (!isValidTextInput) {
		updateErrorMessage(id, "Cannot be empty or contain only spaces.");
	}

	return isValidTextInput;
}

// Check image url field for valid url
function validImageURL(url) {
	console.log("validate image url");
    var image = new Image();
    image.src = url;
    var isValidImageURL = (image.height != 0); // Return False if no image
    updateFieldBorder("image-url-field", isValidImageURL);

    if (!isValidImageURL) {
   		updateErrorMessage("image-url-field", "Invalid Image URL.");
    }

    return isValidImageURL;
}

// Validate all user input fields
function validForm() {
	var name = validName(document.forms.pupForm.inputName.value); 
	var imageURL = validImageURL(document.forms.pupForm.inputImageURL.value); 
	var favoriteToy = validTextInput("favorite-toy-field", document.forms.pupForm.favoriteToy.value);
	var specialTalent = validTextInput("special-talent-field", document.forms.pupForm.specialTalent.value);
	var isValidForm = (name && imageURL && favoriteToy && specialTalent);

	return isValidForm;
}

/* ==================== *
 * = Helper Functions = *
 * ==================== */ 

// Show red border when input is invalid
function updateFieldBorder(id, valid) {
	document.getElementById(id).style.border = valid ? "solid 1px #979797" : "solid 3px red";
}

// Show error message
function updateErrorMessage(id, errorMessage) { 
	var fields = {"name-field": "Name", "image-url-field": "Image URL", "favorite-toy-field": "Favorite Toy", "special-talent-field": "Special Talent"};
	var field = fields[id];

	document.getElementById("form-error-message").innerHTML = (errorMessage == "") ? "" : (field + ": " + errorMessage);
}


