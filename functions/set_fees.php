<?php
function woocommerce_custom_fee( ) {

	if ( ( is_admin() && ! defined( 'DOING_AJAX' ) ) || ! is_checkout() )
		return;

	$chosen_gateway = WC()->session->chosen_payment_method;
    $cart_total = WC()->cart->cart_contents_total;

    switch ($chosen_gateway) {
		case 'bacs':
			$fee = 3.4 * $cart_total / 100 + 0.35;
			WC()->cart->add_fee( 'Despesa de transação teste', $fee, false, '' );
			break;
        default:
            $fee = 0;
            break;
    }
}
add_action( 'woocommerce_cart_calculate_fees','woocommerce_custom_fee' );

function cart_update_script() {
    if (is_checkout()) :
    ?>
    <script>
		jQuery( function( $ ) {

			// woocommerce_params is required to continue, ensure the object exists
			if ( typeof woocommerce_params === 'undefined' ) {
				return false;
			}

			$checkout_form = $( 'form.checkout' );

			$checkout_form.on( 'change', 'input[name="payment_method"]', function() {
					$checkout_form.trigger( 'update' );
			});


		});
    </script>
    <?php
    endif;
}
add_action( 'wp_footer', 'cart_update_script', 999 );
?>