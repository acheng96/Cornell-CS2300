<!DOCTYPE html>

<!-- Puppy Catalog -->
<div class="catalog">
	<div id="catalog-header">
		<h3 id="catalog-title">PUPS</h3>
		<div id="catalog-right-side">
			<h4 id="sort-title">Sort by</h2>
			<select id="sort-select" name="sortSelect">
				<option 'selected' value="DATE">DATE</option>
				<option 'selected' value="NAME">NAME</option>
				<option 'selected' value="WEIGHT">WEIGHT</option>
			</select>
		</div>
	</div>

	<div class="catalog-container">
		<?php 
			$displayedPups = $pups;
		?>
		<?php for ($i = 0; $i < count($displayedPups); $i++) { ?>
				<div class="catalog-item">
					<img id="breed-image" src=<?php echo $displayedPups[$i]->imageURL; ?> alt=<?php echo $displayedPups[$i]->breed; ?>>
					<div class="inner-catalog-container">
						<div class="top-item-container">
							<div class="item-description">
								<h3 id="name"><?php echo $displayedPups[$i]->name; ?></h3>
								<h4 id="description"><?php echo $displayedPups[$i]->breed.' • '.$displayedPups[$i]->weight.' lbs'; ?></h4>
							</div>
							<img id="emoji" src=<?php echo getEmoji($displayedPups[$i]->personality); ?> alt="Emoji"> 
						</div>
						<div class="bottom-item-container">
							<h3><b>Personality: </b><?php echo $displayedPups[$i]->personality; ?></h3>
							<h3><b>Favorite Toy: </b><?php echo $displayedPups[$i]->favoriteToy; ?></h3>
							<h3><b>Special Talent: </b><?php echo $displayedPups[$i]->specialTalent; ?></h3>
							<h3>Image from <a href=<?php echo $displayedPups[$i]->imageURL; ?> target="_blank"><b>here</b></a>.</h3>
						</div>
					</div>
				</div>
		<?php } ?>
	</div>
</div>