<?php
	// Puppy Catalog
	print "<div class='catalog'>
			<div class='catalog-container'>";

				for ($i = 0; $i < count($pups); $i++) {
					$pupName = $pups[$i]->name;
					$pupDescription = $pups[$i]->breed.' • '.$pups[$i]->weight.' lbs';
					$pupPersonality = $pups[$i]->personality;
					$pupEmoji = getEmoji($pups[$i]->personality);
					$pupFavoriteToy = $pups[$i]->favoriteToy;
					$pupSpecialTalent = $pups[$i]->specialTalent;
					$pupImageURL = $pups[$i]->imageURL;

						print "<div class='catalog-item'>
							<img class='breed-image' src='{$pupImageURL}' alt='Puppy'>
							<div class='inner-catalog-container'>
								<div class='top-item-container'>
									<div class='item-description'>
										<h3 class='name'>{$pupName}</h3>
										<h4 class='description'>{$pupDescription}</h4>
									</div>
									<img class='emoji' src='{$pupEmoji}' alt='Emoji'> 
								</div>
								<div class='bottom-item-container'>
									<h3><b>Personality: </b>{$pupPersonality}</h3>
									<h3><b>Favorite Toy: </b>{$pupFavoriteToy}</h3>
									<h3><b>Special Talent: </b>{$pupSpecialTalent}</h3>
									<h3>Image from <a href='{$pupImageURL}' target='_blank'><b>here</b></a>.</h3>
								</div>
							</div>
						</div>";
				}
			print "</div>
		</div>";
?>