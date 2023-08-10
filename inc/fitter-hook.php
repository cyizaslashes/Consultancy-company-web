<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Business_Consulting
 */




/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if( ! function_exists( 'bc_business_consulting_body_classes' ) ) :
	function bc_business_consulting_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}
	
		return $classes;
	}
	add_filter( 'body_class', 'bc_business_consulting_body_classes' );
endif;

if ( ! function_exists( 'bc_business_consulting_walker_comment' ) ) : 
	/**
	 * Implement Custom Comment template.
	 *
	 * @since 1.0.0
	 *
	 * @param $comment, $args, $depth
	 * @return $html
	 */
	  
	function bc_business_consulting_walker_comment($comment, $args, $depth) {
		
		
		?>
            <div class="media">
                <div class="media-left">
                   <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 70 ); ?>
                </div>
                <div class="media-body">
                    <div class="media-content last">
                        <h4 class="media-heading"><?php comment_author(  ); ?><span> <?php
							/* translators: 1: date, 2: time */
							printf( esc_html__('%1$s at %2$s', 'bc-business-consulting' ), get_comment_date(),  get_comment_time() );
							 ?></span></h4>
                        <p>  <?php comment_text(); ?></p>
                        
                         <?php 
					$args ['reply_text'] =  esc_html__( 'Reply', 'bc-business-consulting' );
                    comment_reply_link( array_merge( $args, array(  'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div>
                </div>
            </div>
		<?php
	}
	
	function bc_business_consulting_replace_reply_link_class($class){
		$class = str_replace("class='comment-reply-link", "class='reply", $class);
		return $class;
	}
	add_filter('comment_reply_link', 'bc_business_consulting_replace_reply_link_class');
endif;



if( ! function_exists( 'bc_business_consulting_read_more_link' ) ) :
	/**
	* Adds custom Read More.
	*
	*/
	function bc_business_consulting_read_more_link() {
		return '<div class="clearfix"></div><div class="pull-left padding-top-25"><a class="btn btn-theme" href="' . esc_url( get_permalink() ) . '">'.esc_html__( 'Read More', 'bc-business-consulting' ).'<i class="fa fa-long-arrow-right"></i></a></div>';
	}
	add_filter( 'the_content_more_link', 'bc_business_consulting_read_more_link' );
endif;


if( ! function_exists( 'bc_business_consulting_excerpt_more' ) ) :
	/**
	 * Implement Custom Comment template.
	 *
	 * @since 1.0.0
	 *
	 * @param $comment, $args, $depth
	 * @return $html
	 */
function bc_business_consulting_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}
	$link = sprintf( '<div class="clearfix"></div> <div class="pull-left padding-top-25"><a href="%1$s" class="btn btn-theme">%2$s <i class="fa fa-fw fa-long-arrow-right"></i> </a>  </div>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bc-business-consulting' ), get_the_title( get_the_ID() ) )
	);
	return  $link;
}
add_filter( 'excerpt_more', 'bc_business_consulting_excerpt_more' );

endif;




if( ! function_exists( 'bc_business_consulting_blog_expert_excerpt_length' ) ) :

    /**
     * Excerpt length
     *
     * @since  Blog Expert 1.0.0
     *
     * @param null
     * @return int
     */
    function bc_business_consulting_blog_expert_excerpt_length( $length ){
        $excerpt_length = bc_business_consulting_get_option( 'excerpt_length_blog' );
		if( is_admin() ){
			 return $length;
		}else{
			if ( absint( $excerpt_length ) > 0 && !is_admin() ) {
				$length = absint( $excerpt_length );
			}
		}

        return $length;

    }

add_filter( 'excerpt_length', 'bc_business_consulting_blog_expert_excerpt_length', 999 );
endif; 


remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);