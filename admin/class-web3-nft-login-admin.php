<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://securebit.co
 * @since      1.0.0
 *
 * @package    Web3_Nft_Login
 * @subpackage Web3_Nft_Login/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Web3_Nft_Login
 * @subpackage Web3_Nft_Login/admin
 * @author     SecureBit <support@securebit.co>
 */

 require('partials/web3-nft-login-admin-display.php');
 
 class Web3_Nft_Login_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/web3-nft-login-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/web3-nft-login-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	
	public function web3_nft_login_admin_menu(){
		
		$parent = 'users.php';
		
		$addmenuforrole = 'administrator';
		

		$page = add_menu_page( 'Web3 NFT Login ' . __( 'Web3 NFT Login', 'web3_nft_login' ), 'Web3 Wallet login', $addmenuforrole, 'web3_nft_login', array( $this, 'web3_nft_login' ) , dirname(plugin_dir_url(__FILE__)) . '/images/icon.png');
		
		//$page = add_submenu_page( 'web3_nft_login', 'Web3 NFT Login ' . __('Menu 1'), __('Menu 1'), $addmenuforrole, 'web3_nft_login_menu1', array( $this,'web3_nft_login_menu1') );
				
		

	}
	
	
	function web3_nft_login(){
		
		web3_nft_admin_display();
		
	}
	
	
	function web3_nft_login_menu1() {
		
	}

}
