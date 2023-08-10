<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Consulting
 */

get_header(); ?>
<?php
/**
* Hook - bc_business_consulting_page_layout_start.
*
* @hooked bc_business_consulting_page_layout_main_start - 10
* @hooked bc_bc_business_consulting_breadcrumbs - 20
* @hooked bc_business_consulting_page_wrapper_start - 30
* @hooked bc_business_consulting_page_columns_start - 40
*/
do_action('bc_business_consulting_page_layout_start');
?>		
    
	<?php
    while ( have_posts() ) : the_post();
    
        get_template_part( 'template-parts/content', 'page' );
    
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
    
    endwhile; // End of the loop.
    ?>
            
<?php
/**
* Hook - bc_business_consulting_page_layout_end.
*
* @hooked bc_business_consulting_page_columns_end - 10
* @hooked bc_business_consulting_page_sidebar -20
* @hooked bc_business_consulting_page_wrapper_end - 30
* @hooked bc_business_consulting_page_layout_main_end - 10
*/
do_action('bc_business_consulting_page_layout_end');
?>	
<?php

get_footer();
