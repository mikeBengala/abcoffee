<?php 
add_filter( 'woocommerce_cart_item_name', 'custom_cart_product_name', 20, 3);
function custom_cart_product_name( $name, $cart_item, $cart_item_key ) {

    $product_item = $cart_item['data'];
    $variations = $product_item->get_variation_attributes();

    $degree_of_difficulty = $min_stock = $date = "";
	
    if(isset($variations["attribute_pa_degree-of-difficulty"])){
    	$course_level = $variations["attribute_pa_degree-of-difficulty"];
    	if(pll_current_language() == 'pt') {
    		$course_level = translate_course_level_to_pt($course_level);
    	}
    	$degree_of_difficulty = '<span class="product_name_degree_of_difficulty"> • ' . $course_level . '</span>';
    }

    if(isset($variations["attribute_minimum-stock"])){
    	$min_stock = '<span class="product_name_minimum_stock">Mínimo ' . $product_item->get_variation_attributes()["attribute_minimum-stock"] . " Alunos</span>";	
    }

    if(isset($variations["attribute_date"])){
    	$string_date = abcoffee_dates_to_string($variations["attribute_date"]);
    	$date = '<span class="product_name_date"><span class="convert_date_to_string">' . $string_date . '</span> / </span>';
    }

    if(isset($variations["attribute_data"])){
        $string_date = abcoffee_dates_to_string($variations["attribute_data"]);
        $date = '<span class="product_name_date"><span class="convert_date_to_string">' . $string_date . '</span> / </span>';
    }
    return $name . $degree_of_difficulty . "<br>" . $date . $min_stock;
        
}
?>