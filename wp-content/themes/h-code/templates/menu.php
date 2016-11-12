<?php
/**
 * displaying menu section
 *
 * @package H-Code
 */
?>
<?php 
if( class_exists( 'WooCommerce' ) && (is_product() || is_product_category() || is_product_tag()) || is_404() || is_home() ){
    $enable_header = '2';
}else{
    $old_page_header_meta = '';
    $old_page_header_meta = get_post_meta( $post->ID, 'hcode_enable_header_single', true);
    if( $old_page_header_meta != '' && strlen($old_page_header_meta) > 0 ){
        $enable_header = hcode_option('hcode_enable_header');
    }else{
        $enable_header = '2';  
    }
}
if($enable_header == '1' || $enable_header == '2'){
    $hcode_options = get_option( 'hcode_theme_setting' );
    $hcode_header_text_color = '';
    if($enable_header == '2'){
        $hcode_enable_header = (isset($hcode_options['hcode_enable_header'])) ? $hcode_options['hcode_enable_header'] : '';
        if($hcode_enable_header == 0)
            return;
    }
    
    $hcode_header_layout = hcode_option('hcode_header_layout');
    $hcode_header_logo = hcode_option('hcode_header_logo');
    if(is_array($hcode_header_logo))
        $hcode_header_logo =  $hcode_header_logo['url'];

    $hcode_header_light_logo = hcode_option('hcode_header_light_logo');
    if(is_array($hcode_header_light_logo))
        $hcode_header_light_logo =  $hcode_header_light_logo['url'];

    $retina = hcode_option('hcode_retina_logo');
    if(is_array($retina))
        $retina =  $retina['url'];

    $retina_light = hcode_option('hcode_retina_logo_light');
    if(is_array($retina_light))
        $retina_light =  $retina_light['url'];

    $header_menu = hcode_option('hcode_header_menu');
    if(empty($header_menu))
        $header_menu = (isset($hcode_options['hcode_header_menu'])) ? $hcode_options['hcode_header_menu'] : '';

    $hcode_header_text_color = ' '.hcode_option('hcode_header_text_color');
    $hcode_header_search = hcode_option('hcode_header_search');
    $hcode_header_cart = hcode_option('hcode_header_cart');
    if(isset($hcode_options['hcode_header_mini_cart'])):
        $hcode_header_mini_cart = (isset($hcode_options['hcode_header_mini_cart']) && !empty($hcode_options['hcode_header_mini_cart'])) ? $hcode_options['hcode_header_mini_cart'] : '';
    else:
        $hcode_header_mini_cart = 'hcode-mini-cart';
    endif;
    
    $hcode_search_placeholder_text = (isset($hcode_options['hcode_search_placeholder_text']) && !empty($hcode_options['hcode_search_placeholder_text'])) ? $hcode_options['hcode_search_placeholder_text'] : '';
    

    $output = $classes = $enable_sticky = '';  

    switch ($hcode_header_layout) {
        case 'headertype1':
                    $classes .= 'transparent-header nav-border-bottom ';
                    break;
        case 'headertype2':
                    $classes .= 'nav-dark ';
                    break;
        case 'headertype3':
                    $classes .= 'nav-dark-transparent ';
                    break;
        case 'headertype4':
                    $classes .= 'nav-border-bottom nav-light-transparent ';
                    break;
        case 'headertype5':
                    $classes .= 'nav-border-bottom static-sticky ';
                    break;
        case 'headertype6':
                    $classes .= 'white-header nav-border-bottom ';
                    break;
        case 'headertype7':
                    $classes .= 'static-sticky-gray';
                    break;
        case 'headertype8':
                    $classes .= 'non-sticky ';
                    break;
    }
    ?>
    <nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav <?php echo $classes.$hcode_header_text_color." ".$enable_sticky;?>">
        <div class="container">
            <div class="row">
                <!-- logo -->
                <div class="col-md-2 pull-left">
                <?php
                $retina_width = (isset($hcode_options['hcode_retina_logo_width'])) ? 'width:'.$hcode_options['hcode_retina_logo_width'].'; ' : '';
                $retina_height = (isset($hcode_options['hcode_retina_logo_height'])) ? 'max-height:'.$hcode_options['hcode_retina_logo_height'].'' : '';
                $r_style  = '';
                ?>
                    <?php if(!empty($hcode_header_logo) || $retina){?>
                            <a class="logo-light" href="<?php echo home_url(); ?>">
                                <?php
                                if($hcode_header_logo):
                                ?>
                                    <img alt="" src="<?php echo $hcode_header_logo; ?>" class="logo" />
                                <?php
                                endif;
                                if($retina):
                                    if($retina_width || $retina_height):
                                        $r_style = 'style="'.$retina_width.$retina_height.'"';
                                    endif;
                                    ?>
                                    <img alt="" src="<?php echo $retina; ?>" class="retina-logo" <?php echo $r_style;?> />
                                    <?php
                                endif;
                                ?>
                            </a>
                    <?php } ?>
                    <?php
                    if(!empty($hcode_header_light_logo) || $retina_light){
                        $header_type= array('headertype5','headertype7');
                        if(!in_array($hcode_header_layout, $header_type) ){ 
                            ?>
                            <a class="logo-dark" href="<?php echo home_url(); ?>">
                                <?php
                                if($hcode_header_light_logo):
                                ?>
                                    <img alt="" src="<?php echo $hcode_header_light_logo; ?>" class="logo" />
                                <?php
                                endif;
                                if($retina_light):
                                    if($retina_width || $retina_height):
                                        $r_style = 'style="'.$retina_width.$retina_height.'"';
                                    endif;
                                ?>
                                    <img alt="" src="<?php echo $retina_light; ?>" class="retina-logo-light" <?php echo $r_style; ?>/>
                                <?php
                                endif;
                                ?>
                            </a>
                        <?php
                        } 
                    } ?>
                </div>
                <!-- end logo -->
                <!-- search and cart  -->
                <?php
                if($hcode_header_search == 1 || $hcode_header_cart == 1):
                ?>
                    <?php if( class_exists( 'WooCommerce' ) ){ ?>
                        <div class="col-md-2 no-padding-left search-cart-header pull-right">
                    <?php }else{ ?>
                        <div class="col-md-1 no-padding-left search-cart-header pull-right">
                    <?php } ?>
                        <?php if($hcode_header_search == 1): ?>
                        <div id="top-search">
                            <!-- nav search -->
                            <a href="#search-header" class="header-search-form"><i class="fa fa-search search-button"></i></a>
                            <!-- end nav search -->
                        </div>
                        <!-- search input-->
                        <form id="search-header" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>" name="search-header" class="mfp-hide search-form-result">
                            <div class="search-form position-relative">
                                <button type="submit" class="fa fa-search close-search search-button black-text"></button>
                                <input type="text" name="s" class="search-input" value="<?php echo get_search_query() ?>" placeholder="<?php echo $hcode_search_placeholder_text ?>" autocomplete="off">
                            </div>
                        </form>
                        <!-- end search input -->

                        <?php endif; ?>

                        <?php if( class_exists( 'WooCommerce' ) && $hcode_header_cart == 1 && $hcode_header_mini_cart ):?>
                            <div class="top-cart">
                                <?php dynamic_sidebar($hcode_header_mini_cart);?>
                            </div>
                        <?php endif; ?>
                    </div>
            <?php endif; ?>
                <!-- end search and cart  -->
                <!-- toggle navigation -->
                <div class="navbar-header col-sm-8 col-xs-2 pull-right">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- toggle navigation end -->
                <!-- main menu -->
                <?php
                if($hcode_header_search == 1 || $hcode_header_cart == 1): ?>
                    <?php if( class_exists( 'WooCommerce' ) ){ ?>
                        <div class="col-md-8 no-padding-right accordion-menu text-right">
                    <?php }else { ?>
                        <div class="col-md-8 no-padding-right accordion-menu text-right pull-right">
                    <?php } ?>
                <?php else: ?>
                    <div class="col-md-8 no-padding-right accordion-menu text-right pull-right menu-position-right">
                <?php 
                endif;
                $defaults = '';
                    if (!empty($header_menu)):
                        $defaults = array(
                            'menu'            => $header_menu,
                            'container'       => 'div',
                            'container_class' => 'navbar-collapse collapse',
                            'container_id'    => 'mega-menu',
                            'menu_class'      => 'mega-menu-ul nav navbar-nav navbar-right panel-group',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => false,
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'walker'          => new Hcode_Mega_Menu_Walker
                        );
                    elseif( has_nav_menu('hcodemegamenu') ):
                        $defaults = array(
                            'theme_location'  => 'hcodemegamenu',
                            'container'       => 'div',
                            'container_class' => 'navbar-collapse collapse',
                            'container_id'    => 'mega-menu',
                            'menu_class'      => 'mega-menu-ul nav navbar-nav navbar-right panel-group',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => false,
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'walker'          => new Hcode_Mega_Menu_Walker
                        );
                    else:
                        $defaults = array(
                            'container'       => 'div',
                            'container_class' => 'navbar-collapse collapse',
                            'container_id'    => 'mega-menu',
                            'menu_class'      => 'mega-menu-ul nav navbar-nav navbar-right panel-group',
                            'menu_id'         => '',
                            'echo'            => true,
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        );
                    endif;

                    wp_nav_menu( $defaults );
                    ?>
                </div>
                <!-- end main menu -->
            </div>
        </div>
    </nav>
<?php } ?>