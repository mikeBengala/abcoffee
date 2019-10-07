<?php
$all_cats_string = "Every Category";
$all_levels_string = "Every Level";
$all_tags_string = "Every Type";
if(pll_current_language() == 'pt') {
    $all_cats_string = "Todas as categorias";
    $all_levels_string = "Todos os Níveis";
    $all_tags_string = "Todos os Tipos";
}
?>
<div class="calendar_filters_wrap">

    <?php //categories --------------------------> ?>
    <select id="calendar_cat_filter">
    	<option value="all"><?=$all_cats_string?></option>
        <?php foreach($calendar_arr["all_cats"] as $cat){?>
            <option value="<?=$cat["slug"]?>"><?=$cat["name"]?></option>
        <?php }?>
    </select>
    <?php //end categories ----------------------> ?>

    <?php //levels ------------------------------> ?>
    <select id="calendar_level_filter">
    	<option value="all"><?=$all_levels_string?></option>
        <?php foreach($calendar_arr["all_levels"] as $level){?>
            <option value="<?=$level?>"><?=$level?></option>
        <?php }?>
    </select>
    <?php //end levels ----------------------> ?>

    <?php //tags ------------------------------> ?>
    <select id="calendar_tags_filter">
        <option value="all" data-background="#ffffff"><?=$all_tags_string?></option>
        <?php foreach($calendar_arr["all_tags"] as $tag){?>
            <option value="<?=$tag["slug"]?>" data-background="#<?=$tag["color"]?>"><?=$tag["name"]?></option>
        <?php }?>
    </select>
    <?php //end categories ----------------------> ?>
    
</div>