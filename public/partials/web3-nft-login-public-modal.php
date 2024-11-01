<?php


	function web3_nft_login_public_modal(){
		
		
		wp_enqueue_script( 'web3-nft', plugin_dir_url( __FILE__ ) . 'js/web3.min.js');
		wp_enqueue_script( 'web3-nft-modal', plugin_dir_url( __FILE__ ) . 'js/web3modal.js');
		wp_enqueue_script( 'web3-nft-evmchains', plugin_dir_url( __FILE__ ) . 'js/evmchains.js');
		wp_enqueue_script( 'web3-nft-walletconnect', plugin_dir_url( __FILE__ ) . 'js/walletconnect.js');
		wp_enqueue_script( 'web3-nft-public', plugin_dir_url( __FILE__ ) . 'js/web3-nft-login-public.js');
		
		$nonce = wp_create_nonce("web3-nft-sign");
		
		echo '<script>async function fetchAccountData() {

			  // Get a Web3 instance for the wallet
			  const web3 = new Web3(provider);

			  // Get connected chain id from Ethereum node
			  const chainId = await web3.eth.getChainId();
			  // Load chain information over an HTTP API
			  //const chainData = await EvmChains.getChain(chainId);
			  //document.querySelector("#network-name").textContent = chainData.name;

			  // Get list of accounts of the connected wallet
			  const accounts = await web3.eth.getAccounts();

			  // MetaMask does not give you all accounts, only the selected account
			  selectedAccount = accounts[0];

				let address = selectedAccount;
				web3.eth.personal.sign(web3.utils.utf8ToHex("'.$nonce.'"),address,"'.$nonce.'").then(async (signature) => {
					console.log(signature);
					window.location = "'.get_site_url().'?action=web3_login&signature="+signature+"&nonce='.$nonce.'";
				});
			  

			}</script>';
		if(get_option("web3_nft_login_button_label")) {
			$login_button_label = get_option("web3_nft_login_button_label");
		} else
			$login_button_label = "Login with CryptoWallet";
		
		$login_button_bgcolor = '#135e96';
		if(get_option("web3_nft_login_button_bgcolor")) {
			$login_button_bgcolor = get_option("web3_nft_login_button_bgcolor");
		}
		
		$login_button_textcolor = '#fff';
		if(get_option("web3_nft_login_button_textcolor")) {
			$login_button_textcolor = get_option("web3_nft_login_button_textcolor");
		}
		
		?>
		<script>
			
			let innerHTML="<p><br><br><input type='button' style='width:100%;border-color:<?php echo esc_html($login_button_bgcolor);?>;background:<?php echo esc_html($login_button_bgcolor)?>;color:<?php echo esc_html($login_button_textcolor);?>' class='button button-primary button-large' id='web3-nft-login-btn-connect' value='<?php echo esc_html($login_button_label);?>' /></p>";
				document.getElementById("loginform").innerHTML=document.getElementById("loginform").innerHTML+innerHTML;
						
		</script>
	<?php
		
	}
	
	
	
	function web3_nft_login_public_widget(){

		if ( is_user_logged_in() ) {
			return "";
		}
		
		wp_enqueue_script( 'web3-nft', plugin_dir_url( __FILE__ ) . 'js/web3.min.js');
		wp_enqueue_script( 'web3-nft-modal', plugin_dir_url( __FILE__ ) . 'js/web3modal.js');
		wp_enqueue_script( 'web3-nft-evmchains', plugin_dir_url( __FILE__ ) . 'js/evmchains.js');
		wp_enqueue_script( 'web3-nft-walletconnect', plugin_dir_url( __FILE__ ) . 'js/walletconnect.js');
		wp_enqueue_script( 'web3-nft-public', plugin_dir_url( __FILE__ ) . 'js/web3-nft-login-public.js');
		
		$nonce = wp_create_nonce("web3-nft-sign");
		
		$content = '<script>async function fetchAccountData() {

			  // Get a Web3 instance for the wallet
			  const web3 = new Web3(provider);

			  // Get connected chain id from Ethereum node
			  const chainId = await web3.eth.getChainId();
			  // Load chain information over an HTTP API
			  //const chainData = await EvmChains.getChain(chainId);
			  //document.querySelector("#network-name").textContent = chainData.name;

			  // Get list of accounts of the connected wallet
			  const accounts = await web3.eth.getAccounts();

			  // MetaMask does not give you all accounts, only the selected account
			  selectedAccount = accounts[0];

				let address = selectedAccount;
				web3.eth.personal.sign(web3.utils.utf8ToHex("'.$nonce.'"),address,"'.$nonce.'").then(async (signature) => {
					console.log(signature);
					window.location = "'.get_site_url().'?action=web3_login&signature="+signature+"&nonce='.$nonce.'";
				});
			  

			}</script>';
		if(get_option("web3_nft_login_button_label")) {
			$login_button_label = get_option("web3_nft_login_button_label");
		} else
			$login_button_label = "Login with CryptoWallet";
		
		$login_button_bgcolor = '#135e96';
		if(get_option("web3_nft_login_button_bgcolor")) {
			$login_button_bgcolor = get_option("web3_nft_login_button_bgcolor");
		}
		
		$login_button_textcolor = '#fff';
		if(get_option("web3_nft_login_button_textcolor")) {
			$login_button_textcolor = get_option("web3_nft_login_button_textcolor");
		}
		
		$content .= "<p><br><br><input type='button' style='width:100%;border-color:". esc_html($login_button_bgcolor).";background:".esc_html($login_button_bgcolor).";color:".esc_html($login_button_textcolor)."' class='button button-primary button-large' id='web3-nft-login-btn-connect' value='".esc_html($login_button_label)."' /></p>";
		return $content;
	}
	
	
	function web3_nft_login_opensea_embed($atts) {
		
		if(isset($atts['contractaddress']) && isset($atts['tokenid'])) {
			return '<nft-card contractAddress="'.$atts['contractaddress'].'" tokenId="'.$atts['tokenid'].'"> </nft-card> 
				<script src="https://unpkg.com/embeddable-nfts/dist/nft-card.min.js"></script>';
		}
		else 
			return "Invalid shortcode.";
	}
	
	