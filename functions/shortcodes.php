<?php
function cursos_shortcode($atts){
    $a = shortcode_atts( array(
		'category' => 'Uncategorized',
		'posts_per_page' => -1,
	), $atts );
    ob_start();
    set_query_var( 'a', $a );
    get_template_part( 'template-parts/courses_loop' );
    return ob_get_clean();
    return '<p style="text-align:center;">Cursos go here</p>';
}
add_shortcode("cursos", "cursos_shortcode");

function calendar_shortcode(){
    $calendar_arr = abcoffee_get_the_calendar_arr();
    ob_start();
    set_query_var( 'calendar_arr', $calendar_arr );
    get_template_part( 'template-parts/calendar_filters' );
    get_template_part( 'template-parts/calendar_view' );
    return ob_get_clean();
}
add_shortcode("calendario", "calendar_shortcode");

function get_current_product_variations(){
    // ob_start();
    // get_template_part( 'template-parts/variations' );
    // return ob_get_clean();
    return '<p style="text-align:center;">Variation product comming soon</p>';
}
add_shortcode("get_variations", "get_current_product_variations");
?>