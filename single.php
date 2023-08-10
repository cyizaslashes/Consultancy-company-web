<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Business_Consulting
 */

get_header(); ?>
<?php
/**
* Hook - bc_business_consulting_blog_layout_start.
*
* @hooked bc_business_consulting_blog_layout_main_start - 10
* @hooked bc_bc_business_consulting_breadcrumbs - 20
* @hooked bc_business_consulting_blog_wrapper_start - 30
* @hooked bc_business_consulting_blog_columns_start - 40
*/
do_action('bc_business_consulting_blog_layout_start');
?>		
    
	<?php
    while ( have_posts() ) : the_post();
    
        get_template_part( 'template-parts/single/content', get_post_type() );
		
    	
		  if ( is_singular() ) :
			echo '<div class="blogpost-nextprev">';
				the_post_navigation( array(
					'prev_text'                  => __( '<i class="fa fa-long-arrow-left"></i>%title', 'bc-business-consulting' ),
					'next_text'                  => __( '%title <i class="fa fa-long-arrow-right"></i>', 'bc-business-consulting' ),
					'in_same_term'               => true,
					'taxonomy'                   => esc_html__( 'post_tag', 'bc-business-consulting' ),
					'screen_reader_text' => esc_html__( 'Continue Reading', 'bc-business-consulting' ),
				) );
			echo '<div class="clearfix"></div></div>';
        endif;
		
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
    
    endwhile; // End of the loop.
    ?>
            
<?php
/**
* Hook - bc_business_consulting_blog_layout_end.
*
* @hooked bc_business_consulting_blog_columns_end - 10
* @hooked bc_business_consulting_blog_sidebar -20
* @hooked bc_business_consulting_blog_wrapper_end - 30
* @hooked bc_business_consulting_blog_layout_main_end - 10
*/
do_action('bc_business_consulting_blog_layout_end');
?>	
<?php

get_footer();
