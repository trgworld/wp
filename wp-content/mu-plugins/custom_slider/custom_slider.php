<?php
    /**
    * Plugin Name: Custom Slider
    * Author: Farazulhaq
    * Description: Use the short code to add the dynamic slider in your theme template (e.g: [slider cat_id="2" type="slider" no_of_slides="6"]).
    * If you want to over write the markup of these templates then you just need to add the same folder hierarchy and place your custom files with same name.
    * e.g: your_theme/custom_slider/views/view.slider.php OR your_theme/custom_slider/views/view.carousal.php
    **/


    /**
    * create custom post type for slider and add custom taxonomy into it.
    **/
    add_action( 'init', function(){
        $params_post_type['label'] = 'Slider';
        $params_post_type['text_domain'] = 'custom_slider';
        $params_post_type['slug'] = 'slider';
        $params_post_type['menu_icon'] = 'dashicons-slides';
        $params_post_type['supports'] = ['title', 'thumbnail'];
        createPostType($params_post_type);
        $params_category['label'] = 'Slider Category';
        $params_category['slug'] = 'slider-cat';
        $params_category['post_type'] = $params_post_type['slug'];
        createTaxonomy($params_category);
    } );


    /**
    * add columns to slider post type
    **/
    add_filter('manage_posts_columns', function($defaults) {
        $defaults['slider_image'] = 'Slider Image';
        return $defaults;
    });
    add_action('manage_posts_custom_column', function($column_name, $post_ID) {
        if ($column_name == 'slider_image') {
            $post_thumbnail_id = get_post_thumbnail_id($post_ID);
            if ($post_thumbnail_id) {
                $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
                $post_featured_image = $post_thumbnail_img[0];
                if ($post_featured_image) {
                    echo '<img src="' . $post_featured_image . '" alt="" />';
                } else{
                    echo ' -- ';
                }
            } else{
                echo ' -- ';
            }
        }
    }, 10, 2);


    /**
    * change featured image text
    **/
    add_action('do_meta_boxes', function(){
        remove_meta_box( 'postimagediv', 'slider', 'side' );
        add_meta_box('postimagediv', __('Slider Image'), 'post_thumbnail_meta_box', 'slider', 'side', 'low');
    });
    add_filter( 'admin_post_thumbnail_html', function ( $content ) {
        if ( 'slider' === get_post_type() ) {
            $content = str_replace( 'Set featured image', __( 'Set slider image', 'km' ), $content );
            $content = str_replace( 'Remove featured image', __( 'Remove slider image', 'km' ), $content );
        }
        return $content;
    } );


    /**
    * add custom styles for slider's post type
    **/
    function admin_styles() {
        wp_enqueue_style( 'cs_custom_style', WPMU_PLUGIN_URL . '/custom_slider/css/custom-style.css' );
    }
    add_action( 'admin_enqueue_scripts', 'admin_styles' );



    /**
    * add custom styles for slider's front end
    **/
    function slick_slider() {
        wp_enqueue_style( 'slick_theme_style', WPMU_PLUGIN_URL . '/custom_slider/css/slick-theme.css' );
        wp_enqueue_style( 'slick_style', WPMU_PLUGIN_URL . '/custom_slider/css/slick.css' );

        wp_enqueue_script( 'slick_script', WPMU_PLUGIN_URL . '/custom_slider/js/slick.min.js', array('jquery'), false, true );
        wp_enqueue_script( 'cs_custom_script', WPMU_PLUGIN_URL . '/custom_slider/js/custom-script.js', array(), false, true );
    }
    add_action( 'wp_enqueue_scripts', 'slick_slider' );


    /**
    * add meta box for slider post type which create multiple custom fields
    **/
    function slider_metadata(){
        global $post;
        $slidermeta = get_post_meta($post->ID);
        require_once WPMU_PLUGIN_DIR . '/custom_slider/views/metadata.php';
    }
    add_action('admin_menu', function(){
        add_meta_box('slider_metadata', 'Metadata', 'slider_metadata', 'slider');
    });


    /**
    * save meta fields
    **/
    function save_post_custom_fields( $post_id ) {
        if( isset($_POST['slider_subtitle']) ){
            update_post_meta($post_id, 'slider_subtitle', $_POST['slider_subtitle']);
        }
        if( isset($_POST['slider_description']) ){
            update_post_meta($post_id, 'slider_description', $_POST['slider_description']);
        }
        if( isset($_POST['slider_btn_text']) ){
            update_post_meta($post_id, 'slider_btn_text', $_POST['slider_btn_text']);
        }
        if( isset($_POST['slider_btn_link']) ){
            update_post_meta($post_id, 'slider_btn_link', $_POST['slider_btn_link']);
        }
    }
    add_action( 'save_post', 'save_post_custom_fields' );


    /**
    * shortcode for slider according to category and type
    * it takes two arguments
    *   1- slider category's id
    *   2- slider type(e.g: slider, carousal, etc...)
    **/
    function sliderShortcode($atts = []) {
        $defaults_array['cat_id'] = 0;
        $defaults_array['type'] = 'slider';
        $defaults_array['no_of_slides'] = 5;
        $slider_attr = shortcode_atts( $defaults_array, $atts );
        $args['posts_per_page'] = $slider_attr['no_of_slides'];
        $args['post_type'] = 'slider';
        $args['post_status'] = 'publish';
        if( $slider_attr['cat_id'] > 0 && is_numeric($slider_attr['cat_id']) && !empty($slider_attr['cat_id']) ){
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'slider-cat',
                    'field' => 'term_id',
                    'terms' => $slider_attr['cat_id']
                )
            );
        }
        $slides = get_posts($args);
        ob_start();
        if($slider_attr['type'] == 'carousal'){
            require_once WPMU_PLUGIN_DIR . '/custom_slider/views/view.carousal.php';
        } else{
            $over_written_path = get_template_directory().'/custom_slider/views/view.slider.php';
            if( file_exists($over_written_path) ){
                require_once $over_written_path;
            } else{
                require_once WPMU_PLUGIN_DIR . '/custom_slider/views/view.slider.php';
            }
        }
        return ob_get_clean();
    }
    add_shortcode( 'slider', 'sliderShortcode' );

?>