<?php
global $product;
$id = $product->get_id();
$available_variations = $product->get_available_variations();
?>
<div class="abcoffee_variations_wrap">
<?php foreach($available_variations as $variation){?>
	<?php
	
                                    
		$terms = get_terms( array('slug' => $variation["attributes"]["attribute_pa_degree-of-difficulty"]) );
		$term_label = $terms[0]->name;
                                
		if(pll_current_language() == 'pt') {
			setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
			date_default_timezone_set('America/Sao_Paulo');
		}
		$the_date = $variation["attributes"]["attribute_date"];
		if(validateDate($the_date)){
			$written_date_part1 = date('d', strtotime($the_date));
			$written_date_part2 = strftime('%B', strtotime($the_date));
			$written_date_part3 = date('Y', strtotime($the_date));
				
		}else if(strpos($the_date, "até") != false){
			$date_arr = explode(" até ", $the_date);
			$days = [];
			$months = [];
			$years = [];
			foreach ($date_arr as $this_date) {
				if(validateDate($this_date)){
					$day = date('d', strtotime($this_date));
					$month = strftime('%B', strtotime($this_date));
					$year = date('Y', strtotime($this_date));
					 
					array_push($days, $day);
					array_push($months, $month);
					array_push($years, $year);
				}
			}
			$written_date_part1 = implode(" a ", $days);
			$written_date_part2 = implode(" a ", array_unique($months));
			$written_date_part3 = implode(" a ", array_unique($years));

		}else{
			$written_date_part1 = "DATA";
			$written_date_part2 = "POR";
			$written_date_part3 = "DEFINIR";
		}
		$variation_add_to_cart_href = get_site_url() . "/cart/?add-to-cart=" . $id . "&variation_id=" . $variation["variation_id"] . "&attribute_date=" . $the_date;	
	?>
	<div class="abcoffee_the_variation">
		<div class="first_section">
			<div class="date">
				<span><?=$written_date_part1?></span>
				<span><?=$written_date_part2?></span>
				<span><?=$written_date_part3?></span>
			</div>
			<div class="name_and_level">
				<p class="the_name"><?=$product->get_title();?></p>
				<p class="the_level">
					<?php if(isset($variation["image"]["url"])){?>
						<img src="<?=$variation["image"]["url"]?>" alt="">
					<?php }?>
					<?php if(isset($term_label)){?>
						<span><?=$term_label?></span>
					<?php }?>
				</p>
			</div>
		</div>
		<div class="seccond_section">
			<div class="the_price">
				<?=$variation["display_price"]?>€
			</div>
			<div class="availability">
				<?=$variation["availability_html"]?>
			</div>
			<div class="the_add_to_cart_button_wrap">
				<a class="variations_add_to_cart" href="<?=$variation_add_to_cart_href?>">Inscrição</a>
			</div>
		</div>
			
	</div>
<?php }?>
</div>