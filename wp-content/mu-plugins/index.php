<?php
    function createPostType($params){
        $labels = array(
            'name'               => _x( $params['label'].'s', 'post type general name', $params['text_domain'] ),
            'singular_name'      => _x( $params['label'], 'post type singular name', $params['text_domain'] ),
            'menu_name'          => _x( $params['label'].'s', 'admin menu', $params['text_domain'] ),
            'name_admin_bar'     => _x( $params['label'], 'add new on admin bar', $params['text_domain'] ),
            'add_new'            => _x( 'Add New', strtolower($params['label']), $params['text_domain'] ),
            'add_new_item'       => __( 'Add New '.$params['label'], $params['text_domain'] ),
            'new_item'           => __( 'New '.$params['label'], $params['text_domain'] ),
            'edit_item'          => __( 'Edit '.$params['label'], $params['text_domain'] ),
            'view_item'          => __( 'View '.$params['label'], $params['text_domain'] ),
            'all_items'          => __( 'All '.$params['label'].'s', $params['text_domain'] ),
            'search_items'       => __( 'Search '.$params['label'].'s', $params['text_domain'] ),
            'parent_item_colon'  => __( 'Parent '.$params['label'].'s:', $params['text_domain'] ),
            'not_found'          => __( 'No '.$params['label'].'s found.', $params['text_domain'] ),
            'not_found_in_trash' => __( 'No '.$params['label'].'s found in Trash.', $params['text_domain'] )
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', $params['text_domain'] ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => $params['slug'] ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 100,
            'supports'           => $params['supports'],
            'menu_icon'          => $params['menu_icon']
        );

        register_post_type( $params['slug'], $args );
    }
    function createTaxonomy($params){
        $labels = array(
            'name' => _x( $params['label'], 'taxonomy general name' ),
            'singular_name' => _x( $params['label'], 'taxonomy singular name' ),
            'search_items' =>  __( 'Search '.$params['label'] ),
            'all_items' => __( 'All '.$params['label'] ),
            'parent_item' => __( 'Parent '.$params['label'] ),
            'parent_item_colon' => __( 'Parent '.$params['label'] ),
            'edit_item' => __( 'Edit '.$params['label'] ),
            'update_item' => __( 'Update '.$params['label'] ),
            'add_new_item' => __( 'Add New '.$params['label'] ),
            'new_item_name' => __( 'New '.$params['label'].' Name' ),
            'menu_name' => __( $params['label'] ),
        );
        register_taxonomy($params['slug'],$params['post_type'], array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => $params['slug'] ),
        ));

    }
    require_once WPMU_PLUGIN_DIR . '/custom_slider/custom_slider.php';
?>