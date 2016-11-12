<?php
/**
 * displaying archive pages menu section
 *
 * @package H-Code
 */
?>
<?php 
    $hcode_options = get_option( 'hcode_theme_setting' );
    $hcode_header_text_color = '';
    $hcode_enable_header = (isset($hcode_options['hcode_enable_header_general'])) ? $hcode_options['hcode_enable_header_general'] : '';
    $hcode_header_layout = (isset($hcode_options['hcode_header_layout_general']) && !empty($hcode_options['hcode_header_layout_general'])) ? $hcode_options['hcode_header_layout_general'] : $hcode_options['hcode_header_layout'];
if($hcode_enable_header == 1){
    $hcode_header_layout = ( is_404() ) ? $hcode_options['404_header_type'] : $hcode_header_layout;
    
    
    $hcode_header_logo = (isset($hcode_options['hcode_header_logo_general']['url']) && !empty($hcode_options['hcode_header_logo_general']['url'])) ? $hcode_options['hcode_header_logo_general']['url'] : $hcode_options['hcode_header_logo']['url'];
    $hcode_header_light_logo = (isset($hcode_options['hcode_header_light_logo_general']['url']) && !empty($hcode_options['hcode_header_light_logo_general']['url'])) ? $hcode_options['hcode_header_light_logo_general']['url'] : $hcode_options['hcode_header_light_logo']['url'];
    $header_menu = (isset($hcode_options['hcode_header_menu_general']) && !empty($hcode_options['hcode_header_menu_general'])) ? $hcode_options['hcode_header_menu_general'] : $hcode_options['hcode_header_menu'];
    $hcode_header_text_color = (isset($hcode_options['hcode_header_text_color_general']) && !empty($hcode_options['hcode_header_text_color_general'])) ? $hcode_options['hcode_header_text_color_general'] : $hcode_options['hcode_header_text_color'];
    $hcode_header_search = (isset($hcode_options['hcode_header_search_general'])) ? $hcode_options['hcode_header_search_general'] : '';
    $hcode_header_cart = (isset($hcode_options['hcode_header_cart_general'])) ? $hcode_options['hcode_header_cart_general'] : '';
    if(isset($hcode_options['hcode_header_mini_cart_general'])):
        $hcode_header_mini_cart_general = (isset($hcode_options['hcode_header_mini_cart_general']) && !empty($hcode_options['hcode_header_mini_cart_general'])) ? $hcode_options['hcode_header_mini_cart_general'] : $hcode_options['hcode_header_mini_cart'];
    else:
        $hcode_header_mini_cart_general = 'hcode-mini-cart';
    endif;

    $hcode_search_placeholder_text = (isset($hcode_options['hcode_search_placeholder_text']) && !empty($hcode_options['hcode_search_placeholder_text'])) ? $hcode_options['hcode_search_placeholder_text'] : '';

    $retina = (isset($hcode_options['hcode_retina_logo_general']['url']) && !empty($hcode_options['hcode_retina_logo_general']['url'])) ? $hcode_options['hcode_retina_logo_general']['url'] : $hcode_options['hcode_retina_logo']['url'];
    $retina_light = (isset($hcode_options['hcode_retina_logo_light_general']['url']) && !empty($hcode_options['hcode_retina_logo_light_general']['url'])) ? $hcode_options['hcode_retina_logo_light_general']['url'] : $hcode_options['hcode_retina_logo_light']['url'];
    $retina_width = (isset($hcode_options['hcode_retina_logo_width_general']) && !empty($hcode_options['hcode_retina_logo_width_general'])) ? 'width:'.$hcode_options['hcode_retina_logo_width_general'].'; ' : 'width:'.$hcode_options['hcode_retina_logo_width'].'; ';
    $retina_height = (isset($hcode_options['hcode_retina_logo_height_general']) && !empty($hcode_options['hcode_retina_logo_height_general'])) ? 'max-height:'.$hcode_options['hcode_retina_logo_height_general'] : 'max-height:'.$hcode_options['hcode_retina_logo_height'];
    $r_style  = '';

   
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
    <nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav <?php echo $classes.$hcode_header_text_color." ".$enable_sticky;?>" role="navigation">
        <div class="container">
            <div class="row">
                <!-- logo -->
                <div class="col-md-2 pull-left">
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
                    if(!empty($hcode_header_light_logo)){
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
                    <div class="col-md-2 no-padding-left search-cart-header pull-right">
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

                        <?php if( class_exists( 'WooCommerce' ) && $hcode_header_cart == 1 && $hcode_header_mini_cart_general):?>
                            <div class="top-cart">
                                <?php dynamic_sidebar($hcode_header_mini_cart_general);?>
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
                if($hcode_header_search == 1 || $hcode_header_cart == 1):
                     ?>
                    <div class="col-md-8 no-padding-right accordion-menu text-right">
                    <?php 
                else:
                    ?>
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