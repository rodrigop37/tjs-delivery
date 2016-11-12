<?php
/**
 * displaying footer section
 *
 * @package H-Code
 */
?>
<?php
$footer_menu_class = $footer_social_class = '';
$enable_sidebar = hcode_option('hcode_enable_sidebar_section');
$old_page_footer_meta = '';
if(!empty($post)):
    $old_page_footer_meta = get_post_meta( $post->ID, 'hcode_enable_page_footer_single', true);
endif;
if($old_page_footer_meta != '' && strlen($old_page_footer_meta) > 0){
    $enable_footer = hcode_option('hcode_enable_page_footer');
}else{
    $enable_footer = 'default';  
}
$hcode_options = get_option( 'hcode_theme_setting' );
$enable_social_icons = hcode_option('hcode_enable_social_icons');
$enable_social_sidebar = (isset($hcode_options['hcode_social_sidebar'])) ? $hcode_options['hcode_social_sidebar'] : 'footer-social-icons';
$enable_footer_copyright = hcode_option('hcode_enable_footer_copyright');
$footer_copyright = hcode_option('hcode_footer_copyright');
$enable_scrolltotop_button = hcode_option('hcode_enable_scrolltotop_button');

$enable_footer_logo = (isset($hcode_options['hcode_enable_footer_logo'])) ? $hcode_options['hcode_enable_footer_logo'] : '';
$footer_logo = (isset($hcode_options['hcode_footer_logo'])) ? $hcode_options['hcode_footer_logo'] : '';
$enable_footer_menu = '';

if( ( is_page() || is_single('page') || is_singular(array( 'post', 'portfolio' ))) && $enable_footer != 'default'){
    $footer_sidebar1 = hcode_option('hcode_footer_sidebar_1');
    $footer_sidebar2 = hcode_option('hcode_footer_sidebar_2');
    $footer_sidebar3 = hcode_option('hcode_footer_sidebar_3');
    $footer_sidebar4 = hcode_option('hcode_footer_sidebar_4');
    $footer_sidebar5 = hcode_option('hcode_footer_sidebar_5');
    $enable_footer_menu = hcode_option('hcode_enable_footer_menu');
    $footer_menu = hcode_option('hcode_footer_menu');
    
}else{
    $enable_sidebar = (isset($hcode_options['hcode_enable_sidebar_section'])) ? $hcode_options['hcode_enable_sidebar_section'] : '';
    $enable_footer = hcode_option('hcode_enable_page_footer');
    $enable_footer_menu = hcode_option('hcode_enable_footer_menu');
    $footer_menu = hcode_option('hcode_footer_menu');
    $footer_sidebar1 = hcode_option('hcode_footer_sidebar_1');
    $footer_sidebar2 = hcode_option('hcode_footer_sidebar_2');
    $footer_sidebar3 = hcode_option('hcode_footer_sidebar_3');
    $footer_sidebar4 = hcode_option('hcode_footer_sidebar_4');
    $footer_sidebar5 = hcode_option('hcode_footer_sidebar_5');
    $enable_social_icons = hcode_option('hcode_enable_social_icons');
}
$seperator = $footer_class = '';
?>
<?php if($enable_footer == 1){ ?>
    <?php if($enable_sidebar == 0 && ($enable_footer_menu == '1' || $enable_social_icons == 1)){
            $footer_class .= '';
            echo '<div class="container">';
        }elseif($enable_sidebar == 0 && $enable_footer_menu == '0' && $enable_social_icons == 0){
            $footer_class .= 'no-margin-bottom';
        }else{
            $footer_class .= 'no-margin-bottom';
            if($enable_sidebar == 1 || $enable_footer_menu == 1 || $enable_social_icons == 1){
                echo '<div class="container footer-middle">';
            }
        }
        if($enable_sidebar == 0 || ($enable_footer_menu == 0 && $enable_social_icons == 0)){
            $seperator .='';
        }else{
            $seperator .='<div class="wide-separator-line bg-mid-gray no-margin-lr margin-three no-margin-bottom"></div>';
        }
    ?>
    <?php if($enable_sidebar == 1 ){?>
    	    <div class="row">
    	    	<?php if(is_active_sidebar($footer_sidebar1) && !(empty($footer_sidebar1))){ ?>
    	    		<div class="col-md-4 col-sm-3 sm-display-none">
    					<?php dynamic_sidebar($footer_sidebar1);?>
    				</div>
    			<?php } ?>

    			<?php if(is_active_sidebar($footer_sidebar2) && !(empty($footer_sidebar2))){ ?>
    				<div class="col-md-2 col-sm-3 col-xs-3 footer-links">
    					<?php dynamic_sidebar($footer_sidebar2);?>
    				</div>
    			<?php }?>

    			<?php if(is_active_sidebar($footer_sidebar3) && !(empty($footer_sidebar3))){ ?>
    				<div class="col-md-2 col-sm-3 col-xs-3 footer-links">
    					<?php dynamic_sidebar($footer_sidebar3); ?>
    				</div>
    			<?php } ?>
    	       
    			<?php if(is_active_sidebar($footer_sidebar4) && !(empty($footer_sidebar4))){ ?>
    				<div class="col-md-2 col-sm-3 col-xs-3 footer-links">	
    					<?php dynamic_sidebar($footer_sidebar4); ?>
    				</div>
    			<?php } ?>

                <?php if(is_active_sidebar($footer_sidebar5) && !(empty($footer_sidebar5))){ ?>
                    <div class="col-md-2 col-sm-3 col-xs-3 footer-links">  
                        <?php dynamic_sidebar($footer_sidebar5); ?>
                    </div>
                <?php } ?>
    	    </div>

        <?php echo $seperator; ?>
    <?php }?>
        <?php
            if($enable_footer_menu == 1 || $enable_social_icons == 1): 
                if($enable_footer_menu == 1 && $enable_social_icons == 0):
                    $footer_menu_class .= ' footer-position';
                elseif($enable_footer_menu == 0 && $enable_social_icons == 1):
                    $footer_social_class .= ' footer-position';
                else:
                    $footer_menu_class .= '';
                    $footer_social_class .= '';
                endif;
            ?>
            <div class="row margin-four <?php echo $footer_class; ?>">
            	<?php if (($footer_menu != '' && $enable_footer_menu == '1') || (has_nav_menu( 'hcodefootermenu' ) && $enable_footer_menu == '1')): ?>
                <div class="col-md-6 col-sm-12 sm-text-center sm-margin-bottom-four<?php echo $footer_menu_class?>">
                    <!-- link -->
                    <?php
                $defaults = '';
                    if(!empty($footer_menu)): 
                        $defaults = array(
                            'container'       => '',
                            'menu'            => $footer_menu,
                            'menu_class'      => 'list-inline footer-link text-uppercase',
                            'menu_id'         => '',
                            'echo'            => true,
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        );
                    elseif( has_nav_menu('hcodefootermenu') ):
                        $defaults = array(
                            'theme_location' => 'hcodefootermenu',
                            'container'       => '',
                            'menu_class'      => 'list-inline footer-link text-uppercase',
                            'menu_id'         => '',
                            'echo'            => true,
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        );
                    else:
                        $defaults = array(
                            'container'       => '',
                            'menu_class'      => 'list-inline footer-link text-uppercase',
                            'menu_id'         => '',
                            'echo'            => true,
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        );
                    endif;
                        wp_nav_menu( $defaults );
                    ?>
                    <!-- end link -->
                </div>
            	<?php endif; ?>
                <?php if(($enable_social_icons == 1 || $enable_social_icons == 'default') && !(empty($enable_social_sidebar))){ ?>
                    <div class="col-md-6 col-sm-12 footer-social text-right sm-text-center<?php echo $footer_social_class?>">
                        <!-- social media link -->
                        <?php dynamic_sidebar($enable_social_sidebar); ?>
                        <!-- end social media link -->
                        
                    </div>
                <?php }?>
            </div>
            <?php endif; ?>
<?php
if($enable_sidebar == 1 || $enable_footer_menu == 1 || $enable_social_icons == 1){
   echo '</div>';
}
?>
<?php if($enable_footer_copyright == 1 || $enable_footer_logo == 1){ ?>
    <div class="container-fluid bg-dark-gray footer-bottom">
        <div class="container">
            <div class="row margin-three">
                <?php if($enable_footer_copyright == 1){ ?>
                    <!-- copyright -->
                    <div class="col-md-6 col-sm-6 col-xs-12 copyright text-left letter-spacing-1 xs-text-center xs-margin-bottom-one light-gray-text2">
                        <?php echo $footer_copyright;?>
                    </div>
                    <!-- end copyright -->
                <?php }?>
                <?php if($enable_footer_logo == 1){ ?>
                    <!-- logo -->
                    <div class="col-md-6 col-sm-6 col-xs-12 footer-logo text-right xs-text-center">
                        <a href="<?php echo home_url(); ?>"><img alt="" src="<?php echo $footer_logo['url'];?>" width="<?php echo $footer_logo['width'] ?>" height="<?php echo $footer_logo['height'] ?>"></a>
                    </div>
                    <!-- end logo -->
                <?php }?>
            </div>
        </div>
    </div>
<?php } ?>
<?php } ?>
<?php
    if( get_post_type( get_the_ID() ) == 'portfolio' && is_singular('portfolio') ){
        $enable_ajax = get_post_meta( get_the_ID(),'hcode_enable_ajax_popup_single',true);
    } else {
        $enable_ajax = '';
    }
?>
<?php if( $enable_scrolltotop_button == 1 && ($enable_ajax == '' || $enable_ajax == 'no')){ ?>
<!-- scroll to top -->
    <a class="scrollToTop" href="javascript:void(0);">
        <i class="fa fa-angle-up"></i>
    </a>
<!-- scroll to top End... -->
<?php } ?>