
<?php
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $a["posts_per_page"],
        'tax_query' => array( array(
            'taxonomy'         => 'product_cat',
            'field'            => 'slug', // Or 'term_id' or 'name'
            'terms'            => $a['category'], // A slug term
            // 'include_children' => false // or true (optional)
        )),
    );
    $loop = new WP_Query( $args );
?>
<?php if ( $loop->have_posts() ) { ?>

<div class="courses_loop_wrap">
    <?php while ( $loop->have_posts() ){?>
        <?php
            $loop->the_post();
            $product = wc_get_product();
            $id = $product->get_id();
            
            if(has_post_thumbnail()){
               $picture_url = get_the_post_thumbnail_url();
            }
            $variations = $product->get_available_variations();
            $price = get_post_meta( $id, '_price', true );
            $subtitle = get_post_meta( $id, "custom_text_subtitle", true );
            $atribute_name = "attribute_pa_degree-of-difficulty";
            $used_variations_checker = array();
            $the_permalink = get_the_permalink();
        ?>
        <a href="<?=$the_permalink?>" class="course">
            <div class="course_header">
                 
                <?php if(has_post_thumbnail()){?>
                    <div class="course_image">
                        <img src="<?=get_the_post_thumbnail_url()?>" alt ="">
                    </div>
                <?php }?>

                <div class="course_title_info <?=(has_post_thumbnail()?"has_image":"no_image")?>">
                    <h2><?php the_title();?></h2>
                    <?php if(!empty($subtitle) && $subtitle != ""){ ?>
                        <p><?=$subtitle?></p>
                    <?php }?>
                </div>
            </div>
            <div class="course_description">
                <div class="course_content">
                    <?php the_excerpt();?>
                </div>
                
                <?php if(isset($variations[0]["attributes"][$atribute_name])){ ?>
                    
                    <div class="course_levels">
                        <?php $count = 0;?>
                        <?php foreach($variations as $variation){?>
                            
                            <?php //verify if variation already is displayed to avoid repetitions
                                $is_variation_in_use = false;
                                foreach($used_variations_checker as $used_variation){
                                    if($used_variation == $variation["attributes"][$atribute_name]){
                                        $is_variation_in_use = true;
                                    }
                                }
                            ?>
                            <?php if($is_variation_in_use == false){?>
                                <div class="level">
                                    <div class="level_image_wrap">
                                        <img src="<?=$variation["image"]["url"]?>">
                                    </div>
                                    <div class="level_description"><span class="designation"><?=$variation["attributes"][$atribute_name]?> · <?=$variation["variation_description"]?></span><span class="value"><?=$variation["display_regular_price"]?>€</span></div>
                                </div>
                                <?php array_push($used_variations_checker, $variation["attributes"][$atribute_name]);?>
                            <?php }?>
                        <?php }?>
                    </div>

                <?php }else{?>
                    <div class="course_levels">
                        <div class="level">
                            <div class="level_description"><span class="value"><?=wc_price($price)?></span></div>
                        </div>
                    </div>
                <?php }?>
                
            </div>
        </a>


    <?php }?>
</div>

<?php
    } else {
        echo __( 'No products found' );
    }
    wp_reset_postdata();
    ?>