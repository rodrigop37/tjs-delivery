<?php
/**
 * Theme Register Style Js.
 *
 * @package H-Code
 */
?>
<?php 

/*
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'hcode_register_style_js' ) ) {
	function hcode_register_style_js() {

		/*
		 * Load our h-code theme main and other required stylesheets.
		 */
		
		wp_register_style( 'hcode-style', get_stylesheet_uri() ,null, HCODE_THEME_VERSION);
		wp_register_style( 'hcode-animate-style', HCODE_THEME_CSS_URI . '/animate.css',null, HCODE_THEME_VERSION);
		wp_register_style( 'hcode-bootstrap', HCODE_THEME_CSS_URI . '/bootstrap.css',null, HCODE_THEME_VERSION);
		wp_register_style( 'hcode-et-line-icons-style', HCODE_THEME_CSS_URI . '/et-line-icons.css',null, HCODE_THEME_VERSION);
		wp_register_style( 'hcode-font-awesome-style', HCODE_THEME_CSS_URI . '/font-awesome.min.css',null, HCODE_THEME_VERSION);
		wp_register_style( 'hcode-magnific-popup-style', HCODE_THEME_CSS_URI . '/magnific-popup.css',null, HCODE_THEME_VERSION);
		wp_register_style( 'hcode-owl-carousel-style', HCODE_THEME_CSS_URI . '/owl.carousel.css',null, HCODE_THEME_VERSION);
		wp_register_style( 'hcode-owl-transitions-style', HCODE_THEME_CSS_URI . '/owl.transitions.css',null, HCODE_THEME_VERSION);
		wp_register_style( 'hcode-full-slider-style', HCODE_THEME_CSS_URI . '/full-slider.css',null, HCODE_THEME_VERSION);
		wp_register_style( 'hcode-text-effect-style', HCODE_THEME_CSS_URI . '/text-effect.css',null, HCODE_THEME_VERSION);
		wp_register_style( 'hcode-responsive-style', HCODE_THEME_CSS_URI . '/responsive.css',null, HCODE_THEME_VERSION);
		wp_register_style( 'hcode-extralayers-style', HCODE_THEME_CSS_URI . '/extralayers.css',null, HCODE_THEME_VERSION);
		wp_register_style( 'hcode-settings-style', HCODE_THEME_CSS_URI . '/settings.css',null, HCODE_THEME_VERSION);

		wp_enqueue_style( 'hcode-animate-style' );
		wp_enqueue_style( 'hcode-bootstrap' );
		wp_enqueue_style( 'hcode-et-line-icons-style' );
		wp_enqueue_style( 'hcode-font-awesome-style' );
		wp_enqueue_style( 'hcode-magnific-popup-style' );
		wp_enqueue_style( 'hcode-owl-carousel-style' );
		wp_enqueue_style( 'hcode-owl-transitions-style' );
		wp_enqueue_style( 'hcode-full-slider-style' );
		wp_enqueue_style( 'hcode-text-effect-style' );
		wp_enqueue_style( 'hcode-style' );
		wp_enqueue_style( 'hcode-responsive-style' );
		wp_enqueue_style( 'hcode-extralayers-style' );

		// Load the Internet Explorer specific stylesheet.
		wp_enqueue_style( 'hcode-ie', HCODE_THEME_CSS_URI.'/style-ie.css', array( 'hcode-style' ), HCODE_THEME_VERSION );
		wp_style_add_data( 'hcode-ie', 'conditional', 'IE' );
		
		
		// Load the html5 shiv.
		wp_register_script( 'hcode-html5', HCODE_THEME_JS_URI.'/html5shiv.js', array(), HCODE_THEME_VERSION );
		hcode_script_add_data( 'hcode-html5', 'conditional', 'lt IE 9' );
		wp_enqueue_script( 'hcode-html5' );

		/*
		 * Load our h-code theme main and other required jquery files.
		 */
		wp_register_script( 'hcode-modernizr', HCODE_THEME_JS_URI.'/modernizr.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-bootstrap', HCODE_THEME_JS_URI.'/bootstrap.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'bootstrap-hover-dropdown', HCODE_THEME_JS_URI.'/bootstrap-hover-dropdown.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-jquery-easing', HCODE_THEME_JS_URI.'/jquery.easing.1.3.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-skrollr', HCODE_THEME_JS_URI.'/skrollr.min.js',array('jquery'),HCODE_THEME_VERSION,true);
	    wp_register_script( 'hcode-viewport', HCODE_THEME_JS_URI.'/jquery.viewport.mini.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-smooth-scroll', HCODE_THEME_JS_URI.'/smooth-scroll.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-wow', HCODE_THEME_JS_URI.'/wow.min.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcodepage-scroll', HCODE_THEME_JS_URI.'/page-scroll.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-easypiechart', HCODE_THEME_JS_URI.'/jquery.easypiechart.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-parallax', HCODE_THEME_JS_URI.'/jquery.parallax-1.1.3.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-isotope', HCODE_THEME_JS_URI.'/jquery.isotope.min.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-owl-carousel', HCODE_THEME_JS_URI.'/owl.carousel.min.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-magnific-popup', HCODE_THEME_JS_URI.'/jquery.magnific-popup.min.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-popup-gallery', HCODE_THEME_JS_URI.'/popup-gallery.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-text-effect', HCODE_THEME_JS_URI.'/text-effect.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-tools', HCODE_THEME_JS_URI.'/jquery.tools.min.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-counter', HCODE_THEME_JS_URI.'/counter.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-fitvids', HCODE_THEME_JS_URI.'/jquery.fitvids.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-imagesloaded', HCODE_THEME_JS_URI.'/imagesloaded.pkgd.min.js',array('jquery'),HCODE_THEME_VERSION,true);
	    wp_register_script( 'hcode-onepage-main', HCODE_THEME_JS_URI.'/one-page-main.js',array('jquery'),HCODE_THEME_VERSION,true);
	    wp_register_script( 'hcode-ajax-popup', HCODE_THEME_JS_URI.'/ajax-popup-slider.js',array('jquery'),HCODE_THEME_VERSION,true);
	    wp_register_script( 'hcode-appear-scroll', HCODE_THEME_JS_URI.'/jquery.appear.js',array('jquery'),HCODE_THEME_VERSION,true);
	    wp_register_script( 'hcode-ie-placeholder', HCODE_THEME_JS_URI.'/jquery.placeholder.js',array('jquery'),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcodemain', HCODE_THEME_JS_URI.'/main.js',array('jquery'),HCODE_THEME_VERSION,true);

		
	    wp_enqueue_script( 'hcode-modernizr');
	    wp_enqueue_script( 'hcode-bootstrap');
	    wp_enqueue_script( 'bootstrap-hover-dropdown');
	    wp_enqueue_script( 'hcode-jquery-easing');
	    wp_enqueue_script( 'hcode-skrollr');
	    wp_enqueue_script( 'hcode-viewport' );
	    wp_enqueue_script( 'hcode-smooth-scroll');
	    wp_enqueue_script( 'hcode-wow');
	    wp_enqueue_script( 'hcodepage-scroll');
	    wp_enqueue_script( 'hcode-easypiechart');
	    wp_enqueue_script( 'hcode-parallax');
	    wp_enqueue_script( 'hcode-isotope');
	    wp_enqueue_script( 'hcode-owl-carousel');
	    wp_enqueue_script( 'hcode-magnific-popup');
	    wp_enqueue_script( 'hcode-popup-gallery');
	    wp_enqueue_script( 'hcode-appear-scroll');
	    wp_enqueue_script( 'hcode-text-effect');
	    wp_enqueue_script( 'hcode-tools');
	    wp_enqueue_script( 'hcode-counter');
	    wp_enqueue_script( 'hcode-fitvids');
	    wp_enqueue_script( 'hcode-imagesloaded');
	    wp_enqueue_script( 'hcode-ie-placeholder');
	    wp_enqueue_script( 'hcode-onepage-main');
	    wp_enqueue_script( 'hcodemain');	

	    

		/*
		 * Defind ajaxurl and wp_localize
		 */

		wp_localize_script('hcodemain', 'hcodeajaxurl', 
			array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'theme_url' => get_template_directory_uri()
		) );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hcode_register_style_js',10 );
?>