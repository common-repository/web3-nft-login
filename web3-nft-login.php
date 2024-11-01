<?php

/**
 *
 * @link              https://securebit.co
 * @since             2.1.1
 * @package           Web3_Nft_Login
 *
 * @wordpress-plugin
 * Plugin Name:       Web3 login & NFT embed
 * Plugin URI:        https://securebit.co/web3-nft-login
 * Description:       Provides login with Web3 crypto wallets like Metamask, Wallet Connect, etc.
 * Version:           2.4.3
 * Author:            SecureBit
 * Author URI:        https://securebit.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       https://securebit.co
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'WEB3_NFT_LOGIN_VERSION', '2.4.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-web3-nft-login-activator.php
 */
function activate_web3_nft_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-web3-nft-login-activator.php';
	Web3_Nft_Login_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-web3-nft-login-deactivator.php
 */
function deactivate_web3_nft_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-web3-nft-login-deactivator.php';
	Web3_Nft_Login_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_web3_nft_login' );
register_deactivation_hook( __FILE__, 'deactivate_web3_nft_login' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-web3-nft-login.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_web3_nft_login() {

	$plugin = new Web3_Nft_Login();
	$plugin->run();

}
run_web3_nft_login();
