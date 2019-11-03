<div class="courses_loop_wrap">
    <?php if(!empty($products)){?>

        <?php foreach($products as $product){?>

            <a href="<?=$product["the_permalink"]?>" class="course course_id_<?=$product["id"]?>">
                    <div class="course_header">
                         
                        <?php if($product["picture_url"] != false){?>
                            <div class="course_image">
                                <img src="<?=$product["picture_url"]?>" alt ="">
                            </div>
                        <?php }?>

                        <div class="course_title_info <?=($product["picture_url"]?"has_image":"no_image")?>">
                            <h2><?=$product["title"];?></h2>
                            <?php if(!empty($product["subtitle"]) && $product["subtitle"] != ""){ ?>
                                <p><?=$product["subtitle"]?></p>
                            <?php }?>
                        </div>
                    </div>
                    <div class="course_description">
                        <div class="course_content">
                            <?=$product["excerpt"];?>
                        </div>
                        <div class="course_levels">
                            <?php if(!empty($product["variations_countaining_dates"])){ ?>
                                
                                <?php foreach($product["variations_countaining_dates"] as $variation){?>
                                    <div class="level">
                                        <div class="level_image_wrap">
                                            <img src="<?=$variation["image"]?>">
                                        </div>
                                        <div class="level_description"><span class="designation"><span class="translatable_term_label"><?=$variation["term_label"]?></span> · <?=$variation["variation_description"]?></span><span class="value"><?=$variation["display_regular_price"]?>€</span></div>
                                    </div>
                                <?php }?>
                                <?php //var_dump($product["variations_without_dates"]);?>



                            <?php }else{?>
                                <div class="course_levels">
                                    <div class="level">
                                        <div class="level_image_wrap">
                                            <img src="<?=get_stylesheet_directory_uri()?>/img/img_icn_coffe_level_3.svg">
                                        </div>
                                        <div class="level_description"><span class="designation"><?=$product["time"]?></span> ·<span class="value"><?=wc_price($product["price"])?></span></div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </a>

        <?php }?>

    <?php }else{?>

        <h2><?php echo __( 'No products found', "abccoffee" );?></h2>

    <?php }?>
</div>