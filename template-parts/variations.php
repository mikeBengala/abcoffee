<?php
global $product;
$id = $product->get_id();
$available_variations = $product->get_available_variations();

?>
<div class="abcoffee_variations_wrap">
<?php foreach($available_variations as $variation){?>
	<?php
		$variation_add_to_cart_href = get_site_url() . "/cart/?add-to-cart=" . $id . "&variation_id=" . $variation["variation_id"] . "&attribute_date=" . $variation["attributes"]["attribute_date"];
	?>
	<div class="abcoffee_the_variation">
		<div class="first_section">
			<div class="date">
				<?=$variation["attributes"]["attribute_date"]?>
			</div>
			<div class="name_and_level">
				<p class="the_name"><?=$product->get_title();?></p>
				<p class="the_level">
					<?php if(isset($variation["image"]["url"])){?>
						<img src="<?=$variation["image"]["url"]?>" alt="">
					<?php }?>
					<span><?=$variation["attributes"]["attribute_pa_degree-of-difficulty"]?></span>
				</p>
			</div>
		</div>
		<div class="seccond_section">
			<div class="the_price">
				<?=$product->get_price_html(); ?>
			</div>
			<div clas="availability">
				<?=$variation["availability_html"]?>
			</div>
			<div class="the_add_to_cart_button_wrap">
				<a class="event_add_to_cart" href="<?=$variation_add_to_cart_href?>">Inscrição</a>
			</div>
		</div>
			
	</div>
<?php }?>

</div>