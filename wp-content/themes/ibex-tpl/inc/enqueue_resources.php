<?php
    /* ENQUEUE STYLES AND SCRIPTS */
    function jbs_scripts() {
        global $template_uri;
        wp_deregister_script('jquery');
        wp_register_script('jquery', $template_uri.'/js/jquery-1.12.0.min.js', false, '1.20.0', true);
        wp_enqueue_script('jquery');

        wp_enqueue_style('jbs-style', get_stylesheet_uri() );
        wp_enqueue_style('jbs-google-fonts-style', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,900');
        wp_enqueue_style('jbs-bootstrap-style', $template_uri.'/css/bootstrap.css');
        wp_enqueue_style('jbs-themify-style', $template_uri.'/css/themify-icons.css');
        wp_enqueue_style('jbs-slick-styles', $template_uri.'/css/slick.css');
        wp_enqueue_style('jbs-custom-style', $template_uri.'/css/style.css');

        wp_enqueue_script( 'jbs-navigation-js', $template_uri.'/js/navigation.js', array(), '20151215', true );
        wp_enqueue_script( 'jbs-skip-link-focus-fix-js', $template_uri.'/js/skip-link-focus-fix.js', array(), '20151215', true );
        wp_enqueue_script( 'jbs-migrate-js', $template_uri.'/js/jquery-migrate-1.2.1.min.js', array(), '27-03-2017', true );
        wp_enqueue_script( 'jbs-slick-js', $template_uri.'/js/slick.min.js', array(), '10-04-2017', true );
        wp_enqueue_script( 'jbs-custom-js', $template_uri.'/js/custom.js', array(), '27-03-2017', true );
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
        wp_localize_script( 'jbs-custom-js', 'myAjaxObject', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    }
    add_action( 'wp_enqueue_scripts', 'jbs_scripts' );
    function add_meta_tags_and_favicon(){
        global $template_uri; ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?php echo $template_uri; ?>/images/favicon.ico">
    <?php }
    add_action('wp_head','add_meta_tags_and_favicon');
?>