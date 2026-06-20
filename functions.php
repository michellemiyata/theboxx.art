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
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css', array(), '6.4.0' );

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

/**
 * Register Custom Post Types for Exhibitions and Artists
 */
function theboxx_register_post_types() {
    // Exhibition Post Type
    register_post_type( 'exhibition', array(
        'labels' => array(
            'name'               => __( 'Exhibitions', 'theboxx' ),
            'singular_name'      => __( 'Exhibition', 'theboxx' ),
            'add_new'            => __( 'Add New Exhibition', 'theboxx' ),
            'add_new_item'       => __( 'Add New Exhibition', 'theboxx' ),
            'edit_item'          => __( 'Edit Exhibition', 'theboxx' ),
            'new_item'           => __( 'New Exhibition', 'theboxx' ),
            'view_item'          => __( 'View Exhibition', 'theboxx' ),
            'search_items'       => __( 'Search Exhibitions', 'theboxx' ),
            'not_found'          => __( 'No Exhibitions Found', 'theboxx' ),
            'not_found_in_trash' => __( 'No Exhibitions Found in Trash', 'theboxx' ),
        ),
        'public'              => true,
        'has_archive'         => true,
        'menu_icon'           => 'dashicons-art',
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite'             => array( 'slug' => 'exhibitions' ),
        'show_in_rest'        => true,
    ) );

    // Artist Post Type
    register_post_type( 'artist', array(
        'labels' => array(
            'name'               => __( 'Artists', 'theboxx' ),
            'singular_name'      => __( 'Artist', 'theboxx' ),
            'add_new'            => __( 'Add New Artist', 'theboxx' ),
            'add_new_item'       => __( 'Add New Artist', 'theboxx' ),
            'edit_item'          => __( 'Edit Artist', 'theboxx' ),
            'new_item'           => __( 'New Artist', 'theboxx' ),
            'view_item'          => __( 'View Artist', 'theboxx' ),
            'search_items'       => __( 'Search Artists', 'theboxx' ),
            'not_found'          => __( 'No Artists Found', 'theboxx' ),
            'not_found_in_trash' => __( 'No Artists Found in Trash', 'theboxx' ),
        ),
        'public'              => true,
        'has_archive'         => true,
        'menu_icon'           => 'dashicons-admin-users',
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite'             => array( 'slug' => 'artists' ),
        'show_in_rest'        => true,
    ) );

    // Artwork Post Type
    register_post_type( 'artwork', array(
        'labels' => array(
            'name'               => __( 'Artworks', 'theboxx' ),
            'singular_name'      => __( 'Artwork', 'theboxx' ),
            'add_new'            => __( 'Add New Artwork', 'theboxx' ),
            'add_new_item'       => __( 'Add New Artwork', 'theboxx' ),
            'edit_item'          => __( 'Edit Artwork', 'theboxx' ),
            'new_item'           => __( 'New Artwork', 'theboxx' ),
            'view_item'          => __( 'View Artwork', 'theboxx' ),
            'search_items'       => __( 'Search Artworks', 'theboxx' ),
            'not_found'          => __( 'No Artworks Found', 'theboxx' ),
            'not_found_in_trash' => __( 'No Artworks Found in Trash', 'theboxx' ),
        ),
        'public'              => true,
        'has_archive'         => false,
        'menu_icon'           => 'dashicons-format-image',
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'        => true,
    ) );
}
add_action( 'init', 'theboxx_register_post_types' );
