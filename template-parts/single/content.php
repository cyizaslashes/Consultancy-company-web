<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Consulting
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('type-post') ); ?>>
	
		<?php
        /**
        * Hook - bc_business_consulting_posts_blog_media.
        *
        * @hooked bc_business_consulting_posts_blog_media - 10
        */
        do_action( 'bc_business_consulting_posts_blog_media' );
        ?>
		<?php
        
        if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
        <?php bc_business_consulting_posted_on(); ?>
        <?php
			echo ' <a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" class="avatar_round">';
			echo get_avatar( get_the_author_meta('user_email'), $size = '70'); 
			echo ' </a>';
		?>
        </div><!-- .entry-meta -->
        <?php
        endif; ?>
	

	<div class="entry-content entry-block">
    
    <div class="post-by">
        <span><?php echo esc_html__( 'By -','bc-business-consulting' );?></span>
       <?php echo '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'; ?>
    </div>
	
        <div class="entry-title">
        <?php
        if ( is_singular() ) :
            the_title( '<h2 class="entry-title">', '</h2>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;
        ?>
        </div>
                            
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators:straing */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bc-business-consulting' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bc-business-consulting' ),
				'after'  => '</div>',
			) );
		?>
       
    
        <div class="pull-right padding-top-35">
        <?php bc_business_consulting_entry_footer(); ?>
        </div>
       
        <div class="clearfix"></div>
	</div><!-- .entry-content -->
    
    
	
</article><!-- #post-<?php the_ID(); ?> -->
