<div class="calendar_wrap">
	<div id="calendar"></div>
</div>
<div class="courses_loop_wrap">
	
	<?php foreach($calendar_arr["products"] as $this_product){?>


		<a  href="<?=$this_product["permalink"]?>"
			class="course calendar_course product_id<?=$this_product["id"]?>"
			data-start-date='<?=$this_product["start_date"]?>'
			data-end-date='<?=$this_product["end_date"]?>'
			data-cat='<?=$this_product["categories"]?>'
			data-tag='<?=$this_product["tags"]?>'
			data-level='<?=$this_product["level"]?>'
			data-index="<?=$this_product["index"]?>"
			data-description="<?=$this_product["description"]?>"
			data-add-to-cart="<?=$this_product["variation_add_to_cart_href"]?>">
			
			<div class="calendar_product_image_wrap">
				<img src="<?=$this_product["image"]?>">
			</div>
			<h2><?=$this_product["title"]?></h2>
			<p><?=$this_product["subtitle"]?></p>
			<div class="content">
				<?=$this_product["content"]?>
			</div>
			<div class="availability">
				<?=$this_product["availability"]?>
			</div>

		</a>


	<?php }?>

</div>