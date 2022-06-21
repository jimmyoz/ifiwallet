<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$config['test_eth_private_key'] = "";
// Ethereum
$config['eth_coin_id'] = 3;
$config['accountPWD'] = "Guand0ng";
$config['ethPayAccount'] = "0x0c6c7f6f84b48c5c75f38cb9ee999a255ac6d179";
$config['ETHreserveKeystore'] = "0c6c7f6f84b48c5c75f38cb9ee999a255ac6d179";
$config['ETHkeystorePath'] = "/var/www/nodes/gethdata/keystore";
$config['ETHwithdrawTo'] = "0xB8e70C07C228ddA8DA6917ef1A6c933b6969f111";
$config['etherscanAPIkey'] = "E8BIV7PAYS46Q6MDK2ZD6IBQ37K6SWCP92";
// $config['eth_port'] = "8545";
$config['eth_port'] = "8546";
// $config['ethApiUrl'] = "https://api.etherscan.io/api?";
$config['ethApiUrl'] = "https://api-ropsten.etherscan.io/api?";
// $config['remoteRPC'] = "https://mainnet.infura.io/v3/c9629d5455d540789ac070eff7edb811";
$config['remoteRPC'] = "https://ropsten.infura.io/v3/c9629d5455d540789ac070eff7edb811";
// ERC20 TOKENS
$config['erc20_chain_id'] = 3;
// USDT Ethereum
$config['usdt_coin_id'] = 5;
// Encrypted hot wallet private key
$config['encrypted_eth_hot_wallet'] = "EoTpmS/CTYQerREONRcsrDgYnfufdrmaoIdJpQROdDLE+wz9AXM0P1C09snSjlCT5v5kBPQs7KcGD9qUC9gksQGytxBMXahKXjNaG1ZUw18=";
// ETH REAL CHAIN ID
// $config['eth_real_chain_id'] = 1;
$config['eth_real_chain_id'] = 3;

$config['gas_price'] = 19900000000;



