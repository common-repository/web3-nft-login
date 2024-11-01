<?php

	
	function web3_nft_login_settings() {
		
		if(isset($_POST['web3_nft_login_settings'])){
			
			if(isset($_POST['web3_nft_login_enable']))
				update_option('web3_nft_login_enable', true);
			else
				update_option('web3_nft_login_enable', false);
			
			$login_button_label = "";
			if(isset($_POST['login_button_label'])) $login_button_label = sanitize_text_field($_POST['login_button_label']);
			update_option('web3_nft_login_button_label', $login_button_label);
			
			$login_button_bgcolor = "";
			if(isset($_POST['login_button_bgcolor'])) $login_button_bgcolor = sanitize_text_field($_POST['login_button_bgcolor']);
			update_option('web3_nft_login_button_bgcolor', $login_button_bgcolor);
			
			$login_button_textcolor = "";
			if(isset($_POST['login_button_textcolor'])) $login_button_textcolor = sanitize_text_field($_POST['login_button_textcolor']);
			update_option('web3_nft_login_button_textcolor', $login_button_textcolor);
			
			echo "<div style='max-width:60%;color:black;margin:4px;background: #cdfbaa;padding: 5px 20px;border: 1px solid #b8d6a1;'>Login settings has been updated.</b></div>";
		}
			
		web3_nft_login_settings_view();
		web3_nft_login_settings_preview();
		
	}
	
	
	function web3_nft_login_settings_view() {
		
		$login_button_label = '';
		if(get_option("web3_nft_login_button_label")) {
			$login_button_label = get_option("web3_nft_login_button_label");
		}
		
		$login_button_bgcolor = '#135e96';
		if(get_option("web3_nft_login_button_bgcolor")) {
			$login_button_bgcolor = get_option("web3_nft_login_button_bgcolor");
		}
		
		$login_button_textcolor = '#fff';
		if(get_option("web3_nft_login_button_textcolor")) {
			$login_button_textcolor = get_option("web3_nft_login_button_textcolor");
		}
		
			
		echo '<div style="margin:10px;padding:10px 40px;max-width:850px" class="w3nft-card w3nft-postbox-container">
		<h3><br>Login Settings</h3>
		<hr>
		
		<form  method="POST" action="">
		<input type="hidden" name="web3_nft_login_settings" value="1"/>
		<input type="checkbox" ';
			if(get_option("web3_nft_login_enable")) echo 'checked'; 
		echo ' name="web3_nft_login_enable"> <b>Enable login </b> ( Turn on or off login with crypto on your WP login page) <br><br>
		<b>Button Label</b> ( what label do you want to use on login button)<br><br>
		<input type=text  name="login_button_label"  placeholder="e.g. Login with CryptoWallet" value="'.esc_html($login_button_label).'" style="min-width:750px;padding:5px;"><br><br>
		<b>Button Background : </b> <input type="color" name="login_button_bgcolor" value="'.esc_html($login_button_bgcolor).'"><br><br>
		<b>Button Text Color : </b> <input type="color" name="login_button_textcolor" value="'.esc_html($login_button_textcolor).'"><br><br>
		<br><input type="submit" class="button button-primary button-large" value="Save Settings"></form>
		
		
		<br><br><br>
		<b>Shortcode</b>
		<hr>
		<code>
		[web3_nft_login]
		</code>
		
		<br><br>
		<b>Shortcode (use in PHP code)</b>
		<hr>
		<code>
		&lt;?php echo do_shortcode("[web3_nft_login]"); ?&gt;
		</code>
		
		</div>';
			
	}
	
	
	function web3_nft_login_settings_preview(){
		
		$base_url = plugin_dir_url( __FILE__ );
		$base_url =  str_replace ("admin", "public", $base_url);
		wp_enqueue_script( 'web3-nft', $base_url . 'js/web3.min.js');
		wp_enqueue_script( 'web3-nft-modal', $base_url . 'js/web3modal.js');
		wp_enqueue_script( 'web3-nft-evmchains', $base_url . 'js/evmchains.js');
		wp_enqueue_script( 'web3-nft-walletconnect', $base_url . 'js/walletconnect.js');
		wp_enqueue_script( 'web3-nft-public', $base_url . 'js/web3-nft-login-public.js');
		
		
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
				document.querySelector("#web3-nft-test-wallet-address").innerHTML = "<span style=color:green><b>Test was successful.</b></span><br><br><b>Wallet Address:</b> "+address+"";
			  
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
		
		echo "<div class='w3nft-card w3nft-postbox-container' style='margin:10px;padding:10px 20px;max-width:280px'><h3><br>Preview & Test:</h3>Preview your button settings 
		and Test the cyrpto login below.<br><br><input type='button' style='width:100%;border-color:".esc_html($login_button_bgcolor).";background:".esc_html($login_button_bgcolor).";text-color:".esc_html($login_button_textcolor)."' class='button button-primary button-large' id='web3-nft-login-btn-connect' value='". esc_html($login_button_label). "' /><br><br><h4><br>Test Result :</h4><p id='web3-nft-test-wallet-address'>You have not performed the test yet.<br><br><br></p><br></div>";

	}
	
	
	
	function web3_nft_login_shortcode() {
		
		echo '<div style="margin:10px;padding:10px 40px;min-width:1050px" class="w3nft-card w3nft-postbox-container">
		<b>Shortcode</b>
		<hr>
		<code>
		[web3_nft_login]
		</code>
		
		<br><br><br>
		<b>Shortcode (use in PHP code)</b>
		<hr>
		<code>
		&lt;?php echo do_shortcode("[web3_nft_login]"); ?&gt;
		</code>
		
		</div>';
			
	}
	
	function web3_nft_login_opensea_embed_ui() {
		
		echo '<div style="margin:10px;padding:10px 40px;min-width:1050px" class="w3nft-card w3nft-postbox-container">
		
		<h3>Embed OpenSea NFT</h3>
		<b>Contract Address : </b> (NFT Collection Contract Address)
		<br><input type="text" id="contractaddress" placeholder="eg. 0xc143bbfcdbdbed6d454803804752a064a622c1f3" style="min-width:550px"><br><br>
		<b>TokenID : </b> (NFT Token ID)
		<br><input type="text" id="tokenid" placeholder="eg. 258" style="min-width:550px;"><br><br>
		<input type="button" value="Generate embed code" class="button button-primary button-large" id="generatecode" />
		<br/><br/>
		
		
		<div id="embededcode">
		
		</div>
		
		</div>
		
		<script>
			document.getElementById("generatecode").onclick = function(){
				document.getElementById("embededcode").innerHTML = \'<h3>Embed code <small>(Copy code below to embed NFT)</small></h3><hr><b>Shortcode</b><br><code>[opensea contractAddress="\' + document.getElementById("contractaddress").value + \'" tokenid="\' + document.getElementById("tokenid").value + \'"]</code><br><br><br><b>Shortcode (use in PHP code)</b><br><code>&lt;?php echo do_shortcode("[opensea contractAddress="\' + document.getElementById("contractaddress").value + \'" tokenid="\' + document.getElementById("tokenid").value + \'"]"); ?&gt;</code>\';
		
			}
		</script>
		
		';
			
	}
	
	
?>