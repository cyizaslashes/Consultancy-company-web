<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Business_Consulting
 */

get_header(); ?>

<!-- Main -->
<main class="main-container">
    <div class="container">

        <div class="row">
            <div class="full-wh page-404 text-center col-md-12">

                

                    <h1 ><?php esc_html_e( 'Oooops!', 'bc-business-consulting' ); ?></h1>
                    <h2><?php esc_html_e( '404 Not Found', 'bc-business-consulting' ); ?></h2>
                   <h4 class="hint"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'bc-business-consulting' ); ?></h4>

                   
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-theme"><i class="fa fa-long-arrow-left"></i><?php esc_html_e( 'Back to home', 'bc-business-consulting' ); ?></a>
                   
                    
					
				
               

            </div>
        </div>
    </div>
</main>
<!-- /Main -->


<?php
get_footer();
