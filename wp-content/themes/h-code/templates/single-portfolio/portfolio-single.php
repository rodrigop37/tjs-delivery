<?php
/**
 * displaying content for single portfolio posts
 *
 * @package H-Code
 */
?>
<?php
$output = '';
$portfolio_image = hcode_post_meta('hcode_image');
$portfolio_gallery = hcode_post_meta('hcode_gallery');
$portfolio_video = hcode_post_meta('hcode_video');
$portfolio_link = hcode_post_meta('hcode_link_type');

$hcode_options = get_option('hcode_theme_setting');
$layout_settings = (isset($hcode_options['hcode_layout_settings_portfolio'])) ? $hcode_options['hcode_layout_settings_portfolio'] : '';

// no image
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
if( empty($layout_settings)){
    $layout_settings = hcode_option('hcode_layout_settings');
}else{
    $layout_settings = hcode_option_portfolio('hcode_layout_settings');
}

$section_class_start = $section_class_end = $portfolio_title = $portfolio_meta = $portfolio_meta_start = $portfolio_meta_end = $portfolio_meta_category_start = $portfolio_meta_category_end = '';


switch ($layout_settings) {
    case 'hcode_layout_full_screen':
        $section_class_start .= '<section class="no-padding-bottom"><div class="container"><div class="row"><div class="col-md-12">';
        $section_class_end .= '</div></div></div></section>';
        
        $portfolio_meta_category_start = '<section class="padding-top-40px no-padding-bottom"><div class="container"><div class="row"><div class="col-md-12 col-sm-12 text-center">';
        $portfolio_meta_category_end .= '</div></div></div></section>';

        $portfolio_meta_start .= '<div class="col-md-12 col-sm-12 col-xs-12 margin-five-bottom sm-margin-eight-bottom xs-margin-five-bottom">';
        $portfolio_meta_end .= '</div>';
        break;
    case 'hcode_layout_both_sidebar':
        $section_class_start .= '<section class="no-padding"><div class="container"><div class="row">';
        $section_class_end .= '</div></div></section>';
        
        $portfolio_meta_category_start .= '<section class="padding-top-40px no-padding-bottom clear-both"><div class="container"><div class="row"><div class="col-md-12 col-sm-12 text-center no-padding">';
        $portfolio_meta_category_end .= '</div></div></div></section>';
        break;

    case 'hcode_layout_left_sidebar':
    case 'hcode_layout_right_sidebar':
        $section_class_start .= '<section class="no-padding"><div class="container"><div class="row">';
        $section_class_end .= '</div></div></section>';
        $portfolio_meta_category_start .= '<section class="padding-top-40px no-padding-bottom clear-both"><div class="container"><div class="row"><div class="col-md-12 col-sm-12 text-center no-padding">';
        $portfolio_meta_category_end .= '</div></div></div></section>';
        break;
}
if (!empty($portfolio_gallery)) {
    ob_start();
    echo $section_class_start;
    echo $portfolio_title;
    get_template_part('loop/single-portfolio/portfolio', 'gallery');
    echo $section_class_end;
    $output .= ob_get_contents();
    ob_end_clean();
}elseif (!empty($portfolio_video)) {
    ob_start();
    echo $section_class_start;
    echo $portfolio_title;
    get_template_part('loop/single-portfolio/portfolio', 'video');
    echo $section_class_end;
    $output .= ob_get_contents();
    ob_end_clean();
}elseif (!empty($portfolio_image)) {
    ob_start();
    if($portfolio_image == 1){
        echo $section_class_start;
        echo $portfolio_title;
        get_template_part('loop/single-portfolio/portfolio', 'image');
        echo $section_class_end;
    }
    $output .= ob_get_contents();
    ob_end_clean();
}else {
    /* Image Alt, Title, Caption */
    $img_alt = hcode_option_image_alt(get_post_thumbnail_id());
    $img_title = hcode_option_image_title(get_post_thumbnail_id());
    $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
    $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';
    
    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
    $url = $thumb['0'];
    if ($url):
        $output .= $section_class_start;
        $output .= $portfolio_title;
        $output .= '<div class="gallery-img margin-bottom-30px">';
            $output .= '<img src="' . $url . '" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.'>';
        $output .= '</div>';
        $output .= $section_class_end;
    else:
        $output .= $section_class_start;
        $output .= $portfolio_title;
        $output .= '<div class="gallery-img margin-bottom-30px">';
            $output .= '<img src="' . $hcode_no_image['url'] . '" width="900" height="600" alt=""/>';
        $output .= '</div>';
        $output .= $section_class_end;
    endif;
}
echo $output;
?>
<div class="blog-details-text portfolio-single-content">
<?php the_content(); ?>
   
    <?php
    $hcode_enable_meta_author_portfolio = hcode_option('hcode_enable_meta_author_portfolio');
    $hcode_enable_meta_date_portfolio = hcode_option('hcode_enable_meta_date_portfolio');
    $hcode_enable_meta_category_portfolio = hcode_option('hcode_enable_meta_category_portfolio');
    if (!empty($url) || !empty($portfolio_gallery) || !empty($portfolio_video) || !empty($portfolio_link)):
        if( $hcode_enable_meta_author_portfolio == 1 || $hcode_enable_meta_date_portfolio == 1 || $hcode_enable_meta_category_portfolio == 1){
            echo $portfolio_meta_category_start;
                echo $portfolio_meta = '<div class="blog-date no-padding-top">' . hcode_single_portfolio_meta() . '</div>'; 
            echo $portfolio_meta_category_end;
        }
    endif;
    ?>
   
</div>
<section class="no-padding">
    <div class="container">
        <div class="row">
            <?php
            $hcode_enable_tags = hcode_option('hcode_enable_meta_tags_portfolio');
            
            $enable_post_author = hcode_option('hcode_enable_post_author_portfolio');

            $enable_social_icons = hcode_option('hcode_social_icons_portfolio');

            $hcode_enable_portfolio_comment = hcode_option('hcode_enable_portfolio_comment');

            if ($hcode_enable_tags == 1 || $enable_post_author == 1 || $enable_social_icons == 1 || $hcode_enable_portfolio_comment == 1):
            ?>

            <?php echo $portfolio_meta_start; ?>
                <?php
                if ($hcode_enable_tags == 1):
                        hcode_single_portfolio_meta_tag();
                endif;
                ?>
                <?php
                if ($enable_post_author == 1):
                    // Author bio.
                    if (is_single() && get_the_author_meta('description')) :
                        get_template_part('author-bio');
                    endif;
                endif;
                ?>

                <?php
                if ($enable_social_icons == 1):
                    echo do_shortcode('[hcode_single_post_share]');
                endif;
                ?>
                <?php
                if ($hcode_enable_portfolio_comment == 1):
                    // If comments are open or we have at least one comment, load up the comment template
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                        //echo '</div></div></div>';
                    endif;
                endif;
                ?>
            <?php
            echo $portfolio_meta_end;
            endif;
        ?>
        </div>
    </div>
</section>