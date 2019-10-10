<?php
function get_variations(){
	global $product;	
	if ( $product->is_type( 'variable' ) ) {
		$id = $product->get_id();
		$available_variations = $product->get_available_variations();
		$variations = array();
		foreach($available_variations as $variation){
			
			
			$terms = get_terms( array('slug' => $variation["attributes"]["attribute_pa_degree-of-difficulty"]) );
			$term_label = $terms[0]->name;
			if(pll_current_language() == 'pt') {
				setlocale(LC_TIME, 'pt_PT', 'pt_PT.utf-8', 'pt_PT.utf-8', 'portuguese');
				date_default_timezone_set('Europe/Lisbon');
			}
			$has_valid_date = true;
			$date = false;
			if(isset($variation["attributes"]["attribute_date"])){
				$the_date = $variation["attributes"]["attribute_date"];	
			}else if(isset($variation["attributes"]["attribute_data"])){
				$the_date = $variation["attributes"]["attribute_data"];	
			}

			if($the_date == "Data a Agendar"){
				$has_valid_date = false;
			}else if(validateDate($the_date)){
				$date = strtotime($the_date);
				$written_date_part1 = date('d', strtotime($the_date));
				$written_date_part2 = strftime('%B', strtotime($the_date));
				$written_date_part3 = date('Y', strtotime($the_date));
					
			}else if(strpos($the_date, " ") != false && $the_date != "Data por definir"){
				$date_arr = explode(" ", $the_date);
				$date = strtotime($date_arr[0]);
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
					}else{
						$has_valid_date = false;
					}
				}
				$written_date_part1 = implode("-", $days);
				$written_date_part2 = implode("-", array_unique($months));
				$written_date_part3 = implode("-", array_unique($years));

			}else{
				$has_valid_date = false;
			}
			$variation_add_to_cart_href = get_site_url() . "/cart/?add-to-cart=" . $id . "&variation_id=" . $variation["variation_id"] . "&attribute_date=" . $the_date;

			$time = "";
			
			if(isset($variation["attributes"]["attribute_time"])){
				$time = $variation["attributes"]["attribute_time"];
			}

			$image = false;
			if(isset($variation["image"]["url"])){
				$image = $variation["image"]["url"];
			}

			if($has_valid_date != false){
				$this_variation = array(
					"date" => $date,
					"time" => $time,
					"written_date_part1" => $written_date_part1,
					"written_date_part2" => $written_date_part2,
					"written_date_part3" => $written_date_part3,
					"price" => $variation["display_price"],
					"product_title" => $product->get_title(),
					"image" => $image,
					"label" => $term_label,
					"availability_html" => $variation["availability_html"],
					"add_to_cart_href" => $variation_add_to_cart_href
				);
				array_push($variations, $this_variation);
			}
			
		}


		usort($variations, "sortFunction");
		$response = $variations;
	}else{
		$response = false;
	}
	
	return $response;
}
function sortFunction( $a, $b ) {
    return $a["date"] - $b["date"];
}
?>