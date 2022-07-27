<?php
if(!defined('ABSPATH')){
    exit;
}

if(!function_exists('elitsms_create_setting_page_callback') ){
    function elitsms_create_setting_page_callback(){
        //echo "Checking settings ";
        ?>
        <html>
        <head>
            <title>WooCommerce ElitSMS Settings</title>
             <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        </head>
        <body style="background:#ffff8d">
            <div style="background:orange" >
                <table>
                    <tr>
                        <td><h1><?php _e('ElitSMS Panel Settings','sour');?></h1> </td>
                    </tr>
                </table>
            </div>

        <div id ="wpbody-content" aria-label="Main Content" tabindex="0">
            <div class="clear"></div>
            <div class="wrap">
                <?php
                if(isset($_GET['elitsms_save_error'])){
                    echo '<div style="background: #ff000061; padding: 11px 5px; border-radius: 6px; font-size: 15px;" class="sour_validation_msg">'
                        .urldecode( $_GET['elitsms_save_error'] ).'
                            </div>';
                }

                if(isset($_GET['elitsms_success'])){
                    echo '<div style="background:#00800063; padding: 11px 5px; border-radius: 6px; font-size: 15px;" class="sour_validation_msg">'
                        .urldecode( $_GET['elitsms_success'] ).
                        '</div>';
                }

                $elitsms_settings = get_option( 'elitsms_settings' );
                //var_dump($elitsms_settings);
                ?>

                <table class="form-table">
                    <tbody>
                    <form method="post" action="admin-post.php" novalidate="novalidate">

                        <input type="hidden" name="action" value="elitsms_save_settings_fields" />

                        <?php wp_nonce_field('elitsms_save_settings_fields_verify'); ?>
                        <tr>
                            <td>
                                <label for="elitsms_apikey">
                                    <?php echo _e('APIKEY','ELITSMS') ;?>
                                </label>
                            </td>

                            <td>
                                <input name="elitsms_apikey" id="elitsms_apikey" value="<?php
                                if( isset( $elitsms_settings['elitsms_apikey'] ) ){ echo $elitsms_settings['elitsms_apikey']; }
                                ?>" type="text">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="elitsms_senderid">
                                    <?php echo _e('SENDERID','ELITSMS') ;?>
                                </label>
                            </td>
                            <td>
                                <input name="elitsms_senderid" id="elitsms_senderid" value="<?php
                                if( isset( $elitsms_settings['elitsms_senderid'] ) ){ echo $elitsms_settings['elitsms_senderid']; }
                                ?>" type="text">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="elitsms_sms_domain">
                                    <?php echo _e('SMS Domain','ELITSMS') ;?>
                                </label>
                            </td>
                            <td>
                                <input name="elitsms_sms_domain" id="elitsms_sms_domain" value="<?php
                                if( isset( $elitsms_settings['elitsms_sms_domain'] ) ){ echo $elitsms_settings['elitsms_sms_domain']; }
                                ?>" type="text">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="msg_order_place">
                                    <?php echo _e('Message on Order Placed','ELITSMS') ;?>
                                </label>
                            </td>
                            <td>
                                <textarea name="elitsms_msg_order_place" id="elitsms_msg_order_place" cols="100"><?php
                                        if( isset( $elitsms_settings['elitsms_msg_on_order_placed'] ) ){ echo $elitsms_settings['elitsms_msg_on_order_placed']; }
                                ?></textarea>
                                <ul class="list-inline"><li><a href="#" data-toggle="tooltip" data-placement="top" title="Use the following keywords for inserting the corresponding values in your message. Customer Name = {{customername}}. Shop Name= {{shopname}}. Order ID= {{orderid}}. Amount= {{amount}}. Current Order Status= {{currstatus}}.">Note</a></li>
                                </ul>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <label for="msg_order_status_change">
                                    <?php echo _e('Message on Order Status Change','ELITSMS') ;?>
                                </label>
                            </td>
                            <td>
                                <textarea name="elitsms_msg_order_status_change" id="elitsms_msg_order_status_change" cols="100"><?php
                                        if( isset( $elitsms_settings['elitsms_msg_on_status_changed'] ) ){ echo $elitsms_settings['elitsms_msg_on_status_changed']; }
                                ?></textarea>
                                <ul class="list-inline"><li><a href="#" data-toggle="tooltip" data-placement="top" title="Use the following keywords for inserting the corresponding values in your message. Customer Name = {{customername}}. Shop Name= {{shopname}}. Order ID= {{orderid}}. Amount= {{amount}}. Current Order Status= {{currstatus}}.">Note</a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button name="save" class="button-primary" type="submit" value="<?php _e('Save Changes', 'ELITSMS'); ?>">Save changes</button>
                            </td>
                        </tr>
                    </form>
                    </tbody>

                </table>
            </div>
            <div class="clear"></div>
             <script>
                $(document).ready(function(){
                  $('[data-toggle="tooltip"]').tooltip();   
                });
            </script>
            </div>
        <span>
            <center>
                <h1>POWERED BY ELITBUZZ TECHNOLOGIES BD</h1>
                <img align="middle" src="<?php echo ELITSMS_URI.'/views/Elitbuzz.png' ?>">
                <h5>© Elitbuzz Technologies BD 2021</h5>
            </center>
        </span>
        </body>
        </html>

<?php
    }
}
?>

