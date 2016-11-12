<?php
/**
 * @package H-Code
 */
?>
<?php
/*******************************************************************************/
/* Start Recent Post With Image Thumb  */
/*******************************************************************************/
if (!class_exists('hcode_recent_widget')) {
	class hcode_recent_widget extends WP_Widget {

		function __construct() {
			parent::__construct(
			'hcode_recent_widget',
			esc_html__('H-Code Recent Post Widget', 'H-Code'),
			array( 'description' => esc_html__( 'Your site most recent Posts.', 'H-Code' ), ) // Args
			);
		}

		public function widget( $args, $instance ) {
		    
		    $hcode_options = get_option( 'hcode_theme_setting' );
			$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
	        $postperpage =  $instance['postperpage'] ;
	        $thumbnail = $instance['thumbnail'] ;
			$title = apply_filters( 'widget_title', $instance['title'] );
			echo $args['before_widget'];
			if ( ! empty( $title ) )
				echo $args['before_title'] . $title . $args['after_title'];
			
			$recent_post = array('post_type' => 'post', 'posts_per_page' => $postperpage);
			$the_query = new WP_Query( $recent_post );
			$img_url = '';
			if ( $the_query->have_posts() ) {
				echo '<div class="widget-body">';
					echo '<ul class="widget-posts">';
					while ( $the_query->have_posts() ) {
						$the_query->the_post();

						$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
						if( $url ){
							$img_url = $url;
						}else{
							$img_url = $hcode_no_image['url'];
						}
						echo '<li class="clearfix">';
							if($thumbnail == 'on'){
								echo '<a href="'.get_permalink().'">';
								if ( has_post_thumbnail() ) {
					                    the_post_thumbnail( 'full' );
					            }
					            else {
					                    echo '<img src="'.$hcode_no_image['url'].'" width="900" height="600"/>';
					            }
								echo '</a>';
							}
							echo '<div class="widget-posts-details">';
								echo '<a href="'.get_permalink().'">'.get_the_title().'</a>';
								echo  get_the_author()." - ".get_the_date('d F', get_the_ID());
								echo '</div>';
						echo '</li>';
					}
					wp_reset_postdata();
					echo '</ul>';
				echo '</div>';
	        }
	        echo $args['after_widget'];
		}
			
		// Widget Backend 
		public function form( $instance ) {
			$title = (isset($instance[ 'title' ])) ? $instance[ 'title' ] : '';
			$postperpage = (isset($instance[ 'postperpage' ])) ? $instance[ 'postperpage' ] : '';

			if(isset($instance['thumbnail'])){
				$thumbnail = ($instance['thumbnail'] == 'on') ? 'checked="checked"' : '';
			}

			// Widget admin form
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'H-Code' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'postperpage' ); ?>"><?php esc_html_e( 'Number of posts to show :', 'H-Code' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'postperpage' ); ?>" size="3"  name="<?php echo $this->get_field_name( 'postperpage' ); ?>" type="text" value="<?php echo esc_attr( $postperpage ); ?>" />
			</p>
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id( 'thumbnail' ); ?>" size="3"  name="<?php echo $this->get_field_name( 'thumbnail' ); ?>" type="checkbox" <?php echo $thumbnail; ?> />
				<label for="<?php echo $this->get_field_id( 'thumbnail' ); ?>"><?php esc_html_e( 'Display Thumbnail?', 'H-Code' ); ?></label> 
			</p>
		<?php 
		}
		
		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['postperpage'] = ( ! empty( $new_instance['postperpage'] ) ) ? strip_tags( $new_instance['postperpage'] ) : '';
			$instance['thumbnail'] = ( ! empty( $new_instance['thumbnail'] ) ) ? strip_tags( $new_instance['thumbnail'] ) : '';
			return $instance;
		}
	}
}
/*******************************************************************************/
/* End Recent Post With Image Thumb  */
/*******************************************************************************/

/*******************************************************************************/
/* Start Recent Comment With Author And Date */
/*******************************************************************************/
if (!class_exists('hcode_recent_comment_widget')) {
	class hcode_recent_comment_widget extends WP_Widget {

		function __construct() {
			parent::__construct(
			'hcode_recent_comment_widget',
			esc_html__('H-Code Recent Comments Widget', 'H-Code'),
			array( 'description' => esc_html__( 'Your site most recent comments.', 'H-Code' ), ) // Args
			);
		}
		public function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
			$postperpage =  $instance['postperpage'] ;
			echo $args['before_widget'];
			$no_comments = $postperpage; 
			$comment_len = 80;
			if ( ! empty( $title ) )
			echo  '<div class="widget">';
			echo $args['before_title'] . $title . $args['after_title'];
					
				$comment_output = '';
				$comment_output .= '<div class="widget-body">';
					$comment_output .='<ul class="widget-posts">';
						$comments_query = new WP_Comment_Query();
						$comments = $comments_query->query( array( 'number' => $no_comments,'post_type' => 'post', ) );
						if ( $comments ) : foreach ( $comments as $comment ) :
							$comment_output .= '<li class="clearfix"><div class="widget-posts-details"><a class="author" href="' . get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID . '">';
							$comment_output .= get_the_title($comment->comment_post_ID). '</a> ';
							$comment_output .= get_comment_author( $comment->comment_ID ).' - '.get_comment_date( 'd F', $comment->comment_ID ) ;
							$comment_output .= '</div>';
							$comment_output .= '</li>';
						endforeach;
						else :
							$comment_output .= '<p>'.__("No comments", "H-Code").'</p>';
						endif;
						wp_reset_postdata();
					$comment_output .='</ul>';
				$comment_output .='</div>';
			$comment_output .='</div>';
			echo $comment_output; 
			echo $args['after_widget'];
		}
			
		// Widget Backend 
		public function form( $instance ) {
			
			$title = (isset($instance[ 'title' ])) ? $instance[ 'title' ] : '';
			$postperpage = (isset($instance[ 'postperpage' ])) ? $instance[ 'postperpage' ] : '';
			// Widget admin form
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'H-Code' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'postperpage' ); ?>"><?php esc_html_e( 'Number of posts to show :', 'H-Code' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'postperpage' ); ?>" size="3"  name="<?php echo $this->get_field_name( 'postperpage' ); ?>" type="text" value="<?php echo esc_attr( $postperpage ); ?>" />
			</p>
		<?php 
		}
		
		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['postperpage'] = ( ! empty( $new_instance['postperpage'] ) ) ? strip_tags( $new_instance['postperpage'] ) : '';
			return $instance;
		}
	}
}
/*******************************************************************************/
/* End Recent Comment With Author And Date */
/*******************************************************************************/

// Register and load H-Code custom widget
if ( ! function_exists( 'hcode_load_widget' ) ) :
	function hcode_load_widget() {
		register_widget( 'hcode_recent_widget' );
		register_widget( 'hcode_recent_comment_widget' );
	}
endif;
add_action( 'widgets_init', 'hcode_load_widget' ); ?>