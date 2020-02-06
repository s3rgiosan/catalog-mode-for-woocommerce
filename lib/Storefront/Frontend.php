<?php

namespace s3rgiosan\WP\Plugin\WooCommerceCatalogMode\Storefront;

/**
 * The public-facing functionality of the Storefront theme.
 *
 * @since 1.0.0
 */
class Frontend extends \s3rgiosan\WP\Plugin\WooCommerceCatalogMode\Frontend {

	/**
	 * Register hooks.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		$theme = \wp_get_theme();
		if ( 'Storefront' !== $theme->name && 'Storefront' !== $theme->parent_theme ) {
			return;
		}

		\remove_action( 'storefront_header', 'storefront_header_cart', 60 );
		\remove_action( 'storefront_footer', 'storefront_handheld_footer_bar', 999 );
		\remove_action( 'storefront_after_footer', 'storefront_sticky_single_add_to_cart', 999 );
	}
}
