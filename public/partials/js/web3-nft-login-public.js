"use strict";

/**
 * Example JavaScript code that interacts with the page and Web3 wallets
 */

 // Unpkg imports
const Web3Modal = window.Web3Modal.default;
const WalletConnectProvider = window.WalletConnectProvider.default;
const EvmChains = window.EvmChains;
//const Fortmatic = window.Fortmatic;

// Web3modal instance
let web3Modal

// Chosen wallet provider given by the dialog window
let provider;


// Address of the selected account
let selectedAccount;


/**
 * Setup the orchestra
 */
function Web3_Nft_Login_init() {

  // Tell Web3modal what providers we have available.
  // Built-in web browser provider (only one can exist as a time)
  // like MetaMask, Brave or Opera is added automatically by Web3modal
  const providerOptions = {
    walletconnect: {
      package: WalletConnectProvider,
      options: {
        infuraId: "8043bb2cf99347b1bfadfb233c5325c0",
      }
    },

    /*fortmatic: {
      package: Fortmatic,
      options: {
        key: ""
      }
    }*/
  };

  web3Modal = new Web3Modal({
    cacheProvider: false, // optional
    providerOptions, // required
  });

}




/**
 * Fetch account data for UI when
 * - User switches accounts in wallet
 * - User switches networks in wallet
 * - User connects wallet initially
 */
async function refreshAccountData() {

  await fetchAccountData(provider);
}


/**
 * Connect wallet button pressed.
 */
async function Web3_Nft_Login_onConnect() {

  
  try {
    provider = await web3Modal.connect();
  } catch(e) {
    //console.log("Could not get a wallet connection", e);
    return;
  }

  // Subscribe to accounts change
  provider.on("accountsChanged", (accounts) => {
    fetchAccountData();
  });

  // Subscribe to chainId change
  provider.on("chainChanged", (chainId) => {
    fetchAccountData();
  });

  // Subscribe to networkId change
  provider.on("networkChanged", (networkId) => {
    fetchAccountData();
  });

  await refreshAccountData();
}


window.addEventListener('load', async () => {
  Web3_Nft_Login_init();
  document.querySelector("#web3-nft-login-btn-connect").addEventListener("click", Web3_Nft_Login_onConnect);
});
