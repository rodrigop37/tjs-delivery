<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package H-Code
 */

get_header();?>
<?php
$title_text = ( hcode_option('404_title_text') ) ? '<p class="not-found-title white-text">'.hcode_option('404_title_text').'</p>' : '';
$content_text = ( hcode_option('404_content_text') ) ? '<p class="title-small xs-title-small xs-display-none text-uppercase letter-spacing-2 white-text">'.hcode_option('404_content_text').'</p>' : '';
$img = hcode_option('404_image');
$image = ( hcode_option('404_image') ) ? ' style="background-image: url('.$img['url'].')"' : '';
$button = ( hcode_option('404_button') ) ? hcode_option('404_button') : __('Go to home page','H-Code');
$button_url = ( hcode_option('404_button_url') ) ? get_permalink(get_page_by_path( hcode_option('404_button_url') )) : home_url();
$enable_text_button = hcode_option('404_enable_text_button');
$enable_search = hcode_option('404_enable_search');


$top_header_class = '';
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_enable_header = (isset($hcode_options['hcode_enable_header'])) ? $hcode_options['hcode_enable_header'] : '';
$hcode_header_layout = (isset($hcode_options['hcode_header_layout'])) ? $hcode_options['hcode_header_layout'] : '';
   
if($hcode_enable_header == 1 && $hcode_header_layout != 'headertype8')
{
    $top_header_class .= 'content-top-margin';
}
?>
<?php // Start 404 Page Content ?>
<section class="no-padding cover-background full-screen wow fadeIn"<?php echo $image; ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-12 col-xs-12 text-center center-col full-screen">
                <div class="col-text-center">
                    <div class="col-text-middle-main">
                        <div class="col-text-middle">
                            <?php echo $title_text; ?>
                            <?php echo $content_text; ?>
                            <div class="not-found-search-box">
                                <?php if( $enable_text_button == 1 ): ?>
                                    <a class="btn-small-white btn btn-medium no-margin-right" href="<?php echo $button_url;?>"><?php echo $button; ?></a>
                                <?php endif; ?>
                                <?php if( $enable_text_button == 1 && $enable_search == 1 ): ?>
                                    <div class="not-found-or-text"><?php echo __('or', 'H-Code'); ?></div>
                                <?php endif; ?>
                                <?php if( $enable_search == 1 ): ?>
                                    <?php echo get_search_form( ); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php // End 404 Page Content ?>
<?php get_footer(); ?>