<?php
/**
 * displaying layout for archive, search page
 *
 * @package H-Code
 */
get_header(); 
?>
<?php
    $layout_settings = $enable_container_fluid = $class_main_section = $section_class = $output = '';
    $layout_settings_inner = hcode_option('hcode_blog_page_settings');
    
    $layout_settings = $layout_settings_inner;
    $enable_container_fluid = hcode_option('hcode_blog_page_enable_container_fluid');
    switch ($layout_settings) {
        case 'hcode_blog_page_full_screen':
            if(isset($enable_container_fluid) && $enable_container_fluid == '1'){
                $class_main_section .= 'container-fluid';
            }else{
                $class_main_section .= 'container';
            }
        break;

        case 'hcode_blog_page_both_sidebar':
            $class_main_section .= 'container col3-layout';
        break;

        case 'hcode_blog_page_left_sidebar':
        case 'hcode_blog_page_right_sidebar':
            $class_main_section .= 'container col2-layout';
        break;

        default:
            $class_main_section .= 'container';
        break;
    }
    $output = $title = $top_header_class = '';
    if (class_exists('breadcrumb_navigation_xt')) 
    {
        $hcode_breadcrumb = new breadcrumb_navigation_xt;
        $hcode_breadcrumb->opt['static_frontpage'] = false;
        $hcode_breadcrumb->opt['url_blog'] = '';
        $hcode_breadcrumb->opt['title_blog'] = __('Home','H-Code');
        $hcode_breadcrumb->opt['title_home'] = __('Home','H-Code');
        $hcode_breadcrumb->opt['separator'] = '';
        $hcode_breadcrumb->opt['tag_page_prefix'] = '';
        $hcode_breadcrumb->opt['singleblogpost_category_display'] = false;
    } 

    $title .= single_cat_title( '', false );
    $hcode_options = get_option( 'hcode_theme_setting' );
    $hcode_enable_header = (isset($hcode_options['hcode_enable_header'])) ? $hcode_options['hcode_enable_header'] : '';
    $hcode_header_layout = (isset($hcode_options['hcode_header_layout'])) ? $hcode_options['hcode_header_layout'] : '';
    $hcode_blog_page_title = (isset($hcode_options['hcode_blog_page_title'])) ? $hcode_options['hcode_blog_page_title'] : '';
        
    if($hcode_enable_header == 1 && $hcode_header_layout != 'headertype8')
    {
        $top_header_class .= 'content-top-margin';
    }

    $output .= '<section class="'.$top_header_class.' page-title page-title-small bg-gray">';
        $output .= '<div class="container">';
            $output .= '<div class="row">';
                $output .= '<div class="col-lg-8 col-md-7 col-md-12 col-sm-12 animated fadeInUp">';
                        $output .= '<h1 class="black-text">'.esc_attr($hcode_blog_page_title).'</h1>';
                $output .= '</div>';
                $output .= '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase xs-display-none">';
                    $output .= '<ul class="breadcrumb-gray-text">';
                        $output .= $hcode_breadcrumb->display();
                    $output .= '</ul>';
                $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';
    $output .= '</section>'; 
    echo $output;    
?>
<section class="parent-section">
    <div class="<?php echo esc_attr($class_main_section); ?>">
        <div class="row">
            <?php get_template_part('templates/blog-page-left'); ?>
                <?php 
                    get_template_part('templates/index-content/content');
                ?>
            <?php get_template_part('templates/blog-page-right'); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>