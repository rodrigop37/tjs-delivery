<?php
/**
 * displaying content with full width header
 *
 * @package H-Code
 */
?>
<?php 
$hcode_options = get_option( 'hcode_theme_setting' );
// no image
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
$featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$overlay = $output = '';
if($featured_image):
    $featured_image = $featured_image;
    $overlay = 'bg-black';
else:
    $featured_image = $hcode_no_image['url'];
endif;    
 ?>
<section class="wow fadeIn blog-single-full-width-header fix-background parallax-fix" style="background: transparent url('<?php echo $featured_image;?>') repeat scroll 50% 0%;">
    <div class="opacity-full <?php echo $overlay; ?>"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-8 position-relative full-width-headline text-center center-col">
                <!-- post title  -->
                <h2 class="white-text alt-font"><?php echo get_the_title();?></h2>
                <!-- end post title  -->
                <!-- post date and categories  -->
                <?php hcode_full_width_single_post_meta(); ?>
                <!-- end post date and categories  -->
            </div>

        </div>
    </div>
</section>
<?php
$blog_image = hcode_post_meta('hcode_image');
$blog_quote = hcode_post_meta('hcode_quote');
$blog_gallery = hcode_post_meta('hcode_gallery');
$blog_video = hcode_post_meta('hcode_video_type');
$blog_feature_image = hcode_post_meta("hcode_featured_image");
if($blog_image == 1 || !empty($blog_gallery) || !empty($blog_video) || !empty($blog_quote) || $blog_feature_image == 1):
?>
<section class="no-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-10 center-col text-center">
            <?php
                if(!empty($blog_quote)){
                    ob_start();
                        get_template_part('loop/single-post/loop','quote');
                        $output .= ob_get_contents();  
                    ob_end_clean();  
                }elseif(!empty($blog_gallery)){
                    ob_start();
                        get_template_part('loop/single-post/loop','gallery');
                        $output .= ob_get_contents();  
                    ob_end_clean();  
                }
                elseif(!empty($blog_video)){
                    ob_start();
                        get_template_part('loop/single-post/loop','video');
                        $output .= ob_get_contents();  
                    ob_end_clean();  
                }
                elseif(!empty($blog_image)){
                    ob_start();
                        get_template_part('loop/single-post/loop','image');
                        $output .= ob_get_contents();  
                    ob_end_clean();  
                }
                
                echo $output;
            ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<div class="blog-details-text">
	<?php the_content();//get_template_part( 'templates/content/content', 'single' ); ?>
    <?php
    $hcode_enable_tags = hcode_option('hcode_enable_meta_tags');

    if($hcode_enable_tags == 1):
     $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'H-Code' ) );
     if ( $tags_list ) { 
    ?>
    <section class="no-padding">
        <div class="container">
            <div class="row">
                <div class="wpb_column vc_column_container col-md-8 col-sm-10 text-center center-col blog-date">
                    <?php hcode_single_post_meta_tag(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    }
    endif;
    ?>
</div>
<?php
$enable_post_author = hcode_option('hcode_enable_post_author');

if($enable_post_author == 1):
    // Author bio.
    if ( is_single() && get_the_author_meta( 'description' ) ) :
            get_template_part( 'author-bio' );
    endif;
endif;
?>                         
<?php 
$enable_social_icons = hcode_option('hcode_social_icons');

if($enable_social_icons == 1 && class_exists('Hcode_Addons_Post_Type')):
    echo do_shortcode( '[hcode_single_post_share]' ); 
endif;
?>                               

<?php
	// If comments are open or we have at least one comment, load up the comment template
$hcode_enable_post_comment = hcode_option('hcode_enable_post_comment');

if( $hcode_enable_post_comment == 1 ):
	if ( comments_open() || get_comments_number() ) : ?>
    <section class="no-padding wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-10 center-col">
		          <?php comments_template(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php 
	endif;
endif;
?>
<?php
$enable_navigation = hcode_option('hcode_enable_navigation');

if($enable_navigation == 1):
    hcode_single_post_navigation(); 
endif;
?>