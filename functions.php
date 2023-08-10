<?php

/**
 * Load Theme Core Hook file.
 */

require get_template_directory() . '/inc/theme-core.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement wp-bootstrap-navwalker.
 */
require get_template_directory() . '/vendors/wp-bootstrap-navwalker/wp-bootstrap-navwalker.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme Posts by hooking into WordPress.
 */
require get_template_directory() . '/inc/post-hooks.php';


/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';



/**
 * Load customizer.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Functions which enhance the theme by fitter hook into WordPress.
 */
require get_template_directory() . '/inc/fitter-hook.php';

/**
 * Load breadcrumbs
 */
require get_template_directory() . '/vendors/breadcrumbs/breadcrumbs.php';



require get_template_directory() . '/inc/pro/admin-page.php';

require get_template_directory() . '/inc/recommend-plugins.php';

