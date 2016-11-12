<?php
/**
 * The template for displaying Portfolio category
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package H-Code
 */

get_header(); ?>

<?php
$layout_settings = $enable_container_fluid = $class_main_section = $section_class = $class = $output = $title = $top_header_class = '';
// To Get Category Layout.
$layout_settings_inner = hcode_option('hcode_portfolio_cat_settings');
$hcode_options = get_option( 'hcode_theme_setting' );          
$layout_settings = (isset($hcode_options['hcode_portfolio_cat_settings'])) ? $hcode_options['hcode_portfolio_cat_settings'] : '';
$enable_container_fluid = (isset($hcode_options['hcode_portfolio_cat_enable_container_fluid'])) ? $hcode_options['hcode_portfolio_cat_enable_container_fluid'] : '';
    switch ($layout_settings) {
        case 'hcode_portfolio_cat_full_screen':
            $section_class .= '';
            if(isset($enable_container_fluid) && $enable_container_fluid == '1'){
                $class_main_section .= 'container-fluid';
            } else {
                $class_main_section .= 'container';
            }
        break;

        case 'hcode_portfolio_cat_both_sidebar':
            $section_class .= '';
            $class_main_section .= 'container col3-layout';
        break;

        case 'hcode_portfolio_cat_left_sidebar':
        case 'hcode_portfolio_cat_right_sidebar':
            $section_class .= '';
            $class_main_section .= 'container col2-layout';
        break;

        default:
            $section_class .= '';
            $class_main_section .= 'container';
        break;
    }

    
    $hcode_layout_settings = (isset($hcode_options['hcode_portfolio_cat_layout_settings'])) ? $hcode_options['hcode_portfolio_cat_layout_settings'] : '';
    
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
    $hcode_enable_header = (isset($hcode_options['hcode_enable_header_general'])) ? $hcode_options['hcode_enable_header_general'] : '';
    $hcode_header_layout = (isset($hcode_options['hcode_header_layout_general'])) ? $hcode_options['hcode_header_layout_general'] : '';
        
    if($hcode_enable_header == 1 && $hcode_header_layout != 'headertype8')
    {
        $top_header_class .= 'content-top-margin';
    }

    // Start Postfolio Category Title.
    $output .= '<section class="'.$top_header_class.' page-title page-title-small bg-gray">';
        $output .= '<div class="container">';
            $output .= '<div class="row">';
                $output .= '<div class="col-lg-8 col-md-7 col-md-12 col-sm-12 animated fadeInUp">';
                        $output .= '<h1 class="black-text">'.$title.'</h1>';
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
    // End Postfolio Category Title.
?>

<section class="parent-section <?php echo $section_class;?>">
    <div class="<?php echo $class_main_section; ?>">
        <div class="row">
            <?php
                // If Is Set Get Portfolio Left Sidebar.
                get_template_part('templates/portfolio-cat-left');
            ?>
                <?php
                    // Portfolio Post layout.
                    get_template_part('templates/portfolio-content/content');
                ?>
            <?php
                // If Is Set Get Portfolio Right Sidebar.
                get_template_part('templates/portfolio-cat-right');
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>