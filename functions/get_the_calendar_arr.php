<?php
function get_the_calendar_arr(){
	$args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
    );
    $loop = new WP_Query( $args );
    $all_dates = array();
	$all_cats = array();
    $all_tags = array();
    $all_levels = array();
    $products = array();
    $index = 0;
    if ( $loop->have_posts() ) {

    	//product start here
    	while ( $loop->have_posts() ){
    		$loop->the_post();
	        $product = wc_get_product();

	        if ( $product->is_type( 'variable' ) ) {


	            
	            $variations = $product->get_available_variations();
            	foreach($variations as $variation){

                    $atribute_name = "attribute_data";
                    
                    if(isset($variation["attributes"]["attribute_date"])){
                        $atribute_name = "attribute_date";    
                    }else if(isset($variation["attributes"]["attribute_data"])){
                        $atribute_name = "attribute_data";
                    }
                    
            		if(isset($variation["attributes"][$atribute_name]) && $variation["attributes"][$atribute_name] != ""){
                        array_push($all_dates, $variation["attributes"][$atribute_name]);

            			$id = $product->get_id();
                        $title = get_the_title();
                        $subtitle = get_post_meta( $id, "custom_text_subtitle", true );
                        $content = get_the_excerpt();
                        $the_permalink = get_the_permalink();
                        $variation_id = $variation["variation_id"];
                        

                        //availability
                        $availability = "";
                        if(isset($variation["availability_html"])){
                            $availability = $variation["availability_html"];
                        }
                        //end availability
                        

                        //description
                        $description = $variation["variation_description"];
                        //end description

                        //level
                        $level_array = array(
                                "value" => "",
                                "label" => ""
                            );
                        if(isset($variation["attributes"]["attribute_pa_degree-of-difficulty"])){
                            $level = $variation["attributes"]["attribute_pa_degree-of-difficulty"];
                            $terms = get_terms( array('slug' => $level) );
                            $term_label = $terms[0]->name;
                            
                            if(pll_current_language() == 'pt') {
                                $term_label = translate_course_level_to_pt($term_label);
                            }

                            $level_array = array(
                                "value" => $level,
                                "label" => $term_label
                            );
                            array_push($all_levels, $level_array);
                        }

                        //end level

                        //date
                        $date = $variation["attributes"][$atribute_name];

                        $variation_add_to_cart_href = get_site_url() . "/cart/?add-to-cart=" . $id . "&variation_id=" . $variation_id . "&attribute_date=" . $date;
                        
                        if(strpos($date, ' ') !== false){
                            $date = explode(" ", $date);
                            $date_array_count = count($date) - 1;
                            $start_date = $date[0];
                            $end_date = $date[$date_array_count];
                        }else{
                            $start_date = $date;
                            $end_date = false;
                        }
                        //end date

                        //picture
                        $picture_url = get_stylesheet_directory_uri() . "/img/icn_book.svg";
                        if(has_post_thumbnail()){
                            $picture_url = get_the_post_thumbnail_url();
                        }
                        //end_picture

                        //get categories
                        $on_cat = "";
                        $terms = get_the_terms( $id, 'product_cat' );
                        if ( $terms && ! is_wp_error( $terms ) ) {
                            $cat_links = array();
                            foreach ( $terms as $term ) {
                                $cat_links[] = $term->slug;
								$this_cat = array(
									"slug" => $term->slug,
									"name" => $term->name
								);
								array_push($all_cats, $this_cat);
                            }
                            
                            $on_cat = implode( " ", $cat_links );
                            
                        }
                        //end get categories

                        //get tags
                        $on_tag = "";
                        $color = "#ffffff";
                        $terms = get_the_terms( $id, 'product_tag' );
                        if ( $terms && ! is_wp_error( $terms ) ) {
                            $tag_links = array();
                            foreach ( $terms as $term ) {
                                if(get_term_meta($term->term_id, "cc_color", true) != ""){
                                   $color = get_term_meta($term->term_id, "cc_color", true);
                                }
                                $tag_links[] = $term->slug;
                                $this_tag = array(
                                    "slug" => $term->slug,
                                    "name" => $term->name,
                                    "color" => $color
                                );
                                array_push($all_tags, $this_tag);
                            }
                            
                            $on_tag = implode( " ", $tag_links );
                            
                        }
                        //end get categories

                        //setup product array
                        $this_product = array(
                            "id" => $id,
                            "title" => $title,
                            "subtitle" => $subtitle,
                            "content" => $content,
                            "description" => $description,
                            "permalink" => $the_permalink,
                            "image" => $picture_url,
                            "start_date" => $start_date,
                            "end_date" => $end_date,
                            "categories" => $on_cat,
                            "tags" => $on_tag,
                            "level" => $level_array,
                            "index" => $index,
                            "availability" => $availability,
                            "variation_add_to_cart_href" => $variation_add_to_cart_href,
                            "color" => $color,
                            "price" => $variation["display_price"]
                        );
                        array_push($products, $this_product);
                        $index++;
                        //end setup product array
            		}
            	}
	        }
    	}
    	//product_end_here
        $all_dates = '["' . implode('" , "' , $all_dates) . '"]';
		$all_cats = unique_multidim_array($all_cats,'slug');
        $all_tags = unique_multidim_array($all_tags,'slug');
        $all_levels = unique_multidim_array($all_levels, 'value');
    	$response = array(
			"all_cats" => $all_cats,
            "all_tags" => $all_tags,
            "all_levels" => $all_levels,
    		"all_available_dates" => $all_dates,
    		"products" => $products
    	);

    }else{
    	$response = "no products";
    }
    return $response;
}
?>