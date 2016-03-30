<!DOCTYPE html>
<?php 
	//Start with ajax.js for HW3 instructions 
	//ajax.php, goblet.js and goblet.php also have TODO tasks for you
	//When you get to Spotify and the Goblet, look at Spotify_hints.txt and Goblet_hints.txt
  define('SHARED_FILE_URL', 'https://info2300.coecis.cornell.edu/users/_demosp16/www/hw3/common'); 
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>INFO/CS 2300 | HW3: AJAX</title>
  <link rel="stylesheet" type="text/css" href="<?php echo SHARED_FILE_URL ?>/css/normalize.css">
  <link rel="stylesheet" type="text/css" href="<?php echo SHARED_FILE_URL ?>/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<?php 
		require "includes/functions.php";
		add_versioned_file( 'js/ajax.js', 'JavaScript' );
		add_versioned_file( 'js/goblet.js', 'JavaScript' );
	?>
</head>

<body>
	<header class="header">
		<h1>Your First Day at Hogwarts</h1>
	</header>

  <section class="container">
    <h2>Current Storyline:</h2>
    <div data-index="" class="story-line">
    </div>

    <h2>Your Choices:</h2>
    <div class="plot-box">
      <div class="choice1-plot">
      </div>

      <div class="goblet">
        <div class="form-slice">
          <label class="form-label" for="fn">First Name:</label>
          <input type="text" id="fn" class="goblet-first-name" name="goblet-first-name" size="15" placeholder="John" />
        </div>
        <div class="form-slice">
          <label class="form-label" for="ln">Last Name:</label>
          <input type="text" id="ln" class="goblet-last-name" name="goblet-last-name" size="15" placeholder="Doe" /><br/>
        </div>
        <div class="form-slice">
          <label class="form-label" for="sc">School:</label>
          <input type="text" id="sc" class="goblet-school" name="goblet-school" size="15" placeholder="Hogwarts" /><br/>
        </div>
        <div class="goblet-msg"></div>
      </div>

      <div class="button-wrapper">
        <div class="goblet-msg-valid"></div>
      </div>
      

      <input type="button" data-index="" class="js-trigger choice1" name="choice1" value="">
    </div>

    <div class="plot-box">
      <div class="choice2-plot">
      </div>
      <input type="button" data-index="" class="js-trigger choice2" name="choice2" value="">
    </div>
    
    <div class="location">
      <h2>Your current location:</h2>
      <div class="location-label"></div>
      <div id="googleMap" style="width:600px;height:450px;"></div>
    </div>

  </section>

  <footer class="music-player">
    <div class="credit">Background gif credit: Giphy.com</div>
    <audio class="js-music music-player-item" autoplay controls>
    </audio>
  </footer>

</body>
</html>
