<?php 
/**
 * Template Name: Sitemap
 *
 * @package H-Code
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

get_header();?>

<?php while ( have_posts() ) : the_post(); ?>
  <?php
      $layout_settings = $enable_container_fluid = $class_main_section = $section_class = $inside_section_class = $inside_container_class = '';
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
              //echo $enable_container_fluid;die;
          if(isset($enable_container_fluid) && $enable_container_fluid == '1'){
              $class_main_section .= 'container-fluid';
              $inside_container_class .= 'container-fluid';
          }
          else{
              $class_main_section .= 'container';
              $inside_container_class .= 'container';
          }

          break;

        case 'hcode_layout_both_sidebar':
              $inside_container_class .= 'container';
              $inside_section_class = 'no-padding';
              $section_class .= '';
              $class_main_section .= 'container col3-layout';
          break;

        case 'hcode_layout_left_sidebar':
        case 'hcode_layout_right_sidebar':
              $inside_container_class .= 'container';
              $inside_section_class = 'no-padding';
              $section_class .= '';
              $class_main_section .= 'container col2-layout';
          break;
        
        default:
              $inside_container_class .= 'container';
              $inside_section_class = '';
              $section_class .= '';
              $class_main_section .= 'container';
          break;
      }
      ?>
  <section class="<?php echo $section_class; ?>">
  <div class="<?php echo $class_main_section; ?>">
      <div class="row">
        <?php get_template_part('templates/sidebar-left'); ?>
          <?php the_content(); ?>
          <section class="<?php echo $inside_section_class; ?> wow fadeIn">
            <div class="<?php echo $inside_container_class; ?>">
              <div class="row">
                <div class="sitemap-wrapper">
                  <div class="col-md-4 col-sm-6">
                    <p class="black-text sitemap-title bg-light-gray"><?php esc_html_e( 'Pages', 'H-Code' ); ?></p>
                    <ul>
                        <?php wp_list_pages("title_li=&sort_column=menu_order" ); ?>
                    </ul>
                  </div>

                  <div class="col-md-4 col-sm-6 no-padding">
                    <div class="col-md-12 col-sm-12">
                      <p class="black-text sitemap-title bg-light-gray"><?php esc_html_e( 'All Blog Posts', 'H-Code' ); ?></p>
                      <ul>
                          <?php
                            $post_query = new WP_Query('showposts=-1');
                            while ($post_query->have_posts()) : $post_query->the_post(); 
                              echo '<li><a href="'.get_the_permalink().'" rel="bookmark" title="Permanent Link to '.get_the_title().'">'.get_the_title().'</a></li>';
                            endwhile;
                            wp_reset_postdata();
                          ?>
                      </ul>
                    </div>

                    <div class="col-md-12 col-sm-12">
                      <p class="black-text sitemap-title bg-light-gray">Categories</p>
                      <ul>
                          <?php wp_list_categories('sort_column=name&hierarchical=0&title_li='); ?>
                      </ul>
                    </div>

                    <div class="col-md-12 col-sm-12">
                      <p class="black-text sitemap-title bg-light-gray"><?php esc_html_e( 'Archives', 'H-Code' );?></p>
                      <ul>
                        <?php wp_get_archives('type=monthly'); ?>
                      </ul> 
                    </div>

                    <div class="col-md-12 col-sm-12">
                      <p class="black-text sitemap-title bg-light-gray"><?php esc_html_e( 'Portfolio Categories', 'H-Code' ); ?></p>
                      <?php
                          $portfolio_taxonomy = 'portfolio-category';
                          $portfolio_terms = get_terms($portfolio_taxonomy);
                      ?>
                      <ul>
                          <?php
                            foreach ($portfolio_terms as $portfolio_term) {
                              echo '<li><a href="' . esc_attr(get_term_link($portfolio_term, $portfolio_taxonomy)) . '" title="' . sprintf( esc_html__( "View all posts in %s" ,'H-Code'), $portfolio_term->name ) . '" ' . '>' . $portfolio_term->name.'</a></li>';
                            }
                          ?>
                      </ul>
                    </div>

                    <?php if( class_exists( 'WooCommerce' ) ): ?>
                      <div class="col-md-12 col-sm-12">
                        <p class="black-text sitemap-title bg-light-gray"><?php esc_html_e( 'All Products', 'H-Code' ); ?></p>
                        <ul>
                          <?php
                            $product_query = new WP_Query('post_type=product&showposts=-1');
                            while ($product_query->have_posts()) : $product_query->the_post(); 
                                echo '<li><a href="'.get_the_permalink().'" rel="bookmark" title="Permanent Link to '.get_the_title().'">'.get_the_title().'</a></li>';
                            endwhile;
                            wp_reset_postdata();
                          ?>
                        </ul>
                      </div>

                      <div class="col-md-12 col-sm-12">
                        <p class="black-text sitemap-title bg-light-gray"><?php esc_html_e( 'Product Categories', 'H-Code' ); ?></p>
                        <?php
                            $product_taxonomy = 'product_cat';
                            $product_terms = get_terms($product_taxonomy);
                        ?>
                        <ul>
                            <?php
                            foreach ($product_terms as $product_term) {
                            echo '<li><a href="' . esc_attr(get_term_link($product_term, $product_taxonomy)) . '" title="' . sprintf( esc_html__( "View all posts in %s",'H-Code' ), $product_term->name ) . '" ' . '>' . $product_term->name.'</a></li>';
                            }
                            ?>
                        </ul>
                      </div>
                  <?php endif; ?>

                  </div>

                  <div class="col-md-4 col-sm-6 no-padding">
                    <div class="col-md-12 col-sm-12">
                      <p class="black-text sitemap-title bg-light-gray"><?php esc_html_e( 'All Portfolio Posts', 'H-Code' ); ?></p>
                      <ul>
                        <?php
                          $portfolio_query = new WP_Query('post_type=portfolio&showposts=-1');
                          while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); 
                              echo '<li><a href="'.get_the_permalink().'" rel="bookmark" title="Permanent Link to '.get_the_title().'">'.get_the_title().'</a></li>';
                          endwhile;
                          wp_reset_postdata();
                        ?>
                      </ul>
                    </div>

                    <?php if( taxonomy_exists( 'product_brand' ) && class_exists( 'WooCommerce' ) ): ?>
                        <div class="col-md-12 col-sm-12">
                          <p class="black-text sitemap-title bg-light-gray"><?php esc_html_e( 'Product Brands', 'H-Code' ); ?></p>
                          <?php
                              $brand_taxonomy = 'product_brand';
                              $brand_terms = get_terms($brand_taxonomy);
                          ?>
                          <ul>
                              <?php
                              foreach ($brand_terms as $brand_term) {
                                echo '<li><a href="' . esc_attr(get_term_link($brand_term, $brand_taxonomy)) . '" title="' . sprintf( esc_html__( "View all posts in %s",'H-Code' ), $brand_term->name ) . '" ' . '>' . $brand_term->name.'</a></li>';
                              }
                              ?>
                          </ul>
                        </div>
                    <?php endif; ?>
                  </div>
                  

                </div>
              </div>
            </div>
          </section>
          <?php
            wp_link_pages( array(
              'before' => '<div class="page-links">' . __( 'Pages:', 'H-code' ),
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
  
<?php 
endwhile; // end of the loop ?>
<?php get_footer(); ?>