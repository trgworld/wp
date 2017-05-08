<div class="home-slider">
    <?php
        if( count($slides) > 0 ){
            foreach ($slides as $key => $slide){
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $slide->ID ), array(1920, 1200) )[0];
                if( !empty($image) ){
                    $slide_meta = get_post_meta($slide->ID)
                    ?>
                    <div>
                        <div class="banner-text">
                            <h1 class="big-text">
                                <?php echo $slide->post_title; ?>
                            </h1>
                            <span class="normal-text">
                                <?php echo isset($slide_meta['slider_subtitle'][0]) ? $slide_meta['slider_subtitle'][0] : ''; ?>
                            </span>
                            <a hef="<?php echo isset($slide_meta['slider_btn_link'][0]) ? $slide_meta['slider_btn_link'][0] : 'javscript:void(0)'; ?>" class="small-text">
                                <?php echo isset($slide_meta['slider_btn_text'][0]) ? $slide_meta['slider_btn_text'][0] : ''; ?>
                                <i class="ti-arrow-right"></i>
                            </a>
                        </div>
                        <img src="<?php echo $image; ?>">
                    </div>
                    <?php
                }
            }
        }
    ?>
</div>