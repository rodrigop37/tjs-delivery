<?php
/**
 * displaying content with standard post
 *
 * @package H-Code
 */
?>
<?php
$hcode_options = get_option( 'hcode_theme_setting' );
// no image
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
$section_class = $container_class = $xs_class = '';

$layout_settings = isset($hcode_options['hcode_layout_settings_post']) ? $hcode_options['hcode_layout_settings_post'] :'';
if( !empty($layout_settings)){
    $layout_settings = hcode_option_post('hcode_layout_settings');
    $enable_container_fluid = hcode_option_post('hcode_enable_container_fluid');
}else{
    $layout_settings = hcode_option('hcode_layout_settings');
    $enable_container_fluid = hcode_option('hcode_enable_container_fluid');
}
switch ($layout_settings) {
    case 'hcode_layout_full_screen':
        if(isset($enable_container_fluid) && $enable_container_fluid == '1'){
            $container_class .= 'container-fluid';
            $section_class .= ' class="no-padding-bottom"';
        }else{
            $container_class .= 'container';
            $section_class .= ' class="no-padding-bottom"';
        }

    break;    
    case 'hcode_layout_both_sidebar':
        $section_class .= ' class="no-padding next-prev-post-wrapper-center"';
        $container_class .= 'container';
        $xs_class .= ' no-padding';
        break;

    case 'hcode_layout_left_sidebar':
    case 'hcode_layout_right_sidebar':
        $section_class .= ' class="no-padding next-prev-post-wrapper"';
        $xs_class .= ' no-padding';
        $container_class .= 'container';
        break;
    
    default:
        $section_class .= '';
        $container_class .= 'container';
        break;
}
?>
<section <?php echo $section_class;?>>
    <div class="<?php echo $container_class;?>">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12<?php echo $xs_class;?>">
                <h2 class="blog-details-headline text-black"><?php echo get_the_title();?></h2>
                <div class="blog-date no-padding-top"><?php hcode_single_post_meta(); ?></div>
                <div class="margin-tb-30px">
                <?php
                    $output ='';
                    $blog_quote = hcode_post_meta('hcode_quote');
                    $blog_image = hcode_post_meta('hcode_image');
                    $blog_gallery = hcode_post_meta('hcode_gallery');
                    $blog_video = hcode_post_meta('hcode_video_type');
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
                    }elseif(!empty($blog_video)){
                        ob_start();
                            get_template_part('loop/single-post/loop','video');
                            $output .= ob_get_contents();  
                            ob_end_clean();  
                    }elseif(!empty($blog_image)){
                        ob_start();
                            get_template_part('loop/single-post/loop','image');
                            $output .= ob_get_contents();  
                            ob_end_clean();  
                    }else{
                        /* Image Alt, Title, Caption */
                        $img_alt = hcode_option_image_alt(get_post_thumbnail_id());
                        $img_title = hcode_option_image_title(get_post_thumbnail_id());
                        $image_alt = ( isset($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
                        $image_title = ( isset($img_title['title']) ) ? $img_title['title'] : '';

                        $img_attr = array(
                            'title' => $image_title,
                            'alt' => $image_alt,
                        );

                        $output .='<div class="blog-image bg-transparent">';
                        if ( has_post_thumbnail() ) {
                            $output .= get_the_post_thumbnail( get_the_ID(), 'full',$img_attr );
                        }
                        else {
                                $output .= '<img src="' . $hcode_no_image['url'] . '" width="900" height="600" alt=""/>';
                        }
                        $output .='</div>';
                    }
                    echo $output;
                ?>
                </div>
                <div class="blog-details-text">
                    <?php the_content();?>
                    <?php
                        $hcode_enable_tags = hcode_option('hcode_enable_meta_tags');
                        
                        if($hcode_enable_tags == 1):
                            $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'H-Code' ) );
                            if ( $tags_list ) { ?>
                                <div class="blog-date no-padding-top margin-eight no-margin-bottom">
                                    <?php hcode_single_post_meta_tag(); ?>
                                </div>
                            <?php } ?>
                    <?php endif; ?>
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

                $enable_navigation = hcode_option('hcode_enable_navigation');
                
                if($enable_navigation == 1 ):
                    hcode_single_post_navigation(); 
                endif;
                ?>                           
                                            
                                            
                <?php
                $hcode_enable_post_comment = hcode_option('hcode_enable_post_comment');

                if( $hcode_enable_post_comment == 1 ):
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>