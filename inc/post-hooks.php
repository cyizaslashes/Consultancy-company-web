<?php
/**
 * Functions hooked to post page.
 *
 * @package business_consulting
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 if ( ! function_exists( 'bc_business_consulting_posts_formats_thumbnail' ) ) :

	/**
	 * Post formats thumbnail.
	 *
	 * @since 1.0.0
	 */
	function bc_business_consulting_posts_formats_thumbnail() {
	?>
		<?php if ( has_post_thumbnail() ) :
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			$formats = get_post_format(get_the_ID());
		?>
           <div class="entry-cover <?php echo esc_attr( $formats );?>">
           		<?php if ( is_singular() ) :?>
               		 <a href="<?php echo esc_url( $post_thumbnail_url );?>" class="image-popup">
                <?php else: ?>
                	<a href="<?php echo esc_url( get_permalink() );?>" class="image-link">
                <?php endif;?>
                	<i class="fa fa-plus"></i>
                </a>
                <?php the_post_thumbnail('full');?>
            </div>
         <?php else:?>
        	 <div class="post-grid-image"></div>
        <?php endif;?>  
	<?php
	}

endif;
add_action( 'bc_business_consulting_posts_formats_thumbnail', 'bc_business_consulting_posts_formats_thumbnail' );


if ( ! function_exists( 'bc_business_consulting_posts_formats_video' ) ) :

	/**
	 * Post Formats Video.
	 *
	 * @since 1.0.0
	 */
	function bc_business_consulting_posts_formats_video() {
	
		$content = apply_filters( 'the_content', get_the_content(get_the_ID()) );
		$video = false;
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
		
		
			// If not a single post, highlight the video file.
			if ( ! empty( $video ) ) :
				foreach ( $video as $video_html ) {
					echo '<div class="post-grid-image"><div class="entry-video embed-responsive embed-responsive-16by9">';
						echo $video_html;
					echo '</div></div>';
				}
			else: 
				do_action('bc_business_consulting_posts_formats_thumbnail');	
			endif;
		
		
	 }

endif;
add_action( 'bc_business_consulting_posts_formats_video', 'bc_business_consulting_posts_formats_video' ); 


if ( ! function_exists( 'bc_business_consulting_posts_formats_audio' ) ) :

	/**
	 * Post Formats audio.
	 *
	 * @since 1.0.0
	 */
	function bc_business_consulting_posts_formats_audio() {
		$content = apply_filters( 'the_content', get_the_content() );
		$audio = false;
	
		// Only get audio from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
		}
	
		
	
		// If not a single post, highlight the audio file.
		if ( ! empty( $audio ) ) :
			foreach ( $audio as $audio_html ) {
				echo '<div class="post-grid-image">';
					echo $audio_html;
				echo '</div>';
			}
		else: 
			do_action('bc_business_consulting_posts_formats_video');	
		endif;
	
		
	 }

endif;
add_action( 'bc_business_consulting_posts_formats_audio', 'bc_business_consulting_posts_formats_audio' ); 

add_filter( 'use_default_gallery_style', '__return_false' );


if ( ! function_exists( 'bc_business_consulting_posts_formats_gallery' ) ) :

	/**
	 * Post Formats gallery.
	 *
	 * @since 1.0.0
	 */
	function bc_business_consulting_posts_formats_gallery() {
		global $post;
		if ( get_post_gallery() ) :
			echo '<div class="gallery-media owlGallery">';
			
				$gallery = get_post_gallery( $post, false );
				$ids = explode( ",", $gallery['ids'] );
				
				foreach( $ids as $id ) {
				
				   $link   = wp_get_attachment_url( $id );
				
				  echo '<div class="item"><img src="' . esc_url( $link ) . '"  class="img-responsive" alt="' .esc_attr( get_the_title() ). '" title="' .esc_attr( get_the_title() ). '"  /></div>';
				
				} 
				
			echo '</div>';
		else: 
			do_action('bc_business_consulting_posts_formats_thumbnail');	
		endif;	
	
	 }

endif;
add_action( 'bc_business_consulting_posts_formats_gallery', 'bc_business_consulting_posts_formats_gallery' ); 




if ( ! function_exists( 'bc_business_consulting_posts_blog_media' ) ) :

	/**
	 * Post bc_business_consulting_posts_blog_media
	 *
	 * @since 1.0.0
	 */
	function bc_business_consulting_posts_blog_media() {
		$formats = get_post_format(get_the_ID());
		
		switch ( $formats ) {
			default:
				do_action('bc_business_consulting_posts_formats_thumbnail');
			break;
			case 'gallery':
				do_action('bc_business_consulting_posts_formats_gallery');
			break;
			case 'audio':
				do_action('bc_business_consulting_posts_formats_audio');
			break;
			case 'video':
				do_action('bc_business_consulting_posts_formats_video');
			break;
		} 
		
	 }

endif;
add_action( 'bc_business_consulting_posts_blog_media', 'bc_business_consulting_posts_blog_media' ); 





if ( ! function_exists( 'bc_business_consulting_single_post_navigation' ) ) :

	/**
	 * Post Single Posts Navigation 
	 *
	 * @since 1.0.0
	 */
	function bc_business_consulting_single_post_navigation( ) {
		echo '<div class="row single-prev-next">';
		$prevPost = get_previous_post(true);
		if( $prevPost ) :
			echo '<div class="col-md-6 col-sm-6 ">';
				$prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(40,40) );
				//previous_post_link('%link',$prevthumbnail , TRUE); 
				echo '<div class="text"><h6><i class="fa fa-long-arrow-left"></i>'.esc_html__('Previous Article','bc-business-consulting').'</h6>';
					previous_post_link('%link',"<span>%title</span>", TRUE); 
				echo '</div>';
			echo '</div>';
			
		endif;
		
		$nextPost = get_next_post(true);
		if( $nextPost ) : 
			echo '<div class="col-md-6 col-sm-6 text-right">';
				$nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(40,40) );
				//next_post_link('%link',$nextthumbnail, TRUE);
				echo '<div class="text"><h6>'.esc_html__('Next Article','bc-business-consulting').'<i class="fa fa-long-arrow-right" ></i></h6>';
					next_post_link('%link',"<span>%title</span>", TRUE);
				echo '</div>';
			echo '</div>';
			
		endif;
		echo '</div><hr class="dashedhr">';
	} 

endif;
add_action( 'bc_business_consulting_single_post_navigation', 'bc_business_consulting_single_post_navigation', 10 ); 


 



