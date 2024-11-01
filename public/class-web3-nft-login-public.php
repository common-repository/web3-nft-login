<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://securebit.co
 * @since      1.0.0
 *
 * @package    Web3_Nft_Login
 * @subpackage Web3_Nft_Login/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Web3_Nft_Login
 * @subpackage Web3_Nft_Login/public
 * @author     SecureBit <support@securebit.co>
 */

require('partials/web3-nft-login-public-modal.php');
  
class Web3_Nft_Login_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Web3_Nft_Login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Web3_Nft_Login_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/web3-nft-login-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Web3_Nft_Login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Web3_Nft_Login_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

	}

	public function init() {

		if(isset($_GET['action']) && $_GET['action']=='web3_login') {
			
			if(isset($_GET['nonce']) && isset($_GET['signature'])) {
			
				require_once("elliptic-php/ecrecover.php");
				
				$nonce = sanitize_text_field($_GET['nonce']); //message
				$signature = sanitize_text_field($_GET['signature']);
				
				if(!wp_verify_nonce($nonce, "web3-nft-sign")) {
					wp_die("Invalid nonce. Please try again.");
					exit;
				}
			
				$addr= ecrecover($nonce, $signature);
				$addr=preg_replace("/\n/","",$addr);

				if(!empty($addr)) {
					$user = get_user_by('login', $addr);
					if($user)
					{
					   wp_set_auth_cookie($user->ID);
					   wp_redirect(get_site_url());
					   exit;
					} else {
						$random_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );
						$user_id = wp_create_user( $addr, $random_password, "");
						wp_set_auth_cookie($user->ID);
					    wp_redirect(get_site_url());
					    exit;
					}
				}
				
				wp_die("Something went wrong. Please try again.");
				
				exit;
			}
		}

	}
	
	public function login_footer() {
			
		if(get_option("web3_nft_login_enable")) {
			web3_nft_login_public_modal();
		} 
		
	}
	
	public function login_widget() {
			
		return web3_nft_login_public_widget();
		
	}
	
	public function opensea_embed($atts) {
			
		return web3_nft_login_opensea_embed($atts);
		
	}

}
