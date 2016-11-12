<?php
/**
 * displaying content with full width with lightbox gallery
 *
 * @package H-Code
 */
?>
<?php
$hcode_options = get_option( 'hcode_theme_setting' ); 

$post_author = get_post_field( 'post_author', get_the_ID() );
$author = get_the_author_meta( 'user_nicename', $post_author);
$date = get_the_date('d F Y', get_the_ID());
?>
<section class="no-padding-bottom wow fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 padding-five-bottom">
                <h2 class="blog-details-headline text-black text-center"><?php echo get_the_title();?></h2>
                <div class="blog-date no-padding-top text-center"><?php echo esc_html__('Posted by ', 'H-Code'); ?><a href="<?php echo get_author_posts_url( $post_author ); ?>"><?php echo $author;?></a> | <?php echo $date;?> | 
                    <?php
                    $post_cat = array();
                    $categories = get_the_category();
                    foreach ($categories as $k => $cat) {
                        $cat_link = get_category_link($cat->cat_ID);
                        $post_cat[]='<a href="'.$cat_link.'">'.$cat->name.'</a>';
                    }
                    echo $post_category=implode(",",$post_cat);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$hcode_options = get_option( 'hcode_theme_setting' );
$blog_image = hcode_post_meta('hcode_image');
$blog_quote = hcode_post_meta('hcode_quote');
$blog_gallery = hcode_post_meta('hcode_gallery');
$blog_video = hcode_post_meta('hcode_video_type');
$blog_feature_image = hcode_post_meta("hcode_featured_image");
if($blog_image == 1 || !empty($blog_gallery) || !empty($blog_video) || !empty($blog_quote) || $blog_feature_image == 1):
?>
<section class="no-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 padding-five-bottom">
            <?php
                $output = '';
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
                <div class="wpb_column vc_column_container col-md-12 col-sm-12 col-xs-12 blog-date no-padding-top margin-five-top">
                    <?php hcode_single_post_meta_tag(); ?>
                </div>
            </div>
        </div>
    </section>
<?php
}
endif;
    ?>
<section class="no-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
            </div>
        </div>
    </div>
</section>
<?php
// If comments are open or we have at least one comment, load up the comment template
$hcode_enable_post_comment = hcode_option('hcode_enable_post_comment');

if( $hcode_enable_post_comment == 1 ):
    if ( comments_open() || get_comments_number() ) : ?>
    <section class="padding-two wow fadeIn">
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