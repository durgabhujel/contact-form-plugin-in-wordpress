<?php
/**
 *  GET settings from DB
 */
global $ap_setting;
$ap_setting = $this->ap_setting;
// $from_required_fields = isset($ap_setting['from_required_fields'])?$ap_setting['from_required_fields']:array('post_title','post_content');
// print_r($ap_setting);
?>
<div class="simple_contact_form_wrapper wrap">
    <div class="simple_contact_from_heading">
      <h2>simple contact form settings</h2>
     <p>you can use this form using ['durga']</p>
        
    </div>
    <ul>
        <li> <a href="javascript:void(0" id="form-settings" class="ap-tabs-trigger"><?php echo "Form-setting" ?></a></li>
    </ul>

    <div class="meta-box-holder">
        <div id="optionsframeworks"class="post-box">
            <form  class="ap-settings-form" action="<?php echo admin_url().'admin-post.php'?>" method="post">
                <input type="hidden" name="action" value="sp_settings_action">
                <!-- <input type="hidden" name="taxonomy_reference" value="<?php // echo $ap_setting['taxonomy_reference'] ?>"> -->
                <?php
                
                /**
                 * for from setting
                 */
                include_once('boards/form-setting.php');

                wp_nonce_field('sp_settings_action', 'sp_setting_action');
                ?>
                <div id="options-frameworks-submit" class="sp-setting-submit">
                    <input type="submit" name="sp_setting_submit" value=" Save All Change">
                    <?php
                    // $nonce = wp_create_nonce('scf_restore_default_nonce');
                    /**
                     * 
                     */
                    ?>
                
                </div>
            </form>
        </div>
    </div>
</div>