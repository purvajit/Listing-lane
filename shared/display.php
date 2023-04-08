<div class="property_display">
	<?php foreach(fetch_all_city($property_con) as $bycity){?>
	<h2><?php echo strtoupper($bycity["city"]);?></h2>
	<section class="properties"> 		
		<?php foreach(fetch_by_city($property_con,$bycity["city"]) as $row){?>
			<div class="property_box">
				<div class="image_box"><img class="property_image" src="./uploads/<?php echo $row["image1"]?>" alt=""></div>
				<div class="property_name"><?php echo $row["property_name"]?></div>
				<div class="city"><?php echo $row["city"]?></div>
				<div class="price"><i class="fa fa-rupee"></i><?php echo $row["price"]?></div>
				<div class="address"><i class="fa fa-map-marker"></i><?php echo $row["address"]?></div>
				<div class="contact_number"><i class="fa fa-phone"></i><?php echo $row["contact_number"]?></div>
				<div class="contact_email"><i class="fa fa-solid fa-envelope"></i><?php echo $row["contact_email"]?></div>
				<button class="submit">View</button>
		</div>
			<?php }?>
		</section>
		<?php }?>
</div>