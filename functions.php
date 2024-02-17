<?php

/*
 * Adding bootstrap CSS/JS
 */
function reg_scripts() {
    wp_enqueue_style( 'bootstrapstyle', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrapthemestyle', get_template_directory_uri() . '/css/bootstrap-theme.min.css' );
    wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array(), true );
}
add_action('wp_enqueue_scripts', 'reg_scripts');

/*
 * Registering Menu
 */
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
            'main-menu'   => 'Main Navigation Menu'
        )
    );
}

