<?php
/**
 * The Boxx Custom Theme Functions
 */

if ( ! function_exists( 'theboxx_setup' ) ) {
    function theboxx_setup() {
        // Enforce title tag support (so WordPress manages the <title> dynamically)
        add_theme_support( 'title-tag' );

        // Support Featured Images (thumbnails)
        add_theme_support( 'post-thumbnails' );

        // Support custom logo upload in WordPress Customizer
        add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'width'       => 200,
            'flex-width'  => true,
            'flex-height' => true,
        ) );

        // Register main navigation menu
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'theboxx' ),
        ) );
    }
}
add_action( 'after_setup_theme', 'theboxx_setup' );

/**
 * Enqueue scripts and styles
 */
function theboxx_scripts() {
    // Prevent loading theme script and styles inside Bricks Builder editor UI
    if ( function_exists( 'bricks_is_builder_main' ) && bricks_is_builder_main() ) {
        return;
    }

    // Google Fonts: Roboto
    wp_enqueue_style( 'theboxx-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap', array(), null );

    // FontAwesome Icons
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

    // Main stylesheet (declares dependency on bricks-frontend if available)
    $deps = array( 'theboxx-fonts', 'font-awesome' );
    if ( wp_style_is( 'bricks-frontend', 'registered' ) ) {
        $deps[] = 'bricks-frontend';
    }

    wp_enqueue_style( 'theboxx-style', get_stylesheet_uri(), $deps, '1.1.0' );

    // Main script file
    wp_enqueue_script( 'theboxx-script', get_stylesheet_directory_uri() . '/script.js', array(), '1.1.0', true );
}
add_action( 'wp_enqueue_scripts', 'theboxx_scripts' );
