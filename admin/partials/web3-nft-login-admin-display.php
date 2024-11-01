<?php


	require('web3-nft-login-login-settings.php');
	
	function web3_nft_admin_display() {
		
		$currenttab = "home";
		if(isset($_GET['tab']))
			$currenttab = sanitize_text_field($_GET['tab']);
		if(empty($currenttab)) {
			$currenttab = "home";
		}
		
		echo '<style>#wpcontent {padding-left: 0px;}
		.privacy-settings-tabs-wrapper {grid-template-columns: 1fr 1fr 1fr !important;}
		.w3nft-card { position: relative; min-width: 255px; max-width: 520px; border: 1px solid #c3c4c7; background: #fff; box-sizing: border-box; }
		.w3nft-postbox-container {float: left;}</style>
		<div class="privacy-settings-header">
			<nav class="privacy-settings-tabs-wrapper hide-if-no-js" aria-label="Secondary menu">
				<a href="?page=web3_nft_login" class="privacy-settings-tab';
					if($currenttab == 'home') echo ' active'; echo '" aria-current="true">Login Settings</a>
				<!--<a href="?page=web3_nft_login&tab=smart-contracts" class="privacy-settings-tab';
					if($currenttab == 'smart-contracts') echo ' active'; echo '" >Smart Contracts</a>-->
				<a href="?page=web3_nft_login&tab=embed" class="privacy-settings-tab';
					if($currenttab == 'embed') echo ' active'; echo '" >Opensea NFT Embed</a>
				<a href="?page=web3_nft_login&tab=shortcode" class="privacy-settings-tab';
					if($currenttab == 'shortcode') echo ' active'; echo '" >Shortcode</a>
			</nav>
			<div style="font-size: 15px; padding-top: 10px; display: inline-block; float: right; padding-right: 60px"><b>Email us: </b> <a href="mailto:support@securebit.co">support@securebit.co</a></div>
		</div>';
		if($currenttab == 'home')
			web3_nft_login_settings();
		else if($currenttab == 'shortcode')
			web3_nft_login_shortcode();
		else if($currenttab == 'embed')
			web3_nft_login_opensea_embed_ui();
		
		
	}
	
	
	
	
?>