<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://securebit.co
 * @since      1.0.0
 *
 * @package    Web3_Nft_Login
 * @subpackage Web3_Nft_Login/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Web3_Nft_Login
 * @subpackage Web3_Nft_Login/includes
 * @author     SecureBit <support@securebit.co>
 */
class Web3_Nft_Login_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'web3-nft-login',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
