<?php
//properly Loads css and js files on wordpress site head
function abcoffee_enqueue() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'niceselect', get_stylesheet_directory_uri() . '/css/nice-select.css');
    wp_enqueue_style( 'fullcalendar', get_stylesheet_directory_uri() . '/css/fullcalendar.css');

    wp_enqueue_script( 'niceselect', get_stylesheet_directory_uri() . '/js/jquery.nice-select.min.js', array("jquery"));
    // wp_enqueue_script( 'moment', get_stylesheet_directory_uri() . '/js/moment.min.js');
    wp_enqueue_script( 'moment', 'http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js');
    wp_enqueue_script( 'jquery-ui', 'http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js', array("jquery"));
    wp_enqueue_script( 'popper', get_stylesheet_directory_uri() . '/js/popper.min.js', array("jquery"));
    wp_enqueue_script( 'tooltip', get_stylesheet_directory_uri() . '/js/tooltip.min.js', array("jquery"));
    wp_enqueue_script( 'fullcalendar', get_stylesheet_directory_uri() . '/js/fullcalendar.min.js', array("jquery", "moment", 'popper'));
    // wp_enqueue_script( 'fullcalendar', 'http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js', array("jquery", "moment", 'popper'));
    wp_enqueue_script( 'fullcalendar_all_lang', get_stylesheet_directory_uri() . '/js/locales-all.min.js', array('fullcalendar'));


    wp_enqueue_script( 'abccoffee', get_stylesheet_directory_uri() . '/js/abcoffee.js', array('fullcalendar'));
}
add_action( 'wp_enqueue_scripts', 'abcoffee_enqueue' );


//loads css and js files on wordpress backoffice pages
function abcoffee_admin_enqueue(){
    wp_enqueue_style( 'abccoffee_admin_style', get_stylesheet_directory_uri() . '/css/admin_style.css' );
    wp_enqueue_script('abccoffee_admin_script', get_stylesheet_directory_uri() . '/js/backoffice_script.js');
}
add_action('admin_enqueue_scripts', 'abcoffee_admin_enqueue');
?>