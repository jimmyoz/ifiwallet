<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/Transaction.php');
use Web3p\EthereumTx\Transaction;
class Irc20 extends MY_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->model('ette_model');
            $this->load->model('ifi_coin_model');
            $this->rpc_url = $this->config->item('ifiRPC');
            $this->coin_name = "ifi";
            $this->coin_id = $this->config->item('ifi_coin_id');
            $this->chain_id = $this->config->item('ifi_chain_id');			
        }
        
        
        public function get_token_balance($address,$contract,$dec){
            if(substr($address,0,2)=="0x"){
                $address=substr($address,2);
            } 
            $funcSelector = "0x70a08231";
            $data = $funcSelector . "000000000000000000000000" . $address;
            $method  = "eth_call";
            $param1 = [
                "data"  => $data,
                "to"    =>  $contract
            ];
            $params  = [$param1,"latest"];
            $result = $this->call($method,$params);
            return (hexdec($result)/$dec);
        }

        public function get_nonce($address) {
            $method  = "eth_getTransactionCount";
            $param = [$address,"latest"];
            $result = $this->call($method,$param);
            if(is_array($result)){
                exit("\r\n error when getting nonce \r\n");
            }
            $count = hexdec($result);
            return $count;
        }
        
          public function send_ifi()
        {
            $to = $_GET['address'];
            $amount = isset($_GET['amount'])?$_GET['amount'] : 9;
            $from = $this->config->item("ifiPayAccount");
            $fromPri = decrypt($this->config->item("encrypted_ifi_wallet"));
            $contract = $this->config->item("ifi_contract_address");
          //$tx_res = $this->send_token($this->add_random($amount),$from,$fromPri,$contract,$to);
          //echo "\r\n send ifi sucessfully with tx hash : ".$tx_res."\r\n";
		   $tx_res="";		
       			
	     $tx_res = $this->send_token(dechex($amount),$from,$fromPri,$contract,$to);   //$this->add_random($amount)
	     if(gettype($tx_res)=="array")
	    {
	    echo "\r\n send ifi failed ,cause : ".json_encode($tx_res,true)."\r\n";      		
	    }
	    else
		{
        echo "\r\n send ifi sucessfully with tx hash : ".$tx_res."\r\n";
			
	     }
        }

        public  function printTime($dt)
        {
             $year=getdate($dt)['year'];
             $month=getdate($dt)['mon'];
             $day=getdate($dt)['mday'];

             $hour=getdate($dt)['hours'];
             $min=getdate($dt)['minutes'];
             $second=getdate($dt)['seconds'];

             echo sprintf("%d-%d-%d %d:%d:%d\n",$year,$month,$day,$hour,$min,$second);
        }
		
        public function posturl($url,$params)
       {		
        $data  = json_encode($params);   
         //echo $data;		
        $headerArray =array("Content-type:application/json;charset='utf-8'","Accept:application/json");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return json_decode($output,true);
        }
		
	    function getLogPath() 
		{
            $path='/var/log/voyager_log/';	
            $logPath=$path.'voyager_'.date('Y_m_d_H_i_s').'.log';			
            if ($handle = opendir(realpath($path))) { 
            $filenames=array();		
            while (false !== ($file = readdir($handle))) {    
                if ($file === '.' || $file === '..') {    
                    continue;    
                }
                $this_file = $path . '/' . $file;
                if (is_file($this_file)) {
					array_push($filenames,$file);
                }
            }
            closedir($handle);
            $len=count($filenames);	
            			
			if($len>0)
			{ 
		    $temp=$filenames[0];
			for($i=0;$i<$len;$i++)
			{
				if(strcmp($filenames[$i],$temp)>0)
				{
					$temp=$filenames[$i];
				}
			}
			if(filesize($path.$temp)<=200*1024*1024)
			{ 	
			$logPath=$path.$temp;
			}	
			}						
        }
	//	echo $logPath;
		return $logPath; 
    }
		public function saveLog1($data)
		{    
			$logPath=$this->getLogPath();		
			saveLog($data,$logPath);
		}
		
            public function computeAward()
           {        
		            $flag=false;
                    $res=array("resCode"=>"-1","errorMsg"=>"","transactionHash"=>"","amount"=>0);
                    if(isset($_GET['idCode'])){ 
                     $idCode=$_GET['idCode'];
					 
					 $url="http://116.63.82.233:8086/apiKey/checkDeviceId";
					 $params=array("Id"=>$idCode,"apiKey"=>"4af0653b48e511eca704fa163e796a24");
					 $rs=$this->posturl($url,$params);
					
					 if(isset($rs)){
					   if(is_array($rs)){
						 // echo json_encode($rs)."\r\n";
						if($rs["code"]==0){ 
					       $flag=true;
						}					
					   }
                      }
				   }
				   else
				   {
					   $res['errorMsg']=" error,you did not send the idCode";
                       echo json_encode($res);
                       return;
				   }
				    
                  if(!$flag)
                  { 
                      $res['errorMsg']=" error,the idCode that you sent is illegal";
                       echo json_encode($res);
                       return;
                  }  

                   if(isset($_GET['address']))
                   { 
                      $address=$_GET['address'];
                   }
                  else
                  { 
                      $res['errorMsg']=" error,you did not send the address";
                       echo json_encode($res);
                          return;
                  }
                     
                         
                   if(isset($_GET['today']))
                   { 
                      $td=strtotime($_GET['today']);
                   }
                  else
                  { 
                    $res['errorMsg']=" error,you did not send the time";
                    echo json_encode($res);
                    return;
                  }  
                        
                  $year=getdate($td)['year'];
                  $month=getdate($td)['mon'];
                  $day=getdate($td)['mday'];

                  $tdate=strtotime(sprintf("%d-%d-%d 00:00:00",$year,$month,$day)); 
                  $mdate=strtotime(sprintf("%d-%d-1 00:00:00",$year,$month));
                  $nmdate= strtotime(" +1 months ",$mdate);     
                   
                   $idCodes_record=array("idCode"=>$idCode,"last_date"=>sprintf("%d-%d-%d",$year,$month,$day));
                 
                 /*  if($this->ette_model->isSended($idCodes_record))
                    {
                    $res['errorMsg']=" error,you have send request today";
                    echo json_encode($res);
                    return;
                    }*/
 
                

                  $monthSeconds=$nmdate-$mdate;   
                  $baseIFI=1000000000000000000;   
                  $baseLineStorage=10000000000;
                  $baseLineBandwidth=10000000000;
                  $baseLineBandAudit=10000000000;

                  $weightStorage=0.3;
                  $weightBandwidth=0.3;
                  $weightAudits=0.4;

                  $weightAuditScore=0.3;
                  $weightSuspensionScore=0.3;
                  $weightOnlineScore=0.4;

                  $scoreStorage=0;
                  $scoreBandwidth=0;
                  $scoreAudits=0;

                  $auditScore=0;
                  $suspensionScore=0;
                  $onlineScore=0;
 
                  $totalScore=0;
                if(isset($_GET['sno'])) 
                 {                        
                   $sno=$_GET['sno'];
                   $snoJson=$sno;
                   $arr1=json_decode($snoJson,true);
                   $dynamicStorage = $arr1["diskSpace"]["used"];
                   $scoreStorage = ($dynamicStorage*1.00) / ($baseLineStorage*1.00) ;
                  if($scoreStorage>1.00) $scoreStorage=1.00;                              
                 }
                 else
                  {  
                      $res['errorMsg']= "error,you did not send sno";
                      echo json_encode($res);
                      return;
                 }

                 if(isset($_GET['satellites']))  
                  {  
                       $satellites=$_GET['satellites'];
                       $satellitesJson=$satellites;
                       $arr2=json_decode($satellitesJson,true);
                       $auditScore= $arr2["audits"][0]["auditScore"];
                       $suspensionScore= $arr2["audits"][0]["suspensionScore"];
                       $onlineScore= $arr2["audits"][0]["onlineScore"];                        
                       $scoreAudits=$auditScore*$weightAuditScore+$suspensionScore*$weightSuspensionScore+ $onlineScore*$weightOnlineScore;
                       if($scoreAudits>1.00)  $scoreAudits=1.00;
                       if(isset($arr2["bandwidthDaily"])){                      
                       $len=count($arr2["bandwidthDaily"]);
                       $temp1=array(); //dTotalBandwidth
                       $temp2=array(); //intervalStart
                       $tempLen=0;
                       $todayIndex=-1;
                       for($i=0;$i<$len;$i++)
                          {
                             $dt=strtotime($arr2["bandwidthDaily"][$i][ "intervalStart"]);
                             
                              $tempDate=$dt-$tdate;
                              $str=strval($tempDate);

                              if($tempDate>24*60*60)
                              {     
                                 contine;
                              }
                              else
                              {    
                                 if($str[0]=="-")
                                 {  
                                                                    
                                    $tempDate=$tempDate*(-1);
                                    if($tempDate<=24*60*60)
                                    {
                                     $dTotalBandwidth= $arr2["bandwidthDaily"][$i][ "egress"]["usage"]+$arr2["bandwidthDaily"][$i][ "ingress"]["usage"];
                                     $temp1[$tempLen]=  $dTotalBandwidth;
                                     $temp2[$tempLen]=$dt;
                                     $tempLen++;                                     
                                    }

                                 }
                                 else{
                                   
                                     $dTotalBandwidth= $arr2["bandwidthDaily"][$i][ "egress"]["usage"]+$arr2["bandwidthDaily"][$i]["ingress"]["usage"];
                                     $temp1[$tempLen]=  $dTotalBandwidth;
                                     $temp2[$tempLen]=$dt;
                                     $todayIndex=$tempLen;
                                     $tempLen++; 
                                     
                                     } 
                             }
                             
                         }
                       if($tempLen==2)
                       {                           
                       $scoreBandwidth=(($temp1[0] + $temp1[1])/2.00) * (($temp2[$todayIndex] - $mdate) / ($monthSeconds * 1.00)) / ($baseLineBandwidth * 1.00); 
                       }
                       if($tempLen==1)
                       {   
                       $scoreBandwidth=$temp1[0] * (($temp2[0]-$mdate) / ($monthSeconds*1.00)) / ($baseLineBandwidth * 1.00);   
                       }
                       if($scoreBandwidth > 1.00)  $scoreBandwidth = 1.00;
                   }
                   }
                  else
                  {
                    $res['errorMsg']= "error,you did not send satellites";
                    echo json_encode($res);
                    return; 

                  }  
                  $totalScore = $scoreStorage * $weightStorage + $scoreBandwidth * $weightBandwidth + $scoreAudits * $weightAudits;
             /*    // $amount=$totalScore * 1.00e+10;   
                  // echo $amount;
				  $amount=1.00e+10;
                                  
                               
                  $to =$address;//$arr1['nodeID'];                               
                  $from = $this->config->item("ifiPayAccount");
                  $fromPri = decrypt($this->config->item("encrypted_ifi_wallet"));
                  $contract = $this->config->item("ifi_contract_address"); 
                  $amount=base_convert($amount,10,16);
              //  echo $amount;$this->add_random($amount)
                  $tx_res="";
                  $tx_res =$this->send_token($amount,$from,$fromPri,$contract,$to);
                     
                  if($tx_res==""||$tx_res=='undefined')
                  {
                    $res['errorMsg'] = " transaction failure";
                    echo json_encode($res);
                    return; 
                  }
                  if(gettype($tx_res)=="array"){
                    $res['errorMsg']=json_encode($tx_res);
                    echo json_encode($res);
                    return; 
                   }
                  if(gettype($tx_res)=="string"){
                  if($tx_res.substr(0,2)=="0x"){
                  $res["resCode"]=200;
                  $res["transactionHash"]=$tx_res;
                  $res["amount"]=$amount;                                    
                  echo json_encode($res);
				  $_SESSION[$idCode]=sprintf("%d-%d-%d 00:00:00",$year,$month,$day);}
				  }
                  else
                  {
                   $res['errorMsg']=$tx_res;
                   echo json_encode($res);
                   return; 
                  }*/
				  
				  //$amount = isset($_GET['amount'])?$_GET['amount'] : 9;
           // echo "\r\n php received amount is ".$amount."\r\n";
		    $amount1=$totalScore;
		    $amount=$totalScore * $baseIFI;
            //if($amount==0.00) 
            if(!($amount>0))
			{   
		      $res['errorMsg']=" ifi award is 0";
		      echo json_encode($res);
			 // echo $_GET['sno']."\r\n";
			 // echo $_GET['satellites']."\r\n";
			if(isset($_GET['sno'])) $this->saveLog1($address. PHP_EOL .$_GET['sno']);
			if(isset($_GET['satellites'])) $this->saveLog1($address. PHP_EOL .$_GET['satellites']);
			  return;		
			}
              		
            $from =$this->config->item("ifiPayAccount");  
            $fromPri = decrypt($this->config->item("encrypted_ifi_wallet"));
            $contract = $this->config->item("ifi_contract_address");
            $to =$address;//2125a733ef848b6b885cc5f4df3dcf6a75';
           // echo "\r\n php received address is ".$to."\r\n";			
            $tx_res="";		
       			
	    // $tx_res = $this->send_token(dechex($amount),$from,$fromPri,$contract,$to);   //$this->add_random($amount)

             $succeeded=false;
             $isFirst=true;
             $nonce = $this->get_nonce($from);
             while(!$succeeded){            
            // if(!$isFirst) sleep(2);
            // $isFirst=false;
             $tx_res = $this->send_token1(dechex($amount),$from,$fromPri,$contract,$to,0,$nonce);
             if(!is_array($tx_res)&&!($tx_res=='')) $succeeded=true;
			 if(is_array($tx_res)) $this->saveLog1($address. PHP_EOL .json_encode($tx_res));
			 if($tx_res==''){ $this->saveLog1($address. PHP_EOL);}
             $nonce=$nonce+1;
            }
	    if(is_array($tx_res))
	    {
			$res['errorMsg']=json_encode($tx_res);			
		    echo json_encode($res);  		
	    }
	    else
		{
		 if($tx_res=='')
		 {
           $res['errorMsg']="Transaction failed for unknown reason";
		   echo json_encode($res);	
         }
         else{		 
        $res["resCode"]=200;
        $res["transactionHash"]=$tx_res;
        $res["amount"]=$amount1;                                    
       $this->ette_model->insert_update_idCodes($idCodes_record);
	   // $_SESSION[$idCode]=sprintf("%d-%d-%d 00:00:00",$year,$month,$day);

		$ifi_award_log_record=array("node_address"=>$to,"type"=>3,"from_account"=>$from,"ifi_amount"=>$amount,"timestamp"=>time(),"tx_hash"=>$tx_res);
		$this->ette_model->insert_ifi_award_log($ifi_award_log_record);
		echo json_encode($res);
		return;
		}
	    }              				  	
	    
		//$balance=$this->get_token_balance($to,$contract,1.00000);
		//echo  $to."'s balance is ".$balance;	
      }
        public function get_ifi()
        {
            $input_data = json_decode(trim(file_get_contents('php://input')), true);
            $owner_address = $input_data['owner_address'];
            $cpu_name = $input_data['cpu_name'];
            $cpu_score = $input_data['cpu_score'];
            $local_ip = $input_data['local_ip'];
            $data = array(
                'owner_address' =>  $owner_address,
                'cpu_name'    =>  $cpu_name,
                'cpu_score' =>  $cpu_score,
                'local_ip'  =>  $local_ip,
                'last_updated' => date('Y-m-d H:i:s')
            );
            $this->ette_model->set_node($data, $owner_address);
            // send ifi
            $from = $this->config->item("ifiPayAccount");
            $fromPri = decrypt($this->config->item("encrypted_ifi_wallet"));
            $contract = $this->config->item("ifi_contract_address");
            $ifi_amount = $this->add_random($cpu_score);
            //send ifi to 5 different account
            // $tx_res1 = $this->send_token($this->cal($ifi_amount,10,100),$from,$fromPri,$contract,$this->config->item("a_address"));
            // $tx_res2 = $this->send_token($this->cal($ifi_amount,5,100),$from,$fromPri,$contract,$this->config->item("b_address"));
            // $tx_res3 = $this->send_token($this->cal($ifi_amount,5,100),$from,$fromPri,$contract,$this->config->item("c_address"));
            // $tx_res4 = $this->send_token($this->cal($ifi_amount,20,100),$from,$fromPri,$contract,$this->config->item("d_address"));
        // $tx_res = $this->send_token($this->cal($ifi_amount,60,100),$from,$fromPri,$contract,$owner_address);


           
             $succeeded=false;
             $isFirst=true;
             $nonce = $this->get_nonce($from);
             while(!$succeeded){            
            // if(!$isFirst) sleep(2);
            // $isFirst=false;
             $tx_res = $this->send_token1($this->cal($ifi_amount,60,100),$from,$fromPri,$contract,$owner_address,0,$nonce);
             if(!is_array($tx_res)&&!($tx_res=='')) $succeeded=true;
			 if(is_array($tx_res)) $this->saveLog1($owner_address. PHP_EOL .json_encode($tx_res));
			 if($tx_res==''){ $this->saveLog1($owner_address. PHP_EOL);}
             $nonce=$nonce+1;
            }



            if(is_array($tx_res)){
                echo "\r\n send ifi failed with error : ".json_encode($tx_res,true)."\r\n";
            } else {
                $data = array(
                    'node_address'  =>  $owner_address,
                    'ifi_amount'    =>  base_convert($ifi_amount,16,10),
                    'timestamp'     =>  time(),
                    'from_account'  =>  $from,
                    'tx_hash'       =>  $tx_res
                );
                $this->ette_model->insert_award_log($data);
                echo "\r\n send ifi sucessfully with tx hash : ".$tx_res."\r\n";
            }
        }

        //store the incentive_reward in db
        public function set_incentive_reward()
        {
            $input_data = json_decode(trim(file_get_contents('php://input')), true);
            $owner_address = $input_data['owner_address'];
            $ifi_amount = $input_data['ifi_amount'];
            $tx_res = $input_data['tx_res'];
            $from_account = $input_data['from_account'];

            $data = array(
                'node_address'  =>  $owner_address,
                'ifi_amount'    =>  $ifi_amount,
                'timestamp'     =>  time(),
                'from_account'  =>  $from_account,
                'type'          =>  1,
                'tx_hash'       =>  $tx_res
            );
            $this->ette_model->insert_award_log($data);
            //send ifi to 4 different account
            $from = $this->config->item("ifiPayAccount");
            $fromPri = decrypt($this->config->item("encrypted_ifi_wallet"));
            $contract = $this->config->item("ifi_contract_address");
            // $tx_res1 = $this->send_token($this->cal($ifi_amount,10,100),$from,$fromPri,$contract,$this->config->item("a_address"));
            // $tx_res2 = $this->send_token($this->cal($ifi_amount,5,100),$from,$fromPri,$contract,$this->config->item("b_address"));
            // $tx_res3 = $this->send_token($this->cal($ifi_amount,5,100),$from,$fromPri,$contract,$this->config->item("c_address"));
            // $tx_res4 = $this->send_token($this->cal($ifi_amount,20,100),$from,$fromPri,$contract,$this->config->item("d_address"));
            echo "\r\n set incentive reward sucessfully\r\n";
        }

        public function register_node()
        {
            $input_data = json_decode(trim(file_get_contents('php://input')), true);
            $owner_address = $input_data['owner_address'];
            $chequebook_address = $input_data['chequebook_address'];
            $local_ip = $input_data['local_ip'];
            $data = array(
                'owner_address' =>  $owner_address,
                'chequebook_address'    =>  $chequebook_address,
                'local_ip'  =>  $local_ip,
                'last_updated' => date('Y-m-d H:i:s')
            );
            $data1 = array(
                'owner_address' =>  $owner_address,
                'chequebook_address'    =>  $chequebook_address,
                'local_ip'  =>  $local_ip,
                'startup_time' => date('Y-m-d H:i:s')
            );
            $this->ette_model->set_node($data, $owner_address);
            $this->ette_model->insert_node_startup($data1);
            echo "\r\n register/update the node at the init \r\n";
        }

        

        private function add_random($amount)
        {
            $dec_amount = base_convert($amount,16,10);
            $new_dec = $dec_amount*(rand(0,20)+100)/100;
            return base_convert($new_dec,10,16);
        }

    public function test()
    {
        $res = $this->send_token(
        "9a6df3aabc",
        "0x0Ab100518367dba7470fE5B2b403387972d453B4",
        "a2df2ce01d913148bab1aa95d32049227d325db58a0396ae36f88fd1baecd02a",
        "0x4D2f63d6826603B84D12C1C7dd33aB7F3BDe7553",
        "0xbed13479c186003fdf2dfc932c3467e7e4431a0e"
        );
        echo "\r\n res : ".$res."\r\n";
    }    

    private function cal($amount,$time,$mul){
        $amt_dec = base_convert($amount,16,10);
        $to_dec = $amt_dec*$time/$mul;
        $to_hex = base_convert($to_dec,10,16);
        return $to_hex;
    }

    private function send_token($amount, $from, $privateKey, $contract, $to, $type = 0)
    {

        if (substr($to, 0, 2) == "0x") {
            $to = substr($to, 2);
        }
        $funcSelector = "0xa9059cbb";
        // $amt_hex = base_convert($amount,10,16);
        $amt_hex = $amount;
        $data = $funcSelector . "000000000000000000000000" . $to;

        if (substr($amt_hex, 0, 2) == "0x") {
            $amt_hex = substr($amt_hex, 2);
        }
        $len = strlen($amt_hex);
        $amt_val = "";
        $i = 0;
        while ($i < 64 - $len) {
            $amt_val .= "0";
            $i++;
        }
        $amt_val .= $amt_hex;
        $data .= $amt_val;
        // $gas = '0x' . dechex(193334);
        $gas = '0x' . dechex(333334);
        $gasPrice = '0x' . dechex($this->config->item('gas_price'));
        if ($type == 1) {
            $gas = '0x' . dechex(93334);
        }
        $nonce = $this->get_nonce($from);
        $cnonce = '0x' . dechex($nonce);
        $param = [
            'nonce'     => $cnonce,
            'from'      => $from,
            'to'        => $contract,
            'gas'       => $gas,
            'gasPrice'  => $gasPrice,
            'data'      => $data,
            'chainId'   =>  $this->config->item('ifi_real_chain_id')
        ];
        $transaction = new Transaction($param);
        $signedTransaction = $transaction->sign($privateKey);
        $method  = "eth_sendRawTransaction";
        $params  = ["0x" . $signedTransaction];
        $out_arr = $this->call($method, $params);
        return $out_arr;
    }

        private function send_token1($amount, $from, $privateKey, $contract, $to, $type = 0,$nonce)
    {

        if (substr($to, 0, 2) == "0x") {
            $to = substr($to, 2);
        }
        $funcSelector = "0xa9059cbb";
        // $amt_hex = base_convert($amount,10,16);
        $amt_hex = $amount;
        $data = $funcSelector . "000000000000000000000000" . $to;

        if (substr($amt_hex, 0, 2) == "0x") {
            $amt_hex = substr($amt_hex, 2);
        }
        $len = strlen($amt_hex);
        $amt_val = "";
        $i = 0;
        while ($i < 64 - $len) {
            $amt_val .= "0";
            $i++;
        }
        $amt_val .= $amt_hex;
        $data .= $amt_val;
        // $gas = '0x' . dechex(193334);
        $gas = '0x' . dechex(333334);
        $gasPrice = '0x' . dechex($this->config->item('gas_price'));
        if ($type == 1) {
            $gas = '0x' . dechex(93334);
        }
       
        $cnonce = '0x' . dechex($nonce);
        $param = [
            'nonce'     => $cnonce,
            'from'      => $from,
            'to'        => $contract,
            'gas'       => $gas,
            'gasPrice'  => $gasPrice,
            'data'      => $data,
            'chainId'   =>  $this->config->item('ifi_real_chain_id')
        ];
        $transaction = new Transaction($param);
        $signedTransaction = $transaction->sign($privateKey);
        $method  = "eth_sendRawTransaction";
        $params  = ["0x" . $signedTransaction];
        $out_arr = $this->call($method, $params);
        return $out_arr;
    }
        
        private function toWei($value,$dec) {
            $float = 0;
            switch(intval($dec)){
                case 1:
                    $float = $value*(1.0E+1);
                    break;
                case 2:
                    $float = $value*(1.0E+2);
                    break;
                case 3:
                    $float = $value*(1.0E+3);
                    break;
                case 4:
                    $float = $value*(1.0E+4);
                    break;  
                case 5:
                    $float = $value*(1.0E+5);
                    break;
                case 6:
                    $float = $value*(1.0E+6);
                    break;
                case 7:
                    $float = $value*(1.0E+7);
                    break;
                case 8:
                    $float = $value*(1.0E+8);
                    break;
                case 9:
                    $float = $value*(1.0E+9);
                    break;
                case 10:
                    $float = $value*(1.0E+10);
                    break;
                case 11:
                    $float = $value*(1.0E+11);
                    break;
                case 12:
                    $float = $value*(1.0E+12);
                    break;  
                case 13:
                    $float = $value*(1.0E+13);
                    break;
                case 14:
                    $float = $value*(1.0E+14);
                    break;
                case 15:
                    $float = $value*(1.0E+15);
                    break;
                case 16:
                    $float = $value*(1.0E+16);
                    break; 
                case 17:
                    $float = $value*(1.0E+17);
                    break;
                case 18:
                    $float = $value*(1.0E+18);
                    break;
                default:
                    $float = $value*(1.0E+1);
                    break;
            }
            return number_format($float,0,'.','');
        }

}


