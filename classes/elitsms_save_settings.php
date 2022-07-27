<?php

/**
 * @package WC Elitsms
 */

//prevent direct entry
if(!defined('ABSPATH')){
    exit;
}

if(!class_exists('elitsms_save_setting') ){
    class elitsms_save_setting{
        public function elitsms_save_admin_settings(){
            check_admin_referer('elitsms_save_settings_fields_verify');
            if(!current_user_can('manage_options')){
                wp_die('Permission Denied ! You are not allowed to change settings.');
            }

            //var_dump($_POST);
            //die();
            $elitsms_apikey= sanitize_text_field($_POST['elitsms_apikey']);
            $elitsms_senderid= sanitize_text_field($_POST['elitsms_senderid']);
            $elitsms_sms_domain=esc_url_raw( $_POST['elitsms_sms_domain']);
            $elitsms_msg_on_order_placed=$_POST['elitsms_msg_order_place'];
            $elitsms_msg_on_status_changed=$_POST['elitsms_msg_order_status_change'];

            $settings_values= array(
                'elitsms_apikey'=>$elitsms_apikey,
                'elitsms_senderid'=>$elitsms_senderid,
                'elitsms_sms_domain'=>$elitsms_sms_domain,
                'elitsms_msg_on_order_placed'=>$elitsms_msg_on_order_placed,
                'elitsms_msg_on_status_changed'=>$elitsms_msg_on_status_changed

            );

            update_option('elitsms_settings', $settings_values);
            wp_redirect(get_admin_url().'admin.php?page=elitsms_settings&success='.urlencode('settings_saved'));
            exit();
            //die('printed');


/*
            'elitsms_label' 			=> 'ElitSMS',
						'elitsms_apikey' 		    => 'contact elitbuzz',
						'elitsms_senderid' 		    => 'contact elitbuzz',
						'elitsms_sms_domain' 	    => 'https://880sms.com/smsapi',*/


        }
    }
}




