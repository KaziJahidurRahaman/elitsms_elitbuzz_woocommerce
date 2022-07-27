<?php
/**
 * @package WC Elitsms
 */



//prevent direct entry
if(!defined('ABSPATH')){
    exit;
}

if(!class_exists('wc_elitsms_sms')){
    class wc_elitsms_sms{

//check the number
        private function getNumCheck($contact){
            $numbercheck=false;
            $contact_len=strlen($contact);
            //contact length is less then
            if($contact_len==11 || $contact_len==13 ||$contact_len==14 ){
                if($contact_len==11){
                    $prefix = substr($contact, 0, 2);
                    if($prefix=='01'){
                        $contact='+88'.$contact;
                        $numbercheck=true;
                    }
                }
                else if($contact_len==13) {
                    $prefix = substr($contact, 0, 3);
                    if ($prefix == '880') {
                        $numbercheck = true;
                    }
                }
                else if ($contact_len == 14) {
                    $prefix = substr($contact, 0, 4);
                    if ($prefix == '+880') {
                        $numbercheck = true;
                    }
                }
            }

            return $numbercheck;
        }

        private function elitsms_generateSms($contact,$msg){
            $checkcontact=$this->getNumCheck($contact);
            if($checkcontact==true) {
                $elitsms_settings = get_option('elitsms_settings');
                $senderid = $elitsms_settings['elitsms_senderid'];
                $apikey = $elitsms_settings['elitsms_apikey'];
                $url = $elitsms_settings['elitsms_sms_domain'];
                    
                $data = [
                    "api_key" => $apikey,
                    "type" => "text",
                    "contacts" => $contact,
                    "senderid" => $senderid,
                    "msg" => $msg];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);
            }
        }

        public function elitsms_sendsms_on_order($order_id ){
            $order = wc_get_order( $order_id );
            $firstname = $order->get_billing_first_name();
            $shopname= rawurldecode(get_option('blogname'));
            $phone=$order->get_billing_phone();
            $amount= $order->get_total().$order->get_currency();
            $elitsms_settings = get_option('elitsms_settings');
            $message =$elitsms_settings['elitsms_msg_on_order_placed'];

            //$template = "hello {{name}} world! {{abc}}\n";
            //echo $template;
            $data = [
                'orderid' => $order_id, 
                'customername' => $firstname,
                'shopname'=>$shopname,
                'amount'=> $amount,
            ];

            if (preg_match_all("/{{(.*?)}}/", $message, $m)) {
            foreach ($m[1] as $i => $varname) {
                $message = str_replace($m[0][$i], sprintf('%s', $data[$varname]), $message);
            }
            }
            // print_r($amount);



            //$message = $elitsms_settings['elitsms_sms_domain'];
            //print_r($message);
            $this->elitsms_generateSms($phone,$message);
        }

        public function elitsms_sendsms_on_order_status_change($order){
        	//echo "status changed";
            $order_id=$order;
            $order = wc_get_order( $order);
            $firstname = $order->get_billing_first_name();
            $shopname= rawurldecode(get_option('blogname'));
            $phone=$order->get_billing_phone();
            $order_status=ucwords($order->get_status()) ;
            $elitsms_settings = get_option('elitsms_settings');
            $amount= $order->get_total().$order->get_currency();

            $data = [
                'orderid' => $order_id, 
                'customername' => $firstname,
                'shopname'=>$shopname,
                'amount'=> $amount,
                'currstatus' => $order_status
            ];

            $message = $elitsms_settings['elitsms_msg_on_status_changed'];

            if (preg_match_all("/{{(.*?)}}/", $message, $m)) {
            foreach ($m[1] as $i => $varname) {
                $message = str_replace($m[0][$i], sprintf('%s', $data[$varname]), $message);
            }
            }

            //print_r($message);
            //echo $message;
            //print_r($message);
            $this->elitsms_generateSms($phone,$message);
        }
    }
}