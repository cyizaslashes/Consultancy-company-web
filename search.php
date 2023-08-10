<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

    
	<?php 	if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

				/**
				* Hook - bc_business_consulting_loop_pagination.
				*
				* @hooked bc_business_consulting_loop_pagination - 10
				*/
				do_action( 'bc_business_consulting_loop_pagination' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
            
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
