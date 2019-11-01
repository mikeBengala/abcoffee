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
?>