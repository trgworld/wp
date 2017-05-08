<?php
    function yourprefix_get_menu_items($menu_name){
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
            $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
            return wp_get_nav_menu_items($menu->term_id);
        }
    }
    function getChildMenuItems(){
        if( $_POST['menu_item_id'] > 0 && is_numeric( $_POST['menu_item_id'] ) ){
            $menu_items = yourprefix_get_menu_items('primary');
                if(isset($menu_items)){
                    foreach ( $menu_items as $key => $menu_item ) {
                        if( $menu_item->menu_item_parent == $_POST['menu_item_id'] ){
                            ?>
                                <li>
                                    <a href="<?php echo $menu_item->url; ?>">
                                        <?php echo $menu_item->title; ?>
                                    </a>
                                </li>
                            <?php
                        }
                    }
                }
        } else{
            echo '0';
        }
        die();
    }
    add_action( 'wp_ajax_getChildMenuItems', 'getChildMenuItems' );
    add_action( 'wp_ajax_nopriv_getChildMenuItems', 'getChildMenuItems' );
?>