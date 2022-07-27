<?php 
/**
 * @package WC Elitsms
 * 
 */

 
//prevent direct entry
if(!defined('ABSPATH')){
	exit;
}

if(!function_exists('elitsms_activation')){
	/**
	 * [elitsms_activation add setting option at the time of plugin activation]
	 * 
	 */
	function elitsms_activation (){

		//echo "Activation function is Working";

		//check if elitsms_settings option not found
		if(!get_option( 'elitsms_settings' )){

				add_option( 'elitsms_settings', array(
						'elitsms_label' 						=> 'ElitSMS',
						'elitsms_apikey' 		    			=> 'contact elitbuzz',
						'elitsms_senderid' 		    			=> 'contact elitbuzz',
						'elitsms_sms_domain' 	    			=> 'https://880sms.com/smsapi',
						'elitsms_msg_on_order_placed' 	    	=> 'https://880sms.com/smsapi',
						'elitsms_msg_on_status_changed' 	    => 'https://880sms.com/smsapi',
				));
		}
	}
}