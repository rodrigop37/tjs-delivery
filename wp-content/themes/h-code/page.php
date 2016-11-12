<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package H-Code
 */
get_header(); ?>

<?php
// Start the loop.
while ( have_posts() ) : the_post();

    $layout_settings = $enable_container_fluid = $class_main_section = $section_class = '';
    
    $hcode_options = get_option( 'hcode_theme_setting' );
    
    $layout_settings = hcode_option('hcode_layout_settings');
    $enable_container_fluid = hcode_option('hcode_enable_container_fluid');
    
    switch ($layout_settings) {
        case 'hcode_layout_full_screen':
            $section_class .= 'no-padding';
            if(isset($enable_container_fluid) && $enable_container_fluid == '1'){
                $class_main_section .= 'container-fluid';
            }else{
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
    //echo $section_class.'test';
?>
<section class="parent-section <?php echo $section_class; ?>">
    <div class="<?php echo $class_main_section; ?>">
        <div class="row">
            <?php get_template_part('templates/sidebar-left'); ?>
                <?php the_content(); ?>
                <?php
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'H-Code' ),
                        'after'  => '</div>',
                    ) );
                    $enable_comment = hcode_option('hcode_enable_page_comment');

                    if($enable_comment == 'default'):
                        $enable_page_comment = hcode_option('hcode_enable_page_comment');
                    else:
                        $enable_page_comment = $enable_comment;
                    endif;

                    if ( $enable_page_comment == 1 && (comments_open() || get_comments_number()) ) :
                        comments_template();
                    endif;
                ?>
            <?php get_template_part('templates/sidebar-right'); ?>
        </div>
    </div>
</section>
<?php 
endwhile;
// End the loop.
?>
<?php get_footer(); ?>