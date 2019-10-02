<?php
function wcs_custom_get_availability( $availability, $_product ) {
    
    // Change In Stock Text
    if ( $_product->is_in_stock() ) {
        $availability['availability'] = __('Vacancies', 'abcoffee');
    }
    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
        $availability['availability'] = __('Sold Out', 'abcoffee');
    }
    return $availability;
}
add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
?>