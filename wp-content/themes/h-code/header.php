<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "Title".
 *
 * @package H-Code
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <?php
    if( isset( $_SERVER['HTTP_USER_AGENT'] ) &&
        ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false )
    ) {
        echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
    }
    ?>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php // Start favicon. ?>
    <link rel="shortcut icon" href="<?php if (hcode_option('default_favicon')) { echo hcode_option_url('default_favicon'); } else { echo HCODE_THEME_IMAGES.'/favicon.png'; }?>">
    <link rel="apple-touch-icon" href="<?php if (hcode_option('apple_iPhone_favicon')) { echo hcode_option_url('apple_iPhone_favicon'); } else { echo HCODE_THEME_IMAGES.'/apple-touch-icon-57x57.png'; }?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php if (hcode_option('apple_iPad_favicon')) { echo hcode_option_url('apple_iPad_favicon'); } else { echo HCODE_THEME_IMAGES.'/apple-touch-icon-72x72.png'; }?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php if (hcode_option('apple_iPhone_retina_favicon')) { echo hcode_option_url('apple_iPhone_retina_favicon'); } else { echo HCODE_THEME_IMAGES.'/apple-touch-icon-114x114.png'; }?>">
    <link rel="apple-touch-icon" sizes="149x149" href="<?php if (hcode_option('apple_iPad_retina_favicon')) { echo hcode_option_url('apple_iPad_retina_favicon'); } else { echo HCODE_THEME_IMAGES.'/apple-touch-icon-114x114.png'; }?>">
    <?php // End favicon. ?>
    <?php
        // Set Header for Ajax Popup.
        hcode_set_header( get_the_ID() );
        wp_head();
    ?>
    <?php if( hcode_option('general_css_code') ): ?>
        <style>
            <?php echo hcode_option('general_css_code'); ?>
        </style>
    <?php endif; ?>

    <?php 
        if( hcode_option('tracking_code') ):
            echo hcode_option('tracking_code');
        endif;
    ?>
    <?php 
        if( hcode_option('space_before_head') ):
            echo hcode_option('space_before_head');
        endif;
    ?>
</head>
<body <?php body_class(); ?>>
<?php
    // Add Div For Ajax Popup
    hcode_add_ajax_page_div_header( get_the_ID() );
?>
<?php
    if( class_exists( 'WooCommerce' ) && (is_product() || is_product_category() || is_product_tag() || is_tax( 'product_brand' )) ){
        get_template_part('templates/menu-woocommerce');
        get_template_part('templates/title');
    }elseif(is_search() || is_category() || is_archive()){
        get_template_part('templates/menu-archive'); 
        get_template_part('templates/title');
    }elseif(is_home()){
        get_template_part('templates/menu'); 
    }else{
        get_template_part('templates/menu'); 
        get_template_part('templates/title');
    }
?>