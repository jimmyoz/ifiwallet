<?php

class Bch_coin_model extends Coin_Model {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->coin_id=$this->config->item('bch_coin_id');
        $this->cold_wallet = "hcf_cold_wallet_bch";
        
    }
}
