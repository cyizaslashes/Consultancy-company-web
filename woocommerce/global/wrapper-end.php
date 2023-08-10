<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-end.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
* Hook - bc_business_consulting_page_layout_end.
*
* @hooked bc_business_consulting_page_columns_end - 10
* @hooked bc_business_consulting_page_sidebar -20
* @hooked bc_business_consulting_page_wrapper_end - 30
* @hooked bc_business_consulting_page_layout_main_end - 10
*/
do_action('bc_business_consulting_page_layout_end');