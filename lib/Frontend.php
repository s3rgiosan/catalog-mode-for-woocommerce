<?php

namespace s3rgiosan\WP\Plugin\WooCommerceCatalogMode;

/**
 * The public-facing functionality of the plugin.
 *
 * @since 1.0.0
 */
class Frontend {

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
		\add_action( 'wp', [ $this, 'redirect_pages' ] );

		$priority = \has_action( 'wp_loaded', [ 'WC_Form_Handler', 'add_to_cart_action' ] );
		\remove_action( 'wp_loaded', [ 'WC_Form_Handler', 'add_to_cart_action' ], $priority );

		\remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		\remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		\remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		\remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		\remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
		\remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
		\remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

		\add_filter( 'woocommerce_loop_add_to_cart_link', '__return_empty_string', 10 );
		\add_filter( 'woocommerce_is_purchasable', '__return_false' );

		\add_filter( 'woocommerce_structured_data_type_for_page', [ $this, 'remove_product_structured_data' ], 10, 2 );
	}

	/**
	 * Redirects cart and checkout pages.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function redirect_pages() {

		if ( ! \is_page() ) {
			return;
		}

		$cart     = \get_option( 'woocommerce_cart_page_id' );
		$checkout = \get_option( 'woocommerce_checkout_page_id' );

		if ( empty( $cart ) || empty( $checkout ) ) {
			return;
		}

		\wp_reset_query(); // phpcs:ignore WordPress.WP.DiscouragedFunctions.wp_reset_query_wp_reset_query

		if ( \is_page( $cart ) || \is_page( $checkout ) ) {
			\wp_safe_redirect( \home_url() );
			exit;
		}
	}

	/**
	 * Remove all product structured data.
	 *
	 * @param  array $types Page data types.
	 * @return array
	 */
	public function remove_product_structured_data( $types ) {

		if ( empty( $types ) ) {
			return $types;
		}

		$index = array_search( 'product', $types, true );

		if ( $index !== false ) {
			unset( $types[ $index ] );
		}

		return $types;
	}
}
