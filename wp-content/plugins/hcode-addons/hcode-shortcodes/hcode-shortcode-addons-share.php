<?php
/**
 * The template for displaying share buttons.
 *
 * @package H-Code
 */
?>
<?php
// [hcode_share] Shortcode
if ( ! function_exists( 'hcode_share_shortcode' ) ) :
	function hcode_share_shortcode() {
		global $post;

		if(!$post) 
			return false;
		
		$output = '';
		$permalink = get_permalink($post->ID);
		$featuredimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
		$featured_image = $featuredimage['0'];
		$post_title = rawurlencode(get_the_title($post->ID));

		ob_start();
		?>
		<div class="col-md-12 col-sm-12 product-details-social no-padding">
			<?php if(hcode_option('share_title')) { ?>
				<span class="black-text text-uppercase text-small vertical-align-middle margin-right-five">
					<?php echo hcode_option('share_title'); ?>
				</span>
			<?php } ?>
				<?php if(hcode_option('enable_facebook')) { ?>
		            <a class="black-text-link" href="http://www.facebook.com/sharer.php?u=<?php echo $permalink; ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" target="_blank" title="<?php echo $post_title; ?>"><i class="fa fa-facebook"></i></a>
				<?php } ?>
				<?php if(hcode_option('enable_twitter')) { ?>
		            <a class="black-text-link" href="https://twitter.com/share?url=<?php echo $permalink; ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" target="_blank" title="<?php echo $post_title; ?>"><i class="fa fa-twitter"></i></a>
				<?php } ?>
				<?php if(hcode_option('enable_google_plus')) { ?>
		            <a class="black-text-link" href="//plus.google.com/share?url=<?php echo $permalink; ?>" target="_blank" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" title="<?php echo $post_title; ?>"><i class="fa fa-google-plus"></i></a>
				<?php } ?>
				<?php if(hcode_option('enable_linkedin')) { ?>
					<a class="black-text-link" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo $permalink; ?>&amp;title=<?php echo $post_title; ?>" target="_blank" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" title="<?php echo $post_title; ?>"><i class="fa fa-linkedin"></i></a>
				<?php } ?>
				<?php if(hcode_option('enable_pinterest')) { ?>
		            <a class="black-text-link" href="//pinterest.com/pin/create/button/?url=<?php echo $permalink; ?>&amp;media=<?php echo $featured_image; ?>&amp;description=<?php echo $post_title; ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" target="_blank" title="<?php echo $post_title; ?>"><i class="fa fa-pinterest"></i></a>
				<?php } ?>
				<?php if(hcode_option('enable_email')) { ?>
		            <a class="black-text-link" href="mailto:enteryour@addresshere.com?subject=<?php echo $post_title; ?>&amp;body=<?php esc_html_e('Check%20this%20out:', 'hcode-addons'); ?>%20<?php echo $permalink; ?>" rel="nofollow" title="<?php echo $post_title; ?>"><i class="fa fa-envelope"></i></a>
				<?php } ?>
	    </div>
	    <?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
endif;
add_shortcode('hcode_share','hcode_share_shortcode');

// [hcode_single_post_share] Shortcode.
if ( ! function_exists( 'hcode_single_post_share_shortcode' ) ) :
	function hcode_single_post_share_shortcode() {
		global $post;

		if(!$post) 
			return false;
		
		$output = $border_bottom = '';
		$permalink = get_permalink($post->ID);
		$featuredimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		$featured_image = $featuredimage['0'];
		$post_title = rawurlencode(get_the_title($post->ID));
		
		ob_start();
		?>
		<div class="text-center padding-four-top padding-four-bottom col-md-12 col-sm-12 col-xs-12 no-padding-lr">
			<?php if(hcode_option('enable_facebook_post')) { ?>
	            <a class="btn social-icon social-icon-large button" href="http://www.facebook.com/sharer.php?u=<?php echo $permalink; ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" target="_blank" title="<?php echo $post_title; ?>"><i class="fa fa-facebook"></i></a>
			<?php } ?>
			<?php if(hcode_option('enable_twitter_post')) { ?>
	            <a class="btn social-icon social-icon-large button" href="https://twitter.com/share?url=<?php echo $permalink; ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" target="_blank" title="<?php echo $post_title; ?>"><i class="fa fa-twitter"></i></a>
			<?php } ?>
			<?php if(hcode_option('enable_google_plus_post')) { ?>
	            <a class="btn social-icon social-icon-large button" href="//plus.google.com/share?url=<?php echo $permalink; ?>" target="_blank" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" title="<?php echo $post_title; ?>"><i class="fa fa-google-plus"></i></a>
			<?php } ?>
			<?php if(hcode_option('enable_linkedin_post')) { ?>
				<a class="btn social-icon social-icon-large button" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo $permalink; ?>&amp;title=<?php echo $post_title; ?>" target="_blank" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" title="<?php echo $post_title; ?>"><i class="fa fa-linkedin"></i></a>
			<?php } ?>
			<?php if(hcode_option('enable_pinterest_post')) { ?>
	            <a class="btn social-icon social-icon-large button" href="//pinterest.com/pin/create/button/?url=<?php echo $permalink; ?>&amp;media=<?php echo $featured_image; ?>&amp;description=<?php echo $post_title; ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" target="_blank" title="<?php echo $post_title; ?>"><i class="fa fa-pinterest"></i></a>
			<?php } ?>
	    </div>
	    <?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
endif;
add_shortcode('hcode_single_post_share','hcode_single_post_share_shortcode');

if ( ! function_exists( 'hcode_column_grid_structure' ) ) {
    function hcode_column_grid_structure() {
    	$grid_classes = array('col-md-1','col-md-1','col-md-1','col-md-1','col-md-1','col-md-1','col-md-1','col-md-1','col-md-1','col-md-1','col-md-1','col-md-1','col-md-2','col-md-2','col-md-2','col-md-2','col-md-2','col-md-2','col-md-3','col-md-3','col-md-3','col-md-3','col-md-4','col-md-4','col-md-4','col-md-5','col-md-5','col-md-2','col-md-6','col-md-6','col-md-1','col-md-11','col-md-2','col-md-10','col-md-3','col-md-9','col-md-4','col-md-8','col-md-5','col-md-7');
        $output = '';
    	$output .= '<div class="col-md-12 show-grid">';
    		foreach ($grid_classes as $key => $value) {
    			$output .= '<div class="'.$value.'">.'.$value.'</div>';
    		}                   
        $output .= '</div>';
        return $output;
    }  
} 
add_shortcode('hcode_grid_structure', 'hcode_column_grid_structure');
?>