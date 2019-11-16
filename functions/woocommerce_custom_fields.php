<?php
    function the_custom_fields(){
        return array(
            'custom_text_subtitle' => array(
                'id' => 'custom_text_subtitle',
                'label' => __( 'Sub-title', 'abcoffee' ),
                'class' => 'abcoffee-custom-field',
                'desc_tip' => true,
                'description' => __( 'If this product is a course or a workshop, type the teacher name here', 'abcoffee' )
            ),
            'custom_text_hour' => array(
                'id' => 'custom_text_hour',
                'label' => __( 'Hour', 'abcoffee' ),
                'class' => 'abcoffee-custom-field',
                'desc_tip' => true,
                'description' => __( '2 Horas', 'abcoffee' ),
            ),
            // 'custom_text_starting_date' => array(
            //     'id' => 'custom_text_starting_date',
            //     'label' => __( 'Starting date', 'abcoffee' ),
            //     'class' => 'abcoffee-custom-field abcoffee-custom-field-date',
            //     'desc_tip' => true,
            //     'description' => __( 'If this product is a course or a workshop, add starting date here', 'abcoffee' ),
            // ),
            // 'custom_text_ending_date' => array(
            //     'id' => 'custom_text_ending_date',
            //     'label' => __( 'Ending date', 'abcoffee' ),
            //     'class' => 'abcoffee-custom-field abcoffee-custom-field-date',
            //     'desc_tip' => true,
            //     'description' => __( 'If this product is a course or a workshop, add ending date here.', 'abcoffee' ),
            // ),
        );
    }
    function abcoffee_woocommerce_add_custom_fields(){
        foreach(the_custom_fields() as $key => $args){
            woocommerce_wp_text_input( $args );
        }
    }
    function abcoffee_save_custom_field( $post_id ){
        $product = wc_get_product( $post_id );
        foreach(the_custom_fields() as $key => $args){
            $title = isset( $_POST[$args["id"]] ) ? $_POST[$args["id"]] : '';
            $product->update_meta_data( $args["id"], sanitize_text_field( $title ) );
        }
        $product->save();
    }
    function abcoffee_display_custom_field(){
        global $post;
        // Check for the custom field value
        $product = wc_get_product( $post->ID );
        printf('<div class="abcoffee-custom-field-wrapper">');
        foreach(the_custom_fields() as $key => $args){
            $title = $product->get_meta( $args["id"] );
            if( $title ){
                printf('<div class="abcoffee-custom-field"><strong>'. $args["label"] .'</strong><br>%s</div>', esc_html( $title ));
            }
        }
        printf('</div>');
    }

    if ( class_exists( 'WooCommerce' ) ) {
        add_action( 'woocommerce_product_options_general_product_data', 'abcoffee_woocommerce_add_custom_fields' );
        add_action( 'woocommerce_process_product_meta', 'abcoffee_save_custom_field' );
        //add_action( 'woocommerce_before_add_to_cart_button', 'abcoffee_display_custom_field' );
    }
?>