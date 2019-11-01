<?php
function custom_shop_page_redirect() {
    if( is_shop() ){
        wp_redirect( home_url( '/calendario/' ) );
        exit();
    }
}
add_action( 'template_redirect', 'custom_shop_page_redirect' );
?>