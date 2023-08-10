<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Consulting
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#bc-main-container">
<?php _e( 'Skip to content', 'bc-business-consulting' ); ?>
</a>
<!-- Header -->
<header class="header-main">
<?php
/**
* Hook - bc_business_consulting_header_layout.
*
* @hooked bc_business_consulting_header_top - 10
* @hooked bc_business_consulting_header_middle - 20
*/
do_action( 'bc_business_consulting_header_layout' );
?>
</header>
    
    
<div id="menu_container_wrapper">
<!-- Menu Block -->

	<?php
    /**
    * Hook - bc_business_consulting_nav_action.
    *
    * @hooked bc_business_consulting_nav_action - 10
	* @hooked bc_business_consulting_custom_widgets_or_static_content - 20
    */
    do_action( 'bc_business_consulting_nav_action' );
    ?>
    

     
</div>
   

