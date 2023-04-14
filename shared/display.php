<?php foreach (fetch_all_city($con) as $bycity) { ?>
	<div id="property_display">
		<h2><?php echo strtoupper($bycity["city"]); ?></h2>
		<section class="properties">
			<?php foreach (fetch_by_city($con, $bycity["city"]) as $row) { ?>
				<div class="property_box">
					<div class="image_box"><img class="property_image" src="./uploads/<?php echo $row["image1"] ?>" alt=""></div>
					<div class="pr property_name"><?php echo ucfirst($row["property_name"]) ?></div>
					<div class="pr city"><?php echo ucfirst($row["city"]); ?></div>
					<div class="pr price"><i class="fa fa-rupee"></i><?php echo ucfirst($row["price"]) ?></div>
					<div class="pr address"><i class="fa fa-map-marker"></i><?php echo ucfirst($row["address"]) ?></div>
					<div class="pr contact_number"><i class="fa fa-phone"></i><?php echo $row["contact_number"] ?></div>
					<div class="pr contact_email"><i class="fa fa-solid fa-envelope"></i><?php echo $row["contact_email"] ?></div>
					<button class="submit">View</button>
				</div>
			<?php } ?>
		</section>
	</div>
<?php } ?>