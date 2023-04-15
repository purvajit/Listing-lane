<?php foreach (fetch_all_city($con) as $bycity) { ?>
	<div id="property_display container">
		<h2><?php echo strtoupper($bycity["city"]); ?></h2>
		<section class="properties container">
			<?php foreach (fetch_by_city($con, $bycity["city"]) as $row) { ?>

				<div class="property-box">
					<div class="property_image" style="background-image: url(./uploads/<?php echo $row["image1"] ?>);"></div>
					<div class="detail">
						<div class="pr property_name"><?php echo ucfirst($row["property_name"]) ?></div>
						<div class="pr city"><?php echo ucfirst($row["city"]); ?></div>
						<div class="pr price"><i class="fa fa-rupee"></i><?php echo ucfirst($row["price"]) ?></div>
						<button class="submit">View</button>
					</div>
				</div>

			<?php } ?>
		</section>
	</div>
<?php } ?>