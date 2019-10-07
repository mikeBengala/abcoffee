<?php
function wcs_custom_get_availability( $availability, $product ) {
	$stock = $product->get_stock_quantity();
	if ( $product->is_in_stock() && $product->managing_stock() ) $availability = __( $stock . ' Vagas', 'abcoffe' );
	return $availability;
}
add_filter( 'woocommerce_get_availability_text', 'wcs_custom_get_availability', 1, 2);
?>