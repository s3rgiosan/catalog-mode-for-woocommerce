<?php

namespace s3rgiosan\WP\Plugin\WooCommerceCatalogMode;

/**
 * The dashboard-specific functionality of the plugin
 *
 * @since 1.0.0
 */
class Admin {

	/**
	 * The plugin's instance.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    Plugin
	 */
	private $plugin;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param Plugin $plugin This plugin's instance.
	 */
	public function __construct( Plugin $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * Register hooks.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		\add_filter( 'get_pages', [ $this, 'remove_pages' ] );
	}

	/**
	 * Removes cart and checkout pages from menu.
	 *
	 * @since  1.0.0
	 * @param  array $pages The pages.
	 * @return mixed
	 */
	public function remove_pages( $pages ) {

		$excluded_pages = [
			(int) \get_option( 'woocommerce_cart_page_id' ),
			(int) \get_option( 'woocommerce_checkout_page_id' ),
		];

		$total_pages = count( $pages );
		for ( $i = 0; $i < $total_pages; $i++ ) {
			$page = &$pages[ $i ];
			if ( in_array( $page->ID, $excluded_pages, true ) ) {
				unset( $pages[ $i ] );
			}
		}

		return $pages;
	}
}
