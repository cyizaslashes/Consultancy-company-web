<?php
/**
 * business_consulting Admin Class.
 *
 * @author  eDataStyle
 * @package business_consulting
 * @since   1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'bc_business_consulting_Admin' ) ) :

/**
 * bc_business_consulting_Admin Class.
 */
class bc_business_consulting_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );

		$page = add_theme_page( esc_attr__( 'Getting Started', 'bc-business-consulting' ) , 
		esc_attr__( 'Getting Started', 'bc-business-consulting' ), 
		'activate_plugins', 
		'welcome', array( $this, 'welcome_screen' ) );
		
		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'bc-business-consulting-welcome', get_template_directory_uri() . '/inc/pro/welcome.css', array(), '1.0' );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $pagenow;

		wp_enqueue_style( 'bc-business-consulting-message', get_template_directory_uri() . '/inc/pro/message.css', array(), '1.0' );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'bc_business_consulting_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'bc_business_consulting_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['business_consulting-hide-notice'] ) && isset( $_GET['_business_consulting_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( wp_unslash($_GET['_business_consulting_notice_nonce']), 'business_consulting_hide_notices_nonce' ) ) {
				/* translators: %s: plugin name. */
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'bc-business-consulting' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) 
			/* translators: %s: plugin name. */{
				wp_die( esc_html__( 'Cheatin&#8217; huh?', 'bc-business-consulting' ) );
			}

			$hide_notice = sanitize_text_field( wp_unslash( $_GET['business_consulting-hide-notice'] ) );
			update_option( 'bc_business_consulting_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated cresta-message">
			<a class="cresta-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'business_consulting-hide-notice', 'welcome' ) ), 'business_consulting_hide_notices_nonce', '_business_consulting_notice_nonce' ) ); ?>"><?php  /* translators: %s: plugin name. */ esc_html_e( 'Dismiss', 'bc-business-consulting' ); ?></a>
			<p><?php printf( /* translators: %s: plugin name. */  esc_html__( 'Welcome! Thank you for choosing business consulting! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%2$s.', 'bc-business-consulting' ), '<a href="' . esc_url( admin_url( 'themes.php?page=welcome' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=welcome' ) ); ?>"><?php esc_html_e( 'Get started with BC', 'bc-business-consulting' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="cresta-theme-info">
				<h1>
					<?php esc_html_e('About', 'bc-business-consulting'); ?>
					<?php echo esc_html( $theme->get( 'Name' )) ." ". esc_html( $theme->get( 'Version' ) ); ?>
				</h1>

			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo esc_html( $theme->display( 'Description' ) ); ?>
				<p class="cresta-actions">
					<a href="<?php echo esc_url( 'https://athemeart.com/downloads/bc-business-consulting/?ref=welcome' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'bc-business-consulting' ); ?></a>

					<a href="<?php echo esc_url( apply_filters( 'business_consulting_pro_theme_url', 'https://athemeart.com/demo/bc-source/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'bc-business-consulting' ); ?></a>

					<a href="<?php echo esc_url( apply_filters( 'business_consulting_pro_theme_url', 'https://athemeart.com/downloads/bc-business-consulting/?ref=welcome' ) ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version Demo', 'bc-business-consulting' ); ?></a>

					<a href="<?php echo esc_url( apply_filters( 'business_consulting_pro_theme_url', 'https://wordpress.org/support/theme/bc-business-consulting/reviews/#new-post' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'bc-business-consulting' ); ?></a>
				</p>
				</div>

				<div class="cresta-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
				</div>
			</div>
		</div>

		<h2 class="nav-tab-wrapper">
			
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Free Vs PRO', 'bc-business-consulting' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Changelog', 'bc-business-consulting' ); ?>
			</a>
            
            
            
            
		</h2>
		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
			
		$tabs_data = isset( $_GET['tab'] ) ? sanitize_title( wp_unslash($_GET['tab']) ) : '';
		$current_tab = empty( $tabs_data ) ? /* translators: About. */ esc_html('about','business_consulting') : $tabs_data;

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog point-releases">
				<div class="under-the-hood two-col">
					<div class="col">
						<h4><?php esc_html_e( 'Theme Customizer', 'bc-business-consulting' ); ?></h4>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'bc-business-consulting' ) ?></p>
						<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-secondary"><?php /* translators: %s: plugin name. */ esc_html_e( 'Customize', 'bc-business-consulting' ); ?></a></p>
					</div>

					<div class="col">
						<h4><?php esc_html_e( 'Got theme support question?', 'bc-business-consulting' ); ?></h4>
						<p><?php esc_html_e( 'Please put it in our support forum.', 'bc-business-consulting' ) ?></p>
						<p><a target="_blank" href="<?php echo esc_url( 'https://athemeart.com/support/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Support', 'bc-business-consulting' ); ?></a></p>
					</div>

					<div class="col">
						<h4><?php esc_html_e( 'Need more features?', 'bc-business-consulting' ); ?></h4>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'bc-business-consulting' ) ?></p>
						<p><a target="_blank" href="<?php echo esc_url( 'https://athemeart.com/downloads/business_consulting?ref=welcome' ); ?>" class="button button-secondary"><?php esc_html_e( 'Info about PRO version', 'bc-business-consulting' ); ?></a></p>
					</div>

					
				</div>
			</div>

			<div class="return-to-dashboard cresta">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates', 'bc-business-consulting' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'bc-business-consulting' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'bc-business-consulting' ) : esc_html_e( 'Go to Dashboard', 'bc-business-consulting' ); ?></a>
			</div>
		</div>
		<?php
	}

		/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'bc-business-consulting' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'business_consulting_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
		<?php
	}

	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}

	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'bc-business-consulting' ); ?></p>

			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h4><?php esc_html_e('Features', 'bc-business-consulting'); ?></h4></th>
						<th width="25%"><h4><?php esc_html_e('business consulting', 'bc-business-consulting'); ?></h4></th>
						<th width="25%"><h4><?php esc_html_e('business consulting PRO', 'bc-business-consulting'); ?></h4></th>
					</tr>
				</thead>
				<tbody>
                	<tr>
						<td><h4><?php esc_html_e('24/7 Priority Support', 'bc-business-consulting'); ?></h4></td>
						<td><?php esc_html_e('WP forum', 'bc-business-consulting'); ?></td>
						<td><?php esc_html_e('Ticket, email , Skype & Teamviewer', 'bc-business-consulting'); ?></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('Pagebulider addons  ', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('visual composer Theme toolkit addons  ', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('visual composer bc toolkit addons  ', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Page Builder by SiteOrigin with 8+ Widgets  ', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Home Slider', 'bc-business-consulting'); ?></h4></td>
						<td>3rd party plugins</td>
						<td>Included with theme options</td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Navigation Color', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h4><?php esc_html_e('Responsive Design', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('Post format', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h4><?php esc_html_e('Change Background', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h4><?php esc_html_e('Unlimited Text Color', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h4><?php esc_html_e('Logo Upload', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h4><?php esc_html_e('Choose Social Icon ', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('jQuery Lightbox Popup ', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					
                    
					
                    <tr>
						<td><h4><?php esc_html_e('Extended Theme Options Panel', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Styling for all sections', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('Google Fonts Supported (500+ Fonts)', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Homepage Sections', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('Sub Title', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					
                    <tr>
						<td><h4><?php esc_html_e('Page Layout Style', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Page Layout Style', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Blog Layout Style', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Blog Gird Style', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Breadcrumb', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('  Footer Branding Our Site', 'bc-business-consulting'); ?></h4></td>
						<td><?php esc_html_e('Yes', 'bc-business-consulting'); ?></td>
						<td><?php esc_html_e('No', 'bc-business-consulting'); ?></td>
					</tr>
                    
                    <tr>
						<td><h4><?php esc_html_e('WP-Admin Welcome Section', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-no"></span></td>
					</tr>
                    
                    <tr>
						<td><h4><?php esc_html_e('WooCommerce', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('WooCommerce Custom Plugins', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                      <tr>
						<td><h4><?php esc_html_e('WooCommerce Customizable Options', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('WooCommerce Child Theme', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('WooCommerce Layout Options', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('You can control overall everything without code', 'bc-business-consulting'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							
							<a href="<?php echo esc_url( apply_filters( 'business_consulting_pro_theme_url', 'https://athemeart.com/downloads/bc-business-consulting/?ref=welcome' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'More Information', 'bc-business-consulting' ); ?></a>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
		<?php
	}
	
	
	

}

endif;

return new bc_business_consulting_Admin();
