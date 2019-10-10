<div class="abcoffee_variations_wrap">
<?php foreach($variations as $variation){?>
	<div class="abcoffee_the_variation">

		<div class="first_section">
			<div class="date">
				<span><?=$variation["written_date_part1"]?> <?=$variation["written_date_part2"]?> <?=$variation["written_date_part3"]?></span>
				<span><?=$variation["time"]?></span>
			</div>
			<div class="name_and_level">
				<p class="the_name"><?=$variation["product_title"]?></p>
				<p class="the_level">
					<?php if($variation["image"] != false){?>
						<img src="<?=$variation["image"]?>" alt="">
					<?php }?>
					
					<span><?=$variation["label"]?></span>
					
				</p>
			</div>
		</div>
		<div class="seccond_section">
			<div class="the_price">
				<?=$variation["price"]?>€
			</div>
			<div class="availability">
				<?=$variation["availability_html"]?>
			</div>
			<div class="the_add_to_cart_button_wrap">
				<a class="variations_add_to_cart" href="<?=$variation["add_to_cart_href"]?>">Inscrição</a>
			</div>
		</div>
			
	</div>
	<?php
}
?>
</div>