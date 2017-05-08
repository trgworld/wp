<?php
    /* REMOVE JUNK LINKS */
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

    /* REMOVE TOOLBAR FROM FRONT-END */
    add_filter('show_admin_bar', '__return_false');

    /* ADD THEME SUPPORTS */
    if ( ! function_exists( 'jbs_setup' ) ) {
        function jbs_setup(){
            add_theme_support('title-tag');
            add_theme_support('post-thumbnails');
            register_nav_menus( array(
                'primary' => __( 'Primary Menu', 'jbs' ),
                'footer' => __( 'Footer Menu', 'jbs' )
            ) );
            add_theme_support( 'html5', array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ) );
            if ( function_exists( 'add_theme_support' ) ) {
                add_image_size( 'custom_small_50', 50, 50, true );
                add_image_size( 'custom_small_80', 80, 80, true );
                add_image_size( 'custom_small_150', 150, 150, true );
                add_image_size( 'custom_medium_300', 300, 300, true );
                add_image_size( 'custom_medium_500', 500, 500, true );
                add_image_size( 'custom_large_768', 768, 576, true );
                add_image_size( 'custom_large_1024', 1024, 768, true );
            }
            add_post_type_support( 'page', 'excerpt' );
            add_post_type_support( 'post', 'excerpt' );
        }
    }
    add_action( 'after_setup_theme', 'jbs_setup' );
?>