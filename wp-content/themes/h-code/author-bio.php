<?php
/**
 * The template for displaying Author bios
 *
 * @package H-Code
 */
?>
<?php
    $class = '';
    $layout_settings_inner = hcode_option('hcode_layout_settings');
    $hcode_options = get_option( 'hcode_theme_setting' );

    if($layout_settings_inner == 'default'){
        $layout_settings = (isset($hcode_options['hcode_layout_settings'])) ? $hcode_options['hcode_layout_settings'] : '';
        $enable_container_fluid = (isset($hcode_options['hcode_enable_container_fluid'])) ? $hcode_options['hcode_enable_container_fluid'] : '';
    }else{
        $layout_settings = $layout_settings_inner;
        $enable_container_fluid = hcode_option('hcode_enable_container_fluid');
    }

    if($layout_settings == 'hcode_layout_full_screen'){
        $class .= 'margin-five';
    }else{
        $class .= 'margin-ten';
    }
?>
<?php // Start Author Info. ?>
<div class="text-center <?php echo $class ?> no-margin-bottom about-author text-left bg-gray">
    <div class="blog-comment text-left clearfix no-margin">
        <?php // Start Author Image. ?>
        <a class="comment-avtar no-margin-top" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), 300 ); ?>
        </a>
        <?php // End Author Image. ?>
        <?php // Start Author Description. ?>
        <div class="comment-text overflow-hidden position-relative">
            <h5 class="widget-title"><?php esc_html_e( 'About The Author', 'H-Code' ); ?></h5>
            <p class="blog-date no-padding-top"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author(); ?></a></p>
            <p class="about-author-text no-margin"><?php the_author_meta( 'description' ); ?></p>
        </div>
        <?php // End Author Description. ?>
    </div>
</div>
<?php // End Author Info. ?>