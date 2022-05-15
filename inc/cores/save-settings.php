<?php
/**( [action] => sp_settings_action
 * [form_title] => contact us! 
 * [first_name] => john
 *  [last_name] => cena
 *  [admin_email_url] => admin@gmail.com 
 * [your_message] => [sp_setting_action] => 03f2438cb3 
 * [_wp_http_referer] => /new_plugin_test_site/wp-admin/admin.php?page=simple-contact-form 
 * [sp_setting_submit] => Save All Change )
*/
$_POST = array_map( 'stripslashes_deep', $_POST );

 
foreach($_POST as $key => $val ){
    // echo " key: ". $key;
    // echo " value ". $val;
    $val = sanitize_text_field($val);
    $$key = $val;
   
}
// $_POST['form_title'];
$ap_setting['form_title'] = $form_title;
$ap_setting['first_name'] = $first_name;
$ap_setting['last_name'] =  $last_name;
$ap_setting['admin_email_url'] = $admin_email_url;
$ap_setting['your_message'] = $your_message;
$ap_setting['submit_your_message'] = $submit_your_message;
/**
 * filter option array saved in database
 */
$update_option_check = update_option('ap_setting',$ap_setting);

wp_redirect(admin_url().'admin.php?page=simple-contact-form');
exit;