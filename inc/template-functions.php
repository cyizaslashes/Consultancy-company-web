<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Business_Consulting
 */


/**--------------------------------------------------------------
*----------------------------------------------------------------
* Business Consulting Header Layout 
*----------------------------------------------------------------
*----------------------------------------------------------------
*/

if( ! function_exists( 'bc_business_consulting_header_top' ) ) :
	/**
	* content Header
	*
	*/
	function bc_business_consulting_header_top() {
	?>
        <!-- Top Header -->
        <div class="top-header ">
            <!-- Container -->
            <div class="container">
              <div class="row">
              	
              	<div class="col-md-6 col-sm-6">
                	<?php if ( bc_business_consulting_get_option('social_profile_dialog') == 1 && bc_business_consulting_get_option('dialog_top') !="" )  :?>	
                	<span><?php echo esc_html( bc_business_consulting_get_option('dialog_top') );?></span>
                    <?php endif;?>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="pull-right top-menu">
					<?php
                    wp_nav_menu( array(
                        'theme_location'    => 'top_menu',
                        'depth'             => 2,
						'fallback_cb'    => 'bc_business_consulting_default_menu',
						'container' 	 => '',
                        )
                    );
					
                    ?>
                	</div>
                 </div>   
               </div>     
            </div><!-- Container /- -->
        </div><!-- Top Header /- -->
     <?php
	}
	add_action( 'bc_business_consulting_header_layout', 'bc_business_consulting_header_top',10 );
endif;


if( ! function_exists( 'bc_business_consulting_header_middle' ) ) :
	/**
	* content Header middle
	*
	*/
	function bc_business_consulting_header_middle() {
	?>
        <div class="middle-header container-fluid no-padding">
            <div class="container">
            	<div class="row">
                	<div class="col-md-4 col-sm-5">
                        <div class="logo-block">
                            <?php
                            if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                           	 the_custom_logo();
                            }else{
                            ?>
                           
                                <h3><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
                                <?php $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) : ?>
                                <p class="site-description"><?php echo esc_html($description); ?></p>
                            
                            <?php endif; ?>
                            
                            <?php }?>   
                        </div>
                   </div> 
                   <div class="col-md-8 col-sm-7">
                   		<?php  if ( is_active_sidebar( 'logo_right_widgets' ) ) :
									
								 dynamic_sidebar( 'logo_right_widgets' );
								 
						 else: ?>
                        <div class="header-info">
                            <?php if ( bc_business_consulting_get_option('social_profile_dialog') == 1 && count( bc_business_consulting_get_option('bc_business_consulting_award') ) > 0 )  :
								echo '<ul>';
								
								foreach ( bc_business_consulting_get_option('bc_business_consulting_award') as $key => $text): 
								
							?>	
                            
                                <li><h4><?php echo esc_html( $text['title'] );?></h4><span><?php echo esc_html( $text['text'] );?></span></li>
                               
                            <?php endforeach;
								echo '</ul>';
							 endif;?>
                        </div>
                        <?php endif;?>
                	</div>
                
                </div>
            </div>
        </div>	

     <?php
	}
	add_action( 'bc_business_consulting_header_layout', 'bc_business_consulting_header_middle',20 );
endif;


/**--------------------------------------------------------------
*----------------------------------------------------------------
* Business Consulting Blog Layout 
*----------------------------------------------------------------
*----------------------------------------------------------------
*/

if( ! function_exists( 'bc_business_consulting_blog_layout_main_start' ) ) :
	/**
	* content start Warppper
	*
	*/
	function bc_business_consulting_blog_layout_main_start() {
		echo '<main class="site-main page-spacing" id="main-content">';
	}
	add_action( 'bc_business_consulting_blog_layout_start', 'bc_business_consulting_blog_layout_main_start',10 );
endif;

if( ! function_exists( 'bc_bc_business_consulting_breadcrumbs' ) ) :
	/**
	* breadcrumbs
	*/
	function bc_bc_business_consulting_breadcrumbs() {
		?>
        <div class=" page-breadcrumb">
            <div class="container">
            	<?php do_action('bc_business_consulting_breadcrumb'); ?>
            </div>
        </div>
        <?php
	}
	add_action( 'bc_business_consulting_blog_layout_start', 'bc_bc_business_consulting_breadcrumbs',20 );
endif;


if( ! function_exists( 'bc_business_consulting_blog_wrapper_start' ) ) :
	/**
	* Blog wrapper
	*/
	function bc_business_consulting_blog_wrapper_start() {
		?>
        <div id="bc-main-container" class="container blog latestnews-section ">
             <div class="row">
        <?php
	}
	add_action( 'bc_business_consulting_blog_layout_start', 'bc_business_consulting_blog_wrapper_start',30 );
endif;

if( ! function_exists( 'bc_business_consulting_blog_columns_start' ) ) :
	/**
	* Blog wrapper
	*/
	function bc_business_consulting_blog_columns_start( $layout = '' ) {
		 if( $layout == "" ){
			 $layout = bc_business_consulting_get_option('blog_layout');
		 }
		 if( $layout != 'no-sidebar' ): 
		?>
        <div class="col-md-8 col-sm-8 content-area <?php echo esc_attr($layout);?>">
          <?php else: ?>
        <div class="col-md-10 col-sm-10 content-area <?php echo esc_attr($layout);?>">
        <?php
		endif;
	}
	add_action( 'bc_business_consulting_blog_layout_start', 'bc_business_consulting_blog_columns_start',40 );
endif;

/**--------------------------------------------------------------
*----------------------------------------------------------------
* Business Consulting Blog Layout  End
*----------------------------------------------------------------
*----------------------------------------------------------------
*/
if( ! function_exists( 'bc_business_consulting_blog_columns_end' ) ) :
	/**
	* Blog wrapper
	*/
	function bc_business_consulting_blog_columns_end() {
		?>
        </div>
        <?php
	}
	add_action( 'bc_business_consulting_blog_layout_end', 'bc_business_consulting_blog_columns_end',10 );
endif;


if( ! function_exists( 'bc_business_consulting_blog_sidebar' ) ) :
	/**
	* breadcrumbs
	*/
	function bc_business_consulting_blog_sidebar( $layout = '' ) {
		 if( $layout == "" ){
			 $layout = bc_business_consulting_get_option('blog_layout');
		 }
		 if( $layout != 'no-sidebar' ): 
		?>
         <div class="col-md-4 col-sm-4 widget-area" >
            <?php  get_sidebar();?> 
        </div>
        <?php
		endif;
	}
	add_action( 'bc_business_consulting_blog_layout_end', 'bc_business_consulting_blog_sidebar',20 );
endif;


if( ! function_exists( 'bc_business_consulting_blog_wrapper_end' ) ) :
	/**
	* Blog wrapper
	*/
	function bc_business_consulting_blog_wrapper_end() {
		?>
        	</div>
        </div>
        <?php
	}
	add_action( 'bc_business_consulting_blog_layout_end', 'bc_business_consulting_blog_wrapper_end',30 );
endif;

if( ! function_exists( 'bc_business_consulting_blog_layout_main_end' ) ) :
	/**
	* content start Warppper
	*
	*/
	function bc_business_consulting_blog_layout_main_end() {
		echo '</main>';
	}
	add_action( 'bc_business_consulting_blog_layout_end', 'bc_business_consulting_blog_layout_main_end',40 );
endif;



/**--------------------------------------------------------------
*----------------------------------------------------------------
* Business Consulting Header Layout 
*----------------------------------------------------------------
*----------------------------------------------------------------
*/

if( ! function_exists( 'bc_business_consulting_nav_action' ) ) :
	/**
	* Navigtion And Header Title
	*
	*/
	function bc_business_consulting_nav_action() {
	?>
     <div id="sticker">
    <div class="menu-block menu-block-section container-fluid no-padding">
        <!-- Container -->
        <div class="container">	
        	<div class="row">
                <div class="col-md-10">			
                    <span class="home-icon"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa fa-home" ></i></a></span>
                    <nav class="navbar ow-navigation">
                    
                        
                        <div class="navbar-header">
                            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button" tabindex="0" autofocus>
                                <span class="sr-only"><?php echo esc_html__( 'Toggle navigation', 'bc-business-consulting' );?></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <?php
                        wp_nav_menu( array(
                            'theme_location'    => 'primary',
                            'depth'             => 3,
                            'container'         => 'div',
                            'container_class'   => 'collapse navbar-collapse navbar-left',
                            'container_id'      => 'navbar',
                            'menu_class'        => 'nav navbar-nav menubar',
                            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'            => new WP_Bootstrap_Navwalker())
                        );
                        ?>
                        
                    </nav><!-- Navigation /- -->
                </div>
                <div class="col-md-2 mobile-hide">	
                 <div class="header-social">
                        <ul> 
                <?php if ( bc_business_consulting_get_option('social_profile') == 1 && count (  bc_business_consulting_get_option('bc_business_consulting_social_profile_link') ) > 0 ) :?>	
                
                	 <?php $social_link = bc_business_consulting_get_option('bc_business_consulting_social_profile_link');?>
                   
						<?php 
						foreach ($social_link['social'] as $key => $link): 
							if( $link != ""):
							?>
							<li><a href="<?php echo esc_url( $link );?>" class="fa <?php echo esc_attr($key);?>" target="_blank"></a></li>
							<?php endif; 
                        endforeach;
						?>
					
                    <?php endif;?>
                    
                    <?php 
						if ( bc_business_consulting_get_option('search_icon') == 1 ) :?>
						<li><a href="javascript:void(0);" title="<?php esc_attr_e('search_icon','bc-business-consulting');?>" id="popup-search"><i class="fa fa-search"></i></a></li>
                    <?php endif;?>
                    </ul>
                    </div>
            	</div>
           
           </div> <!-- Row /- -->
        </div><!-- Container /- -->
    </div><!-- Menu Block /- -->
  </div>
     <?php
	}
	add_action( 'bc_business_consulting_nav_action', 'bc_business_consulting_nav_action',10 );
endif;


/**--------------------------------------------------------------
*----------------------------------------------------------------
* Business Consulting Footer Layout 
*----------------------------------------------------------------
*----------------------------------------------------------------
*/
if( ! function_exists('bc_business_consulting_default_menu') ):
/**
	*  fallback default menu.
	*
	* @since 1.0.0
	*/
	function bc_business_consulting_default_menu(){
		if ( current_user_can( 'edit_theme_options' ) ) {	
	?>
        <ul>                  
           <li><a href="<?php echo esc_url( admin_url('nav-menus.php') ); ?>"><?php esc_html_e( 'Set Up menu here', 'bc-business-consulting' ); ?></a></li>
        </ul>
	<?php
		}
	}
endif;


if( ! function_exists( 'bc_business_consulting_footer_layout' ) ) :
	/**
	* Navigtion And Header Title
	*
	*/
	function bc_business_consulting_footer_layout() {
	?>
   
   	<footer class="footer-main ">
    	<?php if ( is_active_sidebar( 'footer' ) ) { ?>
		<div class="container">
			<div class="row">
				<?php dynamic_sidebar( 'footer' ); ?>
			</div>
		</div>
        <?php }?>
        
		<div class="footer-bottom">
			<div class="container">
              <div class="row">
                   
                  <div class="col-md-7 col-sm-7"> 
                    
                    <div class="pull-left">
                    	<?php  echo esc_html ( bc_business_consulting_get_option('copyright_text') ); ?>
                        <div class="carditis">
                        <a href="<?php /* translators:straing */ echo esc_url( esc_html__( 'https://wordpress.org/themes/bc-business-consulting/', 'bc-business-consulting' ) ); ?>" target="_blank"><?php echo esc_html__( 'Theme', 'bc-business-consulting' );?></a>
                        
                        <?php
                        printf( /* translators:straing */  esc_html__( ': %1$s by %2$s.', 'bc-business-consulting' ), 'Business Consulting',  esc_html__( 'aThemeArt', 'bc-business-consulting' ) ); ?>
                        <?php /* translators:straing */  printf( esc_html__( 'Proudly powered by %s .', 'bc-business-consulting' ), 'WordPress' ); ?>
                        </div>
                    </div>
				  </div>
                  
                   <div class="col-md-5 col-sm-5"> 
					<?php
                    wp_nav_menu( array(
                        'theme_location'    => 'footer',
                        'depth'             => 1,
						'fallback_cb'    => 'bc_business_consulting_default_menu',
						'container' 	 => '',
                        )
                    );
					
                    ?>
                   </div> 
                    
			   </div>
			</div>
		</div>
	</footer><!-- Footer Main /- -->
   
     <?php
	}
	add_action( 'bc_business_consulting_footer_layout', 'bc_business_consulting_footer_layout',10 );
endif;


if( !function_exists('bc_business_consulting_popup_search') ){
	/**
	* Add footer popup search
	*
	* @since 1.0.0
	*/
	function bc_business_consulting_popup_search(){
	?>
  	<div class="popup-search">
      	<div id="popup-search-wrap">
        <div class="v-align-middle">
            <?php get_search_form(); ?>
        </div>
        
        <div class="close-popup"><i class="fa fa-times"  tabindex="0" autofocus="true"></i></div>
        </div>
	</div>
    <?php
	}
}
add_action( 'bc_business_consulting_footer_layout', 'bc_business_consulting_popup_search', 20 );


/**--------------------------------------------------------------
*----------------------------------------------------------------
* Business Consulting Header Banner , Widgets, Title 
*----------------------------------------------------------------
*----------------------------------------------------------------*/

if ( ! function_exists( 'bc_business_consulting_custom_header_start' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function bc_business_consulting_custom_header_start() {
	 ?>
     	<div class="custom_header">
     <?php
		
	}

endif;
add_action( 'bc_business_consulting_custom_static_header', 'bc_business_consulting_custom_header_start',10 );


if ( ! function_exists( 'bc_business_consulting_title_in_custom_header' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function bc_business_consulting_title_in_custom_header() {

		if ( is_home() ) {
				echo '<h1 class="display-1">';
				echo bloginfo( 'name' );
				echo '</h1>';
				echo '<div class="subtitle">';
				echo esc_html(get_bloginfo( 'description', 'display' ));
				echo '</div>';
			 
		
		} elseif ( is_singular() ) {
			echo '<h1 class="display-1">';
			echo single_post_title( '', false );
			echo '</h1>';
		} elseif ( is_archive() ) {
			the_archive_title( '<h1 class="display-1">', '</h1>' );
		} elseif ( is_search() ) {
			echo '<h1 class="title">';
			printf( /* translators:straing */ esc_html__( 'Search Results for: %s', 'bc-business-consulting' ),  get_search_query() );
			echo '</h1>';
		} elseif ( is_404() ) {
			echo '<h1 class="display-1">';
			esc_html_e( '404 Error', 'bc-business-consulting' );
			echo '</h1>';
		}

	}

endif;
add_action( 'bc_business_consulting_custom_static_header', 'bc_business_consulting_title_in_custom_header',20 );

if ( ! function_exists( 'bc_business_consulting_sub_title_in_custom_header' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function bc_business_consulting_sub_title_in_custom_header() {

		echo '<div class="subtitle">';

		if ( is_archive() ) {
			?>
              <?php the_archive_description( '<div class="subtitle">', '</div>' );?>
            <?php
		}else{
			?>
             <?php if ( function_exists( 'the_subtitle' ) ) { ?>
                 <div class="subtitle"><?php the_subtitle() ;?></div>  
              <?php }?>
             
            <?php
			
		}

		echo '</div>';

	}

endif;
add_action( 'bc_business_consulting_custom_static_header', 'bc_business_consulting_sub_title_in_custom_header',30 );



if ( ! function_exists( 'bc_business_consulting_custom_header_end' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function bc_business_consulting_custom_header_end() {
	?>
    	</div>
    <?php
		
	}

endif;

add_action( 'bc_business_consulting_custom_static_header', 'bc_business_consulting_custom_header_end',40 );

if ( ! function_exists( 'bc_bc_business_consulting_custom_static_header_banner' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function bc_bc_business_consulting_custom_static_header_banner() {
		$header_image = get_header_image();
		 if( $header_image !="" ):
   			echo '<img src="'.esc_url( $header_image ).'" class="img-responsive" alt="" title="" />';
         endif;
	}

endif;

add_action( 'bc_business_consulting_custom_static_header', 'bc_bc_business_consulting_custom_static_header_banner',50 );




if ( ! function_exists( 'bc_business_consulting_custom_widgets_or_static_content' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function bc_business_consulting_custom_widgets_or_static_content() {
	
		if ( is_front_page()){
			if ( is_active_sidebar( 'front_page_sidebar' ) ) {
				 dynamic_sidebar( 'front_page_sidebar' );
			}else{
				do_action('bc_business_consulting_custom_static_header');
			}
		} elseif ( is_home()){
			if ( is_active_sidebar( 'blog_page_sidebar' ) ) {
				 dynamic_sidebar( 'blog_page_sidebar' );
			}else{
				do_action('bc_business_consulting_custom_static_header');	
			}
		}else{
			do_action('bc_business_consulting_custom_static_header');		
		}
	}

endif;

add_action( 'bc_business_consulting_nav_action', 'bc_business_consulting_custom_widgets_or_static_content',20 );




if ( ! function_exists( 'bc_business_consulting_breadcrumb' ) ) :

	/**
	 * Breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function bc_business_consulting_breadcrumb() {
		
			
		
		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			
			require get_template_directory() . '/vendors/breadcrumbs/breadcrumbs';
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
	
		breadcrumb_trail( $breadcrumb_args );
	
		
		
	}

endif;
add_action( 'bc_business_consulting_breadcrumb', 'bc_business_consulting_breadcrumb',10 );




if ( ! function_exists( 'bc_business_consulting_loop_pagination' ) ) :

	/**
	 * LOOP pagination .
	 *
	 * @since 1.0.0
	 */
	function bc_business_consulting_loop_pagination() {
		 the_posts_pagination( array(
			'type' => 'list',
			'mid_size' => 2,
			'prev_text' => esc_html__( 'Previous', 'bc-business-consulting' ),
			'next_text' => esc_html__( 'Next', 'bc-business-consulting' ),
			'screen_reader_text' => esc_html__( '&nbsp;', 'bc-business-consulting' ),
		) );
	}

endif;
add_action( 'bc_business_consulting_loop_pagination', 'bc_business_consulting_loop_pagination',10 );




/**--------------------------------------------------------------
*----------------------------------------------------------------
* Business Consulting Blog Layout 
*----------------------------------------------------------------
*----------------------------------------------------------------
*/

if( ! function_exists( 'bc_business_consulting_page_layout_main_start' ) ) :
	/**
	* content start Warppper
	*
	*/
	function bc_business_consulting_page_layout_main_start() {
		echo '<main class="site-main page-spacing">';
	}
	add_action( 'bc_business_consulting_page_layout_start', 'bc_business_consulting_page_layout_main_start',10 );
endif;

add_action( 'bc_business_consulting_page_layout_start', 'bc_bc_business_consulting_breadcrumbs',20 );


if( ! function_exists( 'bc_business_consulting_page_wrapper_start' ) ) :
	/**
	* Blog wrapper
	*/
	function bc_business_consulting_page_wrapper_start() {
		?>
        <div class="container page ">
             <div class="row">
        <?php
	}
	add_action( 'bc_business_consulting_page_layout_start', 'bc_business_consulting_page_wrapper_start',30 );
endif;

if( ! function_exists( 'bc_business_consulting_page_columns_start' ) ) :
	/**
	* Blog wrapper
	*/
	function bc_business_consulting_page_columns_start( $layout = '' ) {
		
		 if( $layout == "" ){
			 $layout = bc_business_consulting_get_option('page_layout');
		 }
		
		 if( $layout != 'no-sidebar' ): 
		?>
        <div class="col-md-8 col-sm-8 content-area <?php echo esc_attr($layout);?>">
          <?php else: ?>
        <div class="col-md-12 col-sm-12 content-area <?php echo esc_attr($layout);?>">
        <?php
		endif;
	}
	add_action( 'bc_business_consulting_page_layout_start', 'bc_business_consulting_page_columns_start',40,1);
endif;

/**--------------------------------------------------------------
*----------------------------------------------------------------
* Business Consulting Blog Layout  End
*----------------------------------------------------------------
*----------------------------------------------------------------
*/
if( ! function_exists( 'bc_business_consulting_page_columns_end' ) ) :
	/**
	* Blog wrapper
	*/
	function bc_business_consulting_page_columns_end() {
		?>
        </div>
        <?php
	}
	add_action( 'bc_business_consulting_page_layout_end', 'bc_business_consulting_page_columns_end',10 );
endif;


if( ! function_exists( 'bc_business_consulting_page_sidebar' ) ) :
	/**
	* breadcrumbs
	*/
	function bc_business_consulting_page_sidebar( $layout='' ) {
		
		if( $layout == "" ){
			 $layout = bc_business_consulting_get_option('page_layout');
		 }
		 if( $layout != 'no-sidebar' ): 
		?>
         <div class="col-md-4 col-sm-4 widget-area" >
            <?php  get_sidebar();?> 
        </div>
        <?php
		endif;
	}
	add_action( 'bc_business_consulting_page_layout_end', 'bc_business_consulting_page_sidebar',20,1 );
endif;


if( ! function_exists( 'bc_business_consulting_page_wrapper_end' ) ) :
	/**
	* Blog wrapper
	*/
	function bc_business_consulting_page_wrapper_end() {
		?>
        	</div>
        </div>
        <?php
	}
	add_action( 'bc_business_consulting_page_layout_end', 'bc_business_consulting_page_wrapper_end',30 );
endif;

if( ! function_exists( 'bc_business_consulting_page_layout_main_end' ) ) :
	/**
	* content start Warppper
	*
	*/
	function bc_business_consulting_page_layout_main_end() {
		echo '</main>';
	}
	add_action( 'bc_business_consulting_page_layout_end', 'bc_business_consulting_page_layout_main_end',40 );
endif;