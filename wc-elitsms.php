<?php
/**
 * @package Woocommerce Elitbuzz SMS Plugin
 */
/*
Plugin Name:  Elitsms
Plugin URI: https://elitbuzz-bd.com
Description:  Send SMS on order placing
Version: 1.0.0
Author: Elitbuzz Technologies BD
Author URI: https://elitbuzz-bd.com
License: GPLv2 or later
Text Domain: ELITSMS
*/

//preventing direct access
if ( !function_exists( 'add_action' ) ) {
	echo 'Error Code 404! Content Not Found or Forbidden.';
	exit;
}

//wp version check
if(version_compare(get_bloginfo('version'), '5.0', '<')){
    $message="Please update your wordpress version. Or contact the developer";
    die($message);
}

//setting path constants
define( 'ELITSMS_PATH', plugin_dir_path(__FILE__)   );
//echo ELITSMS_PATH;
define( 'ELITSMS_URI', plugin_dir_url( __FILE__ )   );
//echo ELITSMS_URI;
//check if woocommerce exists
if(in_array('woocommerce/woocommerce.php',
apply_filters('active_plugins', get_option('active_plugins') ) ) ) {
    if(!class_exists('ELITSMS_core')){
        class ELITSMS_core{
            public function __construct(){

    			// * Include Files
                require(ELITSMS_PATH.'/includes/activation.php');
                require(ELITSMS_PATH.'/views/admin/settings_page.php');


                // *INCLUDE CLASSES
                require(ELITSMS_PATH.'/classes/elitsms_setting_page.php');
                require(ELITSMS_PATH.'/classes/elitsms_save_settings.php');
                require(ELITSMS_PATH.'/classes/wc_elitsms_sms.php');

                // *INCLUDE HOOKS
    			register_activation_hook(__FILE__,'elitsms_activation');
    			add_action('admin_menu',array(new elitsms_setting_page(),'elitsms_create_setting_page'));
                add_action( 'admin_post_elitsms_save_settings_fields', array( new elitsms_save_setting(), 'elitsms_save_admin_settings'  ) );
                add_action('woocommerce_thankyou',array(new wc_elitsms_sms(), 'elitsms_sendsms_on_order') ,99, 1);
                add_action( 'woocommerce_order_status_changed', array(new wc_elitsms_sms(), 'elitsms_sendsms_on_order_status_change') ,50, 1);
            }
        }
        $elitsms = new ELITSMS_Core();
    }

}

