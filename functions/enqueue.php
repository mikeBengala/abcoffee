<?php
//properly Loads css and js files on wordpress site head
function abcoffee_enqueue() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'niceselect', get_stylesheet_directory_uri() . '/css/nice-select.css');
    wp_enqueue_style( 'fullcalendar', get_stylesheet_directory_uri() . '/css/fullcalendar.css');

    wp_enqueue_script( 'niceselect', get_stylesheet_directory_uri() . '/js/jquery.nice-select.min.js', array("jquery"));
    wp_enqueue_script( 'moment', get_stylesheet_directory_uri() . '/js/moment.min.js');
    wp_enqueue_script( 'popper', get_stylesheet_directory_uri() . '/js/popper.min.js', array("jquery"));
    wp_enqueue_script( 'tooltip', get_stylesheet_directory_uri() . '/js/tooltip.min.js', array("jquery"));
    wp_enqueue_script( 'fullcalendar', get_stylesheet_directory_uri() . '/js/fullcalendar.min.js', array("jquery", "moment", 'popper'));

    wp_enqueue_script( 'abccoffee_calendar', get_stylesheet_directory_uri() . '/js/abcoffee_calendar.js', array('fullcalendar'));
}
add_action( 'wp_enqueue_scripts', 'abcoffee_enqueue' );


//loads css and js files on wordpress backoffice pages
function abcoffee_admin_enqueue(){
    wp_enqueue_style( 'abccoffee_admin_style', get_stylesheet_directory_uri() . '/css/admin_style.css' );
    wp_enqueue_script('abccoffee_admin_script', get_stylesheet_directory_uri() . '/js/backoffice_script.js');
}
add_action('admin_enqueue_scripts', 'abcoffee_admin_enqueue');
?>