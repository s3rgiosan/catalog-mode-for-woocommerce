<?php
/**
 * @wordpress-plugin
 * Plugin Name:          Catalog Mode for WooCommerce
 * Plugin URI:           https://github.com/s3rgiosan/catalog-mode-for-woocommerce/
 * Description:          Easily switch your WooCommerce store into catalog mode.
 * Version:              1.0.0
 * Author:               Sérgio Santos
 * Author URI:           https://s3rgiosan.com/
 * License:              GPL-2.0+
 * License URI:          http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:          catalog-mode-for-woocommerce
 * Domain Path:          /languages
 * WC requires at least: 3.5.0
 * WC tested up to:      3.5.6
 * GitHub Plugin URI:    https://github.com/s3rgiosan/catalog-mode-for-woocommerce
 * GitHub Branch:        master
 */

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'WOOCOMMERCECATALOGMODE_PLUGIN_FILE', \plugin_basename( __FILE__ ) );

/**
 * Begins execution of the plugin.
 *
 * @since 1.0.0
 */
\add_action(
	'plugins_loaded',
	function () {
		$plugin = new s3rgiosan\WP\Plugin\WooCommerceCatalogMode\Plugin( 'catalog-mode-for-woocommerce', '1.0.0' );
		$plugin->run();
	}
);
