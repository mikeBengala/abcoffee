<?php
function get_woo_products_loop($cat = 'Uncategorized', $posts_per_page = -1, $atribute_name = "attribute_pa_degree-of-difficulty"){
	$args = array(
        'post_type' => 'product',
        'posts_per_page' => $posts_per_page,
        'tax_query' => array( array(
            'taxonomy'         => 'product_cat',
            'field'            => 'slug',
            'terms'            => $cat,
        )),
    );
    $loop = new WP_Query( $args );
    $products = array();


    if ( $loop->have_posts() ) {
    	while ( $loop->have_posts() ){

    		$loop->the_post();
            $product = wc_get_product();
            $id = $product->get_id();
            
            $picture_url = false;
            if(has_post_thumbnail()){
               $picture_url = get_the_post_thumbnail_url();
            }
            $title = get_the_title();
            $excerpt = get_the_excerpt();
            $price = get_post_meta( $id, '_price', true );
            $subtitle = get_post_meta( $id, "custom_text_subtitle", true );
            $custom_text_hour = get_post_meta( $id, "custom_text_hour", true );
            $the_permalink = get_the_permalink();
            $variations_countaining_dates = array();
            $variations_without_dates = array();
            $time = "";

            if($product->is_type( 'variable' )){

            	$variations = $product->get_available_variations();
            	foreach($variations as $variation){

            		$is_variation_in_use = false;
                    $term_label = "";

                    if(isset($variation["attributes"][$atribute_name])){
                        $terms = get_terms( array('slug' => $variation["attributes"][$atribute_name]) );
                        $term_label = $terms[0]->name;

                        $this_variation_arr = array(
                        	"image" => $variation["image"]["url"],
                        	"term_label" => $term_label,
                        	"variation_description" => $variation["variation_description"],
                        	"display_regular_price" => $variation["display_regular_price"]
                        );

                        $variation_has_valid_date = false;
                        
                        if(isset($variation["attributes"]["attribute_date"])){
                            $this_variation_arr["date"] = $variation["attributes"]["attribute_date"];
                            $first_date = substr($variation["attributes"]["attribute_date"], 0, 10);

                            if(validateDate($first_date)){
                                $variation_has_valid_date = true;
                            }
                        }
                        if(isset($variation["attributes"]["attribute_data"])){
                            $this_variation_arr["date"] = $variation["attributes"]["attribute_data"];
                            $first_date = substr($variation["attributes"]["attribute_data"], 0, 10);

                            if(validateDate($first_date)){
                                $variation_has_valid_date = true;
                            }
                        }
                        

                        if($variation_has_valid_date){
                            array_push($variations_countaining_dates, $this_variation_arr);
                        }else{
                            array_push($variations_without_dates, $this_variation_arr);
                        }  
                        
                    }else if(isset($variation["attributes"]["attribute_time"])){
                        $time = $variation["attributes"]["attribute_time"];
                    }


            	}

            }
            $unique_variations_countaining_dates = unique_multidim_array($variations_countaining_dates, "term_label");
            $unique_variations_without_dates = unique_multidim_array($variations_without_dates, "term_label");
            $product = array(
            	"the_permalink" => $the_permalink,
            	"id" => $id,
            	"picture_url" => $picture_url,
            	"title" => $title,
            	"subtitle" => $subtitle,
                "hour" => $custom_text_hour,
            	"excerpt" => $excerpt,
            	"price" => $price,
            	"the_permalink" => $the_permalink,
            	"variations_countaining_dates" => $unique_variations_countaining_dates,
            	"variations_without_dates" => $unique_variations_without_dates,
                "time" => $time
            );
            array_push($products, $product);
    	}
    }
    return $products;
}
?>