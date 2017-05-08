<?php
    /* CREATE POST TYPES */
    $post_types_list = [
        [
            'label' => 'News and Event',
            'text_domain' => 'news-events',
            'slug' => 'news-events',
            'menu_icon' => 'dashicons-microphone',
            'supports' => ['title', 'thumbnail', 'editor', 'excerpt'],
            'taxonomy' => [
                'label' => 'News and Events Category',
                'slug' => 'news-events-cat',
                'post_type' => 'news-events'
            ]
        ],
        [
            'label' => 'Solution',
            'text_domain' => 'solution',
            'slug' => 'solution',
            'menu_icon' => 'dashicons-lightbulb',
            'supports' => ['title', 'thumbnail', 'editor', 'excerpt'],
            'taxonomy' => [
                'label' => 'Solution Category',
                'slug' => 'solution-cat',
                'post_type' => 'solution'
            ]
        ]
    ];
    if (count($post_types_list) > 0){
        foreach ($post_types_list as $key => $value){
            createPostType($value);
            if( isset($value['taxonomy']) ){
                createTaxonomy($value['taxonomy']);
            }
        }
    }

    /* ADD CUSTOM META FIELD FOR SOLUTIONS TAXONOMY */
    function add_custom_solutions_cat_meta() {
        ?>
        <div class="form-field">
            <label for="solution_cat_icon_class"><?php _e( 'Icon Classes', 'pippin' ); ?></label>
            <input type="text" name="solution_cat_icon_class" id="solution_cat_icon_class" value="">
            <p class="description"><?php _e( 'Enter the icon classes with space separated(e.g: icon-bulb icon-image)','pippin' ); ?></p>
        </div>
        <?php
    }
    add_action( 'solution-cat_add_form_fields', 'add_custom_solutions_cat_meta', 10, 2 );
    function edit_custom_solutions_cat_meta($term) {
        $solution_cat_icon_class = get_term_meta( $term->term_id, 'solution_cat_icon_class', true ); ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="solution_cat_icon_class"><?php _e( 'Icon Classes', 'pippin' ); ?></label></th>
            <td>
                <input type="text" name="solution_cat_icon_class" id="solution_cat_icon_class" value="<?php echo esc_attr( $solution_cat_icon_class ) ? esc_attr( $solution_cat_icon_class ) : ''; ?>">
                <p class="description"><?php _e( 'Enter the icon classes with space separated(e.g: icon-bulb icon-image)','pippin' ); ?></p>
            </td>
        </tr>
        <?php
    }
    add_action( 'solution-cat_edit_form_fields', 'edit_custom_solutions_cat_meta', 10, 2 );

    /* SAVE CUSTOM META FIELD OF SOLUTIONS TAXONOMY */
    function save_taxonomy_custom_meta( $term_id ) {
        if ( isset( $_POST['solution_cat_icon_class'] ) ) {
            update_term_meta( $term_id, 'solution_cat_icon_class', $_POST['solution_cat_icon_class'] );
        }
    }
    add_action( 'edited_solution-cat', 'save_taxonomy_custom_meta', 10, 2 );
    add_action( 'create_solution-cat', 'save_taxonomy_custom_meta', 10, 2 );
?>