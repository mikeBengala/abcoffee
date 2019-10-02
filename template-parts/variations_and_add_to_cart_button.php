<?php
	$attribute_keys = array_keys( $product->get_attributes() );


if ( $product->is_type( 'simple' ) ){
   echo woocommerce_simple_add_to_cart();
}
elseif ( $product->is_type( 'variable' ) ){
    // Loop through available variation data
    foreach ( $product->get_available_variations() as $variation_data ) {
        $url = '?add-to-cart='.$variation_data['variation_id']; // The dynamic variation ID (URL)

        // Loop through variation product attributes data
        var_dump($variation_data);
        
    }
}
?>

teste