<?php 
/**
 * Template Name: Newsletter
 *
 * @package H-Code
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}
get_header();?>
<?php while ( have_posts() ) : the_post(); ?>
	
        <?php
        $layout_settings = $enable_container_fluid = $class_main_section = $section_class ='';
        $layout_settings_inner = hcode_option('hcode_layout_settings');
        $hcode_options = get_option( 'hcode_theme_setting' );
        if($layout_settings_inner == 'default'){
            
            $layout_settings = (isset($hcode_options['hcode_layout_settings'])) ? $hcode_options['hcode_layout_settings'] : '';
            $enable_container_fluid = (isset($hcode_options['hcode_enable_container_fluid'])) ? $hcode_options['hcode_enable_container_fluid'] : '';
        }else{
                $layout_settings = $layout_settings_inner;
                $enable_container_fluid = hcode_option('hcode_enable_container_fluid');

        }

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
        ?>
        <section class="parent-section <?php echo $section_class; ?>">
            <div class="<?php echo $class_main_section; ?>">
                <div class="row">
                        <?php get_template_part('templates/sidebar-left'); ?>
                            <?php if( $_GET['result'] && $_GET['result'] == 'success' ){ ?>
                                <section>
                                    <div class="container">
                                        <div class="row">
                                            <section>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-7 col-sm-10 center-col email-subscribed">
                                                            <div class="alert-style6">
                                                                <div class="alert alert-success"><i class="icon-trophy"></i><?php the_content(); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </section>
                            <?php } elseif( $_GET['result'] && $_GET['result'] == 'failure' ){ ?>
                                <section>
                                    <div class="container">
                                        <div class="row">
                                            <section>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-7 col-sm-10 center-col email-subscribed">
                                                            <div class="alert-style6">
                                                                <div class="alert alert-danger" role="alert"><i class="icon-sad"></i><?php the_content(); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </section>
                            <?php }?>
                            <?php
                                wp_link_pages( array(
                                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'H-Code' ),
                                        'after'  => '</div>',
                                ) );
                                $enable_comment = hcode_option('hcode_enable_page_comment');
                                if($enable_comment == 'default'):
                                    $enable_page_comment = (isset($hcode_options['hcode_enable_page_comment'])) ? $hcode_options['hcode_enable_page_comment'] : '';
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
	
<?php endwhile; // end of the loop ?>
<?php get_footer(); ?>