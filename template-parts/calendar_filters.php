<div class="calendar_filters_wrap">

    <?php //categories --------------------------> ?>
    <select id="calendar_cat_filter">
    	<option value="all">Todas as categorias</option>
        <?php foreach($calendar_arr["all_cats"] as $cat){?>
            <option value="<?=$cat["slug"]?>"><?=$cat["name"]?></option>
        <?php }?>
    </select>
    <?php //end categories ----------------------> ?>

    <?php //levels ------------------------------> ?>
    <select id="calendar_level_filter">
    	<option value="all">Todos os Níveis</option>
        <?php foreach($calendar_arr["all_levels"] as $level){?>
            <option value="<?=$level?>"><?=$level?></option>
        <?php }?>
    </select>
    <?php //end levels ----------------------> ?>

    <?php //tags ------------------------------> ?>
    <select id="calendar_tags_filter">
        <option value="all">Todos os Tipos</option>
        <?php foreach($calendar_arr["all_tags"] as $tag){?>
            <option value="<?=$tag["slug"]?>"><?=$tag["name"]?></option>
        <?php }?>
    </select>
    <?php //end categories ----------------------> ?>
    
</div>