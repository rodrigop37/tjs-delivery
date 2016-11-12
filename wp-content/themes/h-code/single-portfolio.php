<?php
/**
 * The template for displaying all single portfolio posts
 *
 * @package H-Code
 */

get_header(); ?>

<?php 
    // Start of the loop.
    while ( have_posts() ) : the_post();
    $layout_settings = $enable_container_fluid = $class_main_section = $section_class = '';
    // Get Theme option.
    $hcode_options = get_option( 'hcode_theme_setting' );
    // Set Layout Setting
    $layout_settings = (isset($hcode_options['hcode_layout_settings_portfolio'])) ? $hcode_options['hcode_layout_settings_portfolio'] : '';
    if( !empty($layout_settings)){
        $layout_settings = hcode_option_portfolio('hcode_layout_settings');
        $enable_container_fluid = hcode_option_portfolio('hcode_enable_container_fluid');
        switch ($layout_settings) {
            case 'hcode_layout_full_screen':
                $section_class .= 'class ="no-padding"';
                if(isset($enable_container_fluid) && $enable_container_fluid == '1'){
                    $class_main_section .= 'container-fluid';
                }
                else{
                    $class_main_section .= 'container';
                }
            break;

            case 'hcode_layout_both_sidebar':
                $section_class .= '';
                $class_main_section .= 'container col3-layout';
            break;

            case 'hcode_layout_left_sidebar':
            case 'hcode_layout_right_sidebar':
                $section_class .= '';
                $class_main_section .= 'container col2-layout';
            break;
            
            default:
                $section_class .= '';
                $class_main_section .= 'container';
            break;
        }
        ?>
        <section <?php echo $section_class; ?>>
            <div class="<?php echo $class_main_section; ?>">
                <div class="row">
                    <?php
                        // If Is Set Get Post Left Sidebar.
                        get_template_part('templates/portfolio-sidebar-left');
                    ?>
                        <?php

                            // Standard Portfolio layout.
                            get_template_part('templates/single-portfolio/portfolio','single');
                        ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'H-Code' ), 'after'  => '</div>', ) ); ?>
                    <?php
                        // If Is Set Get Post Right Sidebar.
                        get_template_part('templates/portfolio-sidebar-right');
                    ?>
                </div>
            </div>
        </section>
    <?php
    }else{
        $layout_settings = hcode_option('hcode_layout_settings');
        $enable_container_fluid = hcode_option('hcode_enable_container_fluid');

        switch ($layout_settings) {
            case 'hcode_layout_full_screen':
                $section_class .= 'class ="no-padding"';
                if(isset($enable_container_fluid) && $enable_container_fluid == '1'){
                    $class_main_section .= 'container-fluid';
                }
                else{
                    $class_main_section .= 'container';
                }
            break;

            case 'hcode_layout_both_sidebar':
                $section_class .= '';
                $class_main_section .= 'container col3-layout';
            break;

            case 'hcode_layout_left_sidebar':
            case 'hcode_layout_right_sidebar':
                $section_class .= '';
                $class_main_section .= 'container col2-layout';
            break;
            
            default:
                $section_class .= '';
                $class_main_section .= 'container';
            break;
        }
        ?>
        <section <?php echo $section_class; ?>>
            <div class="<?php echo $class_main_section; ?>">
                <div class="row">
                    <?php
                        // If Is Set Get Post Left Sidebar.
                        get_template_part('templates/portfolio-sidebar-left');
                    ?>
                        <?php

                            // Standard Portfolio layout.
                            get_template_part('templates/single-portfolio/portfolio','single');
                        ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'H-Code' ), 'after'  => '</div>', ) ); ?>
                    <?php
                        // If Is Set Get Post Right Sidebar.
                        get_template_part('templates/portfolio-sidebar-right');
                    ?>
                </div>
            </div>
        </section>
    <?php
    }
// End of the loop.
endwhile;?>
<?php
    // If Is Set Get Post Related Posts.
    $enable_related_posts = hcode_option('hcode_enable_related_portfolio_posts');
    
    if($enable_related_posts == 1):
        hcode_single_portfolio_related_posts();
    endif;
?>

<?php
    // If Is Set Get Post Portfolio Navigation.
    $enable_navigation = hcode_option('hcode_enable_navigation_portfolio');
    if($enable_navigation == 1):
?>
        <div class="next-previous-bottom">
            <?php hcode_single_portfolio_navigation(); ?>
        </div>
<?php endif; ?>

<?php get_footer(); ?>