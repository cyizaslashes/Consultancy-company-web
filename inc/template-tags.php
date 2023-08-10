<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Business_Consulting
 */

if ( ! function_exists( 'bc_business_consulting_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function bc_business_consulting_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			
			$time_string = sprintf( $time_string,
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);
	
			$posted_on = sprintf(
				/* translators: %s: post date. */
				esc_html_x( 'Last Updated on %s', 'post date', 'bc-business-consulting' ),
				$time_string 
			);
			
		}else{
		
			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);
	
			$posted_on = sprintf(
				/* translators: %s: post date. */
				esc_html_x( 'Posted on %s', 'post date', 'bc-business-consulting' ),
				$time_string 
			);
				
			
		}

		

		
		
		
		echo '<ul class="list-inline">';

		echo '<li class="posted-on"><i class="fa fa-calendar"></i>' . $posted_on . '</li>'; // WPCS: XSS OK.
		
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'bc-business-consulting' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<li>/</li><li class="cat-links">' . esc_html__( 'Posted in %1$s', 'bc-business-consulting' ) . '</li>', $categories_list ); // WPCS: XSS OK.
			}

		}
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<li>/</li><li class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'bc-business-consulting' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</li>';
		}
		
		echo '</ul>';

	}
endif;

if ( ! function_exists( 'bc_business_consulting_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function bc_business_consulting_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			
			/* translators: used between list items, there is a space after the comma */
		

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'bc-business-consulting' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="post-tag"><i class="fa fa-tag"></i>' . esc_html__( 'Tagged : %1$s', 'bc-business-consulting' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}
			
		}

		

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'bc-business-consulting' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
