<?php
/**
 * @package WC Elitsms
 */

//prevent direct entry
if(!defined('ABSPATH')){
    exit;
}

if(!class_exists('elitsms_setting_page') ){
    class elitsms_setting_page{
        public function elitsms_create_setting_page(){
            add_submenu_page(
                'woocommerce',__('ELitsms || Elitbuzz','ELITSMS'),
                __('ELitsms Settings','ELITSMS'),
                'manage_options',
                'elitsms_settings', 'elitsms_create_setting_page_callback'
            );
        }
    }

}
