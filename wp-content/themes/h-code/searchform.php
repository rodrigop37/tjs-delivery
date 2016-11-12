<?php
/**
 * This file use for define custom search form.
 *
 * @package H-Code
 */
?>
<?php 
// Start search form. 
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_search_placeholder_text = (isset($hcode_options['hcode_search_placeholder_text']) && !empty($hcode_options['hcode_search_placeholder_text'])) ? $hcode_options['hcode_search_placeholder_text'] : '';
?>
<form method="get" action="<?php echo esc_url( home_url( '/' ) );?>" name="search" class="main-search">
    <button type="submit" class="fa fa-search close-search search-button black-text"></button>
    <input class="sidebar-search" type="text" name="s" value="<?php echo get_search_query();?>" placeholder="<?php echo $hcode_search_placeholder_text ?>">
</form>
<?php // End search form. ?>