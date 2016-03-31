// Use this Variable keep track of an ajax request as a global variable so 
// it can be aborted
var request;

$(document).ready(function(){

  // google maps code
  function initMap(latlng) {
    
    var splits = latlng.split(",");  
    var myLatLng = {lat: parseFloat(splits[0]), lng: parseFloat(splits[1])};

    var map = new google.maps.Map(document.getElementById('googleMap'), {
		// TODO: center your map on the provided coordinates and set a 
		//       reasonable zoom level (DONE)
		// HINT: USE https://developers.google.com/maps/documentation/javascript/
		  zoom: 4, // Set zoom level to 4
      center: myLatLng // Set center to myLatLng coordinates
    });

    var marker = new google.maps.Marker({
		// TODO: set a Marker on a specified map at a position. (DONE)
		// HINT: USE https://developers.google.com/maps/documentation/javascript/
		  position: myLatLng, // Set marker position to myLatLng coordinates
      map: map // Place marker on the website map
    });
  }
	 
  // the story starts off at index 0 (in the database)
  var init = {labelno: 0};
  updateStory(init);
  findAlbum();

  $('.goblet').addClass('hidden');
  $('.button-wrapper').addClass('hidden');

	// TODO: Create a javascript onclick function that obtains the corresponding 
	//       choice/button.
	//       Then call the updateStory function on that labelno. (DONE)

	// HINT: there's this cool data-index thing we use to encapsulate
	//       data that is not visible to the user.

  // Update story when Choice 1 Button is clicked
  $(document).on("click", ".choice1", function() {
    var dataIndex = $(".choice1")[0].dataset.index;
    updateStory({labelno: parseInt(dataIndex)});
  })

  // Update story when Choice 2 Button is clicked
  $(document).on("click", ".choice2", function() {
    var dataIndex = $(".choice2")[0].dataset.index;
    updateStory({labelno: parseInt(dataIndex)});
  })

  // this has been implemented for you :)
  $('.js-music').on("ended", function() {
    // set the ticker to the beginning of the song
    this.currentTime = 0;
    // load in new music
    findAlbum();
    // pause the music
    this.pause();
    // start loading the music
    this.load();
    // makes sure the music is done loaded before it plays
    this.oncanplaythrough = this.play();
  });


  // HINT: Create an AJAX request that returns the row of the database that  
  //       corresponds to the information for one labelNo.
  // HINT: input to this function should be json formatted like {labelno: 0}
  function updateStory(jsondata) {

    $(".goblet-msg").text('');
    $(".goblet-msg-valid").text('');
    
    // HINT: console.log(jsondata);

    request = $.ajax({
      // TODO: send the request to your server file. (DONE)
	  //Fill in the missing pieces of this AJAX request
      url: 'ajax/ajax.php', 
      type: 'GET', 
      data: jsondata,
      dataType: 'text',
      error: function(error) {
          console.log(error);
      }
    });

    request.success(function(data) {

  		data = JSON.parse(data);

  		// TODO: Update the HTML DOM to the text of the json you returned.
  		//       The one below has been done for you. (DONE)
          // HINT: console.log(data);

  		$(".story-line").text(data.storyline); // Update storyline text
      $(".choice1-plot").text(data.choice1plot); // Update Choice 1 Plot text
      $(".choice2-plot").text(data.choice2plot); // Update Choice 2 Plot text
      $(".choice1")[0].value = data.choice1button; // Update Choice 1 Button text
      $(".choice2")[0].value = data.choice2button; // Update Choice 2 Button text
      $(".choice1")[0].dataset.index = data.choice1result; // Update data-index attribute of Choice 1 Button
      $(".choice2")[0].dataset.index = data.choice2result; // Update data-index attribute of Choice 2 Button
      $(".location-label").text(data.locationlabel); // Update location name of marker on map

      initMap(data.location); // Update location on map

      // Set up the goblet for certain story elements
      if (jsondata.labelno == 6) {
        $(".goblet").removeClass('hidden');
        $(".choice1").addClass('goblet-submit');
        $(".goblet-submit").attr("disabled", "disabled");
        $(".choice1").removeClass('goblet-choose');
      } else {
        $(".goblet").addClass('hidden');
      }

      if (jsondata.labelno == 7) {
        $(".button-wrapper").removeClass('hidden');
        $(".choice1").addClass('goblet-choose');
        $(".choice1").removeClass('goblet-submit');
        $(".goblet-choose").removeAttr("disabled");

      } else {
        $(".button-wrapper").addClass('hidden');
      }

    });  
  }

  // HINT: USE https://developer.spotify.com/web-api/endpoint-reference/ 
  //       to find the right endpoint call that 
  //       you will be using AJAX to send a request to.

	
  // TODO: Find spotify's unique albumId for this album and return the Spotify preview track JSON URL (DONE)
  function findAlbum() {
  	// var albumName = "Harry+Potter+and+The+Sorcerer%27s+Stone+Original+Motion+Picture+Soundtrack%22%3B";

    // Note: I changed albumName because the '+' converted to its ascii equivalent in the given albumName
    var albumName = "Harry Potter and The Sorcerer's Stone Original Motion Picture Soundtrack";

  	$.ajax({
      // TODO: complete ajax call (DONE)
      url: 'https://api.spotify.com/v1/search',  // Base search url
      data: {
        q: 'album:' + albumName, // Search for albums with albumName in album name
        type: 'album'            
      },
      success: function(data) {

        // HINT: console.log(data);
        // TODO: Using the Spotify api, return the AlbumId that corresponds 
        //       with the provided albumName. (DONE)
        var Albumid = data.albums.items[0].id;

        playMusic(Albumid);
      }
	  
    });
  }
  
  function playMusic(albumID) {
    
    // TODO: populate ajax's url field with the appropriate API endpoint
    // an endpoint is fancy-speak for a url you can send ajax requests to. (DONE)
	
    $.ajax({
      // TODO: complete ajax call (DONE)
      url: 'https://api.spotify.com/v1/albums/' + albumID, // Url for album with albumID
      data: '',
      // TODO: if you did this correctly, the album info should be stored in data. (DONE)
      success: function(data) {
        // HINT: use console.log(data) to see the structure.
        var tracks = data.tracks.items; // Get all tracks in album

        // TODO: using javascript's Math.round() and Math.random(), 
        //       get a random song from the album, assignt to rand (DONE)
        var rand = Math.floor(Math.random() * tracks.length); // Get random int from 0..# of tracks in album

        // TODO: once you have a track, get its preview_url field and 
        //       change the music player (.js-music) such it plays the new song. (DONE)
        // HINT: https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/Using_HTML5_audio_and_video
        var previewUrl = tracks[rand].preview_url; // Get preview url for random song

        // Change the music player to play the new randomly selected song
        var musicPlayer = document.getElementsByClassName('js-music')[0];
        musicPlayer.src = previewUrl;
        musicPlayer.play();
      }

    });

  }

});