<?php
add_filter('woocommerce_billing_fields', 'custom_woocommerce_billing_fields');
function custom_woocommerce_billing_fields($fields){
	$label = "VAT number";
	if(pll_current_language() == 'pt') {
		$label = "NIF";
	}
    $fields['billing_options'] = array(
        'label' => $label, // Add custom field label
        'required' => false, // if field is required or not
        'clear' => false, // add clear or not
        'type' => 'text', // add field type
        'class' => array('my-css')    // add class name
    );
    return $fields;
}

add_filter( 'woocommerce_billing_fields', 'wc_optional_billing_fields', 10, 1 );
function wc_optional_billing_fields( $billing_fields ) {
    
    $billing_fields['billing_country']['required'] = false;
    $billing_fields["billing_address_1"]['required'] = false;
    $billing_fields["billing_city"]['required'] = false;
    $billing_fields["billing_postcode"]['required'] = false;
    // var_dump($billing_fields);
    return $billing_fields;
}

add_filter( 'woocommerce_checkout_fields' , 'bbloomer_remove_billing_postcode_checkout' );
 
function bbloomer_remove_billing_postcode_checkout( $fields ) {
  unset($fields['billing']['billing_postcode']);
  return $fields;
}
?>