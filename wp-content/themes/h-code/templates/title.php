<?php
/**
 * displaying title for pages or posts
 *
 * @package H-Code
 */
?>
<?php
if ( class_exists( 'WooCommerce' ) ) {
    if(is_search() || is_category() || is_archive()){
        hcode_get_title_part_for_archive();
    }elseif ( get_post_type( get_the_ID() ) != 'product' && !is_product_category()){
		hcode_get_title_part();
	}elseif(is_product_category() || is_tax('product_brand')){ 
        // get the query object
        $product_category = $wp_query->get_queried_object();
        // get the thumbnail id user the term_id
        $thumbnail_id = get_woocommerce_term_meta( $product_category->term_id, 'thumbnail_id', true ); 
        // get the image URL
        $product_category_image = wp_get_attachment_url( $thumbnail_id ); 

        $category_image = ( $product_category_image ) ? '<img class="parallax-background-img" src="'.$product_category_image.'" alt="" />' : '';
        
        $show_breadcrumb = hcode_option('enable_breadcrumb');
        $show_next_prev_button = hcode_option('enable_next_prev_button');
        
        if( $product_category_image ){
        ?>
            <section class="page-title parallax3 parallax-fix page-title-large page-title-shop">
                <div class="opacity-light bg-dark-gray"></div>
                <?php echo $category_image;?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 wow fadeIn">
                            <!-- page title tagline -->
                                
                            <?php
                                $description  =  get_queried_object()->description;
                                if ( ! empty( $description ) ) : 
                                    echo '<span class="text-uppercase white-text">'.$description.'</span>';
                                endif;
                            ?>
                            <!-- end title tagline -->
                            <!-- Product title -->
                            <?php //if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                                <h1 class="white-text"><?php woocommerce_page_title(); ?></h1>
                            <?php //endif; ?>
                            <!-- end Product title -->
                        </div>
                        <?php $show_category_breadcrumb = hcode_option('enable_category_breadcrumb');//enable_category_breadcrumb ?>
                        <?php if( $show_category_breadcrumb ): ?>
                        <div class="col-md-12 col-sm-12 breadcrumb text-uppercase margin-three no-margin-bottom wow fadeIn">
                            <!-- breadcrumb -->
                            <ul class="woocommerce-breadcrumb-main breadcrumb-white-text">
                                <?php do_action('hcode_woocommerce_breadcrumb');?>
                            </ul>
                            <!-- end breadcrumb -->
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section> 
        <?php
        }else{
            ?>
            <section class="content-top-margin page-title page-title-small border-bottom-light border-top-light">
                <div class="container">
                    <div class="row">
                        <?php $show_category_breadcrumb = hcode_option('enable_category_breadcrumb');//enable_category_breadcrumb ?>
                        <?php if( $show_category_breadcrumb ): ?>
                        <div data-wow-duration="600ms" class="col-md-8 col-sm-7 breadcrumb text-uppercase wow fadeInUp xs-display-none">
                            <ul class="woocommerce-breadcrumb-main breadcrumb-black-text">
                                <?php do_action('hcode_woocommerce_breadcrumb');?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php
        }
     }else{
        $show_product_breadcrumb = hcode_option('enable_product_breadcrumb');
        $show_product_next_prev_button = hcode_option('enable_product_next_prev_button');
    ?>
    <?php if( $show_product_breadcrumb || $show_product_next_prev_button ): 

        $top_header_class = '';
   
        $hcode_options = get_option( 'hcode_theme_setting' );
        $hcode_enable_header = (isset($hcode_options['hcode_enable_header_woocommerce'])) ? $hcode_options['hcode_enable_header_woocommerce'] : '';
        $hcode_header_layout = (isset($hcode_options['hcode_header_layout_woocommerce'])) ? $hcode_options['hcode_header_layout_woocommerce'] : '';
           
        if($hcode_enable_header == 1 && $hcode_header_layout != 'headertype8')
        {
            $top_header_class .= 'content-top-margin';
        }
    
    ?>
        <section class="<?php echo $top_header_class; ?> page-title page-title-small border-bottom-light border-top-light">
            <div class="container">
                <div class="row">
                    <?php if( $show_product_breadcrumb ): ?>
                        <div data-wow-duration="600ms" class="col-md-8 col-sm-7 breadcrumb text-uppercase wow fadeInUp xs-display-none">
                            <!-- breadcrumb -->
                            <ul>
                            <?php  do_action('hcode_woocommerce_breadcrumb');?>
                            </ul>
                            <!-- end breadcrumb -->
                        </div>
                    <?php endif; ?>
                    <?php if( $show_product_next_prev_button ): ?>
                    <div data-wow-duration="300ms" class="col-md-4 col-sm-5 wow fadeInUp header-nav text-right sm-margin-top-two pull-right">
                        <!-- next/previous -->
                        <?php hcode_woocommerce_next_prev();?>
                        <!-- end next/previous -->
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </section>
    <?php endif;?>
<?php }
}elseif(is_search() || is_category() || is_archive()){
    hcode_get_title_part_for_archive();
}else{
    hcode_get_title_part();
} ?>