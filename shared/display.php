<?php foreach (fetch_all_city($con) as $bycity) { ?>
	<div class="property_display container">
		<h2><?php echo strtoupper($bycity["city"]); ?></h2>
		<section class="properties container">
			<?php foreach (fetch_by_city($con, $bycity["city"]) as $row) {
			?>

				<a href="property.php?id=<?php echo $row["property_id"] ?>">
					<div class="property-box">
						<div class="property_image" style="background-image: url(./uploads/<?php echo $row["image1"] ?>), linear-gradient(black, white);"></div>
						<div class="detail">
							<div class="name"><?php echo ucfirst($row["property_name"]) ?></div>
							<div class="city"><?php echo ucfirst($row["city"]); ?></div>
							<div class="price">$<?php echo ucfirst($row["price"]) ?></div>
						</div>
					</div>
				</a>
			<?php } ?>
		</section>
	</div>
<?php } ?>